<?php 
if(have_rows('sector_content', $post_id)):
      while(have_rows('sector_content', $post_id)): the_row();
          if( get_row_layout() == 'help_section' && $_POST['ajaxIndex'] == get_row_index()):
	          $sector_help_section_title = get_sub_field('sector_help_section_title');
			  $sector_help_section_description = get_sub_field('sector_help_section_description');
		  	  $sector_help_section_contact_form = get_sub_field('sector_help_section_contact_form');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-lg-6 content">
            <div class="content-inner">
                <?php if(!empty($sector_help_section_title)){ ?>
                <h2 class="title title-2"><?php echo $sector_help_section_title; ?></h2>
                <?php } if(!empty($sector_help_section_description)){ ?>
                <p><?php echo $sector_help_section_description; ?></p>
                <?php } ?>
            </div>
        </div>
        <?php if(!empty($sector_help_section_contact_form)){ ?>
        <div class="col-sm-12 col-lg-6">
            <?php echo do_shortcode($sector_help_section_contact_form); ?>
        </div>
    <?php } ?>
    </div>
</div>
<?php
  endif;
      endwhile;
endif;
?>