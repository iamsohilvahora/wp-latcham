<?php 
if(have_rows('solutions_post_flexible_content', $post_id)):
      while(have_rows('solutions_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'logo_section' && $_POST['ajaxIndex'] == get_row_index()):
	        $solutions_post_customer_logo = get_sub_field('solutions_post_customer_logo');
?>
<div class="container">
    <div class="logo-carsoul">
    <?php foreach($solutions_post_customer_logo as $company_logo_val){
            $description = get_field('description',$company_logo_val->ID);
            $post_logo = get_field('post_logo',$company_logo_val->ID);
            $title = $company_logo_val->post_title;
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
    </div>
</div>
<?php
  endif;
      endwhile;
endif;
?>