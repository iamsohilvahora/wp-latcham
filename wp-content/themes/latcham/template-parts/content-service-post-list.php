<?php 
$postid = $params['post_id'];
//$postid = get_the_ID();
$service_text = get_field('service_short_description',$postid);
$single_detail_restrict = get_field('single_detail_restrict',$postid);
$title = get_the_title($postid);
$permalink = get_the_permalink($postid);
?>
<div class="col-sm-6 col-lg-4 item">
    <div class="item-inner">
    	<?php if($single_detail_restrict == 'No'){ ?>
    	<a href="<?php echo $permalink; ?>" class="box-link"></a>
    	<?php } ?>
    	<h5 class="arrow-left"><?php echo $title; ?></h5>    	
        <p><?php echo wp_trim_words($service_text, 30, ' ... '); ?></p>
        
    </div>
</div>