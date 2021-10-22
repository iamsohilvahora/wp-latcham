<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package latcham
 */

get_header();
$main_blocks = get_field( '404_content','option');
if( have_rows('404_content','option') ){
    foreach ( $main_blocks as $block ) {
        if( $block['acf_fc_layout'] == 'top_section' ){
?>

<section class="error-404 not-found section-has-dots">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-xl-4 not-found-left">
				<div class="not-found-detail">
                    <?php if(!empty($block['404_title'])){ ?>
					<h1 class="page-title"><?php echo $block['404_title'];?></h1>
                    <?php } if(!empty($block['404_sub_title'])){ ?>
					<h3><?php echo $block['404_sub_title'];?></h3>
                    <?php } if(!empty($block['404_description'])){ ?>
					<p><?php echo $block['404_description'];?></p>
                    <?php } if(!empty($block['404_useful_link'])){ ?>
					<ul>
                        <?php foreach ($block['404_useful_link'] as $value) { ?>
                            <li><?php if(!empty($value)){
                                            echo button_group($value['404_link'],'test');
                                        }?>
                            </li>            
                            <?php } ?>
					</ul>
                    <?php } ?>
				</div>
			</div>
            <?php if(!empty($block['404_video']) &&(
    (!empty($block['404_video']['top_slider_image']) && $block['404_video']['select_type'] == 'Image') || 
    (!empty($block['404_video']['top_slider_video'] && $block['404_video']['select_type'] == 'Video' && $block['404_video']['top_slider_video_select'] == 'internal')) || 
    (!empty($block['404_video']['video_url']) && $block['404_video']['select_type'] == 'Video' && $block['404_video']['top_slider_video_select'] == 'external'))) { ?>
			<div class="col-lg-7 col-xl-8 not-found-right section-content-video">
				<div class="not-found-video">
					<div class="video-content mp4-video"> 
                        <?php if($block['404_video']['select_type'] == 'Image'){ ?>
                        <div class="image-container">
                             <div class="bg-cover" style="background-image: url('<?php echo $block['404_video']['top_slider_image']['url']?>');">
                                <img src="<?php echo get_template_directory_uri()?>/images/placeholder/placeholder-50x28.png">
                            </div>
                        </div>
                    <?php }else { 
                            if($block['404_video']['top_slider_video_select'] == 'internal'){ ?>
                            <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>
                            <div class="banner-video-wrap">
                                 <div class='player'>
                                    <video class="video" width="100%" controls> 
                                      <source src="<?php echo $block['404_video']['top_slider_video']['url']; ?>" type="video/mp4">
                                    </video>
                                    <a href="javascript:void(0);" class="play-btn"></a>
                                </div>
                            </div>                
                         <?php }else{ 
                                $video_url = video_url($block['404_video']['video_url']);
                            ?>
                            <div class="banner-img bg-cover" style="background:url('<?php echo get_template_directory_uri()?>/images/media/video-poster.png')"></div>  
                            <div class="banner-video-wrap">
                                <div class="banner-video-wrap" id="youtube-wrap">
                                    <iframe width="100%" height="315" src="<?php echo $video_url; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="play-btn play-icon"></a>
                    <?php } } ?>
                    </div>
				</div>
			</div>
        <?php } ?>
		</div>
	</div>
	<div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section><!-- .error-404 -->
<?php }else if( $block['acf_fc_layout'] == '404_industy_section' ){ ?>
        
<section class="section section-industry bg-skyblue">
    <div class="container">
        <div class="section-head with--btn">
            <?php if(!empty($block['404_industry_title'])){ ?>
            <h2 class="title"><?php echo $block['404_industry_title']; ?></h2>
            <?php }
                if(!empty($block['404_industry_link'])){
                            echo button_group($block['404_industry_link'],'btn btn-primary');   
                        }
             ?>
        </div>

        <div class="industry-post-row">
            <div class="industry-post-items">
                <?php $i =0; if(!empty($block['404_industry_post'])){ 

                        foreach ($block['404_industry_post'] as $industry_post) {
                        $title = get_the_title( $industry_post->ID );
                         $permalink = get_permalink( $industry_post->ID );
                         $industry_list_small_text = get_field("industry_list_small_text",$industry_post->ID);
                        ?>
                <div class="item <?php if($i == 1){echo "active";}?>">
                    <div class="item-inner">
                        <h5 class="link-text"><?php echo $title; ?></h5>
                        <div class="hover-content">
                            <div class="inner">
                                <h5><?php echo $title; ?></h5>
                                <?php if(!empty($industry_list_small_text)): ?>
                                <p><?php echo mb_strimwidth($industry_list_small_text, 0, 130, '...');?></p>
                                <?php endif; ?> 
                                <a href="<?php echo esc_url( $permalink ); ?>" class="link">Read more</a>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo esc_url( $permalink ); ?>" class="box-link"></a>
                </div>
            <?php $i++; } } ?>              
            </div>
        </div>
    </div>
</section>
<?php }}}

get_footer();
