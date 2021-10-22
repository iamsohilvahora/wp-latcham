<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/admin
 * @author     wpArtisan <md.assaduzzaman.khan@gmail.com>
 */
class Really_Simple_XML_And_HTML_Sitemap_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	
	/**
	 * Custom post type array.
	 *
	 * @since    1.0.0
	 * @access   public static
	 * @var      array    $custom_post_types.
	 */
	public static $custom_post_types = array();
	
	/**
	 * All post types which generate default xml and html site map.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $quired_post_types.
	 */
	
	private $quired_post_types = array();
	
	/**
	 * Wordpress default post type.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $default_types.
	 */
	
	private $default_types = array(
		'page' => 'page',
		'post' => 'post',
	);

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Really_Simple_XML_And_HTML_Sitemap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Really_Simple_XML_And_HTML_Sitemap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/really-simple-xml-and-html-sitemap-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Really_Simple_XML_And_HTML_Sitemap_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Really_Simple_XML_And_HTML_Sitemap_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/really-simple-xml-and-html-sitemap-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Create Plugin Settings Page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function create_admin_menu() {

		add_menu_page(
			__( 'RSXH Sitemap Settings', 'really-simple-xml-and-html-sitemap' ),
			__( 'RSXH Sitemap Settings', 'really-simple-xml-and-html-sitemap' ),
			'manage_options',
			'rsxh-sitemap-settings',
			array($this, 'rsxh_sitemap_settings_function'),
			'dashicons-networking',
			'55.5'
		);

	}
	
	/**
	 * Plugin Settings Page Callback Function.
	 *
	 * @since    1.0.0
	 */
	public function rsxh_sitemap_settings_function() {
		include REALLY_SIMPLE_XML_AND_HTML_SITEMAP_DIR . 'admin/templates/rsxh-sitemap-settings.php';
	}
	
	/**
	 * Get custom post type.
	 *
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function load_custom_post_types() {

		// Get the CPT (Custom Post Type)
		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		$post_types = get_post_types( $args, 'names' );
		
		if( !empty( $post_types ) ){
			self::$custom_post_types = $post_types;
		}
	}
	
	/**
	 * Create all post types publish action to generate xml sitemap.
	 *
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function create_post_type_publish_action() {

		$all_post_types = array_merge( $this->default_types, self::$custom_post_types );
	
		$rsxh_exclude_post_type = get_option( 'rsxh-exclude-post-type' );
		
		if( !empty( $rsxh_exclude_post_type ) ){
			
			$all_post_type_names = array_keys( $all_post_types );
			
			$result = array_diff( $all_post_type_names, $rsxh_exclude_post_type );
			
			$this->quired_post_types = $result;

			foreach( $result as $post_type_name ):
				add_action( 'publish_'.$post_type_name, array( $this, 'xml_sitemap' ) );
			endforeach;
		}else{
			
			$all_post_type_names = array_keys( $all_post_types );
			
			$this->quired_post_types = $all_post_type_names;
			
			foreach( $all_post_type_names as $post_type_name ):
				add_action( 'publish_'.$post_type_name, array( $this, 'xml_sitemap' ) );
			endforeach;
		}
	}
	
	/**
	 * Create XML Sitemap on publish_$post-type action.
	 *
	 * @since     1.0.0
	 * @return    null
	 */
	public function xml_sitemap() {
		
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		$rsxh_exclude_pages = get_option( 'rsxh-exclude-pages' );
		$rsxh_exclude_pcpt_posts = get_option( 'rsxh-exclude-pcpt-posts' );
		
		$exclude_ids = ( $rsxh_exclude_pages ? $rsxh_exclude_pages : '' );
		
		if( !empty(	$rsxh_exclude_pcpt_posts ) ): 
			$exclude_pcptids = explode( ',', $rsxh_exclude_pcpt_posts );
		else:
			$exclude_pcptids = array();
		endif;
		
		foreach ( $this->quired_post_types as $pty_name ) :
		
			if( $pty_name === 'page' ):
				$args = array(
					'sort_order' => 'desc',
					'sort_column' => 'post_modified',
					'hierarchical' => 1,
					'exclude' => ''.$exclude_ids.'',
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
					'orderby'     => 'modified',
					'order'       => 'DESC',
					'exclude'     => $exclude_pcptids,
					'post_type'   => ''.$pty_name.'',
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
	}
	
	/**
	 * Create XML Sitemap when settings updated.
	 *
	 * @since     1.0.0
	 * @return    null
	 */

	public function generate_xml_sitemap_when_option_updated( $params = array() ) {
		
		$exclude_ids = '';
		
		$exclude_pcptids = array();
	
		if (!$this->is_settings_page()) return;

        if (!current_user_can("activate_plugins")) return;
		
		$all_post_types = array_merge( $this->default_types, self::$custom_post_types );
		
		$all_post_type_names = array_keys( $all_post_types );
		
		if ( isset( $params['exclude_post_type'] ) && !empty( $params['exclude_post_type'] ) ) {
			$all_post_type_names = array_diff( $all_post_type_names, $params['exclude_post_type'] );
		}
		
		if ( isset( $params['exclude_pages'] ) && !empty( $params['exclude_pages'] ) ) {
			$exclude_ids = $params['exclude_pages'];
		}
		
		if ( isset( $params['exclude_pcpt_posts'] ) && !empty( $params['exclude_pcpt_posts'] ) ) {
			$exclude_pcptids = explode( ',', $params['exclude_pcpt_posts'] );
		}
		
		if ( !empty( $all_post_type_names ) ) {
			
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			foreach ( $all_post_type_names as $pty_name ) :
				if( $pty_name === 'page' ):
					$args = array(
						'sort_order' => 'desc',
						'sort_column' => 'post_modified',
						'hierarchical' => 1,
						'exclude' => ''.$exclude_ids.'',
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
						'orderby' 	  => 'modified',
						'order'       => 'DESC',
						'exclude'     => $exclude_pcptids,
						'post_type'   => ''.$pty_name.'',
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
		}else{
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			$sitemap .= '</urlset>';

			$fp = fopen(ABSPATH . "sitemap.xml", 'w');
			fwrite($fp, $sitemap);
			fclose($fp);
		}
	}
	
	/**
	 * Create XML Sitemap with schedule event.
	 *
	 * @since     1.0.1
	 * @return    null
	 */

	public static function generate_sitemap_in_schedule_interval() {
		
		$rsxh_exclude_post_type = get_option( 'rsxh-exclude-post-type' );
		
		$rsxh_exclude_pages = get_option( 'rsxh-exclude-pages' );
		$rsxh_exclude_pcpt_posts = get_option( 'rsxh-exclude-pcpt-posts' );
		
		$exclude_ids = ( $rsxh_exclude_pages ? $rsxh_exclude_pages : '' );
		
		if( !empty(	$rsxh_exclude_pcpt_posts ) ): 
			$exclude_pcptids = explode( ',', $rsxh_exclude_pcpt_posts );
		else:
			$exclude_pcptids = array();
		endif;

		
		$default_args = array(
			'page' => 'page',
			'post' => 'post',
		);
		
		$args = array(
			'public'   => true,
			'_builtin' => false,
		);
		$custom_post_types = get_post_types( $args, 'names' );
		
		$all_post_types = array_merge( $default_args, $custom_post_types );
		
		if( !empty( $rsxh_exclude_post_type ) ){
			$all_post_type_names = array_keys( $all_post_types );
			$result = array_diff( $all_post_type_names, $rsxh_exclude_post_type );
			
		}else{
			$result = array_keys( $all_post_types );
			
		}
		
		if ( !empty( $result ) ) {
			
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

			foreach ( $result as $pty_name ) :
				if( $pty_name === 'page' ):
					$args = array(
						'sort_order' => 'desc',
						'sort_column' => 'post_modified',
						'hierarchical' => 1,
						'exclude' => ''.$exclude_ids.'',
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
						'orderby' 	  => 'modified',
						'order'       => 'DESC',
						'exclude'     => $exclude_pcptids,
						'post_type'   => ''.$pty_name.'',
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
		}else{
			$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
			$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			$sitemap .= '</urlset>';

			$fp = fopen(ABSPATH . "sitemap.xml", 'w');
			fwrite($fp, $sitemap);
			fclose($fp);
		}
	}
	
	/**
	 * Check to see if we are on the settings page
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 *
	 */
	public function is_settings_page() {
		if ( ! isset( $_SERVER['QUERY_STRING'] ) ) {
			return false;
		}
		parse_str( $_SERVER['QUERY_STRING'], $params );
		if ( strpos( $params["page"], 'rsxh-sitemap-settings' ) !== false ) {
			return true;
		}

		return false;
	}

}
