<?php

/*
Plugin Name: Fakturabetalning
Description: En betalningsmodul för fakturaköp
Author: Elin, Annika, Yasmine
*/

if (!defined("ABSPATH")) {
    exit;
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    add_action('plugins_loaded', 'iths_add_payment_gateway');
    function iths_add_payment_gateway() {

        class WC_fakturabetalning_Payment_Gateway extends WC_Payment_Gateway {

            function __construct() {

                $this->id = "fakturabetalning-payments";
                $this->method_title = __("Fakturabetalning", "fakturabetalning");
                $this->method_description = __("En betalningsmodul för fakturaköp", "fakturabetalning");
                $this->title = $this->method_title;

                $this->icon = null;

                $this->has_fields = false;

                $this->init_form_fields();
                $this->init_settings();

                add_action('woocommerce_update_options_payment_gateways_' . $this->id, [$this, 'process_admin_options']);
            }

            function init_form_fields() {
                $this->form_fields = [
                    'enabled' => [
                        'title' => __('Aktivera/Avaktivera Gateway', 'fakturabetalning'),
                        'label' => __('Aktivera gateway', 'fakturabetalning'),
                        'type' => 'checkbox',
                        'default' => 'no'
                    ],
                ];
            }

            function process_payment($order_id)
            {
                global $woocommerce;

                $order = new WC_Order($order_id);

                $SSNumber = get_post_meta( $order_id, '_billing_wooccm11', true );

                //Luhn-algorithmen
                function is_valid_luhn($SSNumber) {
                  settype($SSNumber, 'string');
                  $sumTable = array(
                    array(0,1,2,3,4,5,6,7,8,9),
                    array(0,2,4,6,8,1,3,5,7,9));
                  $sum = 0;
                  $flip = 0;
                  for ($i = strlen($SSNumber) - 1; $i >= 0; $i--) {
                    $sum += $sumTable[$flip++ & 0x1][$SSNumber[$i]];
                  }
                  return $sum % 10 === 0;
                }

                if (is_valid_luhn($SSNumber)) {
                  return [
                      'result'   => 'success',
                      'redirect' => $this->get_return_url( $order ),
                  ];
                }
            }
        }

        add_filter('woocommerce_payment_gateways', 'iths_load_payment_gateway');
        function iths_load_payment_gateway($methods)
        {
            $methods[] = "WC_fakturabetalning_Payment_Gateway";
            return $methods;
        }
    }
}
?>
