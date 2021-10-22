<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package latcham
 */

get_header();
?>
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <div class="row">
                <div class="col col-sm-6 slide-content">
                    <h1 class="title">Search results for <br> “<?php echo get_search_query(); ?>”</h1>
				</div>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="section section-utilities search-posts bg-skyblue">
    <div class="container">
        <div class="row">
        	<?php if ( have_posts() ) : 
                //query_posts('showposts=999'); 
        		while ( have_posts() ) :
        		the_post();
        	?>
            <div class="col-md-6 item">
                <div class="item-inner bg-white">
                    <?php the_title( sprintf( '<h5 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
                    <p><?php the_excerpt(); ?></p> 
                    <!-- <?php //latcham_post_thumbnail(); ?> -->
				</div>
            </div>
        	<?php 
        	endwhile;
            if(function_exists('wp_paginate')):
            wp_paginate();  
        else :
        the_posts_pagination( array(
            'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
            'next_text'          => __( 'Next page', 'twentyfifteen' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
        ) );
      endif;
            //the_posts_navigation(array('prev_text'=>'Older posts','next_text'=>'Newer posts','class'=>'search-navigation','screen_reader_text'=>''));
        	else : ?>
			<h1 class="page-title">
				<?php esc_html_e( 'Nothing Found', 'latcham' ); ?>
			</h1>
			<?php
			endif; ?>
        </div>
    </div>
</section>
<?php
//get_sidebar();
get_footer();
