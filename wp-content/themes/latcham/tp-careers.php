<?php

/**
Template Name: Careers Page
**/
get_header();

$post_id = get_the_ID();
$banner_top_section_title = get_field('banner_top_section_title');
$banner_top_section_descreption = get_field('banner_top_section_descreption');
$posts_per_page = -1;
$the_query = new WP_Query( array('posts_per_page'=> $posts_per_page,'post_type' => 'careers', 'post_status' => 'publish' ,  'order' => 'DESC') );
?>
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($banner_top_section_title)){ ?>
                <h1 class="title"><?php echo $banner_top_section_title; ?></h1>
            <?php } ?>
            <div class="row align-items-center">
                <?php if(!empty($banner_top_section_descreption)){ ?>
                <?php echo $banner_top_section_descreption; ?>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
<?php if( $the_query->have_posts() ){ ?>
<section class="section section-utilities career-posts bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="career" sectionName="career-posts"><div class="loader"></div></section>
<?php } ?>
<?php if( have_rows('page_flexible_content') ){
    while ( have_rows('page_flexible_content') ) { the_row(); 
        if( get_row_layout() == 'top_video_page' ){
            $top_video = get_sub_field('content_page_youtubevimeo_url');
            $ImageNull = checkImageNull($top_video);
            if($ImageNull){ 
            ?>
<section class="section section-content-video after--bg ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="video-section"><div class="loader"></div></section>
<?php } } else if( get_row_layout() == 'usps_section_page' ){  ?>
<section class="usps-section ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="usps-section"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'sub_heading_white_section_page' ) { 
    $display_section = get_sub_field('content_page_display_section');
    $imageclone = get_sub_field('content_page_right_image');
    $ImageNull = checkImageNull($imageclone); 
    if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
?>

<section class="section section-content section-image-conetnt <?php echo $imgDispaly;?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-section"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'sub_heading_second_section_page' ) { ?>

<section class="section section-content column-content bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-skyblue-section"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'sub_heading_third_section_page' ) { 
    $display_section = get_sub_field('content_page_display_section');
    $imageclone = get_sub_field('content_page_left_image');
    $ImageNull = checkImageNull($imageclone); 
    if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
?>

<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-third-section"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'title_with_content_page' ) { ?>
<section class="section section-content column-content bg-white ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="titlewithcontent-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'solution_section_page' ){ ?>
<section class="section section-solution solution-with-video ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="section-solution"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'industry_section_page' ){ ?>
<section class="section section-industry bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="industry-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'case_studies_section_page' ){ ?>
<section class="section section-image-conetnt section-post-box section-case-study ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="casestudies-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'services_section_page' ){ ?>
<section class="section section-utilities hover-dots-effect bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="services-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'faq_section_page' ){ ?>
<section class="section section-faq ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="faq-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'related_post_section_page' ){ ?>
<section class="section section-post-box ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="related-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'logo_post_section_page' ){?>
<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="logo-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'customer_logos_section_page' ){?>
<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="customer-logo-post-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'green_dream_section_page' ){ 
    $display_section = get_sub_field('content_page_display_section');
    $imageclone = get_sub_field('content_page_image');
    $ImageNull = checkImageNull($imageclone); 
    if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
?>

<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> top-less-space  ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="green-dream"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'credential_and_logo_section_page' ) { ?>

<section class="section section-client-logo our-creditential-section bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="our-creditential-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'team_section_page' ){?>
<section class="section section-image-conetnt section-post-box section-case-study ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="team-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'testimonial_section_page' ){?>
<section class="section section-testimonials ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="testimonials-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'contact_form_section_page' ){ 
        $title = get_sub_field('content_page_title');
        $description = get_sub_field('content_page_description');
        $shortcode = get_sub_field('content_page_shortcode');
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
<?php } } } 
get_footer(); ?>