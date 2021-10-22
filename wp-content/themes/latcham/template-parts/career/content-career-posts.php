<?php 
    $posts_per_page = -1;
    $the_query = new WP_Query( array('posts_per_page'=> $posts_per_page,'post_type' => 'careers', 'post_status' => 'publish' ,  'order' => 'DESC') );
    if( $the_query->have_posts() ){
?>
<div class="container">
        <div class="row">
            <?php
                while( $the_query->have_posts() ){ 
                    $the_query->the_post();
                    $permalink = get_the_permalink(); ?>
                    
                <div class="col-md-6 item">
                    <div class="item-inner bg-white">
                        <h5><?php the_title(); ?></h5>
                        <p><?php echo mb_strimwidth(get_the_content(), 0, 130, '...'); ?></p>
                        <a href="<?php echo esc_url( $permalink ); ?>" class="btn btn-primary">Find out more</a>
                
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
<?php } ?>