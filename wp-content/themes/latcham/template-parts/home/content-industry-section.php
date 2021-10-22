<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'industry_section' && $_POST['ajaxIndex'] == get_row_index() ):
	          $home_industry_section_label = get_sub_field('home_industry_section_label');
			$home_industry_section_link = get_sub_field('home_industry_section_link');
	      if($home_industry_section_link['button_link'] == 'button_internal_link'){ $specialisms_url = latcham_external_link($home_industry_section_link['button_internal_link'],false); }
		  if($home_industry_section_link['button_link'] == 'button_external_link'){ $specialisms_url = latcham_external_link($home_industry_section_link['button_external_link'],true); }
		  $home_industry_section_list_post = get_sub_field('home_industry_section_list_post');
?>
<div class="container">
		<div class="section-head with--btn">
			<?php if(!empty($home_industry_section_label)){ ?>
			<h2 class="title"><?php echo $home_industry_section_label; ?></h2>
			<?php }
				if(!empty($home_industry_section_link['button_label']) && $specialisms_url != ""){
			 ?>
			<a <?php echo $specialisms_url; ?> class="btn btn-primary"><?php echo $home_industry_section_link['button_label']; ?></a>
		<?php } ?>
		</div>

		<div class="industry-post-row">
			<div class="industry-post-items">
				<?php $i =0; if(!empty($home_industry_section_list_post)){ 

						foreach ($home_industry_section_list_post as $industry_post) {
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
<?php
  endif;
      endwhile;
endif;
?>