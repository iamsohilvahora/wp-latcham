<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'services_section_post' && $_POST['ajaxIndex'] == get_row_index()):
            $content_post_heading_title = get_sub_field('content_post_heading_title');
            $content_post_our_service_button = get_sub_field('content_post_our_service_button');
            $terms = get_the_terms($post_id, 'solutions-category');
            $termsIds = array();
            if(!empty($terms)){
                foreach($terms as $term){
                    $termsIds[] = $term->term_id;
                }
            }
            $termsIdsArray = implode(",", $termsIds);
?>
<div class="container">
        <?php if(!empty($content_post_heading_title)){ ?>
        <h2 class="title title-2"><?php echo $content_post_heading_title; ?></h2>
        <?php }
        $service_count = array(
            'post_type' => 'service',            
            'post_status' => 'publish' ,
            'tax_query' => array(array(
                    'taxonomy' => 'solutions-category',
                    'field' => 'term_id',
                    'terms' => $termsIdsArray,
                )
            ),
            'order' => 'DESC');
        $the_query = new WP_Query( $service_count );
        $totalpost = $the_query->found_posts;
        $posts_per_page = 9;        
        $service_arg = array(
            'posts_per_page'=> $posts_per_page,
            'post_type' => 'service',            
            'post_status' => 'publish' ,
            'tax_query' => array(array(
                    'taxonomy' => 'solutions-category',
                    'field' => 'term_id',
                    'terms' => $termsIdsArray,
                )
            ),
            'order' => 'DESC');

        $the_query = new WP_Query( $service_arg);
        if($the_query->have_posts()){
        ?>
        <div id="Show_articals">
            <div class="row" id="appenddata">
            
            <?php  while( $the_query->have_posts() ){ 
                $the_query->the_post();
                $params['post_id'] = get_the_ID(); 
                bb_get_template_part( 'template-parts/content', 'service-post-list',$params); 
                ?>
            <?php } wp_reset_postdata(); ?>  
            </div>
            </div>           
        </div>
        <?php } ?> 
        <div class="button_group_bottom">
            <div class="container">
                <?php if(!empty($content_post_our_service_button)){                             
                ?>
                <div class="loadmore">
                    <?php echo button_group($content_post_our_service_button,'btn btn-primary');?>
                </div>
            
                
                <?php }if($totalpost >= $posts_per_page){ ?>
                    <div class="load-more text-center loadmore">
                            <div id="loader"></div>
                        <a href="javascript:;" class="btn btn-primary" onclick="service_more_posts('append')">Load more</a>
                        <input type="hidden" class="solutions_term_array" name="solutions_term" value="<?php echo $termsIdsArray; ?>">
                        <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
                        
                    </div>
                <?php } ?> 
            </div>
        </div>
    </div>
<?php 
  endif;
      endwhile;
endif;
?>