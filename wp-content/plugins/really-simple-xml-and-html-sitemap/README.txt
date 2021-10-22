=== Really Simple XML and HTML Sitemap ===
Contributors: sumon086
Donate link: #
Tags: sitemap, wp sitemap, xml and html sitemap, xml sitemap, html sitemap, sitemap pages, page list, dynamic sitemap, sitemap generator, seo, google xml sitemap, sitemap plugin
Requires at least: 4.0
Tested up to: 5.5.3
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

You can add Sitemap on any posts, pages, using the shortcode [rsxh_sitemap] and it also generate a XML Sitemap which will placed on site root directory.This plugin will improve SEO.

== Description ==

This Wordpress Plugin has a really easy way to add Sitemap of your pages. To show HTML Sitemap on any pages or posts, just use the shortcode [rsxh_sitemap]. You can also place `<?php echo do_shortcode( '[rsxh_sitemap]' ); ?>` in your templates. This will automatically generate a Sitemap for all pages, posts and custom post type (CPT) posts.
	
It also generate a XML sitemap which will place on your site root directory (file name sitemap.xml). XML sitemaps will help search engines like Google, Yahoo and Ask.com to better index your site.

== Current features ==

*	Display all pages, posts and Custom Post Type (CPT) (such as: "facilities", "books" etc) posts
*	Display a particular post type posts using the attribute "post_types", like `[rsxh_sitemap post_types="page"]`
*	Display multiple post type posts using the attribute "post_types", like `[rsxh_sitemap post_types="page,posts,..."]`
*	Display only pages and exclude some pages from the list using the attribute "post_types" and "exclude_pages" , like `[rsxh_sitemap post_types="page" exclude_pages="3,10,..."]`
*	Display all pages, posts with custom post type (CPT) posts and exclude some posts and custom post type (CPT) posts using the attribute "exclude_post_and_custom_post_type_posts" , like `[rsxh_sitemap exclude_post_and_custom_post_type_posts="15,18,..."]`
*   Easy to use
*   Have an option to customize the way it will be displayed through the admin panel
*   Have an option to exclude some pages, posts or some Custom Post Type (CPT) posts
*   Posts displayed hierarchically
*   Translation ready

== Installation ==
1. Unzip the plugin and upload the `really-simple-xml-and-html-sitemap` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. To change/modify plugin settings, go to `RSXH Sitemap Settings` tab from Wordpress admin area
4. Use the shortcode [rsxh_sitemap] on any page Or echo the shortcode like `<?php echo do_shortcode( '[rsxh_sitemap]' ); ?>` in your templates file.

== Frequently Asked Questions ==

= Does it generate an XML sitemap? =

Yes. It will placed on your site root directory (file name sitemap.xml). XML sitemaps will help search engines like Google, Yahoo and Ask.com to better index your site.

= Does it work with Custom Post Type (CPT)? =

Yes. It works fine with the Custom Post Type (CPT)

= Is it possible to get only the pages, the posts or a Custom Post Type (CPT)? =

Yes. It can. You have to use following shortcode

*   `[rsxh_sitemap post_types='page, post']` to display both the pages and posts
*   `[rsxh_sitemap post_types='page']` to display only the pages
*   `[rsxh_sitemap post_types="post"]` to display only the posts
*   You can display Custom Post Type(CPT) using the name of the post type inside the "post_types" attribute. For example: `[rsxh_sitemap post_types='facilities']` or `[wp_sitemap_page post_types='books']` 

= Have option to get rid of some specific pages, the posts or a Custom Post Type (CPT) posts? =

Yes. It is. You have to use following shortcode

*   `[rsxh_sitemap post_types='page, post' exclude_pages='3,10,...']` to display both the pages and posts excluding specific pages
*   `[rsxh_sitemap post_types='page' exclude_pages='3,10,...']` to display only the pages excluding specific pages
*   `[rsxh_sitemap exclude_pages='3,10,...']` to display all pages, posts and custom post type (CPT) posts excluding specific pages
*   `[rsxh_sitemap exclude_post_and_custom_post_type_posts='15,18,...']` to display all pages, posts and custom post type (CPT) posts excluding specific posts and custom post type (CPT) posts
*   `[rsxh_sitemap post_types='post' exclude_post_and_custom_post_type_posts='15,18,...']` to display only the posts excluding specific posts
*   You can display Custom Post Type(CPT) using the name of the post type inside the "post_types" attribute. For example: `[rsxh_sitemap post_types='facilities' exclude_post_and_custom_post_type_posts='15,18,...']`  to display only defined post type posts excluding specific post type posts

== Screenshots ==

1.This screen shot for plugin settings section from where you can setup you desire setings from admin area.Here you can find the plugin shortcodes. This description corresponds to `/assets/screenshot-1.png`.
2.From this screenshot, you can see how html sitemap looks like in frontend. This description corresponds to `/assets/screenshot-2.png`.
3.Sample XML sitemap. This description corresponds to `/assets/screenshot-3.png`.

== Changelog ==

= 1.0.0 =
* Initial release of Really Simple XML and HTML Sitemap.

= 1.0.1 =
* use wp_schedule_event to generate XML Sitemap in specific interval.

= 1.0.2 =
* fixed bug with empty parameter "exclude_post_type"
* translation ready