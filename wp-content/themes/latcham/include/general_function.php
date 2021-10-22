<?php 
// General Settings Menu Tab And Setting Function
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'General Settings',
    'menu_title'  => 'General Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));  
}
function latcham_external_link($link = null, $target = null)
{
  if(empty($link)){
    return;
  }
  $href_link = null;
  if(!empty($link) && $link != null){
    if($link == '#' ){
      $href_link = $link;
      $target = '';
    } else {
      $url =  trim($link);
      if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $href_link= "http://" . $url;
      } else {
        $href_link = trim($link);
      }
    }
  }
  if ($target == true){
    return 'href="'.$href_link.'" target="_blank"';
  }else{
    return 'href="'.$href_link.'"';
  }
}

//video function start 
function video_url($url){
    $type = videoType($url);
    if($type == "youtube"){
    $vidUrlID = parse_youtube($url);
    $vidUrl = "https://www.youtube.com/embed/".$vidUrlID;
  } else if($type == "vimeo"){ 
        $vidUrlID = parse_vimeo($url);
        $vidUrl = "https://player.vimeo.com/video/".$vidUrlID;        
  } else { 
    $vidUrl = $url;   
  }
  return $vidUrl;
}
function videoType($url) {
    if (strpos($url, 'youtube') > 0) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo') > 0) {
    return 'vimeo';
    }
}
function parse_youtube($link){

    $regexstr = '~
        # Match Youtube link and embed code
        (?:                             # Group to match embed codes
      (?:<iframe [^>]*src=")?     # If iframe match up to first quote of src
            |(?:                        # Group to match if older embed
                (?:<object .*>)?        # Match opening Object tag
                (?:<param .</param>)    # Match all param tags
                (?:<embed [^>]*src=")?  # Match embed tag to the first quote of src
            )?                          # End older embed code group
        )?                              # End embed code groups
    
        (?:                             # Group youtube url
      https?:\/\/                 # Either http or https
            (?:[\w]+\.)*                # Optional subdomains
            (?:                         # Group host alternatives.
        youtu\.be/              # Either youtu.be,
        | youtube\.com          # or youtube.com
        | youtube-nocookie\.com # or youtube-nocookie.com
            )                           # End Host Group
      (?:\S*[^\w\-\s])?           # Extra stuff up to VIDEO_ID
            ([\w\-]{11})                # $1: VIDEO_ID is numeric
            [^\s]*                      # Not a space
        )                               # End group
        "?                              # Match end quote if part of src
        (?:[^>]*>)?                     # Match any extra stuff up to close brace
        (?:                             # Group to match last embed code
            </iframe>                   # Match the end of the iframe
            |</embed></object>          # or Match the end of the older embed
        )?                              # End Group of last bit of embed code
        ~ix';
        preg_match($regexstr, $link, $matches);
        return $matches[1];
    
}

function parse_vimeo($link){
  $regexstr = '~
    # Match Vimeo link and embed code
    (?:<iframe [^>]*src=")?     # If iframe match up to first quote of src
    (?:                         # Group vimeo url
      https?:\/\/             # Either http or https
      (?:[\w]+\.)*            # Optional subdomains
      vimeo\.com              # Match vimeo.com
      (?:[\/\w]*\/videos?)?   # Optional video sub directory this handles groups links also
      \/                      # Slash before Id
      ([0-9]+)                # $1: VIDEO_ID is numeric
      [^\s]*                  # Not a space
    )                           # End group
    "?                          # Match end quote if part of src
    (?:[^>]*></iframe>)?        # Match the end of the iframe
    (?:<p>.*</p>)?              # Match any title information stuff
    ~ix';

  preg_match($regexstr, $link, $matches);

  return $matches[1];
}
//video function end



remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'wp_generator');
function wpt_remove_version() {  
return '';  
}  
add_filter('the_generator', 'wpt_remove_version');

// Disable support for search
/*function fb_filter_query( $query, $error = true ) {
  if ( is_search() ) {
    $query->is_search = false;
    $query->query_vars[s] = false;
    $query->query[s] = false;
  
    // to error
    if ( $error == true ) {
      $query->is_404 = true;
    }
    }
}

add_action( 'parse_query', 'fb_filter_query' );
add_filter( 'get_search_form', create_function( '$a', "return null;" ) );*/


// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
  $post_types = get_post_types();
  foreach ($post_types as $post_type) {
    if(post_type_supports($post_type, 'comments')) {
      remove_post_type_support($post_type, 'comments');
      remove_post_type_support($post_type, 'trackbacks');
    }
  }
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
  return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);
// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
  $comments = array();
  return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);
// Remove comments page in menu
function df_disable_comments_admin_menu() {
  remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
  global $pagenow;
  if ($pagenow === 'edit-comments.php') {
    wp_redirect(admin_url()); exit;
  }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
  if (is_admin_bar_showing()) {
    remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
  }
}
add_action('init', 'df_disable_comments_admin_bar');

/*Add SVG support*/
function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

