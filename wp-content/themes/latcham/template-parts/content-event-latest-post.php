<?php 
$post = $params['post'];
$term_id = $params['term_id'];
$category = get_term($term_id);
$category_color = get_field("category_color", $category->taxonomy.'_'.$category->term_id);
$event_start_date = get_field('event_start_date',$post->ID);
$date = date( 'jS F Y',strtotime($event_start_date));
$news_image_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post_top_large_image' );
$news_image = $news_image_arr[0];
if(!empty($news_image)){ 
    $final_image = $news_image;
}else{
    $final_image = $Default_image;
}
$category = get_term($term_id);
$category_color = get_field("category_color", $category->taxonomy.'_'.$category->term_id);
?>
<div class="item full-width-item col-md-12">
    <div class="item-inner bg--<?php echo $category_color; ?>">
        <div class="post-image bg-cover" style="background-image: url(<?php echo $final_image; ?>)">
            <img class="img-hide" src="<?php echo get_template_directory_uri()?>/images/placeholder/place-50-35.png">
            <!-- <span class="post-tag">News</span> -->
        </div>
        <div class="post-content">
            <span class="date"><?php echo $date; ?></span>
            <h3 class="title h5"><?php echo wp_trim_words($post->post_title,20); ?></h3>
            <p><?php echo wp_trim_words(wp_strip_all_tags($post->post_content), 60, '...');?></p>
            <a href="<?php echo get_the_permalink($post->ID); ?>" class="link">Read more</a>
        </div>
    </div>
</div>   