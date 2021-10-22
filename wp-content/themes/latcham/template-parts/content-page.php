<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package latcham
 */

?>
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                	<?php the_title( '<h1 class="title">', '</h1>' ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>
<section class="content-area bg-skyblue">
    <div class="container">
        <div class="panel bg-white">
        	<?php
		the_content(); ?>
        </div>
    </div>
</section>
