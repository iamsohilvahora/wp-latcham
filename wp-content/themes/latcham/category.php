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
$count = (int) $category->count;
$child_ids = array();
if(!empty($child_cats)){
    foreach ($child_cats as $child) {
        $child_ids[] = $child->term_id;
    }
}

$news_cat_top_title = get_field('news_cat_top_title', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_description = get_field('news_cat_top_description', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_button = get_field('news_cat_top_button', $category->taxonomy.'_'.$category->term_id);
$news_cat_top_button_2 = get_field('news_cat_top_button_2', $category->taxonomy.'_'.$category->term_id);
function wp_get_cat_postcount() {
    $cat = get_category($category->cat_ID);
    $count = (int) $cat->count;
    $taxonomy = 'category';
    $args = array(
      'child_of' => $category->cat_ID,
    );
    $tax_terms = get_terms($taxonomy,$args);

    foreach ($tax_terms as $tax_term) {
        $count +=$tax_term->count;
    }
    return $count;
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
                    <select name="news_term" class="form-control shadow-none news_term">
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
            </div>
        </div>
        <div class="row no-gutters">
            <div id="Show_articals" class="articallisting post-listing">
            <div id="html_loader" class="main-loader"></div>           
                    <div class="row gutters-20" id="appenddata"> 
            <?php $posts_per_page = 6;
                
                $allCats = array_merge($child_ids,[$category->cat_ID]);
                $the_query = new WP_Query( array( 'category__in' => $allCats, 'posts_per_page' => $posts_per_page, 'orderby' => 'date', 'order' => 'DESC' ) );
                    while( $the_query->have_posts() ){ 
                        $the_query->the_post();                               
                        $params['post_id'] = get_the_ID();
                        $params['term_id'] = $category->cat_ID;
                        bb_get_template_part( 'template-parts/content', 'news-post',$params); 
                    }
                 ?>
                </div>
            </div>
        </div>
        <?php if($posts_per_page <= $count){ ?>

        <div class="load-more text-center loadmore">
            <div id="loader"></div>            
            <a class="btn btn-primary newsloadmore" href="javascript:;">Load more</a>
            <input type="hidden" class="allCats" name="allCats" value="<?php echo implode(',', $allCats);?>">
            <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
        </div>
    <?php } ?>
    </div>
</section>
<?php
get_footer();