<?php

/**
Template Name: Services Page
**/

get_header();
$service_page_banner_title = get_field('service_page_banner_title');
$service_page_banner_description = get_field('service_page_banner_description');

$filter_terms = get_terms( array(
    'taxonomy' => array('industry-category','solutions-category'),
    'hide_empty' => false,
) );
?> 
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <?php if(!empty($service_page_banner_title)){ ?>
                    <h1 class="title"><?php echo $service_page_banner_title; ?></h2>
                    <?php } if(!empty($service_page_banner_description)){ ?>
                    <p><?php echo $service_page_banner_description; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="section section-utilities services-section bg-skyblue">
    <div class="container">
        <div class="filter">
            <div class="row no-gutters">
                <div class="filter-col d-flex align-items-center">
                    <label>Filter by industry</label>
                    <select name="industry_term" class="form-control shadow-none industry_term">
                    	<option value="">Select category</option>
                        <?php if(!empty($filter_terms)){ 
                                foreach($filter_terms as $t){
                                    if($t->taxonomy == 'industry-category'){
                         ?>
                                    <option value="<?php echo $t->term_id; ?>"><?php echo $t->name; ?></option>
                    	<?php } } } ?>                        
                    </select>
                </div>
                <div class="filter-col d-flex align-items-center">
                    <label>Filter by solution</label>
                    <select name="solutions_term" class="form-control shadow-none solutions_term">
                    <option value="">Select category</option>	
                    <?php if(!empty($filter_terms)){ 
                            foreach($filter_terms as $t){ 
                                if($t->taxonomy == 'solutions-category'){
                        ?>
                        <option value="<?php echo $t->term_id; ?>"><?php echo $t->name; ?></option>
                        <?php } } }?>
                    </select>
                </div>
            </div>
        </div>
        <?php $posts_per_page = 9;
            $args = array('post_type' => 'service');
            $the_query = new WP_Query( $args );
            $totalpost = $the_query->found_posts;
            $the_query = new WP_Query( array('posts_per_page'=> $posts_per_page,'post_type' => 'service', 'post_status' => 'publish' ,  'order' => 'DESC') );

             if( $the_query->have_posts() ){
        ?>

        <div class="row">
        	<div id="Show_articals" class="articallisting post-listing"> 
            <div id="html_loader" class="main-loader"></div>        
                    <div class="row" id="appenddata"> 
        	<?php  while( $the_query->have_posts() ){ 
                    $the_query->the_post();                               
                    $params['post_id'] = get_the_ID();                
                    bb_get_template_part( 'template-parts/content', 'service-post-list',$params); 

             }wp_reset_postdata(); ?>             
         </div>
     </div>
        </div>
    <?php } 
     if($totalpost >= $posts_per_page){ ?>
        <div class="load-more text-center loadmore">
                <div id="loader"></div>
            <a href="javascript:;" class="btn btn-primary serviceloadmore">Load more</a>
            <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
            
        </div>
        <?php } ?>
    </div>
</section>
<?php if(!empty($service_page_solution_section)){ ?>
<section class="section section-solution">
    <div class="container">
        <div class=" gutters-20 solution-row">
            <?php  if(!empty($service_page_solution_section)){ 
                    foreach ($service_page_solution_section as $solution_post) {
                     $title = get_the_title( $solution_post->ID );
                     $permalink = get_permalink( $solution_post->ID );
                     $featured_img_url = get_the_post_thumbnail_url($solution_post->ID,'our_post'); 
                     $solutions_image_1 = get_field('solutions_image_1',$solution_post->ID);
                     $solutions_image_2 = get_field('solutions_image_2',$solution_post->ID);
                     $short_descreption = get_field('short_descreption',$solution_post->ID);
                    ?>
            <div class="item">
                <div class="solution-post">
                    <div class="thumb">
                        
                        <div class="img-wrap">
                            <span class="dot-animation"></span>
                            <?php if(!empty($solutions_image_1)){ ?>
                            <img class="main-img" src="<?php echo $solutions_image_1['sizes']['solutions_section']; ?>">
                            <?php } ?>
                            <!-- <img class="for-mobile" src="<?php echo get_template_directory_uri()?>/images/media/dotmatrix-1.png"> -->
                            <?php if(!empty($solutions_image_2)){ ?>
                            <img class="for-mobile"  src="<?php echo $solutions_image_2['sizes']['solutions_section']; ?>">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="summary">
                        <h5><?php echo $title; ?></h5>
                        <p><?php echo mb_strimwidth($short_descreption, 0, 51, '...');?></p>
                        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-primary">Find out more</a>
                    </div>
                    <a href="<?php echo esc_url( $permalink ); ?>" class="box-link"></a>
                </div>
            </div>
        <?php } } ?>                
        </div>
    </div>
</section>
<?php } 
if( have_rows('page_flexible_content') ){
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

<!-- <section class="section section-solution solution-with-video ajaxContent" ajaxIndex="<?php //echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="section-solution"><div class="loader"></div></section> -->
<section class="section section-solution ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="section-solution"><div class="loader"></div></section>

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