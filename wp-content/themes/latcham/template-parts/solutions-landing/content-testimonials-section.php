<?php 
if(have_rows('solutions_content', $post_id)):
      while(have_rows('solutions_content', $post_id)): the_row();
          if( get_row_layout() == 'testimonials_section' && $_POST['ajaxIndex'] == get_row_index() ):
	        $solutions_section_testimonials_val = get_sub_field('solutions_section_testimonials');
            if($solutions_section_testimonials_val['testimonials'] && $solutions_section_testimonials_val['testimonials_image']){
                $solutions_section_testimonials = $solutions_section_testimonials_val;
            }else{
                $solutions_section_testimonials = get_field('default_testimonials_new','option');
            }
if(!empty($solutions_section_testimonials)){ 

?>
<div class="container">
    <div class="row testimonails-row">
        <div class="col-sm-5 col-lg-5 image">
            <?php if(!empty($solutions_section_testimonials['testimonials_image']['sizes']['large'])){ ?>
                <img src="<?php echo $solutions_section_testimonials['testimonials_image']['sizes']['large']; ?>">
            <?php } ?>
        </div>
        <div class="col-sm-7 col-lg-7 testimonials-slider">
            <div class="testimonials-carsoul">
            <?php foreach($solutions_section_testimonials['testimonials'] as $testimonials){ ?>
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