//Button Use for External/Internal Link option
function button_group($button = null, $class = null){ 
    $target = false;
    $link = "";

    if(empty($button))
    {
        return;
    }


    $internal_link = $button['button_internal_link'];
    $external_link = $button['button_external_link'];
    $category_link = $button['button_category_link'];
    $link_type = $button['button_link'];
    $button_label = $button['button_label'];

   
    
    if($link_type == 'button_internal_link' && !empty($internal_link)){
        $link = $internal_link;
    }elseif ($link_type == 'button_external_link' && !empty($external_link)) {
        $target = true;
        $link = $external_link;        
    }elseif ($link_type == 'button_category_link' && !empty($category_link)) {
        $link = $category_link;        
    }

    if(empty($button_label) OR empty($link))
    {
        return;
    }

    $href_link = null;
    
    if(!empty($link) && $link != null)
    {
        if($link == '#' )
        {
            $href_link = $link;
            $target = '';
        } 
        else
        {
            $url =  trim($link);
            if (!preg_match("~^(?:f|ht)tps?://~i", $url))
            {
                $href_link= "http://" . $url;
            }
            else
            {
                $href_link = trim($link);
            }
        }
    }
    if ($class != ''){
        $class = 'class="'.$class.'"';
     }
   if ($target == true)
    {
        return '<a href="'.$href_link.'" target="_blank" '.$class.'>'.$button_label.'</a>';
    }
    else
    {
        return '<a href="'.$href_link.'"'.$class.'>'.$button_label.'</a>';
    }
}

add_action('wp_ajax_get_home_content','get_home_content');
add_action('wp_ajax_nopriv_get_home_content','get_home_content');

// ===================================
// Get Template Part
// ===================================
    function bb_get_template_part($slug = null, $name = null, array $params = array()) {
        global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
        do_action("get_template_part_{$slug}", $slug, $name);
        $templates = array();
        if (isset($name))
            $templates[] = "{$slug}-{$name}.php";
            $templates[] = "{$slug}.php";
            $_template_file = locate_template($templates, false, false);
        if (is_array($wp_query->query_vars)) {
            extract($wp_query->query_vars, EXTR_SKIP);
        }
        extract($params, EXTR_SKIP);
        require($_template_file);
    }

// ===================================
//  Get Template part for ajax 
// ===================================
function bb_return_get_template_part($slug = null, $name = null, array $params = array()) {
    $slug=str_replace("//","/",$slug);
    global $wp_query;
    do_action("get_template_part_{$slug}", $slug, $name);
    $templates = array();
    if (isset($name))
        $templates[] = "{$slug}-{$name}.php";
        $templates[] = "{$slug}.php";
        $_template_file = locate_template($templates, false, false);
    if (is_array($wp_query->query_vars)) {
        extract($wp_query->query_vars, EXTR_SKIP);
    }
    extract($params, EXTR_SKIP);
    if(!empty($_template_file)){
        ob_start();
        include($_template_file);
        $var=ob_get_contents();
        ob_end_clean();
        return $var;
    }
}
add_action('wp_ajax_get_home_content','get_home_content');
add_action('wp_ajax_nopriv_get_home_content','get_home_content');

/* Ajax home page templete response*/
function get_home_content(){    
    $params['post_id'] = $_POST['post_id'];
    $result = bb_return_get_template_part( 'template-parts/'.$_POST['sectionTemplate'].'/content', $_POST['section'],$params ); 
    echo json_encode(array('result'=>$result,'counter' => $_POST['counter']));
    exit();
}

/* Load more service post*/
add_action('wp_ajax_get_service_more_posts' , 'get_service_more_posts');
add_action('wp_ajax_nopriv_get_service_more_posts','get_service_more_posts');
function get_service_more_posts(){ 
   $total_count = 0;
   $ppp=9;

    $args = array(
          'post_status' => 'publish',
          'post_type' => 'service',
          'posts_per_page' => $ppp,
          'order' => 'DESC',
         
      );
    if(isset($_POST['offset']) && !empty($_POST['offset'])) {
      $args['offset'] = $_POST['offset'];
    }
    if(!empty($_POST['industry_term']) && !empty($_POST['solutions_term']) && $_POST['solutions_term'] != "undefined" && $_POST['industry_term'] != "undefined"){
      $industry = array(
              'taxonomy' => 'industry-category',
              'field'    => 'term_id',
              'terms'    => $_POST['industry_term']
            );
      $solutions = array(
              'taxonomy' => 'solutions-category',
              'field'    => 'term_id',
              'terms'    => $_POST['solutions_term']
            );
      $args['tax_query'] = array($industry,$solutions); 
    }else if(!empty($_POST['industry_term']) && $_POST['industry_term'] != "undefined") {

      $industry = array(
              'taxonomy' => 'industry-category',
              'field'    => 'term_id',
              'terms'    => $_POST['industry_term']
            );
      $args['tax_query'] = array($industry); 
    }else if(!empty($_POST['solutions_term']) && $_POST['solutions_term'] != "undefined") {
       $solutions = array(
              'taxonomy' => 'solutions-category',
              'field'    => 'term_id',
              'terms'    => $_POST['solutions_term']
            );
       $args['tax_query'] = array($solutions); 
    }
   
  $result = array();
  $Media_query = new WP_Query($args);
  /*var_dump($args);
  var_dump($Media_query->request);*/
  $result['result'] = '';
   if( $Media_query->have_posts() ) 
      { 
        while ($Media_query->have_posts()) 
        {
          $Media_query->the_post();
          $params['post_id'] = get_the_ID();               
          $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'service-post-list',$params);
        }      
      }
    wp_reset_postdata();
    $result['offset'] = $ppp + $_POST['offset'];
    $result['total_post'] = $Media_query->found_posts;
    $result['query'] = $Media_query->request;
    echo json_encode($result);
    exit;
}

