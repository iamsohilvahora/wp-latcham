<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'sub_heading_second_section_post' && $_POST['ajaxIndex'] == get_row_index() ):
          	$left_title = get_sub_field('content_post_left_title');
            $left_description = get_sub_field('content_post_left_description');
            $right_title = get_sub_field('content_post_right_title');
            $right_description = get_sub_field('content_post_right_description');
?>          	
  <div class="container">
        <?php if(!empty($left_title)) { ?>
        <h2><?php echo $left_title; ?></h2>   
        <?php } ?>
        <div class="row">
            <?php if(!empty($left_description)) {?>
            <div class="col-sm-6">
                <?php echo $left_description; ?>
            </div>
            <?php } ?>
            <?php if(!empty($right_description)) {?>
            <div class="col-sm-6">
                <?php echo $right_description; ?>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
  endif;
      endwhile;
endif;
?>