<?php
wp_redirect(home_url(),301);
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
$top_title = get_field('top_title',$term->taxonomy.'_'.$term->term_id);
$top_description = get_field('top_description',$term->taxonomy.'_'.$term->term_id);
?> 
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($top_title)){ ?>
            <h1 class="title"><?php echo $top_title; ?></h1>
            <?php } ?>
            <div class="row">
                <?php if(!empty($top_description)){ ?>
                <div class="col col-md-6 slide-content">
                    <p><?php echo $top_description; ?></p>
                </div>
                <?php }  ?>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="listing-post-block">
    <div class="container">
        <?php
            $posts_per_page = 12;
            $args = array('post_type' => 'awards');
            $args['tax_query'] = array(array(
              'taxonomy' => 'logo-category',
              'field'    => 'term_id',
              'terms'    => $term->term_id
            ));
            $cnt_query = new WP_Query( $args );
            $totalpost = $cnt_query->found_posts;
            $postArgs = array('posts_per_page'=> $posts_per_page,'tax_query'=>
                array(array('taxonomy' => 'logo-category','field'    => 'term_id','terms'    => $term->term_id)),'post_type' => 'logo', 'post_status' => 'publish' ,  'order' => 'DESC');
             $the_query = new WP_Query($postArgs);
             
             if( $the_query->have_posts() ){
        ?>
        <div class=" gutters-23 clients-logo-block logo-category">
             
            <div id="Show_articals" class="articallisting post-listing">         
                    <div class=" logo-category-slider" id="appenddata"> 
            <?php  while( $the_query->have_posts() ){ 
                $the_query->the_post();                               
                    $params['post_id'] = get_the_ID();                
                    bb_get_template_part( 'template-parts/content', 'logo-post',$params); 

             } ?>
            </div></div>
        </div> 
        <?php if($totalpost >= $posts_per_page){ ?>    
        <div class="load-more text-center mt-0 loadmore">
            <div id="loader" class="main-loader"></div>  
            <a class="btn btn-primary logoloadmore" href="javascript:;">Load more</a>
            <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
            <input type="hidden" id="logo_term" name="logo_term" value="<?php echo $term->term_id; ?>">
        </div>
        <?php } }  ?>
    </div>
</section>


<?php get_footer(); ?>