<?php 
if(have_rows('case_study_content', $post_id)):
      while(have_rows('case_study_content', $post_id)): the_row();
          if( get_row_layout() == 'content_section' && $_POST['ajaxIndex'] == get_row_index()):
	          $casestudy_content_title = get_sub_field('casestudy_content_title');
              $casestudy_content = get_sub_field('casestudy_content');
?>
<div class="container">
    <?php if(!empty($casestudy_content_title)){ ?>
    <h2><?php echo $casestudy_content_title; ?></h2>   
    <?php } if(!empty($casestudy_content)){ ?>
    <div class="row">
        <?php echo $casestudy_content; ?>
    </div>
    <?php } ?>
</div>
<?php
  endif;
      endwhile;
endif;
?>