/* Load more News post*/
add_action('wp_ajax_get_news_more_posts' , 'get_news_more_posts');
add_action('wp_ajax_nopriv_get_news_more_posts','get_news_more_posts');
function get_news_more_posts(){ 
 $total_count = 0;
 $ppp=6;

  $args = array(
        'post_status' => 'publish',
        'post_type' => 'post',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  if(isset($_POST['news_term']) && !empty($_POST['news_term'])) {

    $args['tax_query'] = array(array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $_POST['news_term'],
            'include_children' => false
          ));
  }else{
    $args['cat'] = explode(',', $_POST['cat_ids']);
  }

 $result = array();

 $Media_query = new WP_Query($args);

 $result['result'] = '';
 if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $cat = get_the_category();
        $params['post_id'] = get_the_ID();
        if(isset($_POST['news_term'])){$params['term_id'] = $_POST['news_term'];}else{$params['term_id'] = $cat[0]->term_id;}
        
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'news-post',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;  
  echo json_encode($result);
  exit;
}

/* Load more Event post*/
add_action('wp_ajax_get_event_more_posts' , 'get_event_more_posts');
add_action('wp_ajax_nopriv_get_event_more_posts','get_event_more_posts');
function get_event_more_posts(){ 
   $total_count = 0;
   $ppp=7;

  $date_now = date('Y-m-d H:i:s');

    
    $args = array(
          'post_status' => 'publish',
          'post_type' => 'post',
          'order' => 'ASC',
          'orderby' => 'meta_value',
          'meta_key' => 'event_start_date'       
         
      );
    
    if(isset($_POST['event_term']) && !empty($_POST['event_term'])) {

      $args['tax_query'] = array(array(
              'taxonomy' => 'category',
              'field'    => 'term_id',
              'terms'    => $_POST['event_term'],
              'include_children' => false
            ));
    }else{
      $args['tax_query'] = array(array(
              'taxonomy' => 'category',
              'field'    => 'term_id',
              'terms'    => 5,
              'include_children' => false
            ));
    }
    if(isset($_POST['event_date']) && !empty($_POST['event_date'])) {
       $args['meta_query'] = array(      
                              array(
                                  'key'     => 'event_start_date',
                                  'compare' => '>=',
                                  'value'   => date('Y-m-d H:i:s',strtotime($_POST['event_date'].'-01')),
                                  'type'          => 'DATETIME',
                              ),
                               array(
                                  'key'     => 'event_start_date',
                                  'compare' => '<=',
                                  'value'   => date('Y-m-d H:i:s',strtotime($_POST['event_date'].'-31')),
                                  'type'          => 'DATETIME',
                              )        
      );
     
      }else{
        $args['meta_query'] = array(
            array(
                'key'           => 'event_start_date',
                'compare'       => '>',
                'value'         => $date_now,
                'type'          => 'DATETIME',
            )
          );
      }
  $total_Media_query = get_posts($args);
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
      $args['offset'] = $_POST['offset'];
    }
  $args['posts_per_page'] = $ppp; 
  $result = array();

  $Media_query = get_posts($args);

   if( $Media_query ) 
      { 
        if(isset($_POST['event_term'])){$params['term_id'] = $_POST['event_term'];}else{$params['term_id'] = 5;}
          
          
                $i=0; 
                foreach( $Media_query as $post ) { 

                $params['post'] = $post;
                if($i == 0 && $_POST['type'] == 'html'){
                    $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'event-latest-post',$params); 
                }else{
                    $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'event-post',$params); 
                }
            $i++;}        
          
      }
    //wp_reset_postdata();
    $result['offset'] = $ppp + $_POST['offset'];
    $result['total_post'] = count($total_Media_query); 
    //$result['query'] = $Media_query->request;
    echo json_encode($result);
    exit;
}

/* Load more award post*/

