<?php 
$postID = $params['post_id'];
$post_title = get_the_title($postID);
$select_pdf_file = get_field('select_resource_file',$postID);
$post_file = get_field('file',$postID);
$post_file_url = get_field('enter_file_url',$postID);
if(!empty($select_pdf_file))
{
    if($select_pdf_file == 'File' && !empty($post_file))
    {
        $file_title = $post_file['title'];
        $file_name = $post_file['filename'];
        $file_url = $post_file['url'];

        $externsion_array = explode('.', $file_name);
        $file_extension = $externsion_array[1];
        $file_extension = strtolower($file_extension);
        $target_file_url = latcham_external_link($file_url,true);

    }if($select_pdf_file == 'URL' && !empty($post_file_url)){
    	$externsion_array = explode('.', $post_file_url);
        $file_extension = $externsion_array[1];
        $file_extension = strtolower($file_extension);
        $target_file_url = latcham_external_link($post_file_url,true);

    }
    $icons = get_field('file_icon','option');
        if(!empty($icons)){
            foreach ($icons as $icon_key => $icon_value) 
            {
                $icon_type = $icon_value['file_type'];
                $icon_type = strtolower($icon_type);
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