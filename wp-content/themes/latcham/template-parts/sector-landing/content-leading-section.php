<?php 
if(have_rows('sector_content', $post_id)):
      while(have_rows('sector_content', $post_id)): the_row();
          if( get_row_layout() == 'market_leading_section' && $_POST['ajaxIndex'] == get_row_index()):
	          $sector_market_leading_section_title = get_sub_field('sector_market_leading_section_title');
			  $sector_leading_section_content = get_sub_field('sector_leading_section_content');
		  	  $market_leading_section_image = get_sub_field('market_leading_section_image');
		  	  $sector_market_leading_section_button = get_sub_field('sector_market_leading_section_button');
              
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col col-sm-12 col-lg-6 content">
            <div class="content-inner">
            	<?php if(!empty($sector_market_leading_section_title)){ ?>
                <h2 class="title"><?php echo $sector_market_leading_section_title; ?></h2>
            	<?php } if(!empty($sector_leading_section_content)){ echo $sector_leading_section_content; }
            	if(!empty($sector_market_leading_section_button)){
            	?>
                <div class="button-group">
                	<?php echo button_group($sector_market_leading_section_button,'btn btn-primary');  ?>
                </div>
            	<?php } ?>
            </div>
        </div>
        <div class="col col-sm-12 col-lg-6 image text-right">
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
    </div>
</div>
<?php
  endif;
      endwhile;
endif;
?>