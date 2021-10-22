<?php

/**
 * Fired during plugin deactivation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 * @author     wpArtisan <md.assaduzzaman.khan@gmail.com>
 */
class Really_Simple_XML_And_HTML_Sitemap_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option( 'rsxh-exclude-post-type' );
		delete_option( 'rsxh-exclude-pages' );
		delete_option( 'rsxh-exclude-pcpt-posts' );
		unlink(ABSPATH . "sitemap.xml");
		
		/* since version 1.0.1 */ 
		
		wp_clear_scheduled_hook( 'sitemap_in_schedule_interval' );
	}

}
