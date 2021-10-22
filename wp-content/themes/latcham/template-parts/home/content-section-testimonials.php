<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'testimonials_section' && $_POST['ajaxIndex'] == get_row_index() ):
	          $home_section = get_sub_field('home_section_testimonials1');
	      	  if($home_section['testimonials'] && $home_section['testimonials_image']){
	      	  	$home_section_testimonials = $home_section;
	      	  }else{
	      	  	 $home_section_testimonials = get_field('default_testimonials_new','option');
	      	  }
	          if(!empty($home_section_testimonials)){
?>
<div class="container ">
	
	<div class="row testimonails-row align-items-center ">
		

		<div class="col-md-5 image">
			<?php if(!empty($home_section_testimonials['testimonials_image']['sizes']['large'])){ ?>
			<img src="<?php echo $home_section_testimonials['testimonials_image']['sizes']['large']; ?>">
		<?php } ?>
		</div>
		
		<div class="col-md-7  testimonials-slider">
			<div class="testimonials-carsoul">
				<?php foreach($home_section_testimonials['testimonials'] as $testimonials){ ?>
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
<?php }
  endif;
      endwhile;
endif;
?>