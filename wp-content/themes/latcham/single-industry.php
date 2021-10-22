<?php
get_header();
$id = get_the_id();
$terms = get_the_terms($id, 'industry-category');

$termsIds = array();
if(!empty($terms)){
    foreach($terms as $term){
        $termsIds[] = $term->term_id;
    }
}
while ( have_posts() ) :
            the_post();

$industry_post_top_video = get_field('industry_post_top_video');
$industry_post_enquire_button = get_field('industry_post_enquire_button');
if(!empty($industry_post_top_video['top_slider_image']) || !empty($industry_post_top_video['top_slider_video']) || !empty($industry_post_top_video['video_url'])){
    $videocls = "content-with-top-video";
}else{
    $videocls = "content-without-video";
}
?> 
<section class="content-page-top <?php echo $videocls; ?> hero-section section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <h1 class="title title-2"><?php the_title(); ?></h1>
            <div class="row align-items-center">
                <?php the_content(); ?>
                <div class="col-12">
                    <?php if(!empty($industry_post_enquire_button)){
                                echo button_group($industry_post_enquire_button,'btn btn-primary');   
                            }
                    ?>
                </div>
            </div>
        </div>
    </div>    
<?php $ImageNull = checkImageNull($industry_post_top_video); 
            if($ImageNull){
 if($industry_post_top_video['select_type'] == 'Image' && $industry_post_top_video['top_slider_image']['sizes']['content_solutions'] != ""){ ?>
                    <div class="section-content-video">
                        <div class="container">            
                            <div class="video-content mp4-video"> 
                                <div class="image-container">
                                    <div class="bg-cover" style="  background-image: url('<?php echo $industry_post_top_video['top_slider_image']['sizes']['content_solutions']?>');">
                                        <img src="<?php echo get_template_directory_uri()?>/images/placeholder/placeholder-50x28.png">
                                    </div>
                            </div>
                        </div>
                    </div>
            <?php }else { 
                    if($industry_post_top_video['top_slider_video_select'] == 'internal' && $industry_post_top_video['top_slider_video']['url'] != ""){ ?>
                    <div class="section-content-video">
                        <div class="container">            
                            <div class="video-content mp4-video">     
                    <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>
                    <div class="banner-video-wrap">
                         <div class='player'>
                            <video class="video" width="100%" controls> 
                              <source src="<?php echo $industry_post_top_video['top_slider_video']['url']; ?>" type="video/mp4">
                            </video>
                            <a href="javascript:void(0);" class="play-btn"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                 <?php }else{ 
                        $video_url = video_url($industry_post_top_video['video_url']);
                        if(!empty($video_url)){
                    ?>
                    <div class="section-content-video">
                        <div class="container">            
                            <div class="video-content mp4-video"> 
                    <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>  
                    <div class="banner-video-wrap">
                        <div class="banner-video-wrap" id="youtube-wrap">
                            <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="play-btn play-icon"></a>
                </div>
            </div>
        </div>
            <?php } } } ?>
                   
       
<?php } ?>
    <div class="dot-circles"></div>
</section>


<?php if( have_rows('post_flexible_content') ){
    while ( have_rows('post_flexible_content') ) { the_row(); 
        if( get_row_layout() == 'top_video_post' ){
            $top_video = get_sub_field('content_post_youtubevimeo_url');
            $ImageNull = checkImageNull($top_video); 
            if($ImageNull){ 
            ?>
<section class="section section-content-video after--bg ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="content" sectionName="video-section"><div class="loader"></div></section>
<?php } } else if( get_row_layout() == 'usps_section_post' ){  ?>
<section class="usps-section ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="usps-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'sub_heading_white_section_post' ){ 
        $display_section = get_sub_field('content_post_display_section');
        $imageclone = get_sub_field('content_post_right_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="subheading-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'sub_heading_second_section_post' ){ ?>
<section class="section section-content column-content bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="subheading-skyblue-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'sub_heading_third_section_post' ){ 
        $display_section = get_sub_field('content_post_display_section');
        $imageclone = get_sub_field('content_post_left_image');
        $ImageNull = checkImageNull($imageclone);
        if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';}
    ?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="subheading-third-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'title_with_content_post' ){ ?>
<section class="section section-content column-content bg-white ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="titlewithcontent-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'solution_section_post' ){ ?>
<section class="section section-solution solution-with-video ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="section-solution"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'industry_section_post' ){ ?>
<section class="section section-industry bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="industry-section"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'case_studies_section_post' ){
 ?>
<section class="section section-image-conetnt section-post-box section-case-study ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="sector-case-study-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'services_section_post' ){ ?>
<section class="section section-utilities services-section hover-dots-effect bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="sector-service-post-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'faq_section_post' ){ ?>
<section class="section section-faq ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="faq-section"><div class="loader"></div></section>

<?php } else if( get_row_layout() == 'related_post_section_post' ) { ?>

<section class="section section-post-box ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="related-post-section"><div class="loader"></div></section>

<?php }else if( get_row_layout() == 'logo_post_section_post' ){ ?>

<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="logo-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'customer_logos_section_post' ) { ?>
<section class="section section-client-logo client-logo-less ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="customer-logo-post-section"><div class="loader"></div></section>
<?php } else if( get_row_layout() == 'green_dream_section_post' ){ 
    $display_section = get_sub_field('content_post_display_section');
    $imageclone = get_sub_field('content_post_image');
    $ImageNull = checkImageNull($imageclone);
    if($ImageNull){$imgDispaly = ' image--'.$display_section;}else{$imgDispaly = '';} 
?>
<section class="section section-content section-image-conetnt <?php echo $imgDispaly; ?> top-less-space  ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="green-dream"><div class="loader"></div></section>
<?php }else if( get_row_layout() == 'credential_and_logo_section_post' ){?>
<section class="section section-client-logo our-creditential-section bg-skyblue ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="our-creditential-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'testimonial_section_post' ){?>
<section class="section section-testimonials ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="post-content" sectionName="testimonials-section"><div class="loader"></div></section>
<?php }
else if( get_row_layout() == 'contact_form_section_post' ){ 
        $title = get_sub_field('content_post_title');
        $description = get_sub_field('content_post_description');
        $shortcode = get_sub_field('content_post_shortcode');
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
endwhile;  get_footer(); ?>