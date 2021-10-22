<?php 
if(have_rows('industry_post_flexible_content', $post_id)):
      while(have_rows('industry_post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'industry_section' && $_POST['ajaxIndex'] == get_row_index()):
            $industry_section_post_label = get_sub_field('industry_section_post_label');
            $industry_section_post_link = get_sub_field('industry_section_post_link');
            $industry_section_list_post = get_sub_field('industry_section_list_post');
?>
<div class="container">
    <div class="section-head with--btn">
        <?php if(!empty($industry_section_post_label)){ ?>
        <h2 class="title"><?php echo $industry_section_post_label; ?></h2>
        <?php }
            if(!empty($industry_section_post_link)){
                 echo button_group($industry_section_post_link,'btn btn-primary'); 
          } ?>
    </div>

    <div class="industry-post-row">
        <div class="industry-post-items">
            <?php $i =0; if(!empty($industry_section_list_post)){ 

                    foreach ($industry_section_list_post as $industry_post) {
                    $title = get_the_title( $industry_post->ID );
                     $permalink = get_permalink( $industry_post->ID );
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
        <?php $i++; } } ?>                
        </div>
    </div>
</div>
<?php 
  endif;
      endwhile;
endif;
?>