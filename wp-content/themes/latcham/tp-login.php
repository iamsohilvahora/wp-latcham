<?php

/**
Template Name: Login Page
**/

get_header();
$login_link = get_field("login_link");
?> 
<section class="content-page-top section-has-dots fit-window">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col col-sm-6 slide-content">
                    <h1 class="title"><?php the_title();?></h1>
                    <?php the_content(); ?>
                </div>
                <?php if(!empty($login_link)){ ?>
                <div class="col col-sm-6 slide-content">
                    <div class="button-group-block login-page-buttons justify-content-center">
                        <?php foreach($login_link as $links){
                            $link = $links['login_page_link'];
                            $button_label = $link['button_label'];
                            if($link['button_link'] == 'button_internal_link'){ $url = latcham_external_link($link['button_internal_link'],false); }
                            if($link['button_link'] == 'button_external_link'){ $url = latcham_external_link($link['button_external_link'],true); }
                            if(!empty($button_label) && !empty($url)){ ?>
                                <a <?php echo $url; ?> class="btn btn-default arrow-right"><?php echo $button_label; ?></a>
                            <?php } } ?>
                        
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>


<?php get_footer(); ?>