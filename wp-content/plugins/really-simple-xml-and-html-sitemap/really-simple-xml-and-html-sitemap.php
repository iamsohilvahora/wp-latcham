<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wpartisan.net/
 * @since             1.0.0
 * @package           Really_Simple_XML_And_HTML_Sitemap
 *
 * @wordpress-plugin
 * Plugin Name:       Really Simple XML and HTML Sitemap
 * Plugin URI:        https://wordpress.org/plugins/really-simple-xml-and-html-sitemap
 * Description:       To add Sitemap on any posts, pages, use the shortcode [rsxh_sitemap] and it also generate a XML Sitemap which will placed on site root directory.This plugin will improve SEO.
 * Version:           1.0.2
 * Author:            wpArtisan
 * Author URI:        https://wpartisan.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       really-simple-xml-and-html-sitemap
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * 1.0.2
 */
define( 'REALLY_SIMPLE_XML_AND_HTML_SITEMAP_VERSION', '1.0.2' );

define( 'REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR', plugin_dir_path( __FILE__ ) );
define( 'REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-really-simple-xml-and-html-sitemap-activator.php
 */
function activate_really_simple_xml_and_html_sitemap() {
	require_once REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR . 'includes/class-really-simple-xml-and-html-sitemap-activator.php';
	Really_Simple_XML_And_HTML_Sitemap_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-really-simple-xml-and-html-sitemap-deactivator.php
 */
function deactivate_really_simple_xml_and_html_sitemap() {
	require_once REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR . 'includes/class-really-simple-xml-and-html-sitemap-deactivator.php';
	Really_Simple_XML_And_HTML_Sitemap_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_really_simple_xml_and_html_sitemap' );
register_deactivation_hook( __FILE__, 'deactivate_really_simple_xml_and_html_sitemap' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR . 'includes/class-really-simple-xml-and-html-sitemap.php';

/**
 * Add plugin page settings link.
 */

add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'rsxh_add_plugin_page_settings_link' );
function rsxh_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .admin_url( 'admin.php?page=rsxh-sitemap-settings' ) .'">' . __('Settings') . '</a>';
	return $links;
}


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_really_simple_xml_and_html_sitemap() {

	$plugin = new Really_Simple_XML_And_HTML_Sitemap();
	$plugin->run();
	
}
run_really_simple_xml_and_html_sitemap();
