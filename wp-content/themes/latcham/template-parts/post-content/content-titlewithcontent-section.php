<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'title_with_content_post' && $_POST['ajaxIndex'] == get_row_index()):
          	  $content_post_solutions_title = get_sub_field('content_post_solutions_title');
              $content_post_solutions_description = get_sub_field('content_post_solutions_description');
              
?>       
<div class="container">
    <?php if(!empty($content_post_solutions_title)){ ?>
    <h2><?php echo $content_post_solutions_title; ?></h2>   
    <?php } if(!empty($content_post_solutions_description)){ ?>
    <div class="row">
        <div class="col-sm-9">
            <p><?php echo $content_post_solutions_description; ?></p>
        </div>
    </div>
    <?php } ?>
</div>
<?php
  endif;
      endwhile;
endif;
?>