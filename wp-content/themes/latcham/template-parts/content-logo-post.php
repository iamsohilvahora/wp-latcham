<?php
$postid = $params['post_id'];
$title = get_the_title($postid);
$description = get_field('description',$postid);
$post_logo = get_field('post_logo',$postid);
?>
<div class=" clients-logo-item">
	<div class="client-logo">
	    <img src="<?php echo $post_logo['sizes']['large']; ?>">
	    <div class="client-logo-description">
	    	<?php if(!empty($title)){ ?>
	        <h6><?php echo $title; ?></h6>
	    	<?php } if(!empty($description)){ ?>
	        <p><?php echo $description; ?></p>
	    	<?php } ?>
	    </div>
	</div>
</div>