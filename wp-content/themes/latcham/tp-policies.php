<?php

/**
Template Name: Policies 
**/

get_header();

$policy_heading = get_field('policy_heading');
$policy_left_content = get_field('policy_left_content');
$policy_right_content = get_field('policy_right_content');

$policies = get_field('policy');

?> 
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($policy_heading)): ?>
                <h1 class="title"><?php echo $policy_heading; ?></h1>
            <?php endif; ?>

            <div class="row">
                <?php if(!empty($policy_left_content)): ?>
                <div class="col col-sm-6 slide-content">
                    <p><?php echo $policy_left_content; ?></p>
                </div>
                <?php endif;
                if(!empty($policy_right_content)): ?>
                <div class="col col-sm-6 slide-content">
                    <p><?php echo $policy_right_content; ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="content-area bg-skyblue">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">    
            <?php
            if(!empty($policies)):
                foreach($policies as $policy): 
                    $policy_title = $policy['policy_title'];
                    $policy_links = $policy['policy_link']; ?>

                    <div class="buttons-block">
                        <?php if(!empty($policy_title)): ?>
                        <h4><?php echo $policy_title; ?></h4>
                        <?php endif;

                        if(!empty($policy_links)): ?>
                        <div class="button-group-block">
                            <?php foreach($policy_links as $link): 
                                $policy_button_link = $link['policy_button_link'];
                                
                                if(!empty($policy_button_link)): ?>
                                    <div  class="btn btn-default "> <?php  echo button_group($policy_button_link,'arrow-right'); ?></div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    </div>
            <?php endforeach; 
            endif;?>

            </div>
        </div>
    </div>
</section>


<?php get_footer(); ?>