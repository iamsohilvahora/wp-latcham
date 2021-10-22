<?php

/**
Template Name: Home Page
**/

get_header();
if( have_rows('home_flexible_content') ){
	while ( have_rows('home_flexible_content') ) { the_row();		
	//var_dump(get_row_layout());
	if( get_row_layout() == 'top_slider' ){
		$top_slider = get_sub_field('top_slider');	
				
?> 

<section class="section hero-banner hero-section">
	<div class="container">
		<div class="hero-slider">
			<?php if(!empty($top_slider)){ 
				foreach ($top_slider as $slider) {
					$top_slider_button = $slider['top_slider_button'];
				?>
			<div class="item">
				<div class="container">
					<div class="row">
						<div class="col col-sm-5 slide-content">
							<?php if(!empty($slider['top_slider_title'])){ ?>
							<h1 class="title"><?php echo $slider['top_slider_title']; ?></h1>
							<?php } 
							if(!empty($slider['top_slider_text'])){
							?>
							<p class="p-large"><?php echo $slider['top_slider_text']; ?></p>
							<?php } 

							if(!empty($top_slider_button)):
				                echo button_group($top_slider_button,'btn btn-primary');   
				              endif;
						?>
						</div>
						<?php if(!empty($slider['top_slider_image'])){ ?>
						<div class="col col-sm-7 slide-image">
							<span class="slide-img">
								<img src="<?php echo $slider['top_slider_image']['sizes']['home_banner']?>">
							</span>
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		<?php } }  ?>		
		</div>
	</div>

	<div class="dot-pattern-image">
		<div class="img-container">
			<img src="<?php echo get_template_directory_uri()?>/images/dot-matrix-latest.gif">
		</div>
		<div class="shape-1 line"></div>
		<div class="shape-2 line"></div>
		<div class="shape-3 line"></div>
	</div>
</section>

<?php } } } 
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
<?php } } } ?>
<?php get_footer(); ?>