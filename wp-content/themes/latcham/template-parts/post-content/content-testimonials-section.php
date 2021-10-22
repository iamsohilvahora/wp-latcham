<?php 
if(have_rows('post_flexible_content', $post_id)):
      while(have_rows('post_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'testimonial_section_post'  && $_POST['ajaxIndex'] == get_row_index()):
	        $cnt_testimonial = get_sub_field('content_post_content_page_testimonial');
            if($cnt_testimonial['testimonials'] && $cnt_testimonial['testimonials_image']){
                $testimonial = $cnt_testimonial;
              }else{
                 $testimonial = get_field('default_testimonials_new','option');
              }
if(!empty($testimonial)){              
?>
<div class="container">
    <div class="row testimonails-row">
        <div class="col-sm-5 col-lg-5 image">
            <?php if(!empty($testimonial['testimonials_image']['sizes']['large'])){ ?>
                <img src="<?php echo $testimonial['testimonials_image']['sizes']['large']; ?>">
            <?php } ?>
        </div>
        <div class="col-sm-7 col-lg-7 testimonials-slider">
            <div class="testimonials-carsoul">
            <?php foreach($testimonial['testimonials'] as $testimonials){ ?>
            <div class="item">
                <?php if(!empty($testimonials['testimonials_text'])){ ?>
                <p><?php echo $testimonials['testimonials_text']; ?></p>
                <?php } ?>
                <span class="author-name"><?php if(!empty($testimonials['testimonials_author'])){ ?>
                    <strong><?php echo $testimonials['testimonials_author']; ?>,</strong> <?php } if(!empty($testimonials['testimonials_author_label'])){ echo $testimonials['testimonials_author_label']; } ?> </span>
            </div>
            <?php } ?>          
        </div>
        </div>
    </div>
</div>
<?php }
  endif;
      endwhile;
endif;
?>