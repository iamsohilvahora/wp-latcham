<?php 
if(have_rows('case_study_content', $post_id)):
      while(have_rows('case_study_content', $post_id)): the_row();
          if( get_row_layout() == 'testimonials_section' && $_POST['ajaxIndex'] == get_row_index() ):
	        $casestudy_testimonials_chk = get_sub_field('casestudy_testimonials');
            if($casestudy_testimonials_chk['testimonials'] && $casestudy_testimonials_chk['testimonials_image']){
                $casestudy_testimonials = $casestudy_testimonials_chk;
              }else{
                 $casestudy_testimonials = get_field('default_testimonials_new','option');
              }
              if(!empty($casestudy_testimonials)){
?>
<div class="container">
    <div class="row testimonails-row">
        <div class="col-sm-5 col-lg-5 image">
            <?php if(!empty($casestudy_testimonials['testimonials_image']['sizes']['large'])){ ?>
                <img src="<?php echo $casestudy_testimonials['testimonials_image']['sizes']['large']; ?>">
            <?php } ?>
        </div>
        <div class="col-sm-7 col-lg-7 testimonials-slider">
            <div class="testimonials-carsoul">
            <?php foreach($casestudy_testimonials['testimonials'] as $testimonials){ ?>
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