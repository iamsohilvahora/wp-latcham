<?php 
if(have_rows('careers_content', $post_id)):
      while(have_rows('careers_content', $post_id)): the_row();
          if( get_row_layout() == 'industry_section'  && $_POST['ajaxIndex'] == get_row_index()):
	          $industry_label = get_sub_field('industry_label');
            $industry_link = get_sub_field('industry_link');
            $industry_posts = get_sub_field('industry_section_list_post');
?>

      <div class="container">
          <div class="section-head with--btn">
              <?php if(!empty($industry_label)): ?>  
              <h2 class="title"><?php echo $industry_label; ?></h2>
              <?php endif;

              if(!empty($industry_link)):
                echo button_group($industry_link,'btn btn-primary');   
              endif; ?>

          </div>

          <div class="industry-post-row">
              <div class="industry-post-items">  
                <?php $i =0;
                if(!empty($industry_posts)):
                foreach($industry_posts as $industry_post): 
                  
                    $title = $industry_post->post_title;
                    $content = $industry_post->post_content; 
                    $permalink = get_permalink($industry_post->ID);
                    $industry_list_small_text = get_field("industry_list_small_text",$industry_post->ID);
                     ?>                  
                  <div class="item <?php if($i == 1){echo "active";}?>">
                    <div class="item-inner">
                        <h5 class="link-text"><?php echo $title; ?></h5>
                        <div class="hover-content">
                            <div class="inner">
                                <h5><?php echo $title; ?></h5>
                                <p><?php echo mb_strimwidth($industry_list_small_text, 0, 130, '...');?></p>
                                
                                <a href="<?php echo esc_url( $permalink ); ?>" class="link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( $permalink ); ?>" class="box-link"></a>
                </div>

                <?php $i++; endforeach; endif;?>

              </div>
          </div>
      </div>
<?php
  endif;
      endwhile;
endif;
?>