<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'market_leading_section' && $_POST['ajaxIndex'] == get_row_index() ):
	          $market_leading_section_title = get_sub_field('market_leading_section_title');
	          $market_leading_section_content = get_sub_field('market_leading_section_content');
	          $market_leading_section_image = get_sub_field('market_leading_section_image');
	          $market_leading_section_link_1 = get_sub_field('market_leading_section_link_1');
	          if($market_leading_section_link_1['button_link'] == 'button_internal_link'){ $about_url = latcham_external_link($market_leading_section_link_1['button_internal_link'],false); }
			  if($market_leading_section_link_1['button_link'] == 'button_external_link'){ $about_url = latcham_external_link($market_leading_section_link_1['button_external_link'],true); }
	          
	          $market_leading_section_link_2 = get_sub_field('market_leading_section_link_2');
	          if($market_leading_section_link_2['button_link'] == 'button_internal_link'){ $work_url = latcham_external_link($market_leading_section_link_2['button_internal_link'],false); }
			  if($market_leading_section_link_2['button_link'] == 'button_external_link'){ $work_url = latcham_external_link($market_leading_section_link_2['button_external_link'],true); }
?>
<div class="container">
	<div class="row no-gutters align-items-center image-conetnt-block">
		<div class="col col-sm-12 col-lg-6">
			<div class="summary">
				<?php if(!empty($market_leading_section_title)){ ?>
				<h2 class="title"><?php echo $market_leading_section_title; ?></h2>
				<?php } 
				if(!empty($market_leading_section_content)){echo $market_leading_section_content;}?>
				<div class="button-group">
					<?php if(!empty($market_leading_section_link_1['button_label']) && $about_url !=""){ ?>
					<a <?php echo $about_url; ?> class="btn btn-primary"><?php echo $market_leading_section_link_1['button_label']; ?></a>
					<?php } 
						if(!empty($market_leading_section_link_2['button_label']) && $work_url != ""){
					?>
					<a <?php echo $work_url; ?> class="btn btn-link"><?php echo $market_leading_section_link_2['button_label']; ?></a>
				<?php } ?>
				</div>
			</div>
		</div>
		<?php if(!empty($market_leading_section_image)){ ?>
		<div class="col col-sm-12 col-lg-6">
			<div class="thumb">
			<?php if($market_leading_section_image['select_type'] == 'Image'){ ?>
				<div class="image-container">
					<img src="<?php echo $market_leading_section_image['top_slider_image']['sizes']['content_solutions']?>">
				</div>
			<?php }else { 
					if($market_leading_section_image['top_slider_video_select'] == 'internal'){ ?>
					<div class="video-container">
					 	<video controls autoplay>
							  <source src="<?php echo $market_leading_section_image['top_slider_video']['url']; ?>" type="video/mp4">
							  <source src="<?php echo $market_leading_section_image['top_slider_video']['url']; ?>" type="video/ogg">
							  Your browser does not support the video tag.
						</video>
					</div>
				 <?php }else{ 
				 		$video_url = video_url($market_leading_section_image['video_url']);
				 	?>	
				 	<div class="video-container">
						<iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>

			<?php } } ?>
			</div>
		</div>
	<?php } ?>
	</div>
</div>
<?php
  endif;
      endwhile;
endif;
?>