<?php

/**
Template Name: Sitemap Page
**/

get_header();
?> 
<!-- <h2>Authors</h2>
<ul>
<?php wp_list_authors( array(
  'exclude_admin' => false
) ); ?>
</ul> -->

<h2>Pages</h2>
<ul>
<?php
wp_list_pages( array( 
  'exclude' => '',
  'title_li' => '',
) ); ?>
</ul>

<h2>Posts</h2>
<?php 
$cats = get_categories('exclude=');
foreach ($cats as $cat) {
  echo '<h3>' . $cat->cat_name . '</h3>';
  echo '<ul>';
  query_posts('posts_per_page=-1&cat=' . $cat->cat_ID);
  while(have_posts()) {
    the_post();
    $category = get_the_category();
    if ($category[0]->cat_ID == $cat->cat_ID) {
      echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>'; 
    }
  }
  echo '</ul>';
}
 get_footer(); ?>