<?php
/*
Plugin Name: Leverans med bud
Plugin URI:
Description: Plugin för leveranssätt med bud
Author: Annika, Yasmine, Elin
Version: 1.0
Author URI: 
*/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	function your_shipping_method_init() {
		if ( ! class_exists( 'WC_home_delivery_custom_shipping' ) ) {
			class WC_home_delivery_custom_shipping extends WC_Shipping_Method {
				/**
				 * Constructor for your shipping class
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {
                    $this->id                 = "custom"; 
                    $this->method_title       = __( 'Custom Shipping', 'custom' );  
                    $this->method_description = __( 'Custom Shipping Method', 'custom' ); 
 
                    $this->init();
 
                    $this->enabled = isset( $this->settings['enabled'] ) ? $this->settings['enabled'] : 'yes';
                }
				/**
				 * Init your settings
				 *
				 * @access public
				 * @return void
				 */
                function init() {
                    // Load the settings API
                    $this->init_form_fields(); 
                    $this->init_settings(); 
 
                    // Save settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }
				function init_form_fields() {
                    $this->form_fields = array(
 
                        'enabled' => array(
                             'title' => __( 'Home delivery', 'custom' ),
                             'type' => 'checkbox',
                             'description' => __( 'Enable this shipping method', 'custom' ),
                             'default' => 'yes'
                             ),
                        'price' => array(
                           'title' => __( 'Price', 'price' ),
                             'type' => 'number',
                             'description' => __( 'Price for home delivery', 'price' ),
                             'default' => 100
                             ),
                        );
                }
				/**
				 * calculate_shipping function.
				 *
				 * @access public
				 * @param mixed $package
				 * @return void
				 */
				public function calculate_shipping( $package = array() ) {
                    
                    $cost = isset( $this->settings['price'] ) ? $this->settings['price'] : 100;
                        if ($cost) {
                            $rate = array(
                                'id' => $this->id,
                                'label' => 'Home delivery',
                                'cost' => $cost,
                                'calc_tax' => 'per_order'
                            );
                            $this->add_rate( $rate );
                        }else {
                            $rate = array(
                                'id' => $this->id,
                                'label' => 'Home delivery',
                                'cost' => 100,
                                'calc_tax' => 'per_order'
                            );
                            $this->add_rate( $rate );
                        }
        
				}
			}
		}
	}
    add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );
    
	function add_your_shipping_method( $methods ) {
		$methods['WC_home_delivery_custom_shipping'] = 'WC_home_delivery_custom_shipping';
		return $methods;
	}
	add_filter( 'woocommerce_shipping_methods', 'add_your_shipping_method' );
}