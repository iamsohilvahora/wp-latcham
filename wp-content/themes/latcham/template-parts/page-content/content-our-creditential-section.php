<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'credential_and_logo_section_page'  && $_POST['ajaxIndex'] == get_row_index()):
	        $title = get_sub_field('content_page_title');
            $view_all_button = get_sub_field('content_page_view_all_button');
            $company_logo = get_sub_field('content_page_company_logo');
?>
<div class="container">
    <div class="row">
        <div class="col our-creditential-left">
            <?php if(!empty($title)){ ?>
            <h2><?php echo $title; ?></h2>
            <?php } 
            if(!empty($view_all_button)){
                echo button_group($view_all_button,'btn btn-primary');   
            }
            ?>
        </div>
        <?php if(!empty($company_logo)){ ?>
        <div class="col our-creditential-right">
            <div class="logo-carsoul our-creditential-block">
                <?php foreach($company_logo as $logo){
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