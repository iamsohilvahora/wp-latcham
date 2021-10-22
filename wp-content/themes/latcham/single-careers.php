<?php
get_header();

while ( have_posts() ) :
            the_post();

?> 

<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <h1 class="title"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
<?php endwhile; 
if(have_rows('job_content') ){
    while ( have_rows('job_content') ) { the_row();
        if( get_row_layout() == 'content_section' ){
            $job_details_left_content = get_sub_field('job_details_left_content');
            $job_details_right_content = get_sub_field('job_details_right_content');
?>            
<section class="section job-detail-section content-area-detail">
    <div class="container">
 
        <div class="row">
            <?php if(!empty($job_details_left_content)): ?>
            <div class="col-lg-6">
                <div class="job-detail-inner">
                   <?php echo $job_details_left_content; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if(!empty($job_details_right_content)): ?>
            <div class="col-lg-6">
                <div class="job-detail-inner">
                     <?php echo $job_details_right_content; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php }if( get_row_layout() == 'apply_here' ){  ?> 
<section class="apply-here-section section-has-dots bg--lightblue">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="custom-form custom-form-light">
                    <h2>Apply <strong>here</strong></h2>
                    <?php echo do_shortcode('[contact-form-7 id="89" title="Apply here"]') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
<?php }if( get_row_layout() == 'why_join_section' ){  
    $job_join_title = get_sub_field('job_join_title');
    $job_join_content = get_sub_field('job_join_content');
    $job_button = get_sub_field('job_button');
    $job_image = get_sub_field('job_image');
    ?> 
<section class="section section-content section-image-conetnt image--right">
    <div class="container">
        <div class="row align-items-center">
            <div class="col col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($job_join_title)): ?>  
                    <h2 class="title"><?php echo $job_join_title; ?></h2>
                    <?php endif;
                    if(!empty($job_join_content)): ?>
                    <p><?php echo $job_join_content; ?></p>
                    <?php endif; 

                    if(!empty($job_button)): ?>
                        <div class="button-group">
                            <?php echo button_group($job_button,'btn btn-primary'); ?>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>

            <?php if(!empty($job_image)): ?>
            <div class="col col-sm-12 col-lg-6 image">
                <?php if($job_image['select_type'] == 'Image'){ ?>
                    <img src="<?php echo $job_image['top_slider_image']['sizes']['job_detail_image_size']?>">
                <?php }else { 
                     if($job_image['top_slider_video_select'] == 'internal'){ ?>
                        <video controls autoplay>
                              <source src="<?php echo $job_image['top_slider_video']['url']; ?>" type="video/mp4">
                              <source src="<?php echo $job_image['top_slider_video']['url']; ?>" type="video/ogg">
                              Your browser does not support the video tag.
                        </video>
                     <?php }else{ 
                            $video_url = video_url($job_image['video_url']);
                        ?>  
                        <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } } ?>                
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php }if( get_row_layout() == 'industry_section' ){  
    $job_label = get_sub_field('job_label');
    $job_link = get_sub_field('job_link');
    $job_list_post = get_sub_field('job_list_post');
    ?> 
<section class="section section-industry bg-skyblue">
    <div class="container">
        <div class="section-head with--btn">
            <?php if(!empty($job_label)){ ?>
            <h2 class="title"><?php echo $job_label; ?></h2>
            <?php }
                if(!empty($job_link)){
                            echo button_group($job_link,'btn btn-primary');   
                        }
             ?>
        </div>

        <div class="industry-post-row">
            <div class="industry-post-items">
                <?php $i =0; if(!empty($job_list_post)){ 

                        foreach ($job_list_post as $industry_post) {
                        $title = get_the_title( $industry_post->ID );
                         $permalink = get_permalink( $industry_post->ID );
                         $industry_list_small_text = get_field("industry_list_small_text",$industry_post->ID);
                        ?>
                <div class="item <?php if($i == 1){echo "active";}?>">
                    <div class="item-inner">
                        <h5 class="link-text"><?php echo $title; ?></h5>
                        <div class="hover-content">
                            <div class="inner">
                                <h5><?php echo $title; ?></h5>
                                <?php if(!empty($industry_list_small_text)): ?>
                                <p><?php echo mb_strimwidth($industry_list_small_text, 0, 130, '...');?></p>
                                <?php endif; ?> 
                                <a href="<?php echo esc_url( $permalink ); ?>" class="link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( $permalink ); ?>" class="box-link"></a>
                </div>
            <?php $i++; } } ?>              
            </div>
        </div>
    </div>
</section>
 <?php }  } } ?>
<?php get_footer(); ?>