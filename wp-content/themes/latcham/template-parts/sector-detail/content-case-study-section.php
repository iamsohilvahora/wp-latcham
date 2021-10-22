<?php 
if(have_rows('industry_post_flexible_content', $post_id)):
      while(have_rows('industry_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'case_study_section' && $_POST['ajaxIndex'] == get_row_index()):
            $terms = get_the_terms($post_id, 'industry-category');
            $termsIds = array();
            if(!empty($terms)){
                foreach($terms as $term){
                    $termsIds[] = $term->term_id;
                }
            }
	          $industry_post_case_study_title = get_sub_field('industry_post_case_study_title');
                $industry_post_case_study_description = get_sub_field('industry_post_case_study_description');
                $industry_post_case_study_button_1 = get_sub_field('industry_post_case_study_button_1');
                $industry_post_case_study_button_2 = get_sub_field('industry_post_case_study_button_2');

?>
<div class="container container-align-left">
    <div class="row align-items-center">
        <div class="col col-sm-12 col-lg-6 content">
            <div class="content-inner">
                <?php if(!empty($industry_post_case_study_title)){ ?>
                <h2 class="title"><?php echo $industry_post_case_study_title; ?></h2>
                <?php } if(!empty($industry_post_case_study_description)){ ?>
                <p><?php echo $industry_post_case_study_description; ?></p>
                <?php } ?>
                <div class="button-group">
                    <?php
                        if(!empty($industry_post_case_study_button_1)){
                            echo button_group($industry_post_case_study_button_1,'btn btn-primary');   
                        }
                        if(!empty($industry_post_case_study_button_2)){
                            echo button_group($industry_post_case_study_button_2,'btn btn-link');   
                        }
                    ?>
                </div>
            </div>
        </div>
        
                <?php 
                    $posts_per_page = 9;        
                    $service_arg = array(
                        'posts_per_page'=> $posts_per_page,
                        'post_type' => 'casestudy',            
                        'post_status' => 'publish' ,
                        'tax_query' => array(array(
                                'taxonomy' => 'industry-category',
                                'field' => 'term_id',
                                'terms' => implode(",", $termsIds),
                            )
                        ),
                        'order' => 'DESC');
                    $the_query = new WP_Query( $service_arg);
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