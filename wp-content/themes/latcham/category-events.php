<?php
/**
 * The template for displaying cat pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package latcham
 */

get_header();
/* Get parent cat*/
$category = get_category( get_query_var( 'cat' ) );

/* Get sub cat*/
$get_children_cats = array('child_of' => $category->cat_ID);
$child_cats = get_categories( $get_children_cats );

$news_cat_top_title = get_field('news_cat_top_title', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_description = get_field('news_cat_top_description', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_button = get_field('news_cat_top_button', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_button_2 = get_field('news_cat_top_button_2', $category->taxonomy.'_'.$category->term_id);
$date_now = date('Y-m-d H:i:s');
$posts_per_page = 7;
$Filter_posts = get_posts( array(
    'post_type' => 'post',
    'order' => 'ASC',
    'posts_per_page' => -1,
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_query' => array(
        array(
            'key'           => 'event_start_date',
            'compare'       => '>',
            'value'         => $date_now,
            'type'          => 'DATETIME',
        )
    ),
    'tax_query'=> array(array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => 5,
            'include_children' => true
          )
    ),
));
$posts = get_posts( array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'order' => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'event_start_date',
    'meta_query' => array(
        array(
            'key'           => 'event_start_date',
            'compare'       => '>',
            'value'         => $date_now,
            'type'          => 'DATETIME',
        )
    ),
    'tax_query'=> array(array(
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => 5,
            'include_children' => true
          )
    ),
));

$count = count($Filter_posts);
if($Filter_posts){
    $start_date = [];
    foreach ($Filter_posts as $fp) {
         $event_start_date = get_field('event_start_date',$fp->ID);
         $datem = date('Y-m', strtotime($event_start_date));
         if(!in_array($datem,$start_date)){
            $start_date[] = $datem;
         }
         
     
    }
    
}
?>

<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <?php if(!empty($news_cat_top_title)){ ?>
                    <h1 class="title"><?php echo $news_cat_top_title; ?></h1>
                    <?php } if(!empty($news_cat_top_description)){ ?>
                    <p><?php echo $news_cat_top_description; ?></p>
                    <?php } 
                        if(!empty($news_cat_top_button)):
                        echo button_group($news_cat_top_button,'btn btn-primary');   
                    endif; 
                    if(!empty($news_cat_top_button_2)):
                        echo button_group($news_cat_top_button_2,'btn btn-primary');   
                    endif; 
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
    
<section class="listing-post-block">
    <div class="container">
        <div class="filter">
            <div class="row no-gutters">
                <div class="filter-col d-flex align-items-center">
                    <label>Filter results</label>
                    <select name="event_term" class="form-control shadow-none event_term">
                        <option value="">Select category</option>
                        <?php if(!empty($category)){ ?>
                        <option value="<?php echo $category->term_id; ?>"><?php echo $category->name; ?></option>
                        <?php } 
                        if(!empty($child_cats)){ 
                            foreach ($child_cats as $subcat) {
                            ?>
                        <option value="<?php echo $subcat->term_id; ?>"><?php echo $subcat->name; ?></option>
                        <?php } } ?>
                    </select>
                </div>
                <div class="filter-col d-flex align-items-center">
                    <label>Date</label>
                    <select name="event_date" class="form-control shadow-none event_date">
                        <option value="">Select date</option>
                        <?php if ( $start_date ){
                        foreach ($start_date as $r){
                            $year = date('Y', strtotime( $r ) );
                            $month = date('M', strtotime( $r ) );
                            $month1 = date('m', strtotime( $r ) );
                             ?>
                        <option value="<?php echo $year.'-'.$month1;?>"><?php echo $month.' '.$year;?></option>        
                        <?php } } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="gutters-23 section-post-box">
            <div id="Show_articals" class="articallisting post-listing">  
             <div id="html_loader" class="main-loader"></div>          
            <div  id="appenddata" class="row"> 
            <?php 
                    if( $posts ) {
                        $i=0; foreach( $posts as $post ) { 
                        $params['term_id'] = $category->cat_ID;
                        $params['post'] = $post;
                        if($i == 0){
                            bb_get_template_part( 'template-parts/content', 'event-latest-post',$params); 
                        }else{
                            bb_get_template_part( 'template-parts/content', 'event-post',$params); 
                        }
                    $i++;}
                    
                }
                 ?>
                </div>
            </div>
        </div>
        <div class="load-more text-center loadmore">
            <div id="loader"></div>
            <?php if($count >= $posts_per_page){ ?>
            <a class="btn btn-primary eventloadmore" href="javascript:;">Load more</a>
            <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
            <?php } ?>
        </div>
    </div>
</section>
<?php
get_footer();