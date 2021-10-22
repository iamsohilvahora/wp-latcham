<?php 
if(have_rows('page_flexible_content', $post_id)):
      while(have_rows('page_flexible_content', $post_id)): the_row();
          if( get_row_layout() == 'faq_section_page' && $_POST['ajaxIndex'] == get_row_index()):
            $heading_title = get_sub_field('content_page_heading_title');
            $description = get_sub_field('content_page_description');
            $faqs = get_sub_field('content_page_faqs');
        ?>
  <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-5 content">
                <div class="content-inner">
                    <?php if(!empty($heading_title)){ ?>
                    <h2 class="title title-2"><?php echo $heading_title; ?></h2>
                    <?php } if(!empty($description)){ ?>
                    <p><?php echo $description; ?></p>
                    <?php } ?>
                </div>
            </div>
            <div class="col-sm-12 col-lg-7 faq-block">
                <div class="tab_container">
                 <?php 
                 if(!empty($faqs)){
                    foreach ($faqs as $fkey => $fvalue) {
                        if($fkey == 0){ $class= 'd_active'; } else{ $class = ''; } 
                        $q_title = $fvalue['title'];
                        $q_description = $fvalue['description'];
                    
                    if(!empty($q_title)){ ?>
                        <h3 class="<?php echo $class; ?> tab_drawer_heading" rel="tab<?php echo $fkey; ?>"><?php echo $q_title; ?></h3>
                    <?php } ?>
                      <div id="tab<?php echo $fkey; ?>" class="tab_content">
                        <?php if(!empty($q_description)){ ?>
                            <p><?php echo $q_description; ?></p>
                        <?php } ?>
                      </div>
                  <?php } } ?>
                </div>
                <!-- .tab_container -->
                </div>
            </div>
        </div>
<?php
  endif;
      endwhile;
endif;
?>