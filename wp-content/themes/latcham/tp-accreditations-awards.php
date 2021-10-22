<?php

/**
Template Name: Accreditations Awards Page
**/

get_header();
$award_page_banner_title = get_field('award_page_banner_title');
$award_page_top_content_left = get_field('award_page_top_content_left');
$award_page_top_content_right = get_field('award_page_top_content_right');
?> 
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($award_page_banner_title)){ ?>
            <h1 class="title"><?php echo $award_page_banner_title; ?></h1>
            <?php } ?>
            <div class="row">
                <?php if(!empty($award_page_top_content_left)){ ?>
                <div class="col col-md-6 slide-content">
                    <p><?php echo $award_page_top_content_left; ?></p>
                </div>
                <?php } if(!empty($award_page_top_content_right)){ ?>
                <div class="col col-md-6 slide-content">
                    <p><?php echo $award_page_top_content_right; ?></p>
                </div>
            <?php } ?>
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
                <div class="col d-flex flex-wrap align-items-center">
                    <label>Filter</label>
                    <div class="filter-alphabet">
                        <?php foreach(range('a', 'z') as $i) : ?>
                            <a class="alphaaward" data-src="<?php echo strtoupper($i); ?>" href="javascript:;"><?php echo strtoupper($i); ?></a>                            
                            <?php endforeach;?>                        
                    </div>
                </div>
            </div>
        </div>
        <?php
            $posts_per_page = 12;
            $args = array('post_type' => 'awards');
            $the_query = new WP_Query( $args );
            $totalpost = $the_query->found_posts;
             $the_query = new WP_Query( array('posts_per_page'=> $posts_per_page,'post_type' => 'awards', 'post_status' => 'publish' ,  'order' => 'DESC') );

             if( $the_query->have_posts() ){
        ?>
        <div class=" gutters-23 clients-logo-block">
             <div id="loader" class="main-loader"></div>  
            <div id="Show_articals" class="articallisting post-listing">         
                    <div class="row" id="appenddata"> 
            <?php  while( $the_query->have_posts() ){ 
                $the_query->the_post();                               
                    $params['post_id'] = get_the_ID();                
                    bb_get_template_part( 'template-parts/content', 'accreditations-awards-post-list',$params); 

             } ?>
            </div></div>
        </div> 
            
        <div class="load-more text-center mt-0 loadmore">
            <?php if($totalpost >= $posts_per_page){ ?>
            <a class="btn btn-primary awardsloadmore" href="javascript:;">Load more</a>
            <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
        <?php } ?>
        </div>
        <?php } ?>
    </div>
</section>


<?php get_footer(); ?>