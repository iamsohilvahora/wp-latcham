<?php 
if(have_rows('case_study_content', $post_id)):
      while(have_rows('case_study_content', $post_id)): the_row();
          if( get_row_layout() == 'service_section' && $_POST['ajaxIndex'] == get_row_index()):
            $service_post = get_sub_field('service_post');
?>
<div class="container">
      <?php if(!empty($service_post)){ ?>
      <div class="row">
          <?php foreach($service_post as $service){
              $service_short_description = get_field('service_short_description',$service->ID);
           ?>
          <div class="col-sm-6 col-lg-4 item">
              <div class="item-inner">
                  <h5><?php echo $service->post_title; ?></h5>
                  <p><?php echo mb_strimwidth($service_short_description, 0, 140, '...'); ?></p>
              </div>
          </div>
          <?php } ?>
      </div>
  <?php } ?>
</div>
<?php
  endif;
      endwhile;
endif;
?>