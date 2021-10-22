<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'customer_logos_section_page' && $_POST['ajaxIndex'] == get_row_index() ):
          $customer_logos_post = get_sub_field('content_page_customer_logos_post');
          $customer_logos_show_title = get_sub_field('content_page_customer_logos_show_title');
          $customer_logos_show_text = get_sub_field('content_page_customer_logos_show_text');
          
if(!empty($customer_logos_post)){          
?>          	
<div class="container">
    <div class="logo-carsoul">
    <?php foreach($customer_logos_post as $company_logo_val){
            $description = get_field('description',$company_logo_val->ID);
            $post_logo = get_field('post_logo',$company_logo_val->ID);
            $title = $company_logo_val->post_title;
            if(!empty($post_logo['url'])){ ?>
                <div class=" clients-logo-item">
                    <div class="client-logo <?php if(!$customer_logos_show_title && !$customer_logos_show_text){echo 'only-logo';}?>">
                        <img src="<?php echo $post_logo['url']; ?>">
                        <?php if($customer_logos_show_title || $customer_logos_show_text){ ?>
                        <div class="client-logo-description">
                            <?php if(!empty($title) && $customer_logos_show_title){ ?>
                            <h6><?php echo $title; ?></h6>
                            <?php } if(!empty($description) && $customer_logos_show_text) { ?>
                            <p><?php echo $description; ?></p>
                            <?php } ?>
                        </div>
                      <?php } ?>
                    </div>
                </div>
            <?php } } ?>
    </div>
</div>
<?php }
  endif;
      endwhile;
endif;
?>

