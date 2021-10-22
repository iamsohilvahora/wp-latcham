<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'green_dream_section_page' && $_POST['ajaxIndex'] == get_row_index()):
          	$title = get_sub_field('content_page_title');
            $content = get_sub_field('content_page_content');
            $find_out_button = get_sub_field('content_page_find_out_button');
            $button_label = $find_out_button['button_label'];
            $button_link = $find_out_button['button_link'];
            $internal_link = $find_out_button['button_internal_link'];
            $external_link = $find_out_button['button_external_link'];
            if($button_link == 'button_internal_link'){
                $btnurl =latcham_external_link($internal_link,false);
            }else{
                $btnurl =latcham_external_link($external_link,true);
            }
            
            $link = get_sub_field('content_page_link');
            $link_label = $link['button_label'];
            $link_type = $link['button_link'];
            $internal_link2 = $link['button_internal_link'];
            $external_link2 = $link['button_external_link'];
            if($link_type == 'button_internal_link'){
                $linkurl =latcham_external_link($internal_link2,false);
            }else{
                $linkurl =latcham_external_link($external_link2,true);
            }
            $imageclone = get_sub_field('content_page_image');
            $ImageNull = checkImageNull($imageclone);
?>          	
 <div class="container">
    <div class="row align-items-center">

        <div class="col col-sm-12 col-lg-6 content">
          <div class="content-inner">
            <?php if(!empty($title)){ ?>
            <h2 class="title"><?php echo $title; ?></h2>
            <?php } if(!empty($content)){ ?>
            <?php echo $content; } ?>

            <div class="button-group">
                <?php if(!empty($button_label) && !empty($btnurl)){ ?>
                <a <?php echo $btnurl; ?> class="btn btn-primary"><?php echo $button_label; ?></a>
                <?php } if(!empty($link_label) && !empty($linkurl)){ ?>
                <a <?php echo $linkurl;?> class="btn btn-link"><?php echo $link_label; ?></a>
                <?php } ?>
            </div>
          </div>  
        </div>

        <?php if(!empty($ImageNull)) { ?>
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
</div>
<?php
  endif;
      endwhile;
endif;
?>

