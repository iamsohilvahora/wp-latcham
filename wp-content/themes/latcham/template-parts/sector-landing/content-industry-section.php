<?php 
if(have_rows('sector_content', $post_id)):
      while(have_rows('sector_content', $post_id)): the_row();
          if( get_row_layout() == 'industry_section' && $_POST['ajaxIndex'] == get_row_index()):
	          $sector_industry_section_label = get_sub_field('sector_industry_section_label');
			  $sector_industry_section_link = get_sub_field('sector_industry_section_link');
		  	  $sector_industry_section_list_post = get_sub_field('sector_industry_section_list_post');
?>
<div class="container">
		<div class="section-head with--btn">
			<?php if(!empty($sector_industry_section_label)){ ?>
			<h2 class="title"><?php echo $sector_industry_section_label; ?></h2>
			<?php }
				if(!empty($sector_industry_section_link)){
                            echo button_group($sector_industry_section_link,'btn btn-primary');   
                        }
			 ?>
		</div>

		<div class="industry-post-row">
			<div class="industry-post-items">
				<?php $i =0; if(!empty($sector_industry_section_list_post)){ 

						foreach ($sector_industry_section_list_post as $industry_post) {
						$title = get_the_title( $industry_post->ID );
						 $permalink = get_permalink( $industry_post->ID );
						 $industry_list_small_text = get_field("industry_list_small_text",$industry_post->ID);
						?>
				<div class="item <?php if($i == 1){echo "active";}?>">
					<div class="item-inner">
						<h5 class="link-text"><?php echo $title; ?></h5>
						<div class="hover-content">
							<div class="inner">
								<h5><?php echo $title; ?></h5>
								<?php if(!empty($industry_list_small_text)): ?>
								<p><?php echo mb_strimwidth($industry_list_small_text, 0, 130, '...');?></p>
								<?php endif; ?>	
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