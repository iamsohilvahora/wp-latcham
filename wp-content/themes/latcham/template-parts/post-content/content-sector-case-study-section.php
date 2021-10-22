<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'case_studies_section_post' && $_POST['ajaxIndex'] == get_row_index()):
            $solutions_terms = get_the_terms($post_id, 'solutions-category');
            $solutions_termsIds = array();
            if(!empty($solutions_terms)){
                foreach($solutions_terms as $solutions_term){
                    $solutions_termsIds[] = $solutions_term->term_id;
                }
            }
            $industry_terms = get_the_terms($post_id, 'industry-category');
            $industry_termsIds = array();
            if(!empty($industry_terms)){
                foreach($industry_terms as $industry_term){
                    $industry_termsIds[] = $industry_term->term_id;
                }
            }
	          $content_post_title = get_sub_field('content_post_title');
                $content_post_description = get_sub_field('content_post_description');
                $content_post_button = get_sub_field('content_post_button');
                $content_post_button_2 = get_sub_field('content_post_button_2');

?>
<div class="container container-align-left">
    <div class="row align-items-center">
        <div class="col col-sm-12 col-lg-6 content">
            <div class="content-inner">
                <?php if(!empty($content_post_title)){ ?>
                <h2 class="title"><?php echo $content_post_title; ?></h2>
                <?php } if(!empty($content_post_description)){ ?>
                <p><?php echo $content_post_description; ?></p>
                <?php } ?>
                <div class="button-group">
                    <?php
                        if(!empty($content_post_button)){
                            echo button_group($content_post_button,'btn btn-primary');   
                        }
                        if(!empty($content_post_button_2)){
                            echo button_group($content_post_button_2,'btn btn-link');   
                        }
                    ?>
                </div>
            </div>
        </div>
        
                <?php 
                    $posts_per_page = 9;        
                    $solutions_arg = array(
                        'posts_per_page'=> $posts_per_page,
                        'post_type' => 'casestudy',            
                        'post_status' => 'publish' ,
                        'tax_query' => array(array(
                                'taxonomy' => 'solutions-category',
                                'field' => 'term_id',
                                'terms' => implode(",", $solutions_termsIds),
                            )
                        ),
                        'order' => 'DESC');
                    $industry_arg = array(
                        'posts_per_page'=> $posts_per_page,
                        'post_type' => 'casestudy',            
                        'post_status' => 'publish' ,
                        'tax_query' => array(array(
                                'taxonomy' => 'industry-category',
                                'field' => 'term_id',
                                'terms' => implode(",", $industry_termsIds),
                            )
                        ),
                        'order' => 'DESC');
                    $solutions_query = new WP_Query( $solutions_arg);
                    $industry_query = new WP_Query( $industry_arg);
                    if($solutions_query->found_posts > 0){
                        $the_query = $solutions_query;
                    }else{
                        $the_query = $industry_query;
                    }
                    if($the_query->have_posts()){ ?>
        <div class="col col-sm-12 col-lg-6 image image-post-carsoul">
            <div class="case-post-box-carsoul slide-arrow-top">                            
                <?php         
                while( $the_query->have_posts() ){ 
                    $the_query->the_post();
                    $params['post_id'] = get_the_ID();
                    echo bb_get_template_part( 'template-parts/content', 'casestudy-post-perspectives',$params); 
                    } 
                    wp_reset_postdata();
                ?> 
                
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