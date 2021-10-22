<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 * @author     wpArtisan <md.assaduzzaman.khan@gmail.com>
 */
class Really_Simple_XML_And_HTML_Sitemap_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'really-simple-xml-and-html-sitemap',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
