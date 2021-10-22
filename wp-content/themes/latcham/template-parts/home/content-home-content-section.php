<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'content_sections' && $_POST['ajaxIndex'] == get_row_index() ):
          	$home_content_sections_image_1 = get_sub_field('home_content_sections_image_1');
          	$home_content_sections_title_1 = get_sub_field('home_content_sections_title_1');
          	$home_content_sections_description_1 = get_sub_field('home_content_sections_description_1');
          	$home_content_sections_button_1 = get_sub_field('home_content_sections_button_1');
          	if($home_content_sections_button_1['button_link'] == 'button_internal_link'){ $btn1_url = latcham_external_link($home_content_sections_button_1['button_internal_link'],false); }
	  		if($home_content_sections_button_1['button_link'] == 'button_external_link'){ $btn1_url = latcham_external_link($home_content_sections_button_1['button_external_link'],true); }
          	$home_content_sections_title_2 = get_sub_field('home_content_sections_title_2');
          	$home_content_sections_description_2 = get_sub_field('home_content_sections_description_2');
          	$home_content_sections_button_2 = get_sub_field('home_content_sections_button_2');
          	if($home_content_sections_button_2['button_link'] == 'button_internal_link'){ $btn2_url = latcham_external_link($home_content_sections_button_2['button_internal_link'],false); }
	  		if($home_content_sections_button_2['button_link'] == 'button_external_link'){ $btn2_url = latcham_external_link($home_content_sections_button_2['button_external_link'],true); }
          	$home_content_sections_button_3 = get_sub_field('home_content_sections_button_3');
          	if($home_content_sections_button_3['button_link'] == 'button_internal_link'){ $btn3_url = latcham_external_link($home_content_sections_button_3['button_internal_link'],false); }
	  		if($home_content_sections_button_3['button_link'] == 'button_external_link'){ $btn3_url = latcham_external_link($home_content_sections_button_3['button_external_link'],true); }
          	$home_content_sections_image_2 = get_sub_field('home_content_sections_image_2');

?>          	
<section class="section section-content section-image-conetnt image--left">
	<div class="container">
		<div class="row no-gutters align-items-center image-conetnt-block">
			<div class="col col-sm-12 col-lg-6">
				<div class="summary">
					<?php if(!empty($home_content_sections_title_1)){ ?>
					<h2 class="title"><?php echo $home_content_sections_title_1; ?></h2>
					<?php } if(!empty($home_content_sections_description_1)){ ?>
					<p><?php echo $home_content_sections_description_1; ?></p>
					<?php } 
					if(!empty($home_content_sections_button_1['button_label']) && $btn1_url != ""){
					?>
					<div class="button-group">
						<a <?php echo $btn1_url; ?> class="btn btn-primary"><?php echo $home_content_sections_button_1['button_label'];?></a>
					</div>
					<?php } ?>
				</div>
			</div>
			<div class="col col-sm-12 col-lg-6">
				<div class="thumb">
					<?php if($home_content_sections_image_1['select_type'] == 'Image'){ ?>
					<div class="image-container">
						<img src="<?php echo $home_content_sections_image_1['top_slider_image']['sizes']['content_solutions']?>">
					</div>
					<?php }else { 
							if($home_content_sections_image_1['top_slider_video_select'] == 'internal'){ ?>
							<div class="video-container">	
							 	<video controls autoplay>
									  <source src="<?php echo $home_content_sections_image_1['top_slider_video']['url']; ?>" type="video/mp4">
									  <source src="<?php echo $home_content_sections_image_1['top_slider_video']['url']; ?>" type="video/ogg">
									  Your browser does not support the video tag.
								</video>
							</div>
						 <?php }else{ 
						 		$video_url = video_url($home_content_sections_image_1['video_url']);
						 	?>
						 	<div class="video-container">	
								<iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
					<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section section-content section-image-conetnt image--right">
	<div class="container">
		<div class="row no-gutters align-items-center image-conetnt-block">
			<div class="col col-sm-12 col-lg-6">
				<div class="summary">
				<?php if(!empty($home_content_sections_title_2)){ ?>
				<h2 class="title"><?php echo $home_content_sections_title_2; ?></h2>
				<?php } if(!empty($home_content_sections_description_2)){ ?>
				<p><?php echo $home_content_sections_description_2; ?></p>
				<?php } ?>
				<div class="button-group">
					<?php if(!empty($home_content_sections_button_2['button_label']) && $btn2_url){ ?>
					<a <?php echo $btn2_url; ?> class="btn btn-primary"><?php echo $home_content_sections_button_2['button_label']; ?></a>
					<?php } 
						if(!empty($home_content_sections_button_3['button_label']) && $btn3_url != ""){
					?>
					<a <?php echo $btn3_url; ?> class="btn btn-link"><?php echo $home_content_sections_button_3['button_label']?></a>
				<?php } ?>
				</div>
				</div>
			</div>
			<div class="col col-sm-12 col-lg-6">
				<div class="thumb">
					<?php if($home_content_sections_image_2['select_type'] == 'Image'){ ?>
					<div class="image-container">
						<img src="<?php echo $home_content_sections_image_2['top_slider_image']['sizes']['content_solutions']?>">
					</div>
				<?php }else { 
						if($home_content_sections_image_2['top_slider_video_select'] == 'internal'){ ?>
						<div class="video-container">
						 	<video controls autoplay>
								  <source src="<?php echo $home_content_sections_image_2['top_slider_video']['url']; ?>" type="video/mp4">
								  <source src="<?php echo $home_content_sections_image_2['top_slider_video']['url']; ?>" type="video/ogg">
								  Your browser does not support the video tag.
							</video>
						</div>
					 <?php }else{ 
					 		$video_url = video_url($home_content_sections_image_2['video_url']);
					 	?>
					 	<div class="video-container">	
							<iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
				<?php } } ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
  endif;
      endwhile;
endif;
?>