<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/includes
 * @author     wpArtisan <md.assaduzzaman.khan@gmail.com>
 */
class Really_Simple_XML_And_HTML_Sitemap_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		
		add_option( 'rsxh-exclude-post-type' );
		
		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		$post_types = get_post_types( $args, 'names' );
		
		$default_types = array(
			'page' => 'page',
			'post' => 'post',
		);
		$all_post_types = array_merge( $default_types, $post_types );
		
		$all_post_type_names = array_keys( $all_post_types );
		
		$all_post_type_names = apply_filters( 'all_post_type_names', $all_post_type_names );
		
		if ( !empty( $all_post_type_names ) ) {
			
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			foreach ( $all_post_type_names as $pty_name ) :
				
				if( $pty_name === 'page' ):
					$args = array(
						'sort_order' => 'desc',
						'sort_column' => 'post_modified',
						'hierarchical' => 1,
						'exclude' => '',
						'include' => '',
						'meta_key' => '',
						'meta_value' => '',
						'authors' => '',
						'child_of' => 0,
						'parent' => -1,
						'exclude_tree' => '',
						'number' => '',
						'offset' => 0,
						'post_type' => ''.$pty_name.'',
						'post_status' => 'publish'
					); 
					$postsForSitemap = get_pages($args); 
				else:
					$args = array(
						'numberposts' => -1,
						'orderby' => 'modified',
						'order'    => 'DESC',
						'post_type'  => ''.$pty_name.'',
					);
					$postsForSitemap = get_posts($args); 
				endif;
				
				if( !empty(	$postsForSitemap ) ){
					foreach($postsForSitemap as $post) {
						setup_postdata($post);

						$postdate = explode(" ", $post->post_modified);

						$sitemap .= '<url>'.
							'<loc>'. get_permalink($post->ID) .'</loc>'.
							'<lastmod>'. $postdate[0] .'</lastmod>'.
							'<changefreq>monthly</changefreq>'.
						'</url>';
					}
				}
			endforeach;

			$sitemap .= '</urlset>';

			$fp = fopen(ABSPATH . "sitemap.xml", 'w');
			fwrite($fp, $sitemap);
			fclose($fp);
			
			/* since version 1.0.1 */ 
			
			if ( ! wp_next_scheduled ( 'sitemap_in_schedule_interval' ) ) {
				wp_schedule_event( time(), 'daily', 'sitemap_in_schedule_interval' );
			}
		}
	}

}
