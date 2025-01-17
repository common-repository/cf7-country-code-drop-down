<?php
/**
 *
 * @link              #
 * @since             1.0.0
 * @package           cf7-country-code-drop-down
 *
 * @wordpress-plugin
 * Plugin Name:       Country code drop down for CF7
 * Plugin URI:        #
 * Description:       Add country drop-down field for phone number. Required minimum version of PHP is 5.6 and Wordpress version 5.0.
 * Version:           1.0.4
 * Author:            MageINIC
 * Author URI:        #
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       cf7-country-code-drop-down
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
		exit;
}

define('CF7_CC_URL', plugin_dir_url(__FILE__));
define('CF7_CC_PUBLIC_URL', CF7_CC_URL . 'public/');

register_activation_hook( __FILE__, 'cf7_cc_activation' );

/**
 * Activation hook
 *
 * @since    		1.0.0
 * @param      	string    $plugin_name       	Country code drop down for cf7.
 * @param      	string    $version    				1.0.0.
 */

function cf7_cc_activation() {
	global $wp_version;

	$php_version = '5.6';
	$wordpress_version  = '5.0';

	if ( version_compare( PHP_VERSION, $php_version, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'Required version for PHP is %1$s. Please update your PHP version to activate this plugin.', 'cf7-country-code-drop-down' ),
				$php_version
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'cf7-country-code-drop-down' ) . '</a>'
		);
	}

	if ( version_compare( $wp_version, $wordpress_version, '<' ) ) {
		deactivate_plugins( basename( __FILE__ ) );
		wp_die(
			'<p>' .
			sprintf(
				__( 'Required version for WordPress is %1$s. Please update your WordPress version to activate this plugin.', 'cf7-country-code-drop-down' ),
				$wordpress_version
			)
			. '</p> <a href="' . admin_url( 'plugins.php' ) . '">' . __( 'go back', 'cf7-country-code-drop-down' ) . '</a>'
		);
	}
}

/**
 * Deactivation hook
 *
 * @since    		1.0.0
 * @param      	string    $plugin_name       	Country code drop down for cf7.
 * @param      	string    $version    				1.0.0.
 */
register_deactivation_hook( __FILE__, 'cf7_cc_deactivation' );
function cf7_cc_deactivation() {
  // Deactivation rules here
}


/**
 * Init hook
 *
 * @since    		1.0.0
 * @param      	string    $plugin_name       	Country code drop down for cf7.
 * @param      	string    $version    				1.0.0.
 */
add_action( 'init', 'cf7_cc_init' );
function cf7_cc_init() {
	include_once plugin_dir_path( __FILE__ ).'admin/admin_init.php';
	include_once plugin_dir_path( __FILE__ ).'public/cf7-cc-form-tag.php';
}