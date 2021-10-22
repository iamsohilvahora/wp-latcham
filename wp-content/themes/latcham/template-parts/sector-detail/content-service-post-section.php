<?php 
if(have_rows('industry_post_flexible_content', $post_id)):
      while(have_rows('industry_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'service_section' && $_POST['ajaxIndex'] == get_row_index()):
            $industry_post_service_title = get_sub_field('industry_post_service_title');
            $industry_post_service_button = get_sub_field('industry_post_service_button');
            $terms = get_the_terms($post_id, 'industry-category');
            $termsIds = array();
            if(!empty($terms)){
                foreach($terms as $term){
                    $termsIds[] = $term->term_id;
                }
            }
?>
<div class="container">
        <?php if(!empty($industry_post_service_title)){ ?>
        <h2 class="title title-2"><?php echo $industry_post_service_title; ?></h2>
        <?php }
        $posts_per_page = 9;        
        $service_arg = array(
            'posts_per_page'=> $posts_per_page,
            'post_type' => 'service',            
            'post_status' => 'publish' ,
            'tax_query' => array(array(
                    'taxonomy' => 'industry-category',
                    'field' => 'term_id',
                    'terms' => implode(",", $termsIds),
                )
            ),
            'order' => 'DESC');
        $the_query = new WP_Query( $service_arg);
        if($the_query->have_posts()){
        ?>
        <div class="row">
            <?php  while( $the_query->have_posts() ){ 
                $the_query->the_post();
                $service_short_description = get_field('service_short_description',get_the_ID());
                ?>
            <div class="col-sm-6 col-lg-4 item">
                <div class="item-inner">
                    <h5><?php echo get_the_title();?></h5>
                    <?php if(!empty($service_short_description)){ ?>
                    <p><?php echo mb_strimwidth($service_short_description, 0, 140, '...'); ?></p>
                    <?php } ?>
                </div>
            </div>
        <?php } wp_reset_postdata(); ?>             
        </div>
    <?php } 
            if(!empty($industry_post_service_button)){                             
        ?>
        <div class="loadmore">
            <?php echo button_group($industry_post_service_button,'btn btn-primary');?>
        </div>
    <?php } ?>
    </div>
<?php 
  endif;
      endwhile;
endif;
?>