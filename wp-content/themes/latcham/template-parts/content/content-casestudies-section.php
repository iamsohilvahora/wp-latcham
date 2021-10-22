<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'case_studies_section' && $_POST['ajaxIndex'] == get_row_index()):
              	$title = get_sub_field('title');
                $description = get_sub_field('description');
                $case_studies_btn = get_sub_field('button');
                $btn_label = $case_studies_btn['button_label'];
                $btn_link = $case_studies_btn['button_link'];
                $btn_internal_link = $case_studies_btn['button_internal_link'];
                $btn_external_link = $case_studies_btn['button_external_link'];
                if($btn_link == 'button_internal_link'){
                    $btnurl =latcham_external_link($btn_internal_link,false);
                }else{
                    $btnurl =latcham_external_link($btn_external_link,true);
                }
                $link_label = get_sub_field('link_label');
                $inquiry_link = get_sub_field('inquiry_link');
                $internal_link = get_sub_field('internal_link');
                $external_link = get_sub_field('external_link');
                if($inquiry_link == 'Internal'){
                    $link =latcham_external_link($internal_link,false);
                }else{
                    $link =latcham_external_link($external_link,true);
                }        
            $case_studies = get_sub_field('case_studies');
?>          	
 <div class="container container-align-left">
        <div class="row align-items-center">
            <div class="col col-sm-12 col-lg-6 content">
                <div class="content-inner">
                    <?php if(!empty($title)){ ?>
                        <h2 class="title"><?php echo $title; ?></h2>
                    <?php } if(!empty($description)){ ?>
                        <p><?php echo $description; ?></p>
                    <?php } ?>
                    <div class="button-group">
                        <?php if(!empty($btn_label) && !empty($btnurl)){ ?>
                        <a <?php echo $btnurl; ?> class="btn btn-primary"><?php echo $btn_label; ?></a>
                        <?php } if(!empty($link_label) && !empty($link)){ ?>
                        <a <?php echo $link; ?> class="btn btn-link">Enquire today</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col col-sm-12 col-lg-6 image image-post-carsoul">
                <div class="case-post-box-carsoul slide-arrow-top">
                    <?php if(!empty($case_studies)){ 
                        foreach ($case_studies as $case_key => $case_value) {
                            $postID = $case_value->ID;
                            $post_title = $case_value->post_title;
                            $post_content = $case_value->post_content;
                            $post_content = get_field('industry_list_small_text',$case_value->ID);
                            $params['post_id'] =  $case_value->ID;
                            echo bb_get_template_part( 'template-parts/content', 'casestudy-post-perspectives',$params); 
                        } 
                    } ?>
                </div>
            </div>
        </div>
    </div>
<?php
  endif;
      endwhile;
endif;
?>