<?php 

/*
Plugin Name: Fakturabetalning
Description: En betalningsmodul för fakturaköp
Author: Elin, Annika, Yasmine
*/

if (!defined("ABSPATH")) {
    // Se till att inte filen laddas direkt
    exit;
}

// Verifiera att woocommerce är aktiverat
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Vänta tills plugin är laddade innan payment gatewayen skapas
    add_action('plugins_loaded', 'iths_add_payment_gateway');
    function iths_add_payment_gateway()
    {
        class WC_fakturabetalning_Payment_Gateway extends WC_Payment_Gateway
        {
            function __construct()
            {
                // Sätter upp basparametrarna för modulen
                $this->id = "fakturabetalning-payments";
                $this->method_title = __("Fakturabetalning", "fakturabetalning");
                $this->method_description = __("En betalningsmodul för fakturaköp", "fakturabetalning");
                $this->title = $this->method_title;

                $this->icon = null;
                // Vi behöver inga fält i checkouten
                $this->has_fields = false;

                // Initiera formulärsfält och inställningar
                $this->init_form_fields();
                $this->init_settings();

                // Ser till att inställningarna laddas in i $this->settings
                add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
            }

            function init_form_fields()
            {
                // Sätter upp de formulärsfält som behövs
                $this->form_fields = [
                    'enabled' => [
                        'title' => __('Aktivera/Avaktivera Gateway', 'fakturabetalning'),
                        'label' => __('Aktivera gateway', 'fakturabetalning'),
                        'type' => 'checkbox',
                        'default' => 'no'
                    ],
                    // 'accepted_name' => [
                    //     'title' => __('Godkänt namn', 'iths'),
                    //     'label' => __('Godkänt namn', 'iths'),
                    //     'type' => 'text'
                    // ]
                ];
            }

            // Hanterar "betalningen"
            function process_payment($order_id)
            {
                // Laddar in woocommerce-objektet
                // Detta behövs för att rensa varukorgen
                global $woocommerce;

                // Skapar ett orderobjekt från det givna IDt
                $order = new WC_Order($order_id);

                // Hämtar ut kundens "Billing First Name"
                $givenName = $order->get_billing_first_name();

                // Hämtar ut vårt konfigurerade godkända namn
                $acceptedName = $this->settings['accepted_name'];

                if (strtolower($givenName) == strtolower($acceptedName)) {
                    // Om namnen stämmer överens så lägger vi till en ny note, markerar ordern som betald och tömmer
                    // varukorgen
                    $order->add_order_note(__("Betalningen lyckades", "fakturabetalning"));
                    $order->payment_complete();
                    $woocommerce->cart->empty_cart();

                    return [
                        'result'   => 'success',
                        'redirect' => $this->get_return_url( $order ),
                    ];
                } else {
                    // Om namnen inste stämmer överens så lägger vi till en note att betalningen misslyckades. Vi
                    // visar även ett felmeddelande för kunden
                    $error = __("Betalningen misslyckades", "fakturabetalning");
                    wc_add_notice( $error, 'error' );
                    $order->add_order_note( 'Error: '. $error );
                }
            }
        }


        // Lägger till vår nyskapade gateway
        add_filter('woocommerce_payment_gateways', 'iths_load_payment_gateway');
        function iths_load_payment_gateway($methods)
        {
            $methods[] = "WC_fakturabetalning_Payment_Gateway";
            return $methods;
        }
    }
}
?>
