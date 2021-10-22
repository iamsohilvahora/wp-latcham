<?php get_header();
$short_description = get_field('short_description');
$case_study_post_video = get_field('case_study_post_video');
if(!empty($case_study_post_video['top_slider_image']) || !empty($case_study_post_video['top_slider_video']) || !empty($case_study_post_video['video_url'])){
    $videocls = "content-with-top-video";
}else{
    $videocls = "content-without-video";
}
while ( have_posts() ) :
            the_post();
$terms = array();
$filter_terms = get_the_terms( get_the_ID(),'industry-category');         
if(!empty($filter_terms)){
    foreach ($filter_terms as $term) {
        $terms[] =  $term->name;
    }
}
$top_left_section = get_field('top_left_section');  
$casestudy_top_left_section_text = $top_left_section['casestudy_top_left_section_text'];  
$casestudy_service_text = $top_left_section['casestudy_service_text'];  
$casestudy_select_pdf_file = $top_left_section['select_pdf_file'];
$download_popup_text = get_field('download_popup_text','option');    
$casestudy_pdf_file = $top_left_section['post_pdf_file'];  
$casestudy_pdf_url = $top_left_section['post_pdf_url'];
?> 
<section class="content-page-top <?php echo $videocls; ?> hero-section section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-sm-6 slide-content">
                    <h1 class="title title-2"><?php the_title();?></h1>
                    <?php if(!empty($short_description)){ ?>
                    <p><?php echo $short_description; ?></p>
                    <?php } ?>
                </div>
                <?php       
                            if(!empty($casestudy_select_pdf_file)){
                                if($casestudy_select_pdf_file == 'File'){
                                    $pdfUrl = $casestudy_pdf_file['url'];
                                }else{
                                    $pdfUrl = $casestudy_pdf_url;
                                }
                            } 
                if(!empty($top_left_section)){
                ?>
                <div class="col col-sm-6 slide-content">
                    <div class="content-page-inner">
                        <?php if(!empty($terms)){ ?>
                        <h6><?php echo implode(",",$terms);?></h6>
                        <?php } if(!empty($casestudy_top_left_section_text)){ ?>
                            <h5><?php echo $casestudy_top_left_section_text.' <strong>'.get_the_title(); ?></strong></h5>
                        <?php } if(!empty($casestudy_service_text)){ ?>
                        <ul>
                            <?php foreach($casestudy_service_text as $service){ if(!empty($service['service_text_repeater'])){ ?>
                            <li><?php echo $service['service_text_repeater']; ?></li>
                        <?php } } ?>
                        </ul>
                        <?php } ?>
                        <?php if(!empty($pdfUrl)){ ?> 
                            <a class="btn btn-primary download-icon pdfdwnload" href="javascript:;">PDF download</a>
                            
                            <?php } ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php if(!empty($case_study_post_video) &&(
    (!empty($case_study_post_video['top_slider_image']) && $case_study_post_video['select_type'] == 'Image') || 
    (!empty($case_study_post_video['top_slider_video'] && $case_study_post_video['select_type'] == 'Video' && $case_study_post_video['top_slider_video_select'] == 'internal')) || 
    (!empty($case_study_post_video['video_url']) && $case_study_post_video['select_type'] == 'Video' && $case_study_post_video['top_slider_video_select'] == 'external'))){ ?>
            <?php if($case_study_post_video['select_type'] == 'Image'){ ?>
            <div class="section-content-video">
        <div class="container">
            <div class="video-content mp4-video">     
            <div class="image-container">
                <div class="bg-cover" style="background-image: url('<?php echo $case_study_post_video['top_slider_image']['sizes']['content_solutions']?>');">
                    <img src="<?php echo get_template_directory_uri()?>/images/placeholder/placeholder-50x28.png">
                </div>
            </div>
        </div></div></div>
        <?php }else { 
                if($case_study_post_video['top_slider_video_select'] == 'internal' && $case_study_post_video['top_slider_video']['url'] != ""){ ?>
                    <div class="section-content-video">
        <div class="container">
            <div class="video-content mp4-video"> 
                <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>
                <div class="banner-video-wrap">
                     <div class='player'>
                        <video class="video" width="100%" controls> 
                          <source src="<?php echo $case_study_post_video['top_slider_video']['url']; ?>" type="video/mp4">
                        </video>
                        <a href="javascript:void(0);" class="play-btn"></a>
                    </div>
                </div>
                </div></div></div>                
             <?php }else{ 
                    $video_url = video_url($case_study_post_video['video_url']);
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
            </div></div></div>
        <?php } } } ?>
        </div>
        </div>
    </div>
<?php } ?>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
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
<section class="section section-content section-image-conetnt <?php echo $ImageNull; ?> ajaxContent" ajaxIndex="<?php echo get_row_index(); ?>" sectionTemplate="page-content" sectionName="subheading-section"><div class="loader"></div></section>
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
endwhile; get_footer(); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-centered custom-popup">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body">
            <h1 class="modal-title" id="exampleModalLabel">Download <strong>PDF</strong></h1>
            <?php if(!empty($download_popup_text)){ ?>
            <p><?php echo $download_popup_text;?></p>
        <?php } ?>
            <form method="GET" class="custom-form">
                <div class="alert alert-danger display-error" style="display: none"></div>
                <div class="row">
                    <div class="col-sm-12 form-group">
                        <input type="text" id="name" name="name" placeholder="Name*" class="form-control">
                    </div>
                    <div class="col-sm-12 form-group">
                        <input type="email" id="email" name="email" placeholder="Work email address*" class="form-control">
                    </div>
                    <div class="col-sm-12 submit-btn">
                        <div id="loader"></div>
                        <button type="submit" id="custompdfsubmit" class="btn btn-primary download-icon">PDF download</button>
                        <input type="hidden" id="sk_nonce" name="sk_nonce" value="<?php echo wp_create_nonce( 'sk_nonce' ); ?>">
                        <input type="hidden" id="postid" name="postid" value="<?php echo get_the_ID(); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>