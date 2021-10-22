<?php


require get_template_directory() . '/include/custom_post.php';
require get_template_directory() . '/include/themesetup.php';
require get_template_directory() . '/include/enqueue_scripts.php';
require get_template_directory() . '/include/general_function.php';
require get_template_directory() . '/include/custom_image_size.php';

/*Admin Page : PDF Download list*/
require get_template_directory() . '/include/pdf_admin_list.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Fire AJAX action for both logged in and non-logged in users
add_action('wp_ajax_get_more_posts', 'get_more_posts');
add_action('wp_ajax_nopriv_get_more_posts', 'get_more_posts');