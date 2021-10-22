<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Really_Simple_XML_And_HTML_Sitemap
 * @subpackage Really_Simple_XML_And_HTML_Sitemap/public
 * @author     wpArtisan <md.assaduzzaman.khan@gmail.com>
 */
class Really_Simple_XML_And_HTML_Sitemap_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/really-simple-xml-and-html-sitemap-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/really-simple-xml-and-html-sitemap-public.js', array( 'jquery' ), $this->version, false );

	}
	
	/**
	 * Really simple XML and HTML sitemap shortcode list
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 *
	 */
	 
	public function register_shortcodes() {
		add_shortcode( 'rsxh_sitemap', array( $this, 'rsxh_sitemap_func' ) );
	}
	
	/**
	 * Really simple XML and HTML sitemap default shortcode
	 *
	 * @since  1.0.0
	 *
	 * @access public
	 *
	 */
	 
	public function rsxh_sitemap_func( $atts ) {

		$all_post_types = array_merge( $this->default_types, Really_Simple_XML_And_HTML_Sitemap_Admin::$custom_post_types );
	
		$rsxh_exclude_post_type = get_option( 'rsxh-exclude-post-type' );
		
		if( !empty( $rsxh_exclude_post_type ) ){
			
			$all_post_type_names = array_keys( $all_post_types );
			
			$post_types = array_diff( $all_post_type_names, $rsxh_exclude_post_type );
			
		}else{
			
			$post_types = array_keys( $all_post_types );
			
		}
		
		$post_types = implode( ',', $post_types );
		
		$rsxh_exclude_pages = get_option( 'rsxh-exclude-pages' );
		$rsxh_exclude_pcpt_posts = get_option( 'rsxh-exclude-pcpt-posts' );
		
		$exclude_pageids = ( $rsxh_exclude_pages ? $rsxh_exclude_pages : '' );
		
		$exclude_pcptids = ( $rsxh_exclude_pcpt_posts ? $rsxh_exclude_pcpt_posts : '' );

		$params = shortcode_atts( array(
			'post_types' => $post_types,
			'exclude_pages' => $exclude_pageids,
			'exclude_post_and_custom_post_type_posts' => $exclude_pcptids,
		), $atts );
		
		ob_start();
		
		if( !empty( $params ) ):
			$output = '';
			if( !empty( $params['post_types'] ) ):
				$post_types = explode( ',', $params['post_types'] );
				foreach ( $post_types as $pty_name ) :
					if( $pty_name === 'page' ):
						$args = array(
							'exclude' => ''.$params['exclude_pages'].'',
							//'title_li' => '',
						);
						$output .= wp_list_pages($args);
					else:
						$exclude_pcptids = explode( ',', $params['exclude_post_and_custom_post_type_posts'] );
						$args = array(
							'numberposts' => -1,
							'orderby'     => 'modified',
							'order'       => 'DESC',
							'exclude'     => $exclude_pcptids,
							'post_type'   => ''.$pty_name.'',
						);
						$postsForSitemap = get_posts($args); 

						if( !empty(	$postsForSitemap ) ){
							$output .= '<li class="'.$pty_name.'nav">'.ucfirst($pty_name);
							$output .= '<ul class="'.$pty_name.'">';
					
							foreach($postsForSitemap as $post) {
								setup_postdata($post);
								
								$output .= '<li><a href="'.get_permalink($post->ID).'">'.get_the_title($post->ID).'</a></li>';
							}
							$output .= '</ul>';
							$output .= '</li>';
						}
					endif;
				endforeach;
			endif;
		endif;
		$output .= ob_get_clean();
		return $output;
		
	}

}
