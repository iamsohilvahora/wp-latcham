<?php 
if(have_rows('content_page_flexible_content', $post_id)):
      while(have_rows('content_page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'related_post_section' && $_POST['ajaxIndex'] == get_row_index() ):
            $title = get_sub_field('title');
            $show_latest_post = get_sub_field('show_latest_post');
            if($show_latest_post){
                $realestate_args = array('showposts' => '9','cat' => '5,6','post_type' => 'post','post_status' => 'publish','orderby' => 'post_date','order' => 'DESC');
                $related_post = get_posts($realestate_args);
            }else{
                $related_post = get_sub_field('related_post');
            }
        ?>
  <div class="section-head">
        <div class="container">
            <?php if(!empty($title)){ ?>
                <h2 class="title"><?php echo $title; ?></h2>
            <?php } ?>
        </div>
    </div>
    <div class="container container-align-left">
        <div class="post-box-carsoul  slide-arrow-top">
            <?php 
            if(!empty($related_post)){
            foreach ($related_post as $rel_key => $rel_value) { 
                $postID = $rel_value->ID;
                $params['post_id']  = $postID;
                echo bb_get_template_part( 'template-parts/content', 'related-post',$params);  

                } } ?>
        </div>
    </div>
<?php
  endif;
      endwhile;
endif;
?>