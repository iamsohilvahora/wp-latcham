<?php 
if(have_rows('industry_post_flexible_content', $post_id)):
      while(have_rows('industry_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'logo_section' && $_POST['ajaxIndex'] == get_row_index()):
            $industry_post_customer_logo = get_sub_field('industry_post_customer_logo');
            if(!empty($industry_post_customer_logo)){ 
?>
<div class="container">
    <div class="logo-carsoul">
        <?php foreach($industry_post_customer_logo as $logo){
                $description = get_field('description',$logo->ID);
                $post_logo = get_field('post_logo',$logo->ID);
                $title = $logo->post_title;
                if(!empty($post_logo)){
             ?>
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
<?php } 
  endif;
      endwhile;
endif;
?>