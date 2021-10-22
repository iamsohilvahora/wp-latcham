<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'usps_section_page' && $_POST['ajaxIndex'] == get_row_index() ):
          	$usps = get_sub_field('content_page_usps');
?>          	
<div class="container">
        <div class="usps-slider">
          <?php
          if(!empty($usps))
            {
              foreach ($usps as $usp_key => $usp_value) {
                $icon_image = $usp_value['icon_image']['sizes']['large'];
                $title = $usp_value['title'];
            ?>
            <div class="usps-slide">
              <div class="usps-item">
                  <?php if(!empty($icon_image)){ ?>
                    <img src="<?php echo $icon_image; ?>">
                  <?php } if(!empty($title)){ ?>
                      <p><?php echo $title; ?></p>
                    <?php } ?>
                </div>
            </div>
            <?php } }  ?>
        </div>
    </div>
<?php
  endif;
      endwhile;
endif;
?>

