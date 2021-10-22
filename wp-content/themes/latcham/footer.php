<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package latcham
 */
$footer_social = get_field('footer_social','option');
$footer_copyright = get_field('footer_copyright','option');
$footer_email = get_field('footer_email','option');
$footer_call = get_field('footer_call','option');
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-6 footer-block left">
					<div class="block-inner-top">
						<?php 
						wp_nav_menu(
							array(
								'menu'        => 'footer-menu',
								'menu_class' => 'footer-menu',
							)
						);
						?>
						
						<div class="contact-links">
							<?php if(!empty($footer_email)){ ?>
							<p>Email: <a href="mailto:<?echo $footer_email; ?>"><?echo $footer_email; ?></a></p>
						<?php } ?>
							<p>Call: <a href="tel:01173118200">0117 311 8200</a></p>
							<?php if(!empty($footer_social)){ ?>
							<ul class="social-links">
								<?php foreach($footer_social as $social){ ?>

									<li><a href="<?php echo $social['footer_social_url'];?>" target="_blank"><i class="fab <?php echo $social['footer_social_class'];?>"></i></a></li>
								<?php } ?>
							</ul>
						<?php } ?>
						</div>
					</div>
					<?php if(!empty($footer_copyright)){ ?>
					<p class="for-desktop"><?php echo $footer_copyright; ?></p>
				<?php } ?>
				</div>
				<div class="col-md-6 footer-block right">
					<?php echo do_shortcode('[contact-form-7 id="630" title="Subscribe form"]') ?>
					<?php if(!empty($footer_copyright)){ ?>
					<p class="for-mobile"><?php echo $footer_copyright; ?></p>
				<?php } ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type="text/javascript">

jQuery(document).ready(function() {
	
 });
</script>
<?php wp_footer(); ?>



</body>
</html>