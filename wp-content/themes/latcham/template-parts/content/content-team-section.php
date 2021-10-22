<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'team_section_content' && $_POST['ajaxIndex'] == get_row_index() ):
            $content_team_text = get_sub_field('content_team_text');
            $content_team_description = get_sub_field('content_team_description');
            $content_team_button = get_sub_field('content_team_button');
            $content_team_post = get_sub_field('content_team_post');
?>
<div class="container container-align-left">
      <div class="row align-items-center">
          <div class="col col-sm-12 col-lg-6 content">
              <div class="content-inner">
                  <?php if(!empty($content_team_text)){ ?>
                  <h2 class="title"><?php echo $content_team_text; ?></h2>
                  <?php } if(!empty($content_team_description)){ ?>
                  <p><?php echo $content_team_description; ?></p>
                  <?php } if(!empty($content_team_button)){
                  ?>
                  <div class="button-group">
                      <?php echo button_group($content_team_button,'btn btn-primary'); ?>
                  </div>
              <?php } ?>
              </div>
          </div>
          <?php if(!empty($content_team_post)){ ?>
          <div class="col col-sm-12 col-lg-6 image team-post-carsoul">
              <div class="team-member-carsoul slide-arrow-top">
                  <?php foreach($content_team_post as $team){
                      $image = get_field('team_image',$team->ID);
                      $job_title = get_field('team_job_title',$team->ID);
                       if($image){
                          $team_image = $image['sizes']['team_post_image'];
                       }
                       else{
                          $team_image = get_field('default_team_image','options')['sizes']['team_post_image'];
                       }
                   ?>
                  <div class="item">
                      <div class="team-member">
                          <div class="team-member-thumb bg-cover" style="background-image: url(<?php echo $team_image; ?>);">
                              <img src="<?php echo get_template_directory_uri()?>/images/placeholder/place-91-93.png" alt="">
                          </div>
                          <div class="team-member-summary">
                              <h4><?php echo $team->post_title; ?></h4>
                              <span><?php echo $job_title; ?></span>
                          </div>
                      </div>
                  </div>
              <?php } ?> 
                  
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