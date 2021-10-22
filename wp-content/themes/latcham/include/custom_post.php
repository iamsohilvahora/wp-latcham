<?php
/* Global taxonomie add*/
function add_industry_taxonomies() {
    /* Create Industry Taxonomy */
    $args = array(
            'label' => __( 'Sector category' ),
            'rewrite' => array( 'slug' => 'industry-category' ),
            'hierarchical' => true,
        );

    register_taxonomy( 'industry-category', array('industry','post','solutions','service','resources','casestudy'), $args );
    /* Create Solutions Taxonomy */
    $args = array(
            'label' => __( 'Solutions category' ),
            'rewrite' => array( 'slug' => 'solutions-category' ),
            'hierarchical' => true,
        );

    register_taxonomy( 'solutions-category', array('industry','post','solutions','service','resources','casestudy'), $args );

}

add_action( 'init', 'add_industry_taxonomies', 0 );
/* Industry function*/
function industry_posttype() {
 
    register_post_type( 'industry',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Sectors' ),
                'singular_name' => __( 'industry' )
            ),
            'public' => true,
            'taxonomies' => array( 'Industry category'),
            'has_archive' => false,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'rewrite' => array('slug' => 'sectors'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'industry_posttype' );

/* Careers function*/

function careers_posttype() {
 
    register_post_type( 'careers',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Careers' ),
                'singular_name' => __( 'careers' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'rewrite' => array('slug' => 'careers'),
            'show_in_rest' => true,
 
        )
    );
     
    
}
// Hooking up our function to theme setup
add_action( 'init', 'careers_posttype' );

/* Service function*/

function service_posttype() {
 
    register_post_type( 'service',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Services' ),
                'singular_name' => __( 'service' )
            ),
            'public' => true,
            'has_archive' => false,
            'supports'            => array( 'title', 'editor' ),
            'rewrite' => array('slug' => 'services'),
            'show_in_rest' => true,
            'exclude_from_search' => true,
        )
    );
      /* Create Story Type Taxonomy */
    /*$args = array(
            'label' => __( 'Service category' ),
            'rewrite' => array( 'slug' => 'service-category' ),
            'hierarchical' => true,
        );

    register_taxonomy( 'service-category', 'service', $args );*/
    
}
// Hooking up our function to theme setup
add_action( 'init', 'service_posttype' );

/* Solutions function*/

function solutions_posttype() {
 
    register_post_type( 'solutions',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Solutions' ),
                'singular_name' => __( 'solutions' )
            ),
            'public' => true,
            'has_archive' => false,
            'supports'            => array( 'title','editor' ),
            'rewrite' => array('slug' => 'solutions'),
            'show_in_rest' => true,
 
        )
    );
     
    
}
// Hooking up our function to theme setup
add_action( 'init', 'solutions_posttype' );

/* Awards function*/

function awards_posttype() {
 
    register_post_type( 'awards',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Accreditation & awards' ),
                'singular_name' => __( 'awards' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports'            => array( 'title' ),
            'rewrite' => array('slug' => 'awards'),
            'show_in_rest' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
        )
    );
     
    
}
// Hooking up our function to theme setup
add_action( 'init', 'awards_posttype' );

/* Resources function*/

function resources_posttype() {
 
    register_post_type( 'resources',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Resources' ),
                'singular_name' => __( 'resources' )
            ),
            'public' => true,
            'has_archive' => false,
            'supports'            => array( 'title' ),
            'rewrite' => array('slug' => 'resources'),
            'show_in_rest' => true,
            'exclude_from_search' => true,
 
        )
    );
     
     /* Create Story Type Taxonomy */
    $args = array(
            'label' => __( 'Resources category' ),
            'rewrite' => array( 'slug' => 'resources-category' ),
            'hierarchical' => true,
        );

    register_taxonomy( 'resources-category', 'resources', $args );
}
// Hooking up our function to theme setup
add_action( 'init', 'resources_posttype' );

/* Team function*/
// Hooking up our function to theme setup
add_action( 'init', 'team_posttype' );
function team_posttype() {
 
    register_post_type( 'team',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Team' ),
                'singular_name' => __( 'team' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports'            => array( 'title' ),
            'rewrite' => array('slug' => 'team'),
            'show_in_rest' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
        )
    );
     
}
// Hooking up our function to theme setup
add_action( 'init', 'logo_posttype' );

/* Industry function*/
function logo_posttype() {
 
    register_post_type( 'logo',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Logo' ),
                'singular_name' => __( 'logo' )
            ),
            'public' => true,
            'taxonomies' => array(''),
            'has_archive' => false,
            'supports'            => array( 'title', ),
            'rewrite' => array('slug' => 'logo'),
            'show_in_rest' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
        )
    );
    /* Create logo Type Taxonomy */
    $args = array(
            'label' => __( 'Logo category' ),
            'rewrite' => array( 'slug' => 'logo-category' ),
            'hierarchical' => true,
        );

    register_taxonomy( 'logo-category', 'logo', $args );
    
}

/* CaseStudy function*/

function casestudy_posttype() {
 
    register_post_type( 'casestudy',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Case Study' ),
                'singular_name' => __( 'casestudy' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'rewrite' => array('slug' => 'casestudy'),
            'show_in_rest' => true,
 
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'casestudy_posttype' );