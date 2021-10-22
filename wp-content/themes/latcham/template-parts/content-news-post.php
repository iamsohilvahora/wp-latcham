<?php 
$postid = $params['post_id'];
$postid = get_the_ID();
$title = wp_trim_words(get_the_title(),20);
$term_id = $params['term_id'];
$news_image_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'post_main_image' );
$news_image = $news_image_arr[0];
$alt = !empty($news_image_arr['alt']) ? $news_image_arr['alt'] : $news_image_arr['name'];
$category = get_term($term_id);
$cat = get_the_category();
$post_content = get_the_content($postid);
$post_default_banner = get_field('post_default_banner','option');
if(!empty($news_image)){ 
    $final_image = $news_image;
}else{
	$final_image = $post_default_banner['sizes']['post_main_image'];
}
$permalink = get_the_permalink($postid);
$date = get_the_date( 'jS F Y',$postid);

$category_color = get_field("category_color", $cat[0]->taxonomy.'_'.$cat[0]->term_id);
?>
<div class="item col-md-4">
    <div class="blog-post blog-post-small bg--<?php echo $category_color; ?>">
        <div class="thumb bg-cover" style="background-image: url(<?php echo $final_image; ?>)">
            <img class="img-hide" src="<?php echo get_template_directory_uri()?>/images/placeholder/place-24-12.png">
            <span class="post-tag"><?php echo $category->name; ?></span>
        </div>
        <div class="summary">
            <span class="date"><?php echo $date; ?></span>
            <h3 class="title h5"><?php echo $title; ?></h3>
            <p><?php echo wp_trim_words(wp_strip_all_tags($post_content), 30, '...');?></p>
            <a href="<?php echo $permalink; ?>" class="link">Read more</a>
        </div>
        <a href="<?php echo $permalink; ?>" class="box-link"></a>
    </div>
</div>