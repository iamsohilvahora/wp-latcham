<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'title_with_content_page' && $_POST['ajaxIndex'] == get_row_index()):
          	  $content_page_solutions_title = get_sub_field('content_page_solutions_title');
              $content_page_solutions_description = get_sub_field('content_page_solutions_description');
              
?>       
<div class="container">
    <?php if(!empty($content_page_solutions_title)){ ?>
    <h2><?php echo $content_page_solutions_title; ?></h2>   
    <?php } if(!empty($content_page_solutions_description)){ ?>
    <div class="row">
            <?php echo $content_page_solutions_description; ?>        
    </div>
    <?php } ?>
</div>
<?php
  endif;
      endwhile;
endif;
?>