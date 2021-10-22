<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'services_section_post' && $_POST['ajaxIndex'] == get_row_index()):
              	$heading_title = get_sub_field('content_post_heading_title');
                $services = get_sub_field('content_post_utilities');
                $our_service_button = get_sub_field('content_post_our_service_button');
                $ser_btn_label = $our_service_button['button_label'];
                $ser_btn_link = $our_service_button['button_link'];
                $ser_btn_internal = $our_service_button['button_internal_link'];
                $ser_btn_external = $our_service_button['button_external_link'];
                if($ser_btn_link == 'button_internal_link'){
                    $ser_btnurl =latcham_external_link($ser_btn_internal,false);
                }else{
                    $ser_btnurl =latcham_external_link($ser_btn_external,true);
                } ?>
  <div class="container">
        <?php if(!empty($heading_title)){?>
        <h2 class="title title-2"><?php echo $heading_title; ?></h2>
        <?php } ?>
        <div class="row">
             <?php if(!empty($services)){ 
                    foreach ($services as $ser_key => $ser_value) {
                        $params['post_id'] =  $ser_value->ID;
                        echo bb_get_template_part( 'template-parts/content', 'service-post-list',$params); 
                 } } 
            ?>
        </div>
        <?php if(!empty($ser_btn_label) && !empty($ser_btnurl)){ ?>
        <div class="loadmore">
            <a <?php echo $ser_btnurl; ?> class="btn btn-primary"><?php echo $ser_btn_label; ?></a>
        </div>
        <?php } ?>
    </div>
<?php
  endif;
      endwhile;
endif;
?>