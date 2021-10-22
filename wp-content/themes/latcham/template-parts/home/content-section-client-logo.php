<?php 
if(have_rows('home_flexible_content', $post_id)):
      while(have_rows('home_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'company_logo' && $_POST['ajaxIndex'] == get_row_index() ):
	          $home_company_logo = get_sub_field('home_company_logo_cat');
	       ?>
<div class="container">
		<div class="logo-carsoul">
			<?php foreach($home_company_logo as $home_company_logo_val){ 
					$description = get_field('description',$home_company_logo_val->ID);
					$post_logo = get_field('post_logo',$home_company_logo_val->ID);
					$title = $home_company_logo_val->post_title;
					
				if(!empty($post_logo['url'])){ ?>
				 <div class=" clients-logo-item">
	                <div class="client-logo">
	                    <img src="<?php echo $post_logo['url']; ?>">
	                    <div class="client-logo-description">
	                    	<?php if(!empty($title)){ ?>
	                        <h6><?php echo $title; ?></h6>
	                        <?php } if(!empty($description)) { ?>
	                        <p><?php echo $description; ?></p>
	                        <?php } ?>
	                    </div>
	                </div>
	            </div>
	            <?php } } ?>
<?php
  endif;
      endwhile;
endif;
?>

