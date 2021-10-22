<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'sub_heading_third_section' && $_POST['ajaxIndex'] == get_row_index()):
          	$imageclone = get_sub_field('left_image');
            $ImageNull = checkImageNull($imageclone);
            $right_title_third = get_sub_field('right_title');
            $content = get_sub_field('content');
            $button = get_sub_field('button');
            $btnlabel = $button['button_label'];
            $button_link = $button['button_link'];
            $button_internal_link = $button['button_internal_link'];
            $button_external_link = $button['button_external_link'];
            if($button_link == 'button_internal_link'){
                $btnurl =latcham_external_link($button_internal_link,false);
            }else{
                $btnurl =latcham_external_link($button_external_link,true);
            }
?>          	
  <div class="container">
        <div class="row align-items-center">
            <div class="col col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($right_title_third)){?>
                    <h2 class="title"><?php echo $right_title_third; ?></h2>
                    <?php } if(!empty($content)){ ?>
                    <p><?php echo $content; ?></p>
                    <?php } if(!empty($btnlabel) && !empty($btnurl)){?>
                    <div class="button-group">
                        <a <?php echo $btnurl; ?> class="btn btn-primary"><?php echo $btnlabel; ?></a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <?php if(!empty($ImageNull)){ ?>
            <div class="col col-sm-12 col-lg-6 image">
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
    </div>
<?php
  endif;
      endwhile;
endif;
?>