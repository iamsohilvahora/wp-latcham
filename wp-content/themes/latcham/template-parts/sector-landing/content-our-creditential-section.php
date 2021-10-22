<?php 
if(have_rows('sector_content', $post_id)):
      while(have_rows('sector_content', $post_id)): the_row();
          if( get_row_layout() == 'our_creditentials' && $_POST['ajaxIndex'] == get_row_index()):
	          $sector_our_creditentials_title = get_sub_field('sector_our_creditentials_title');
			  $sector_our_creditentials_button = get_sub_field('sector_our_creditentials_button');
		  	  $sector_logo_post = get_sub_field('sector_logo_post');
?>
<div class="container">
    <div class="row">
        <div class="col our-creditential-left">
            <?php if(!empty($sector_our_creditentials_title)){ ?>
            <h2><?php echo $sector_our_creditentials_title; ?></h2>
            <?php } 
            if(!empty($sector_our_creditentials_button)){
                echo button_group($sector_our_creditentials_button,'btn btn-primary');   
            }
            ?>
        </div>
        <?php if(!empty($sector_logo_post)){ ?>
        <div class="col our-creditential-right">
            <div class="logo-carsoul our-creditential-block">
                <?php foreach($sector_logo_post as $logo){
                    $post_logo = get_field('post_logo',$logo->ID);
                    if(!empty($post_logo)){
                 ?>
                <div class="item">
                    <div class="creditentials-item-inner">
                        <img src="<?php echo $post_logo['url']?>">
                    </div>
                </div>
            <?php }} ?>                
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