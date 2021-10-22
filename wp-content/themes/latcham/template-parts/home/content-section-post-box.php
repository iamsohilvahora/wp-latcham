<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'post_section' && $_POST['ajaxIndex'] == get_row_index() ):
	          $home_post_section = get_sub_field('home_post_section');
	          if(!empty($home_post_section)){
?>
<div class="section-head">
		<div class="container">
			<h2 class="title">Our latest</h2>
		</div>
	</div>
	<div class="container container-align-left">
		<div class="post-box-carsoul slide-arrow-top">
				<?php foreach($home_post_section as $home_post){ 
					$title = get_the_title( $home_post->ID );
				    $permalink = get_permalink( $home_post->ID );
				    $featured_img_url = get_the_post_thumbnail_url($home_post->ID,'our_post');
				    $post_categorie = get_the_category($home_post->ID);				    
				    $category_color = get_field("category_color", $post_categorie[0]->taxonomy.'_'.$post_categorie[0]->term_id);				    
				?>
				<div class="item">
					<div class="blog-post bg--<?php echo $category_color;?>">
						<div class="thumb bg-cover" style="background-image: url(<?php echo $featured_img_url; ?>)">
							<img class="img-hide" src="<?php echo get_template_directory_uri()?>/images/placeholder/place-24-12.png">
							<span class="post-tag"><?php echo $post_categorie[0]->name; ?></span>
						</div>
						<div class="summary">
							<span class="date"><?php $post_date = get_the_date( 'dS F Y',$home_post->ID); echo $post_date; ?></span>
							<h3 class="title h5"><?php echo $title;?></h3>
							<p><?php echo mb_strimwidth($home_post->post_content, 0, 124, '...');?></p>
							<a href="<?php echo $permalink; ?>" class="link">Read more</a>
						</div>
						<a href="<?php echo $permalink; ?>" class="box-link"></a>
					</div>
				</div>

				<?php } ?>
		</div>
	</div>
<?php }
  endif;
      endwhile;
endif;
?>