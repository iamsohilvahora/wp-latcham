<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'sub_heading_white_section' && $_POST['ajaxIndex'] == get_row_index()):
          	  $heading_title = get_sub_field('title');
              $description = get_sub_field('description');
              $button = get_sub_field('button');
              $imageclone = get_sub_field('right_image');
              $ImageNull = checkImageNull($imageclone);
              
?>          	
 <div class="container">
        <div class="row align-items-center">
            <div class="col col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($heading_title)) { ?>
                    <h2 class="title"><?php echo $heading_title; ?></h2>
                    <?php } if(!empty($description)) { ?>
                    <p><?php echo $description; ?></p>
                    <?php }  if(!empty($button)){ ?>
                    <div class="button-group">
                        <?php echo button_group($button,'btn btn-primary');  ?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php if(!empty($ImageNull)){ ?>
            <div class="col col-sm-12 col-lg-6 image text-right">
              <div class="thumb">
                <?php if($imageclone['select_type'] == 'Image'){ ?>
                <div class="image-container">
                  <img src="<?php echo $imageclone['top_slider_image']['sizes']['content_solutions']?>">
                </div>
                <?php }else { 
                    if($imageclone['top_slider_video_select'] == 'internal'){ ?>
                    <div class="video-container"> 
                      <video controls autoplay>
                          <source src="<?php echo $imageclone['top_slider_video']['url']; ?>" type="video/mp4">
                          <source src="<?php echo $imageclone['top_slider_video']['url']; ?>" type="video/ogg">
                          Your browser does not support the video tag.
                      </video>
                    </div>
                   <?php }else{ 
                      $video_url = video_url($imageclone['video_url']);
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