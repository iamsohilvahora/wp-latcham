<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package latcham
 */

get_header();

$post_top_banner = get_field('post_top_banner');
$post_default_banner = get_field('post_default_banner','option');
if(!empty($post_top_banner)){
	$banner = $post_top_banner['sizes']['post_top_banner'];
}else{
	$banner = $post_default_banner['sizes']['post_top_banner'];
}

/* Event ACF*/
$event_start_date = get_field('event_start_date');
$event_end_date = get_field('event_end_date');
$event_start_time = get_field('event_start_time');
$event_end_time = get_field('event_end_time');
$event_type = get_field('event_type');
$event_contact_detail = get_field('event_contact_detail');
$event_website = get_field('event_website');
$event_meeting_link = get_field('event_meeting_link');
$register_for_event = get_field('register_for_event');
$select_pdf_file = get_field('select_pdf_file');
$post_pdf_file = get_field('post_pdf_file');
$post_pdf_url = get_field('post_pdf_url');
$download_popup_text = get_field('download_popup_text','option');
if(!empty($select_pdf_file)){
	if($select_pdf_file == 'File'){
		$pdfUrl = $post_pdf_file['url'];
	}else{
		$pdfUrl = $post_pdf_url;
	}
}


$categories = get_the_category(get_the_ID());

if($categories){
    if($categories[0]->parent == 0){
        $IndexCatId = $categories[0]->term_id;
    }else{
        $IndexCatId = $categories[0]->parent;
    }
}
$eventTrue = false;
$catIds = array();
foreach ($categories as $cat) {	
	if($cat->term_id == 5 || $cat->parent == 5){
		$eventTrue = true;
	}
    
}
$catColor = "";
$child_categories=get_categories(array( 'parent' => $categories[0]->parent ));
foreach ($categories as $catId) {
    if($catId->parent == 0){
        $catColor = $catId->taxonomy.'_'.$catId->term_id;
    }
}
$category_color = get_field("category_color", $catColor);
$post_id = get_the_ID(); // current post ID
$cat = get_the_category(); 

$current_cat_id = $cat[0]->cat_ID; // current category ID 


if($IndexCatId == 5){
    $date_now = date('Y-m-d H:i:s');
    $posts = get_posts( array(
        'post_type' => 'post',
        'order' => 'ASC',
        'orderby' => 'meta_value',
        'meta_key' => 'event_start_date',
        'meta_query' => array(
            array(
                'key'           => 'event_start_date',
                'compare'       => '>',
                'value'         => $date_now,
                'type'          => 'DATETIME',
            )
        ),
        'tax_query'=> array(array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => 5,
                'include_children' => true
              )
        ),
    ));
}else{
    $category = get_category( get_query_var( 'cat' ) );
    $get_children_cats = array('child_of' => $category->cat_ID);
    $child_cats = get_categories( $get_children_cats );
    $child_ids = array();
    if(!empty($child_cats)){
        foreach ($child_cats as $child) {
            $child_ids[] = $child->term_id;
        }
    }
    $allCats = array_merge($child_ids,[$category->cat_ID]);
    $args = array('category__in' => array($IndexCatId), 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'DESC');
    $posts = get_posts( $args );
}

// get IDs of posts retrieved from get_posts
$ids = array();
foreach ( $posts as $thepost ) {
    $ids[] = $thepost->ID;    
}
// get and echo previous and next post in the same category
$thisindex = array_search( $post_id, $ids );
$previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : false;
$nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : false;


?>
<section class="single-inner-banner bg-cover" style="background-image: url(<?php echo $banner;?>);">
    <img src="<?php echo get_template_directory_uri()?>/images/placeholder/place-20-6.png" alt="">
</section>

