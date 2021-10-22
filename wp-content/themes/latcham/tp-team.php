<?php

/**
Template Name: Team Page
**/
get_header();

$team_heading = get_field('team_heading');
$team_content = get_field('team_content');
$career_heading = get_field('career_heading');
$role_button = get_field('role_button');
$count_args = array('post_type' => 'team');
$the_query = new WP_Query( $count_args );
$totalpost = $the_query->found_posts;
$posts_per_page = 6;
$args = array(  
        'post_type' => 'team',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish', 
        'orderby' => 'publish_date', 
        'order' => 'DESC', 
    );

$loop = new WP_Query( $args );

?> 
<?php if(!empty($team_heading) || !empty($team_content)): ?>
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <?php if(!empty($team_heading)): ?>
                    <h1 class="title"><?php echo $team_heading; ?></h1>
                    <?php endif;

                    if(!empty($team_content)): ?>
                    <p><?php echo $team_content; ?></p>
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

<section class="team-section bg-skyblue">
    <div class="container">
        <div class="row gutters-32 blog-archive append-post">
            <?php if(!empty($career_heading) || !empty($role_button)): ?>
            <div class="col-lg-12 col-xl-6 d-flex team-post-item">
                <div class="career-role-block bg-white d-flex flex-column justify-content-end align-items-start">
                    <?php if(!empty($career_heading)): ?>
                    <h2><?php echo $career_heading; ?></h2>
                    <?php endif;

                    if(!empty($role_button)): ?>
                        <?php echo button_group($role_button,'btn btn-primary'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if($loop->posts):  
                foreach($loop->posts as $post):
                     $id = $post->ID; 
                     $title = $post->post_title;
                     $job_title = get_field('team_job_title');
                     $image = get_field('team_image');

                     if($image){
                        $team_image = $image['sizes']['team_post_image'];
                     }
                     else{
                        $team_image = get_field('default_team_image','options')['sizes']['team_post_image'];
                     }         
            ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex team-post-item">
                        <div class="team-member">
                            <div class="team-member-thumb bg-cover" style="background-image: url(<?php echo $team_image; ?>);">
                                <img src="<?php echo get_template_directory_uri()?>/images/placeholder/place-91-93.png" alt="">
                            </div>
                            <div class="team-member-summary">
                                <?php if(!empty($title)): ?>
                                <h4><?php echo $title; ?> </h4>
                                <?php endif; ?>
                                <?php if(!empty($job_title)): ?>
                                <span><?php echo $job_title; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; wp_reset_postdata();
            endif; ?>
        </div>
        <?php if($totalpost >= $posts_per_page){ ?>
        <div class="load-more text-center mt-0">
            <div id="loader"></div>
            <a class="btn btn-primary" href="javascript:void(0);" onClick="postListFilter(this)">Load more</a>
        </div>
    <?php } ?>
    </div>
</section>
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
<?php } else if( get_row_layout() == 'sub_heading_white_section_page' ){ 
        $display_section = get_sub_field('content_page_display_section');
        $imageclone = get_sub_field('content_page_right_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'sub_heading_second_section_page' ){ ?>
<section class="section section-content column-content bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-skyblue-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'sub_heading_third_section_page' ){ 
        $display_section = get_sub_field('content_page_display_section');
        $imageclone = get_sub_field('content_page_left_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-third-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'title_with_content_page' ){ ?>
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
<?php }else if( get_row_layout() == 'credential_and_logo_section_page' ){?>
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