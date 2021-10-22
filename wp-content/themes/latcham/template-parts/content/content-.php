<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'top_video' && $_POST['ajaxIndex'] == get_row_index()):
          	$youtubevimeo_url = get_sub_field('youtubevimeo_url');
?>          	
<div class="container">
      <?php  
      if($youtubevimeo_url['top_slider_video_select'] == 'internal'){ ?>
        <div class="video-content mp4-video"> 
             
            <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')">
              <img src="<?php echo get_template_directory_uri()?>/images/placeholder/placeholder-50x28.png">
            </div>
            <div class="banner-video-wrap">
                 <div class='player'>
                    <video class="video" width="100%" controls> 
                      <source src="<?php echo $youtubevimeo_url['top_slider_video']['url']; ?>" type="video/mp4">
                    </video>
                    <a href="javascript:void(0);" class="play-btn"></a>
                </div>
            </div>
        </div>
        <?php } else{ 
                $video_url = video_url($youtubevimeo_url['video_url']);
            ?>
            <div class="video-content iframe-video">
            <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')">
            </div>
            <div class="banner-video-wrap">
                 <div class="banner-video-wrap" id="youtube-wrap">
                    <iframe class="lazyload youtube-video" src="<?php echo $video_url; ?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
                </div>
            </div>
            <a href="javascript:void(0);" class="play-btn play-icon"></a>
        </div>
       <?php } ?>
    </div>
<?php
  endif;
      endwhile;
endif;
?>

