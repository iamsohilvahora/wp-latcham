<?php 

$postid = $params['post_id'];
//$postid = get_the_ID();
$title = substr(get_the_title($postid),0,50);
$news_image_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'post_main_image' );

$news_image = $news_image_arr[0];

$alt = !empty($news_image_arr['alt']) ? $news_image_arr['alt'] : $news_image_arr['name'];

$category = get_the_terms($postid,'industry-category');
$categoryName = "";
if(!empty($category)){
    foreach($category as $cat){
        $categoryName = $cat->name;
    }
}
$short_description = get_field("short_description",$postid);
if(!empty($news_image)){ 
    $final_image = $news_image;
}else{
	$final_image = $Default_image;
}
$permalink = get_the_permalink($postid);
$date = get_the_date( 'jS F Y',$postid);

?>
<div class="item blog-post">
    <div class="item-inner bg--blue">
        <div class="post-image bg-cover" style="background-image: url(<?php echo $final_image; ?>)">
            <img class="img-hide" src="<?php echo get_template_directory_uri()?>/images/placeholder/place-24-12.png">
            <span class="post-tag"><?php echo $categoryName; ?></span>
        </div>
        <div class="post-content summary">
            <span class="date"><?php echo $date; ?></span>
            <h3 class="title h5"><?php echo $title; ?></h3>
            <p><?php echo mb_strimwidth($short_description, 0, 124, '...');?></p>
            <a href="<?php echo $permalink; ?>" class="link">Read more</a>
        </div>
    </div>
</div>