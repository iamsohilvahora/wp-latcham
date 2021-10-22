<?php
$postid = $params['post_id'];
$title = get_the_title($postid);
$awards_text = get_field('awards_text',$postid);
$awards_image = get_field('awards_image',$postid);
?>
<div class="col-sm-6 col-lg-4 col-xl-3 clients-logo-item">
	<div class="client-logo">
	    <img src="<?php echo $awards_image['sizes']['large']; ?>">
	    <div class="client-logo-description">
	    	<?php if(!empty($title)){ ?>
	        <h6><?php echo $title; ?></h6>
	    	<?php } if(!empty($awards_text)){ ?>
	        <p><?php echo $awards_text; ?></p>
	    	<?php } ?>
	    </div>
	</div>
</div>