<section class="single-content-area">
    <div class="container">
        <div class="row gutters-23">
            <div class="col-lg-4 col-xl-3">
                <div class="post-sidebar">
                    <div class="back-to-listing d-flex justify-content-between d-lg-block mb-4 mb-lg-0">
                        <a class="btn-link" href="<?php echo get_category_link($IndexCatId);?>">Back to <?php echo lcfirst(get_cat_name($IndexCatId));?></a>
                        
                        <div class="social-links icon-color-blue d-lg-none">                           
                            <?php if ( is_active_sidebar( 'home_right_1' ) ) : 
                                    dynamic_sidebar( 'home_right_1' );  
                                endif; ?>
                        </div>
                    </div>
                    <div class="share-post d-none d-lg-block">
                        <span>Share this</span>
                        <div class="social-links icon-color-blue">
                             <?php if ( is_active_sidebar( 'home_right_1' ) ) :     
                                     dynamic_sidebar( 'home_right_1' ); 
                                 endif; ?>  
                        
                        </div>
                    </div>
                    <?php if($eventTrue){ ?>
                    <div class="post-detail">
                        <div class="post-description">
                        	<?php if(!empty($event_start_date) && !empty($event_end_date)){ ?>
                        	<p><strong>Date:</strong><?php echo date('jS', strtotime($event_start_date)); ?> - <?php echo date('jS F Y', strtotime($event_end_date)); ?></p>
                        	<?php } if(!empty($event_type)){ ?>
                            <p><strong>Event Type:</strong><?php echo $event_type; ?></p>
                        	<?php } if(!empty($event_start_time) && !empty($event_end_time)){ ?>
                            <p><strong>Time:</strong><?php echo $event_start_time; ?> - <?php echo $event_end_time; ?></p>
                        	<?php } if(!empty($event_contact_detail)){ ?>
                            <p><strong>Contact details:</strong><a href="tel:<?php echo $event_contact_detail; ?>"><?php echo FormatPhone($event_contact_detail); ?></a></p>
                        	<?php } if(!empty($event_website)){
                        		$domain = parse_url($event_website, PHP_URL_HOST);
                        	 ?>
                            <p><a target="_blank" href="<?php echo $event_website; ?>"><?php echo $domain; ?></a></p>
                        	<?php } ?>
                        </div>
                        <div class="post-buttons">
                        	<?php if(!empty($event_meeting_link)):
					                echo button_group($event_meeting_link,'btn btn-primary btn-block');   
					              endif;
					              if(!empty($register_for_event)):
					                echo button_group($register_for_event,'btn btn-danger btn-block bg--red');   
					              endif;
					        ?>      
                            
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div class="col-lg-8 col-xl-9">
                <div class="post-content">
                	<?php if(!$eventTrue){ 
                	
                		  $date = get_the_date( 'jS F Y',$postid);	
                		}
                	?>
                    <div class="post-category text-color--<?php echo $category_color; ?>"><?php echo $categories[0]->name; ?> <span class="post-date"><?php echo $date; ?></span></div>
                    <h2 class="post-title"><?php the_title(); ?></h2>
                    <?php 
                    	the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'latcham' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							)
						);

                    ?>
                    
                    <div class="post-navigation">
                        <div class="d-flex justify-content-between">
                        	<?php  //previous_post_link( '%link', 'Previous '.lcfirst(get_cat_name($IndexCatId)), true ); ?>
                            <?php if (false !== $previd ) {?>
                        		<a class="btn bg--yellow post-previous" rel="prev" href="<?php echo get_permalink($previd) ?>">Previous <?php echo lcfirst(get_cat_name($IndexCatId));?></a>
                        	<?php }else{ ?> 
                                <a class="btn bg--yellow post-previous disabled" disabled="disabled" rel="prev" href="javascript:;">Previous <?php echo lcfirst(get_cat_name($IndexCatId));?></a>
                            <?php } ?>
                            <?php if(!empty($pdfUrl)){ ?> 
                        	<a class="btn btn-primary download-icon pdfdwnload" href="javascript:;<?php //echo $pdfUrl; ?>">PDF download</a>
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
                                                    <button type="submit" id="pdfsubmit" class="btn btn-primary download-icon">PDF download</button>
                                                    <input type="hidden" id="sk_nonce" name="sk_nonce" value="<?php echo wp_create_nonce( 'sk_nonce' ); ?>">
                                                    <input type="hidden" id="postid" name="postid" value="<?php echo get_the_ID(); ?>">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        	<?php } 
                            //next_post_link( '%link', 'Next '.lcfirst(get_cat_name($IndexCatId)), true ); ?>
                            <?php if (false !== $nextid ) { ?>
                        		<a class="btn bg--yellow post-next" rel="next" href="<?php echo get_permalink($nextid) ?>">Next <?php echo lcfirst(get_cat_name($IndexCatId));?></a>
                               <?php }else{ ?> 
                                <a class="btn bg--yellow post-next disabled" disabled="disabled" rel="next" href="javascript:;">Next <?php echo lcfirst(get_cat_name($IndexCatId));?></a>
                        	<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
	if( have_rows('post_section') ){
	while ( have_rows('post_section') ) { the_row();		
	if( get_row_layout() == 'testimonials_section' ){
		$post_testimonials_val = get_sub_field('post_testimonials');
        if($post_testimonials_val['testimonials'] && $post_testimonials_val['testimonials_image']){
            $post_testimonials = $post_testimonials_val;
        }else{
            $post_testimonials = get_field('default_testimonials_new','option');
        }
if(!empty($post_testimonials)){        
	 ?>
<section class="section section-testimonials">
    <div class="container">
        <div class="row testimonails-row align-items-center ">
            <div class="col-md-5 image">
                <?php if(!empty($post_testimonials['testimonials_image']['sizes']['large'])){ ?>
                <img src="<?php echo $post_testimonials['testimonials_image']['sizes']['large']; ?>">
                <?php } ?>
            </div>
            <div class="col-md-7  testimonials-slider">
                <div class="testimonials-carsoul">
                    <?php foreach($post_testimonials['testimonials'] as $testimonials){ ?>
                    <div class="item">
                        <?php if(!empty($testimonials['testimonials_text'])){ ?>
                        <p><?php echo $testimonials['testimonials_text']; ?></p>
                        <?php } ?>
                        <span class="author-name"><?php if(!empty($testimonials['testimonials_author'])){ ?>
                            <strong><?php echo $testimonials['testimonials_author']; ?>,</strong> <?php } if(!empty($testimonials['testimonials_author_label'])){ echo $testimonials['testimonials_author_label']; } ?> </span>
                    </div>
                    <?php } ?>          
                </div>
            </div>
        </div>
    </div>
</section>
<?php } }else if( get_row_layout() == 'solutions_section' ){
		$post_solutions_title = get_sub_field('post_solutions_title');
		$post_solutions_desription = get_sub_field('post_solutions_desription');
		
?>
<section class="section section-content column-content bg-white">
    <div class="container">
    	<?php if(!empty($post_solutions_title)){ ?>
        <h2><?php echo $post_solutions_title; ?></h2>   
    	<?php }
    		if(!empty($post_solutions_desription)){
    	 ?>
        <div class="row">
            <div class="col-sm-9">
                <p><?php echo $post_solutions_desription; ?></p>
            </div>
        </div>
    <?php } ?>
    </div>
</section>  
<?php }else if( get_row_layout() == 'industry_section' ){
	$post_industry_label = get_sub_field('post_industry_label');
	$post_industry_link = get_sub_field('post_industry_link');
	$post_industry_post = get_sub_field('post_industry_post');
 ?>
<section class="section section-industry bg-skyblue">
    <div class="container">
        <div class="section-head with--btn">
        	<?php if(!empty($post_industry_label)){ ?>
            <h2 class="title"><?php echo $post_industry_label; ?></h2>
        	<?php } 
        		if(!empty($post_industry_link)){
                echo button_group($post_industry_link,'btn btn-primary');   
              	}
        	?>
        </div>

        <div class="industry-post-row">
            <div class="industry-post-items">
            	<?php $i =0; if(!empty($post_industry_post)){ 

						foreach ($post_industry_post as $industry_post) {
						$title = get_the_title( $industry_post->ID );
						 $permalink = get_permalink( $industry_post->ID );
                         $post_content = get_field('industry_list_small_text',$industry_post->ID);
						?>
                <div class="item <?php if($i == 1){echo "active";}?>">
                    <div class="item-inner">
                        <h5 class="link-text"><?php echo $title; ?></h5>
                        <div class="hover-content">
                            <div class="inner">
                                <h5><?php echo $title; ?></h5>
                                <p><?php echo mb_strimwidth($post_content, 0, 130, '...');?></p>
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
	

<?php } } } 
//get_sidebar();
get_footer();
