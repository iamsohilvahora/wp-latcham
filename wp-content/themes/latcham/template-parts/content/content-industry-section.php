<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'industry_section' && $_POST['ajaxIndex'] == get_row_index()):
          	$main_title = get_sub_field('main_title');
            $industry_button = get_sub_field('button');
            $industries = get_sub_field('industries');

            $button_label = $industry_button['button_label'];
            $button_link = $industry_button['button_link'];
            $button_internal_link = $industry_button['button_internal_link'];
            $button_external_link = $industry_button['button_external_link'];
            if($button_link == 'button_internal_link'){
                $ind_btnurl =latcham_external_link($button_internal_link,false);
            }else{
                $ind_btnurl =latcham_external_link($button_external_link,true);
            }
?>          	
 <div class="container">
        <div class="section-head with--btn">
            <?php if(!empty($main_title)){ ?>
                <h2 class="title"><?php echo $main_title; ?></h2>
            <?php } if(!empty($button_label) && !empty($ind_btnurl)){ ?>
                <a <?php echo $ind_btnurl; ?> class="btn btn-primary"><?php echo $button_label; ?></a>
            <?php } ?>
        </div>
         <div class="industry-post-row">
            <div class="industry-post-items">
                <?php $i =0; if(!empty($industries)) {
                    foreach ($industries as $ind_key => $ind_value) {
                        $postID = $ind_value->ID;
                        $post_title = $ind_value->post_title;
                        $post_content = get_field('industry_list_small_text',$ind_value->ID);
                        $readmore_link = get_the_permalink($postID);
                 ?>
                <div class="item <?php if($i == 1){echo "active";}?>">
                    <div class="item-inner">
                        <?php if(!empty($post_title)){ ?>
                        <h5 class="link-text"><?php echo $post_title; ?></h5>
                        <?php } ?>
                        <div class="hover-content">
                            <div class="inner">
                                <?php if(!empty($post_title)){ ?>
                                <h5><?php echo $post_title; ?></h5>
                                <?php } if(!empty($post_content)){ ?> 
                                <p><?php echo mb_strimwidth($post_content, 0, 140, '...'); ?></p>
                                <?php } if(!empty($readmore_link)) { ?>
                                    <a href="<?php echo $readmore_link; ?>" class="link">Read more</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php if(!empty($readmore_link)) { ?>
                        <a href="<?php echo $readmore_link; ?>" class="box-link"></a>
                    <?php } ?>
                </div>
                <?php $i++;} }  ?>
            </div>
        </div>
    </div>
<?php endif;
    endwhile;
endif;
?>