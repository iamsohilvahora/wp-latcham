<?php 
if(have_rows('industry_post_flexible_content', $post_id)):
      while(have_rows('industry_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'post_section' && $_POST['ajaxIndex'] == get_row_index()):
            $industry_post_post_title = get_sub_field('industry_post_post_title');
            $industry_post_post_link = get_sub_field('industry_post_post_link');
            $post_list = get_sub_field('post_list');            
?>
<div class="section-wrapper">
        <div class="section-head">
            <div class="container">
                <?php if(!empty($industry_post_post_link)){
                        echo button_group($industry_post_post_link,'btn-link');
                    }
                ?>
                <?php if(!empty($industry_post_post_title)){ ?>
                <h2 class="title"><?php echo $industry_post_post_title; ?></h2>
                <?php } ?>
            </div>
        </div>
        <?php if(!empty($post_list)){ ?>
        <div class="container container-align-left">
            <div class="post-box-carsoul slide-arrow-top">
                <?php
                    foreach ($post_list as $postData) {
                        $params['post_id'] = $postData->ID;
                        bb_get_template_part( 'template-parts/content', 'related-post',$params); 
                    } 
                ?>
            </div>
        </div>
        <?php } ?>
    </div>
<?php 
  endif;
      endwhile;
endif;
?>