<?php 
if(have_rows('careers_content', $post_id)):
      while(have_rows('careers_content', $post_id)): the_row();
          if( get_row_layout() == 'job_join_section'  && $_POST['ajaxIndex'] == get_row_index()):
	          $job_title = get_sub_field('job_title');
            $job_content = get_sub_field('job_content');
            $job_button = get_sub_field('job_button');
            $job_image = get_sub_field('job_image');
?>
<div class="container">
        <div class="row align-items-center">
            <div class="col col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($job_title)): ?>  
                    <h2 class="title"><?php echo $job_title; ?></h2>
                    <?php endif;
                    if(!empty($job_content)): ?>
                    <p><?php echo $job_content; ?></p>
                    <?php endif; 

                    if(!empty($job_button)): ?>
                        <div class="button-group">
                            <?php echo button_group($job_button,'btn btn-primary'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if(!empty($job_image)): ?>
            <div class="col col-sm-12 col-lg-6 image">
                <?php if($job_image['select_type'] == 'Image'){ ?>
                    <img src="<?php echo $job_image['top_slider_image']['sizes']['job_detail_image_size']?>">
                <?php }else { 
                     if($job_image['top_slider_video_select'] == 'internal'){ ?>
                        <video controls autoplay>
                              <source src="<?php echo $job_image['top_slider_video']['url']; ?>" type="video/mp4">
                              <source src="<?php echo $job_image['top_slider_video']['url']; ?>" type="video/ogg">
                              Your browser does not support the video tag.
                        </video>
                     <?php }else{ 
                            $video_url = video_url($job_image['video_url']);
                        ?>  
                        <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php } } ?>                
            </div>
            <?php endif; ?>

        </div>
</div>


<?php
  endif;
      endwhile;
endif;
?>