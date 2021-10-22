<?php

/**
Template Name: Contact Page
**/

get_header();
$conatc_page_top_title = get_field('conatc_page_top_title');
$conatc_page_description = get_field('conatc_page_description');
$conatc_page_scocial = get_field('conatc_page_scocial');
$conatc_page_email = get_field('conatc_page_email');
$conatc_page_call = get_field('conatc_page_call');
$conatc_page_industry_title = get_field('conatc_page_industry_title');
$conatc_page_industry_link = get_field('conatc_page_industry_link');
$conatc_page_industry_post = get_field('conatc_page_industry_post');

?> 
<section class="contact-section fit-window section-has-dots d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 slide-content">
                <div class="contact-content-inner">
                    <?php if(!empty($conatc_page_top_title)){ ?>
                    <h2 class="title"><?php echo $conatc_page_top_title; ?></h1>
                    <?php } if(!empty($conatc_page_description)){ ?>    
                    <p><?php echo $conatc_page_description; ?></p>
                    <?php } if(!empty($conatc_page_scocial)){ ?>
                    <ul class="social-links">
                        <?php foreach($conatc_page_scocial as $scocial){
                            if(!empty($scocial['conatc_page_class_name']) && !empty($scocial['conatc_page_scocial_link'])){
                         ?>
                        <li><a href="<?php echo $scocial['conatc_page_scocial_link']; ?>" target="_blank"><i class="fab <?php echo $scocial['conatc_page_class_name']; ?>"></i></a></li>
                        <?php } } ?>
                    </ul>
                    <?php } ?>
                    <div class="content-info">
                        <?php if(!empty($conatc_page_email)){ ?>
                        <p>Email: <a href="mailto:<?php echo $conatc_page_email; ?>"><?php echo $conatc_page_email; ?></a><br></p>
                        <?php } if(!empty($conatc_page_call)){ ?>
                        <p>Call: <a href="tel:01173118200">0117 311 8200</a></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 slide-content ml-auto">
                <div class="contact-form custom-form custom-form-light">
                    <h2 class="title">Or <strong>contact us</strong> on</h1>
                    <?php echo do_shortcode('[contact-form-7 id="37" title="Contact form"]') ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="section section-industry bg-skyblue">
    <div class="container">
        <div class="section-head with--btn">
            <?php if(!empty($conatc_page_industry_title)){ ?>
            <h2 class="title"><?php echo $conatc_page_industry_title; ?></h2>
            <?php } if(!empty($conatc_page_industry_link)){ 
                    echo button_group($conatc_page_industry_link,'btn btn-primary'); 
                } ?>
        </div>

        <div class="industry-post-row">
            <div class="industry-post-items">
                <?php
                    $i =0;
                if(!empty($conatc_page_industry_post)):
                foreach($conatc_page_industry_post as $industry_post): 
                    $title = $industry_post->post_title;
                    $permalink = get_permalink($industry_post->ID);
                    $post_content = get_field('industry_list_small_text',$industry_post->ID);
                ?>
                <div class="item <?php if($i == 1){echo "active";}?>">
                      <div class="item-inner">
                          <?php if(!empty($title)): ?>
                          <h5 class="link-text"><?php echo $title; ?></h5>
                          <?php endif; ?>
                          <div class="hover-content">
                              <div class="inner">
                                <?php if(!empty($title)): ?>
                                  <h5><?php echo $title; ?></h5>
                                <?php endif; 
                                if(!empty($post_content)): ?>
                                  <p><?php echo mb_strimwidth($post_content, 0, 130, '...'); ?></p>
                                <?php endif; ?>

                                <a href="<?php echo esc_url($permalink); ?>" class="link">Read more</a>
                                
                              </div>
                          </div>
                      </div>
                      <a href="<?php echo esc_url($permalink); ?>" class="box-link"></a>
                  </div>
                <?php $i++; endforeach; 
                endif;?>                 
            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>