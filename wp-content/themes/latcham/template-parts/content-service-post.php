<?php 
$postid = $params['post_id'];
$industry_post__list = get_field('industry_post__list',$postid);
$industry_post_landing_page_text = get_field('industry_post_landing_page_text',$postid);
$title = get_the_title($postid);
//$content = get_the_content($postid);
$permalink = get_the_permalink($postid);
?>
<div class="col-sm-6 col-lg-4 item">
    <div class="item-inner">
        <?php if(isset($permalink) && !empty($permalink)){ ?>
        <a href="<?php echo $permalink;?>" class="box-link"></a>
        <?php } ?>
        <h5 class="arrow-left"> <?php echo $title; ?></h5>
        <p><?php echo mb_strimwidth($industry_post_landing_page_text, 0, 140, '...'); ?></p>
        <?php if(!empty($industry_post__list)){ ?>
        <ul>
            <?php foreach($industry_post__list as $industry){ 
                if(!empty($industry['industry_post__type'])){
                ?>
            <li><?php echo $industry['industry_post__type']; ?></li>
            <?php } } ?>
        </ul>
        <?php } ?>
    </div>
</div>