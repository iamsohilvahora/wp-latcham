<?php 
if(have_rows('solutions_post_flexible_content', $post_id)):
      while(have_rows('solutions_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'services_section' && $_POST['ajaxIndex'] == get_row_index()):
            $solutions_post_services_text = get_sub_field('solutions_post_services_text');
            $terms = get_the_terms($post_id, 'solutions-category');
            $termsIds = array();
            if(!empty($terms)){
                foreach($terms as $term){
                    $termsIds[] = $term->term_id;
                }
            }
?>
<div class="container">
        <?php if(!empty($solutions_post_services_text)){ ?>
        <h2 class="title title-2"><?php echo $solutions_post_services_text; ?></h2>
        <?php }
        $posts_per_page = 9;        
        $service_arg = array(
            'posts_per_page'=> $posts_per_page,
            'post_type' => 'service',            
            'post_status' => 'publish' ,
            'tax_query' => array(array(
                    'taxonomy' => 'solutions-category',
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
                $single_detail_restrict = get_field('single_detail_restrict',$postid);
                $permalink = get_the_permalink($postid);
                ?>
            <div class="col-sm-6 col-lg-4 item">
                <div class="item-inner">
                    <h5><?php echo get_the_title();?></h5>
                    <?php if(!empty($service_short_description)){ ?>
                    <p><?php echo mb_strimwidth($service_short_description, 0, 140, '...'); ?></p>
                    <?php } if($single_detail_restrict == 'No'){ ?>
                    <a href="<?php echo $permalink; ?>" class="box-link"><?php echo $title; ?> </a>
                    <?php } ?>
                </div>
            </div>
        <?php } wp_reset_postdata(); ?>             
        </div>
    <?php }else{
        echo "No data found.";
    } ?>
    </div>
<?php 
  endif;
      endwhile;
endif;
?>