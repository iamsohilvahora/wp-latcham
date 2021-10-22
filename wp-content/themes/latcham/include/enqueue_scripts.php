<?php
/**
 * Enqueue scripts and styles.
 */
function latcham_scripts() {

    wp_enqueue_style( 'latcham-fa', get_template_directory_uri().'/css/all.min.css' );
    wp_enqueue_style( 'latcham-slick', get_template_directory_uri().'/css/slick.css' );
    wp_enqueue_style( 'latcham-bs', get_template_directory_uri().'/css/bootstrap.min.css' );
    wp_enqueue_style( 'latcham-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'latcham-style', 'rtl', 'replace' );
    wp_enqueue_style( 'latcham-media', get_template_directory_uri().'/css/responsive.css' );

    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'latcham-popper', get_template_directory_uri().'/js/popper.min.js');
    wp_enqueue_script( 'latcham-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js');
    wp_enqueue_script( 'latcham-slick', get_template_directory_uri().'/js/slick.min.js');
    wp_enqueue_script( 'latcham-player', get_template_directory_uri().'/js/player.js');
    wp_enqueue_script( 'latcham-custom', get_template_directory_uri().'/js/custom.js');
    wp_localize_script( 'latcham-custom', "post_list_admin_URL_NAME",  post_list_admin_URL()); 
    //For jQuery-AJAX

    //wp_enqueue_script( 'latcham-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

    wp_localize_script( 'latcham-custom', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),'post_id' => get_the_ID())); 
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'latcham_scripts' );


//Admin-ajax

function post_list_admin_URL(){ 
        $MyTemplatepath = get_template_directory_uri(); 
        $MyHomepath = esc_url( home_url( '/' )); 
        $admin_URL = admin_url( 'admin-ajax.php' ); // Your File Path
        return array(
            'admin_URL' =>  $admin_URL,
            'MyTemplatepath' =>  $MyTemplatepath,
            'MyHomepath' =>  $MyHomepath
        );

}