function title_filter($where, &$wp_query){
    global $wpdb;

    if($search_term = $wp_query->get( 'search_prod_title' )){
        /*using the esc_like() in here instead of other esc_sql()*/
        $search_term = $wpdb->esc_like($search_term);
        $search_term = '\'' . $search_term . '%\'';
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE '.$search_term;
    }

    return $where;
}
add_action('wp_ajax_get_award_more_posts' , 'get_award_more_posts');
add_action('wp_ajax_nopriv_get_award_more_posts','get_award_more_posts');
function get_award_more_posts(){ 
 $total_count = 0;
 $ppp=12;
 
  $args = array(
        'post_status' => 'publish',
        'post_type' => 'awards',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  if(isset($_POST['aplha']) && !empty($_POST['aplha'])) {
    $args['search_prod_title'] = $_POST['aplha'];
    add_filter( 'posts_where', 'title_filter', 10, 2 );
  }
  $result = array();

  $Media_query = new WP_Query($args);
  remove_filter( 'posts_where', 'title_filter', 10 );
/*var_dump($args);
var_dump($Media_query->request);*/
$result['result'] = '';
 if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $params['post_id'] = get_the_ID();               
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'accreditations-awards-post-list',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;
  //$result['query'] = $Media_query->request;
  echo json_encode($result);
  exit;
}
/* Logo post list ajax*/
add_action('wp_ajax_get_logo_more_posts' , 'get_logo_more_posts');
add_action('wp_ajax_nopriv_get_alog_more_posts','get_logo_more_posts');
function get_logo_more_posts(){ 
 $total_count = 0;
 $ppp=12;
 
  $args = array(
        'post_status' => 'publish',
        'post_type' => 'logo',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  if(isset($_POST['logo_term']) && !empty($_POST['logo_term'])) {
      $args['tax_query'] = array(array(
              'taxonomy' => 'logo-category',
              'field'    => 'term_id',
              'terms'    => $_POST['logo_term']
            ));
    }
  $result = array();

  $Media_query = new WP_Query($args);
  
/*var_dump($args);
var_dump($Media_query->request);*/
$result['result'] = '';
 if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $params['post_id'] = get_the_ID();               
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'logo-post',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;
  //$result['query'] = $Media_query->request;
  echo json_encode($result);
  exit;
}
/*jQuery-AJAX Load More function*/
function get_more_posts(){
  $post_html; 
  $latcham_postperpage = 4;
  $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 1;
  $pagedata = $latcham_postperpage * $page - 2;
   
  $args = array(
      'post_status' => 'publish',
      'post_type' => 'team',
      'posts_per_page' => $latcham_postperpage,
      'order' => 'DESC',
      'paged' => $page,
      'offset' => $pagedata,          
  );

  $argscount = array(
      'post_status' => 'publish',
      'post_type' => 'team',
      'posts_per_page' => -1,           
  );

  //global $the_query;
  $the_query = new WP_Query($args);
  $count_post = new WP_Query($argscount);  
  $count = count($count_post->posts );

  if ($the_query->have_posts() ) :
        /* Start the Loop */
        while ( $the_query->have_posts() ) :
          $the_query->the_post();
          $postID = get_the_ID();

          $title = get_the_title();
          $job_title = get_field('team_job_title');
          $image = get_field('team_image');

          if($image){
            $team_image = $image['sizes']['team_post_image'];
          }
          else{
            $team_image = get_field('default_team_image','options')['sizes']['team_post_image'];
          }    
          
          $post_html .= '<div class="col-sm-6 col-lg-4 col-xl-3 d-flex team-post-item">';
          $post_html .= '<div class="team-member">';

          $post_html .='<div class="team-member-thumb bg-cover" style="background-image: url('. $team_image .');">
                          <img src="' .get_template_directory_uri().'/images/placeholder/place-91-93.png" alt="">
                        </div>';

          $post_html .='<div class="team-member-summary">
                          <h4>' .$title. '</h4>
                            <span>'.$job_title.'</span>
                        </div>';

          $post_html.= '</div>';
          $post_html.= '</div>';
        endwhile;  
  endif;
        
  if($count % 4 != 0):
    $page++;
  endif;


  echo json_encode(
    array(  
      'max_pages' => $the_query->max_num_pages,
      'page' => $page,
      'total_post'=>$count,
      'content' => $post_html,
      'posts' => json_encode($the_query->query_vars) // everything about your loop is here
    ));
  exit;
}
/* Socail icon wigent area*/
function arphabet_widgets_init() {

  register_sidebar( array(
    'name'          => 'Social',
    'id'            => 'home_right_1',
    'before_widget' => '<div>',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="rounded">',
    'after_title'   => '</h2>',
  ) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_html');

function add_featured_image_html( $html ) {

    return $html .= '<p>Image Size : large : 1200x821 and Medium : 640x320</p>';

}


/* Admin order set category and sub catyegory list*/
function remove_default_categories_box() {
    remove_meta_box('categorydiv', 'post', 'side');
}
add_action( 'admin_head', 'remove_default_categories_box' );

// add the new box
function add_custom_categories_box() {
    add_meta_box('customcategorydiv', 'Categories', 'custom_post_categories_meta_box', 'post', 'side', 'low', array( 'taxonomy' => 'category' ));
}
add_action('admin_menu', 'add_custom_categories_box');

/**
 * Display CUSTOM post categories form fields.
 *
 * @since 2.6.0
 *
 * @param object $post
 */
function custom_post_categories_meta_box( $post, $box ) {
    $defaults = array('taxonomy' => 'category');
    if ( !isset($box['args']) || !is_array($box['args']) )
        $args = array();
    else
        $args = $box['args'];
    extract( wp_parse_args($args, $defaults), EXTR_SKIP );
    $tax = get_taxonomy($taxonomy);

    ?>
    <div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
        <ul id="<?php echo $taxonomy; ?>-tabs" class="category-tabs">
            <li class="tabs"><a href="#<?php echo $taxonomy; ?>-all" tabindex="3"><?php echo $tax->labels->all_items; ?></a></li>
            <li class="hide-if-no-js"><a href="#<?php echo $taxonomy; ?>-pop" tabindex="3"><?php _e( 'Most Used' ); ?></a></li>
        </ul>

        <div id="<?php echo $taxonomy; ?>-pop" class="tabs-panel" style="display: none;">
            <ul id="<?php echo $taxonomy; ?>checklist-pop" class="categorychecklist form-no-clear" >
                <?php $popular_ids = wp_popular_terms_checklist($taxonomy); ?>
            </ul>
        </div>

        <div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
            <?php
            $name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
            echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
            ?>
            <ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy?> categorychecklist form-no-clear">
                <?php 
                /**
                 * This is the one line we had to change in the original function
                 * Notice that "checked_ontop" is now set to FALSE
                 */
                wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy, 'popular_cats' => $popular_ids, 'checked_ontop' => FALSE ) ) ?>
            </ul>
        </div>
    <?php if ( !current_user_can($tax->cap->assign_terms) ) : ?>
    <p><em><?php _e('You cannot modify this taxonomy.'); ?></em></p>
    <?php endif; ?>
    <?php if ( current_user_can($tax->cap->edit_terms) ) : ?>
            <div id="<?php echo $taxonomy; ?>-adder" class="wp-hidden-children">
                <h4>
                    <a id="<?php echo $taxonomy; ?>-add-toggle" href="#<?php echo $taxonomy; ?>-add" class="hide-if-no-js" tabindex="3">
                        <?php
                            /* translators: %s: add new taxonomy label */
                            printf( __( '+ %s' ), $tax->labels->add_new_item );
                        ?>
                    </a>
                </h4>
                <p id="<?php echo $taxonomy; ?>-add" class="category-add wp-hidden-child">
                    <label class="screen-reader-text" for="new<?php echo $taxonomy; ?>"><?php echo $tax->labels->add_new_item; ?></label>
                    <input type="text" name="new<?php echo $taxonomy; ?>" id="new<?php echo $taxonomy; ?>" class="form-required form-input-tip" value="<?php echo esc_attr( $tax->labels->new_item_name ); ?>" tabindex="3" aria-required="true"/>
                    <label class="screen-reader-text" for="new<?php echo $taxonomy; ?>_parent">
                        <?php echo $tax->labels->parent_item_colon; ?>
                    </label>
                    <?php wp_dropdown_categories( array( 'taxonomy' => $taxonomy, 'hide_empty' => 0, 'name' => 'new'.$taxonomy.'_parent', 'orderby' => 'name', 'hierarchical' => 1, 'show_option_none' => '&mdash; ' . $tax->labels->parent_item . ' &mdash;', 'tab_index' => 3 ) ); ?>
                    <input type="button" id="<?php echo $taxonomy; ?>-add-submit" class="add:<?php echo $taxonomy ?>checklist:<?php echo $taxonomy ?>-add button category-add-sumbit" value="<?php echo esc_attr( $tax->labels->add_new_item ); ?>" tabindex="3" />
                    <?php wp_nonce_field( 'add-'.$taxonomy, '_ajax_nonce-add-'.$taxonomy, false ); ?>
                    <span id="<?php echo $taxonomy; ?>-ajax-response"></span>
                </p>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
/* auto select parent cat*/
function super_category_toggler() {
  
  $taxonomies = apply_filters('super_category_toggler',array());
  for($x=0;$x<count($taxonomies);$x++)
  {
    $taxonomies[$x] = '#'.$taxonomies[$x].'div .selectit input';
  }
  $selector = implode(',',$taxonomies);
  if($selector == '') $selector = '.selectit input';
  
  echo '
    <script>
    jQuery("'.$selector.'").change(function(){
      var $chk = jQuery(this);
      var ischecked = $chk.is(":checked");
      var tmp = ischecked;
      $chk.parent().parent().siblings().children("label").children("input").each(function() {
        var b = this.checked;
        ischecked = ischecked || b;
      });
      console.log(ischecked);
      if (tmp) {
        checkParentNodes(ischecked, $chk);
      } else {
        checkChildNodes($chk);
      }
    });
    function checkParentNodes(b, $obj)
    {
      $prt = findParentObj($obj);
      if ($prt.length != 0)
      {
       $prt[0].checked = b;
       checkParentNodes(b, $prt);
      }
    }
    function findParentObj($obj)
    {
      return $obj.parent().parent().parent().prev().children("input");
    }
    function checkChildNodes($obj) {
      $obj.parent().siblings().children().children("label").children("input").each(function() {
        var $this = jQuery(this);
        $this[0].checked = false;
        checkChildNodes($this);
      });
    }
    </script>
    ';
  
}
add_action('admin_footer', 'super_category_toggler');

/*career mail change sender and subject*/
add_action( 'wpcf7_before_send_mail', 'wpcf7_jobs_mail' );
function wpcf7_jobs_mail( $contact_form ) {
    //Get the form ID
    $form_id = $contact_form->id();
    $submission = WPCF7_Submission::get_instance();
    $posted_data = $submission->get_posted_data();
    $url = $submission->get_meta( 'url' );    
    $postid = url_to_postid( $url );
    //Do something specifically for form with the ID "123"
    if( $form_id == 89 ) {
        $job_email_address = get_field('job_email_address',$postid);
        $emaiIDS = array();
        if(!empty($job_email_address)){
          foreach ($job_email_address as $emaiId) {
            if(!empty($emaiId['job_email_id'])){
              $emaiIDS[] = $emaiId['job_email_id']; 
            }
          }
        }
        $values_list = $posted_data['valsitems'];
        $values_str = implode(", ", $values_list);

        // get mail property
        $mail = $contact_form->prop( 'mail' ); // returns array 

        // add content to email body
        if(!empty($emaiIDS)){
          $mail['recipient'] = implode(",", $emaiIDS);
        }
        $mail['subject'] = get_the_title($postid).' - '.$posted_data['text-710'];
        // set mail property with changed value(s)
        $contact_form->set_properties( array( 'mail' => $mail ) );
    }
    if( $form_id == 37 ) {        
        $post_email = get_field('post_email',$postid);
        $emaiIDS = array();
        if(!empty($post_email)){
          foreach ($post_email as $emaiId) {
            if(!empty($emaiId['post_email_id'])){
              $emaiIDS[] = $emaiId['post_email_id']; 
            }
          }
        }
        
        $values_list = $posted_data['valsitems'];
        $values_str = implode(", ", $values_list);

        // get mail property
        $mail = $contact_form->prop( 'mail' ); // returns array 
        $mail['subject'] = "New contact form submission - ".get_the_title($postid);
        // add content to email body
        if(!empty($emaiIDS)){
          $mail['recipient'] = implode(",", $emaiIDS);
        }
        // set mail property with changed value(s)
        
        $contact_form->set_properties( array( 'mail' => $mail ) );
    }
}
add_filter( 'wpcf7_before_send_mail', 'de_wpcf7_salesforce' );
function de_wpcf7_salesforce( $contact_form ) {
    global $wpdb;

    if ( ! isset( $contact_form->posted_data ) && class_exists( 'WPCF7_Submission' ) ) {
        $submission = WPCF7_Submission::get_instance();

        if ( $submission ) {
            $form_data = $submission->get_posted_data();
        }
    } else {
        return $contact_form;
    }
    $salesforce_org_id = get_field('salesforce_org_id','option');
    $salesforce_debugging_emails = get_field('salesforce_debugging_emails','option');

    if($contact_form->id() == 37){
    $body = array(
        'oid' => $salesforce_org_id, 
        'retURL' => 'http://',
        'debug' => 1,
        'debugEmail' => $salesforce_debugging_emails,
        'last_name' => $form_data['your-name'],
        'email' => $form_data['your-email'],
        'phone' => $form_data['phone'],
        'lead_source' => 'Website',
        'description' => $form_data['your-message'],
    );
    $url = 'https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8';

    $params = array(
      'headers' => array(
            'Content-Type' => 'application/x-www-form-urlencoded'
        ),
      'method'      => 'POST',    
      'body' => $body
    );
    
    $response = wp_remote_post( $url,$params );
    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        $subject = 'CF7 -> Salesforce POST Failed';
        $body = 'Error message: '.$error_message;
        $headers = array( 'Content-Type: text/html; charset=UTF-8' );
        $wpdb->insert("wp_salesforce_log", array("message_body" => $error_message)); 
        wp_mail( $salesforce_debugging_emails, $subject, $body, $headers );
    }
  }
}
/* Sector load more post*/
add_action('wp_ajax_get_sector_more_posts' , 'get_sector_more_posts');
add_action('wp_ajax_nopriv_get_sector_more_posts','get_sector_more_posts');
function get_sector_more_posts(){ 
 $total_count = 0;
 $ppp=9;
 
  $args = array(
        'post_status' => 'publish',
        'post_type' => 'industry',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  
  $result = array();

  $Media_query = new WP_Query($args);
  $result['result'] = '';
  if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $params['post_id'] = get_the_ID();               
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'service-post',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;  
  echo json_encode($result);
  exit;
}
/* Solution load more post*/
add_action('wp_ajax_get_solutions_more_posts' , 'get_solutions_more_posts');
add_action('wp_ajax_nopriv_get_solutions_more_posts','get_solutions_more_posts');
function get_solutions_more_posts(){ 
 $total_count = 0;
 $ppp=8;
 
  $args = array(
        'post_status' => 'publish',
        'post_type' => 'solutions',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  
  $result = array();

  $Media_query = new WP_Query($args);
  $result['result'] = '';
  if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $params['post_id'] = get_the_ID();               
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'solutions-post',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;  
  echo json_encode($result);
  exit;
}
/* Case Study load more post*/
add_action('wp_ajax_get_casestudy_more_posts' , 'get_casestudy_more_posts');
add_action('wp_ajax_nopriv_get_casestudy_more_posts','get_casestudy_more_posts');
function get_casestudy_more_posts(){ 
 $total_count = 0;
 $ppp=6;
 
  $args = array(
        'post_status' => 'publish',
        'post_type' => 'casestudy',
        'posts_per_page' => $ppp,
        'order' => 'DESC',
       
    );
  if(isset($_POST['offset']) && !empty($_POST['offset'])) {
    $args['offset'] = $_POST['offset'];
  }
  if(isset($_POST['casestudy_term']) && !empty($_POST['casestudy_term'])) {
      $args['tax_query'] = array(array(
              'taxonomy' => 'industry-category',
              'field'    => 'term_id',
              'terms'    => $_POST['casestudy_term']
            ));
    }
  $result = array();

  $Media_query = new WP_Query($args);
  
  $result['result'] = '';
  if( $Media_query->have_posts() ) 
    { 
      while ($Media_query->have_posts()) 
      {
        $Media_query->the_post();
        $params['post_id'] = get_the_ID();               
        $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'casestudy-post',$params);
      }      
    }
  wp_reset_postdata();
  $result['offset'] = $ppp + $_POST['offset'];
  $result['total_post'] = $Media_query->found_posts;
  $result['query'] = $Media_query->request;
  echo json_encode($result);
  exit;
}
/* Download PDF by Ajax*/
add_action('wp_ajax_download_pdf_form' , 'download_pdf_form');
add_action('wp_ajax_nopriv_download_pdf_form','download_pdf_form');
function download_pdf_form(){ 
  global $wpdb;
    $errorMSG = "";
    if (!wp_verify_nonce($_POST['sk_nonce'],'sk_nonce')){    
      return false;
    }else{
    /* NAME */
  if (empty($_POST["name"])) {
      $errorMSG = "<li>Name is required</<li>";
  } else {
      $name = $_POST["name"];
  }


  /* EMAIL */
  if (empty($_POST["email"])) {
      $errorMSG .= "<li>Email is required</li>";
  } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $errorMSG .= "<li>Invalid email format</li>";
  }else {
      $email = $_POST["email"];
  }
  if(empty($errorMSG)){
      $select_pdf_file = get_field('select_pdf_file',$_POST['postid']);
      if($select_pdf_file == 'File'){
          $post_pdf_url = get_field('post_pdf_file',$_POST['postid']);
          $pdfUrl = $post_pdf_url['url'];
        }else{
          $pdfUrl = get_field('post_pdf_url',$_POST['postid']);
        }
    
    
    
    $wpdb->insert("wp_pdf_download", array(
       "name" => $_POST['name'],
       "email" => $_POST['email'],
       "post_id" => $_POST['postid'],
    ));  
    echo json_encode(['code'=>200, 'url'=>$pdfUrl]);
    exit;
    }
    echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    exit;
    }
}
/* Custom pageDownload PDF by Ajax*/
add_action('wp_ajax_custom_page_download_pdf_form' , 'custom_page_download_pdf_form');
add_action('wp_ajax_nopriv_custom_page_download_pdf_form','custom_page_download_pdf_form');
function custom_page_download_pdf_form(){ 
  global $wpdb;
    $errorMSG = "";
    if (!wp_verify_nonce($_POST['sk_nonce'],'sk_nonce')){    
      return false;
    }else{
    /* NAME */
  if (empty($_POST["name"])) {
      $errorMSG = "<li>Name is required</<li>";
  } else {
      $name = $_POST["name"];
  }


  /* EMAIL */
  if (empty($_POST["email"])) {
      $errorMSG .= "<li>Email is required</li>";
  } else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $errorMSG .= "<li>Invalid email format</li>";
  }else {
      $email = $_POST["email"];
  }
  if(empty($errorMSG)){
      $select_pdf_file = get_field('select_pdf_file',$_POST['postid']);
      
      $top_left_section = get_field('top_left_section',$_POST['postid']);  
      $select_pdf_file = $top_left_section['select_pdf_file'];
      $casestudy_pdf_file = $top_left_section['post_pdf_file'];  
      $casestudy_pdf_url = $top_left_section['post_pdf_url'];

      if($select_pdf_file == 'File'){
          $post_pdf_url = $casestudy_pdf_file;
          $pdfUrl = $post_pdf_url['url'];
        }else{
          $pdfUrl = $casestudy_pdf_url;
        }
    
    
    
    $wpdb->insert("wp_pdf_download", array(
       "name" => $_POST['name'],
       "email" => $_POST['email'],
       "post_id" => $_POST['postid'],
    ));  
    echo json_encode(['code'=>200, 'url'=>$pdfUrl]);
    exit;
    }
    echo json_encode(['code'=>404, 'msg'=>$errorMSG]);
    exit;
    }
}
function cc_mime_types($mimes) {
 $mimes['svg'] = 'image/svg+xml';
 return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/* Load more resource post*/
add_action('wp_ajax_get_resource_more_posts' , 'get_resource_more_posts');
add_action('wp_ajax_nopriv_get_resource_more_posts','get_resource_more_posts');
function get_resource_more_posts(){ 
   $total_count = 0;
   $ppp=4;

    $args = array(
          'post_status' => 'publish',
          'post_type' => 'resources',
          'posts_per_page' => $ppp,
          'order' => 'DESC',
         
      );
    if(isset($_POST['offset']) && !empty($_POST['offset'])) {
      $args['offset'] = $_POST['offset'];
    }
    if(isset($_POST['resource_term']) && !empty($_POST['resource_term'])) {

      $args['tax_query'] = array(array(
              'taxonomy' => 'resources-category',
              'field'    => 'term_id',
              'terms'    => $_POST['resource_term']
            ));
    }
  $result = array();
  $Media_query = new WP_Query($args);
  $result['result'] = '';
   if( $Media_query->have_posts() ) 
      { 
        while ($Media_query->have_posts()) 
        {
          $Media_query->the_post();
          $params['post_id'] = get_the_ID();               
          $result['result'] .= bb_return_get_template_part( 'template-parts/content', 'resource-post-list',$params);
        }      
      }
    wp_reset_postdata();
    $result['offset'] = $ppp + $_POST['offset'];
    $result['total_post'] = $Media_query->found_posts;
    $result['query'] = $Media_query->request;
    echo json_encode($result);
    exit;
}

// Check empty functions - 24-dec-2020
function latcham_check_empty_content_section($type, $post_id, $section,$group) {
  global $wpdb;

  $return = false;
  $type_with_id = $type.'_'.$post_id;

  // Check empty page content section
  if(have_rows('page_flexible_content', $type_with_id)) {

    $page_section_arr = array('sub_heading_white_section_page','sub_heading_third_section_page','green_dream_section_page');
    while(have_rows('page_flexible_content', $type_with_id)): the_row();
      
      // sub_heading_white_section_page
      if(get_row_layout() == $section && in_array($section, $page_section_arr)) {
        $imageclone = get_sub_field('content_page_right_image');
        if($imageclone['select_type'] == 'Image') {
          if(!empty($imageclone['top_slider_image'])) {
            $return = true;
          }  
        } else {
          if($imageclone['top_slider_video_select'] == 'internal' && !empty($imageclone['top_slider_video'])) {
            $return = true;
          } else if($imageclone['top_slider_video_select'] == 'external' && !empty($imageclone['video_url'])) {
            $return = true;
          }
        }
      }

      // sub_heading_third_section_page
      if(get_row_layout() == $section && in_array($section, $page_section_arr)) {
        $imageclone = get_sub_field('content_page_left_image');
        if($imageclone['select_type'] == 'Image') {
          if(!empty($imageclone['top_slider_image'])) {
            $return = true;
          }  
        } else {
          if($imageclone['top_slider_video_select'] == 'internal' && !empty($imageclone['top_slider_video'])) {
            $return = true;
          } else if($imageclone['top_slider_video_select'] == 'external' && !empty($imageclone['video_url'])) {
            $return = true;
          }
        }
      }

      // green_dream_section_page
      if(get_row_layout() == $section && in_array($section, $page_section_arr)) {
        $imageclone = get_sub_field('content_page_image');
        if($imageclone['select_type'] == 'Image') {
          if(!empty($imageclone['top_slider_image'])) {
            $return = true;
          }  
        } else {
          if($imageclone['top_slider_video_select'] == 'internal' && !empty($imageclone['top_slider_video'])) {
            $return = true;
          } else if($imageclone['top_slider_video_select'] == 'external' && !empty($imageclone['video_url'])) {
            $return = true;
          }
        }
      }

    endwhile;
  }


  // Check empty post content section
  if(have_rows('post_flexible_content', $type_with_id)) {

    $post_section_arr = array('customer_logos_section_post','related_post_section_post');
    while(have_rows('post_flexible_content', $type_with_id)): the_row();
      
      // customer_logos_section_post
      if(get_row_layout() == $section && in_array($section, $post_section_arr)) {
        $customer_logos_post = get_sub_field('content_post_customer_logos_post');

        if(!empty($customer_logos_post)) {
          $return = true;
        }  
      }

      // related_post_section_post
      if(get_row_layout() == $section && in_array($section, $post_section_arr)) {
        $content_post_related_post = get_sub_field('content_post_related_post');
        $show_latest_post = get_sub_field('show_latest_post');
        if($show_latest_post){
          $return = true;
        }
        if(!empty($content_post_related_post)) {
          $return = true;
        }
      }

    endwhile;
  }

  return $return;
}
function checkImageNull($imageData){
  $ChkImage = false;    
          if(!empty($imageData) &&(
          (!empty($imageData['top_slider_image']) && $imageData['select_type'] == 'Image') || 
          (!empty($imageData['top_slider_video'] && $imageData['select_type'] == 'Video' && $imageData['top_slider_video_select'] == 'internal')) || 
          (!empty($imageData['video_url']) && $imageData['select_type'] == 'Video' && $imageData['top_slider_video_select'] == 'external'))){$ChkImage = true; }
    return $ChkImage;
}
function posts_link_next_class($format){
    $format = str_replace('href=', 'class="btn bg--yellow post-previous" href=', $format);
     return $format;
}
add_filter('next_post_link', 'posts_link_next_class');

function posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="btn bg--yellow post-next" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'posts_link_prev_class');

/*Phone format*/
function FormatPhone($phone)
{
        $phone = str_replace(" ", "", $phone);
        return substr($phone, 0, 5) . " " . substr($phone, 5);
}
