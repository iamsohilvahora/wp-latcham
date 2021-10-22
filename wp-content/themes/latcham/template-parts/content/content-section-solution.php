<?php  
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'solution_section' && $_POST['ajaxIndex'] == get_row_index() ):
	        $solution = get_sub_field('solution');
	    	$solution_title = get_sub_field('solution_title');
	          
?>
<div class="container">
	<?php if(!empty($solution_title)){ ?>
        <h2 class="title title-2"><?php echo $solution_title; ?></h2>
        <?php } ?>	
			<div class=" gutters-20 solution-row">
				<?php  if(!empty($solution)){ 
						foreach ($solution as $solution_post) {
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
							<p><?php echo wp_trim_words($short_descreption, 10, ' ...');?></p>
							<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-primary">Find out more</a>
						</div>
						<div class="hover-text">
							<h5><?php echo $title; ?></h5>
							<p><?php echo wp_trim_words($short_descreption, 20, ' ...'); ?></p>
							<a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-primary">Find out more</a>
						</div>
						<a href="<?php echo esc_url( $permalink ); ?>" class="box-link"></a>
					</div>
				</div>
			<?php } } ?>				
			</div>
		</div>
<?php
  endif;
      endwhile;
endif;
?>