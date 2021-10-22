<?php
/**
Template Name: Resources
**/


get_header();
$ID = get_the_ID();
$page_title = get_the_title($ID);
$content = get_the_content($ID);
$page_content = apply_filters('the_content', $content);

?> 
<section class="content-page-top section-has-dots">
    <div class="content-page-top-inner">
        <div class="container">
            <?php if(!empty($page_title)){ ?>
                <h1 class="title"><?php echo $page_title; ?></h1>
            <div class="row">
                <?php } if(!empty($page_content)){ echo $page_content;  } ?>
            </div>
        </div>
    </div>
    <div class="dot-circle-bg">
        <img class="svg" src="<?php echo get_template_directory_uri()?>/images/icons/dots-image.svg" alt="">
    </div>
</section>

<section class="listing-post-block">
    <div class="container">
        <div class="filter">
            <div class="row no-gutters">
                <div class="filter-col d-flex align-items-center">
                    <label>Filter results</label>
                    <?php 
                        $terms = get_terms( array('taxonomy' => 'resources-category', 'hide_empty' => false) );
                        
                    ?>
                    <select class="form-control shadow-none" id="resource_term">
                          <option value="">Select category</option>
                            <?php foreach ($terms as $key => $value) { ?>
                          <option value="<?php echo $value->term_id; ?>"><?php echo $value->name ?></option>
                        <?php }  ?>
                    </select>
                </div>
            </div>
        </div>
        <?php
         $posts_per_page = 12;
         $query = new WP_Query( array('posts_per_page'=> $posts_per_page,'post_type' => 'resources', 'post_status' => 'publish' ,  'order' => 'DESC') );
            
        ?>
        <div class="row gutters-23  resorces-main" id="show_resorces">
            <?php 
            $icons = get_field('file_icon','option');
            if($query->have_posts()){ ?>
            <div id="show_resources_post" class="articallisting post-listing">
            <div id="html_loader" class="main-loader"></div>   
            <div class="row" id="appenddata"> 
                <?php while( $query->have_posts() ){
                    $query->the_post();
                    $postID = get_the_ID();
                    $post_title = get_the_title();
                    $content = get_the_content();
                    $select_pdf_file = get_field('select_resource_file',$postID);
                    $post_file = get_field('file',$postID);
                    $post_file_url = get_field('enter_file_url',$postID);
                    if(!empty($select_pdf_file))
                    {
                        if($select_pdf_file == 'File')
                        {
                            $file_title = $post_file['title'];
                            $file_name = $post_file['filename'];
                            $file_url = $post_file['url'];

                            $externsion_array = explode('.', $file_name);
                            $file_extension = $externsion_array[1];
                            $file_extension = strtolower($file_extension);
                            $target_file_url = latcham_external_link($file_url,true);

                        }if($select_pdf_file == 'URL'){
                            $externsion_array = explode('.', $post_file_url);
                            $file_extension = $externsion_array[1];
                            $file_extension = strtolower($file_extension);
                            $target_file_url = latcham_external_link($post_file_url,true);
                        }
                        if(!empty($icons)){
                            foreach ($icons as $icon_key => $icon_value) 
                            {
                                $icon_type = strtolower($icon_value['file_type']);
                                if($file_extension == $icon_type)    
                                {
                                     $icon['url'] = $icon_value['icon']['url'];
                                }else{
                                     $icon['url-default'] = get_template_directory_uri().'/images/icons/pdf-file1.svg';
                                 }
                            } 
                        }
                        
                        
                    }
                   
                ?>
            <div class="col-sm-6 col-lg-4 col-xl-3 item resources-item">
                <a <?php echo $target_file_url; ?> class="btn btn-default resources-links  min-w-100">
                    <img class="svg" src="<?php if(!empty($icon['url'])) { echo $icon['url']; }else { echo $icon['url-default']; }  ?>" alt="">
                    <h6 class="arrow-right"> <?php echo $post_title; ; ?></h6>
                </a>
            </div>
            <?php }  ?>     
         </div>
         </div>
        <?php }  ?>    
         </div>
        <?php if($query->found_posts >= $posts_per_page) { ?>
        <div class="load-more load-more-space text-center">
             <div id="loader"></div>
            <a class="btn btn-primary resourceloadmore" href="javascript:void(0);" >Load more</a>
        </div>
        <?php } ?>
        <input type="hidden" name="total_post" id="total_post" value="<?php echo $query->found_posts; ?>" data-category="" data-month="3" data-yer="2019"> 
        <input type="hidden" id="offset" name="offset" value="<?php echo $posts_per_page; ?>">
         

    </div>
</section>


<?php get_footer(); ?>