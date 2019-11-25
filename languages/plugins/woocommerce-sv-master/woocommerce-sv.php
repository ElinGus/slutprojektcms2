<?php
/*
 * Plugin Name: WooCoomerce (sv)
 * Plugin URI: http://www.rasmuskjellberg.se/woocommerce-sv
 * Description: Aktiverar svensk översättning för WooCommerce.
 * Author: Rasmus Kjellberg
 * Author URI: https://www.rasmuskjellberg.se/
 * Text Domain: woocommerce_sv
 * Domain Path: /languages/
 * Version: 1.0
 * Requires at least: 3.0
 * License: GPL
 * GitHub URI: https://github.com/kjellberg/wp-woocommerce-sv
 * This is a fork from https://github.com/pronamic/wp-woocommerce-nl
*/


class WooCommerceSVPlugin {
	/**
	 * The current langauge
	 *
	 * @var string
	 */
	private $language;

	/**
	 * Flag for the swedish langauge, true if current langauge is swedish, false otherwise
	 *
	 * @var boolean
	 */
	private $is_swedish;

	////////////////////////////////////////////////////////////

	/**
	 * Bootstrap
	 */
	public function __construct( $file ) {
		$this->file = $file;

		// Filters and actions
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );

		add_filter( 'load_textdomain_mofile', array( $this, 'load_mo_file' ), 10, 2 );

		/*
		 * WooThemes/WooCommerce don't execute the load_plugin_textdomain() in the 'init'
		 * action, therefor we have to make sure this plugin will load first
		 *
		 * @see http://stv.whtly.com/2011/09/03/forcing-a-wordpress-plugin-to-be-loaded-before-all-other-plugins/
		 */
		add_action( 'activated_plugin',       array( $this, 'activated_plugin' ) );
	}

	////////////////////////////////////////////////////////////

	/**
	 * Activated plugin
	 */
	public function activated_plugin() {
		$path = plugin_basename( $this->file );

		if ( $plugins = get_option( 'active_plugins' ) ) {
			if ( $key = array_search( $path, $plugins ) ) {
				array_splice( $plugins, $key, 1 );
				array_unshift( $plugins, $path );

				update_option( 'active_plugins', $plugins );
			}
		}
	}

	////////////////////////////////////////////////////////////

	/**
	 * Plugins loaded
	 */
	public function plugins_loaded() {
		$rel_path = dirname( plugin_basename( $this->file ) ) . '/languages/';

		// Other
		$locale = apply_filters( 'plugin_locale', get_locale(), 'woocommerce' );
		$dir    = plugin_dir_path( __FILE__ );

		if ( is_admin() ) {
			load_textdomain( 'woocommerce', $dir . 'languages/woocommerce/admin-' . $locale . '.mo' );
		}

		load_textdomain( 'woocommerce', $dir . 'languages/woocommerce/' . $locale . '.mo' );
	}

	////////////////////////////////////////////////////////////

	/**
	 * Load text domain MO file
	 *
	 * @param string $moFile
	 * @param string $domain
	 */
	public function load_mo_file( $mo_file, $domain ) {

		if ( $this->language == null ) {
			$this->language = get_locale();
			$this->is_swedish = ( $this->language == 'sv' || $this->language == 'sv_SE' );
		}

		// The ICL_LANGUAGE_CODE constant is defined from an plugin, so this constant
		// is not always defined in the first 'load_textdomain_mofile' filter call
		if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
			$this->is_swedish = ( ICL_LANGUAGE_CODE == 'sv' );
		}

		return $mo_file;
	}
}

global $woocommerce_sv_plugin;

$woocommerce_sv_plugin = new WooCommerceSVPlugin( __FILE__ );
