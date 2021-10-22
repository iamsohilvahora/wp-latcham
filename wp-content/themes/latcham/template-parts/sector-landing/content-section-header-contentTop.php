<?php 
if(have_rows('sector_content', $post_id)):
      while(have_rows('sector_content', $post_id)): the_row();

          if( get_row_layout() == 'content_sections' && $_POST['ajaxIndex'] == get_row_index()):

	          $sector_content_sections_title = get_sub_field('sector_content_sections_title');
              $sector_content_sections_description = get_sub_field('sector_content_sections_description');
              $sector_content_sections_button = get_sub_field('sector_content_sections_button');
              $sector_content_sections_image = get_sub_field('sector_content_sections_image');
?>
<div class="container">
    <div class="row no-gutters align-items-center image-conetnt-block">
        <div class="col col-sm-12 col-lg-6">
            <div class="summary">
            <?php if(!empty($sector_content_sections_title)){ ?>
            <h2 class="title"><?php echo $sector_content_sections_title; ?></h2>
            <?php } if(!empty($sector_content_sections_description)){ ?>
            <p><?php echo $sector_content_sections_description; ?></p>
            <?php } if(!empty($sector_content_sections_button)){ ?>
            <div class="button-group">
                <?php echo button_group($sector_content_sections_button,'btn btn-primary'); ?>
            </div>
            <?php } ?>
        </div>
        </div>
       
        <div class="col col-sm-12 col-lg-6">
            <div class="thumb">
                <?php if($sector_content_sections_image['select_type'] == 'Image'){ ?>
                <div class="image-container">
                    <img src="<?php echo $sector_content_sections_image['top_slider_image']['sizes']['content_solutions']?>">
                </div>
                <?php }else { 
                        if($sector_content_sections_image['top_slider_video_select'] == 'internal'){ ?>
                        <div class="video-container">   
                            <video controls autoplay>
                                  <source src="<?php echo $sector_content_sections_image['top_slider_video']['url']; ?>" type="video/mp4">
                                  <source src="<?php echo $sector_content_sections_image['top_slider_video']['url']; ?>" type="video/ogg">
                                  Your browser does not support the video tag.
                            </video>
                        </div>
                     <?php }else{ 
                            $video_url = video_url($sector_content_sections_image['video_url']);
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
