<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'top_video_page' && $_POST['ajaxIndex'] == get_row_index()):
          	$top_video = get_sub_field('content_page_youtubevimeo_url');
?>        
 <div class="container">
        
        <div class="video-content mp4-video"> 
            <?php if($top_video['select_type'] == 'Image'){ ?>
            <div class="image-container">
                <img src="<?php echo $top_video['top_slider_image']['sizes']['content_solutions']?>">
            </div>
        <?php }else { 
                if($top_video['top_slider_video_select'] == 'internal'){ ?>
                <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>
                <div class="banner-video-wrap">
                     <div class='player'>
                        <video class="video" width="100%" controls> 
                          <source src="<?php echo $top_video['top_slider_video']['url']; ?>" type="video/mp4">
                        </video>
                        <a href="javascript:void(0);" class="play-btn"></a>
                    </div>
                </div>                
             <?php }else{ 
                    $video_url = video_url($top_video['video_url']);
                ?>
                <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>  
                <div class="banner-video-wrap">
                    <div class="banner-video-wrap" id="youtube-wrap">
                        <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
                <a href="javascript:void(0);" class="play-btn play-icon"></a>
        <?php } } ?>
        </div>
    </div>  	

<?php
  endif;
      endwhile;
endif;
?>

