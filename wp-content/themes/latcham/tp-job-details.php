<?php

/**
Template Name: Job details
**/
get_header();

$job_heading = get_field('job_heading');
$job_content = get_field('job_content');

$job_join_title = get_field('job_join_title');
$job_join_content = get_field('job_join_content');
$job_button = get_field('job_button');
$job_image = get_field('job_image');

$job_details_left_content = get_field('job_details_left_content');
$job_details_right_content = get_field('job_details_right_content');

?> 
<?php if(!empty($job_heading) || !empty($job_content)): ?>
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <?php if(!empty($job_heading)): ?>    
                    <h1 class="title"><?php echo $job_heading; ?></h2>
                    <?php endif;

                    if(!empty($job_content)): ?>
                    <p><?php echo $job_content; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
<?php endif; ?>

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
 
<?php get_footer(); ?>