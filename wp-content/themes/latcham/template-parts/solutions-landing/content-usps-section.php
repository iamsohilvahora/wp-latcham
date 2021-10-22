<?php 
if(have_rows('solutions_content', $post_id)):
      while(have_rows('solutions_content', $post_id)): the_row();
          if( get_row_layout() == 'usps' && $_POST['ajaxIndex'] == get_row_index() ):
	          $solutions_post_usps = get_sub_field('solutions_post_usps');
?>
<div class="container">
    <div class="usps-slider">
        <?php if(!empty($solutions_post_usps)){ foreach($solutions_post_usps as $usps){ ?>
        <div class="usps-slide">
          <div class="usps-item">
                <?php if(!empty($usps['image'])){ ?>
                <img src="<?php echo $usps['image']['sizes']['large'];?>">
                <?php } if(!empty($usps['title'])){ ?>
                <p><?php echo $usps['title'];?></p>
                <?php } ?>
            </div>
        </div>
        <?php } } ?>
    </div>
</div>
<?php
  endif;
      endwhile;
endif;
?>