<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package latcham
 */
$header_call = get_field('header_call','option');
$google_analytics_key = get_field('google_analytics_key','option');
$fb_pixel_code = get_field('fb_pixel_code','option');
$linkedin_pixel_code = get_field('linkedin_pixel_code','option'); 
$search_shortcode = get_field('search_shortcode','option'); 
$company_logo_image = get_field('company_logo_image','option');

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=0"/>
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.typekit.net/fnv8vdx.css">
	<link rel="icon" type="image/ico" href="<?php echo get_template_directory_uri()?>/images/favicon.png">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $google_analytics_key;?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', '<?php echo $google_analytics_key;?>');
	</script>
	<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '<?php echo $fb_pixel_code; ?>');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"	src="https://www.facebook.com/tr?id=<?php echo $fb_pixel_code; ?>&ev=PageView&noscript=1"	/></noscript>
	<!-- End Facebook Pixel Code -->
	<script type="text/javascript"> _linkedin_partner_id = "<?php echo $linkedin_pixel_code; ?>"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=<?php echo $linkedin_pixel_code; ?>&fmt=gif" /> </noscript>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="row">
				<div class="col col-sm-2 site-branding">
					<?php if(!empty($company_logo_image)){ ?>
					<a class="logo" href="<?php echo home_url(); ?>">
						<img src="<?php echo $company_logo_image['url']?>" alt="Carbon">
					</a>
				<?php } ?>
				</div><!-- .site-branding -->

				<div class="col col-sm-10 header-col-right">
					<nav id="site-navigation" class="main-navigation">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
							)
						);
						?>

						<ul class="header-links mobile">
							<?php if(!empty($header_call)){ 
								$result = '';
								if(  preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $header_call,  $matches ) )
									{
									    $result = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
									    
									}
								?>
							<li>Call: <a href="tel:<?php echo $header_call; ?>"><?php echo $header_call; ?></a></li>
							<?php } ?>
							<li><a href="#" class="link-login">Login</a></li>
						</ul>
					</nav><!-- #site-navigation -->

					<div class="header-right">
						<ul class="header-links desktop">
							<?php if(!empty($header_call)){ ?>
							<li class="link-phone">Call: <a href="tel:<?php echo $header_call; ?>"><?php echo $header_call; ?></a></li>
							<?php } ?>
							<li class="link-login"><a href="<?php echo site_url();?>/login" class="link-login">Login</a></li>
							<li class="link-search"><a href="javascript:void(0)" class="link-search-btn"><i class="icon icon-search"></i></a></li>
						</ul>

						<a class="menu-toggle" href="javascript:void(0)">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</div>

	 <div id="searchform" class="serach-form">
			<form class="searchbox" action="<?php echo home_url(); ?>">
				<div class="form-group">
					<div class="input-box">
					 <input type="search" autocomplete="off" placeholder="Search Latcham" name="s"  value="<?php echo (isset($_GET['s']) && !empty($_GET['s'])) ? $_GET['s'] : ''; ?>" class="searchbox-input"> 
					</div>
					<div class="input-box serach-btn">
        			 <input type="submit" class="searchbox-submit" value="">
        			</div>
				</div>
			</form>   
		</div>  
	</header><!-- #masthead -->
