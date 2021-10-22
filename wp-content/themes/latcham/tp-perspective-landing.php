<?php

/**
Template Name: Our Perspective Landing Page
**/

get_header();

$id = get_the_id();
$title = get_the_title();
$content = get_the_content();

//Get post section category wise
$parent_cats = get_field('select_post_category');
$post_default_banner = get_field('post_default_banner','option');
?>

<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <?php if(!empty($title)): ?>
                    <h1 class="title"><?php echo $title; ?></h1>
                    <?php endif;
                    if(!empty($content)): ?>
                    <p><?php echo $content; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<?php if(!empty($parent_cats)) : ?>
<section class="section section-post-box our-perspectives-section">                     
    <?php foreach($parent_cats as $cat) : 
            $cat_title = $cat['category_title'];
            $parent_cat = $cat['select_parent_category'];
            $button_cat = $cat['perspectives_post_button'];    
            //Post(Category Wise) Query
            $args = array(
                        'post_type' => 'post' ,
                        'post_status' => 'publish',
                        'orderby' => 'date' ,
                        'order' => 'DESC' ,
                        'posts_per_page' => 9,
                        'cat' => $parent_cat,
                    ); 
            $args = new WP_Query($args);

    if($args->have_posts() ) : ?>      
    <div class="section-wrapper">
        <div class="section-head">
            <div class="container">
                <?php
                    // Get the ID of a given category
                    $category_id = $parent_cat ;
                    // Get the URL of this category
                    
                    if(!empty($button_cat)){
                        echo button_group($button_cat,'btn-link');   
                    }
                    ?>
                
                <h2 class="title"><?php echo $cat_title; ?></h2>
            </div>
        </div>
        <div class="container container-align-left">
            <div class="post-box-carsoul slide-arrow-top">
                <?php while ( $args->have_posts() ) : $args->the_post(); 
                        $post_id = get_the_id();    
                        $post_title = wp_trim_words(get_the_title(),20);
                        $permalink = get_the_permalink();
                        $content = get_the_content();
                        $post_content = wp_trim_words(wp_strip_all_tags($content), 30); 
                       
                        $date = get_the_date(); 
                        $post_date = date('jS F Y',strtotime($date));

                        $src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id),'single-post-thumbnail'); //featured image
                        if(!empty($src[0])){
                            $post_image = $src[0];
                        }else{
                            $post_image = $post_default_banner['sizes']['post_main_image'];
                        }
                        $parent = get_cat_name($category_id);    
                        $categories = get_the_category($post_id);

                        $category = get_term($category_id);
                        $category_color = get_field("category_color", $category->taxonomy.'_'.$category->term_id);  ?>

                        <div class="item">
                            <div class="item-inner bg--<?php echo $category_color; ?> blog-post">
                                <div class="post-image bg-cover" style="background-image: url(<?php echo  $post_image; ?>)">
                                    <img class="img-hide" src="<?php echo get_template_directory_uri()?>/images/placeholder/place-24-12.png">
                                    
                                    <span class="post-tag">
                                        <?php 
                                        if(!empty($categories)): 
                                            $catlist = "";
                                            foreach($categories as $cat):
                                                if($cat->category_parent == $category_id):
                                                        $catlist .=  $cat->name . ', ';
                                                endif;        
                                            endforeach;
                                            echo $catlist ? rtrim($catlist, ", ") : $parent;
                                        endif;
                                        ?>
                                    </span>
                                </div>

                                <?php if (!empty($post_title) && !empty($post_content)) : ?>
                                <div class="post-content summary">
                                    <?php if (!empty($post_date)) : ?><span class="date"><?php echo $post_date; ?></span><?php endif; ?>
                                    <?php if (!empty($post_title)) : ?><h3 class="title h5"><?php echo $post_title; ?></h3><?php endif; ?>
                                    <?php if (!empty($post_content)) : ?><p><?php echo $post_content; ?></p>
                                    <a href="<?php echo $permalink; ?>" class="link">Read more</a>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo $permalink; ?>" class="box-link"></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php endif;
        endforeach; ?>  
 
</section>
<?php endif; ?>

<?php get_footer(); ?>