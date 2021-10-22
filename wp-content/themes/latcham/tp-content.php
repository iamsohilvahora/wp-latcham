<?php

/**
Template Name: Content Page
**/

get_header();
$ID = get_the_ID();
$page_title = get_the_title($ID);
$content = get_the_content($ID);
$page_content = apply_filters('the_content', $content);
$button = get_field('button',$ID);
$top_btn_label = $button['button_label'];
$top_btn_link = $button['button_link'];
$top_btn_internal = $button['button_internal_link'];
$top_btn_external = $button['button_external_link'];
if($top_btn_link == 'button_internal_link'){
    $top_btnurl =latcham_external_link($top_btn_internal,false);
}else{
    $top_btnurl =latcham_external_link($top_btn_external,true);
}
?> 
<section class="content-page-top hero-section section-has-dots ">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($page_title)) { ?>
                    <h1 class="title title-2"><?php echo $page_title; ?></h1>
                    <?php } ?>
            <div class="row align-items-center">
                    <?php if(!empty($page_content)) {  echo $page_content; } ?>
                    
                   
            </div>
            <?php if(!empty($top_btnurl) && !empty($top_btn_label)){ ?>
            <?php echo button_group($button,'btn btn-primary');  ?>
            
                    <?php } ?>
        </div>
    </div>
    <div class="dot-circles">
         <!-- <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">  -->
    </div>
</section>
<?php
    if( have_rows('content_page_flexible_content') ){
    while ( have_rows('content_page_flexible_content') ) { the_row(); 
        if( get_row_layout() == 'top_video' ){
            $top_video = get_sub_field('youtubevimeo_url');
            $ImageNull = checkImageNull($top_video); 
            if($ImageNull){ 
            ?>
<section class="section section-content-video after--bg ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="video-section"><div class="loader"></div></section>
<?php } } else if( get_row_layout() == 'usps_section' ){  ?>
<section class="usps-section usps-space-more ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="usps-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'sub_heading_white_section' ){ 
        $display_section = get_sub_field('display_section');
        $imageclone = get_sub_field('right_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="subheading-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'sub_heading_second_section' ){ ?>
<section class="section section-content column-content bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="subheading-skyblue-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'sub_heading_third_section' ){ 
        $display_section = get_sub_field('display_section');
        $imageclone = get_sub_field('left_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imageclone; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="subheading-third-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'solution_section' ){ ?>
<section class="section section-solution solution-with-video ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="section-solution"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'industry_section' ){ ?>
<section class="section section-industry bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="industry-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'case_studies_section' ){ ?>
<section class="section section-image-conetnt section-post-box section-case-study ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="casestudies-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'services_section' ){ ?>
<section class="section section-utilities hover-dots-effect bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="services-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'faq_section' ){ ?>
<section class="section section-faq ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="faq-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'related_post_section' ){ ?>
<section class="section section-post-box ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="related-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'logo_post_section' ){?>
<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="logo-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'customer_logos_section' ){?>
<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="customer-logo-post-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'green_dream_section' ){ 
    $display_section = get_sub_field('display_section');
    $imageclone = get_sub_field('image');
    $ImageNull = checkImageNull($imageclone);
    if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> top-less-space  ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="green-dream"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'credential_and_logo_section' ){?>
<section class="section section-client-logo our-creditential-section bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="our-creditential-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'team_section_content' ){?>
<section class="section section-image-conetnt section-post-box section-case-study ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="team-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'testimonial_section' ){?>
<section class="section section-testimonials ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="testimonials-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'contact_form_section' ){ 
        $title = get_sub_field('title');
        $description = get_sub_field('description');
        $shortcode = get_sub_field('shortcode');
    ?>
<section class="section section-contact" id="contactForm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($title)) { ?>
                        <h2 class="title title-2"><?php echo $title; ?></h2>
                    <?php } if(!empty($description)) { ?>
                         <p><?php echo $description; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6 contact-form">
                <?php echo do_shortcode($shortcode) ?>
            </div>
        </div>
    </div>
</section>
<?php } } } ?>

<?php get_footer(); ?>