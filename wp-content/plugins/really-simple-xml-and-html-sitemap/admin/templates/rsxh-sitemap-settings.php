<?php
$rsxh_sitemap_admin = new Really_Simple_XML_And_HTML_Sitemap_Admin( 'really-simple-xml-and-html-sitemap', '1.0.0' );

?>
<div id="rsxh-plugin-settings" class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Really Simple XML And HTML Sitemap Settings', 'really-simple-xml-and-html-sitemap' ); ?></h1>

	<hr class="wp-header-end">
	
	<p><?php esc_html_e( 'To show HTML Sitemap on any posts, pages, just use the shortcode [rsxh_sitemap]. This will automatically generate a sitemap for all pages, posts and custom post type (CPT) posts based on your settings from settings page.', 'really-simple-xml-and-html-sitemap' ); ?></p>
	<p><?php esc_html_e( 'It also generate a XML sitemap which will place on your site root directory (file name sitemap.xml). XML sitemaps will help search engines like Google, Yahoo and Ask.com to better index your site.', 'really-simple-xml-and-html-sitemap' ); ?></p>
	
	<strong><?php esc_html_e( 'Here is the other following example shortcode:', 'really-simple-xml-and-html-sitemap' ); ?></strong>
	
	<p><strong>*</strong> <?php esc_html_e( '[rsxh_sitemap] to display pages,posts and custom post type (CPT) posts according to the settings from admin area.', 'really-simple-xml-and-html-sitemap' ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='page, post'] to display both the pages and posts", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='page'] to display only the pages", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( '[rsxh_sitemap post_types="post"] to display only the posts', 'really-simple-xml-and-html-sitemap' ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[wp_sitemap_page post_types='books'] to display only custom post type (CPT) posts", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='page, post' exclude_pages='3,10,...'] to display both the pages and posts excluding specific pages", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='page' exclude_pages='3,10,...'] to display only the pages excluding specific pages", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap exclude_pages='3,10,...'] to display all pages, posts and custom post type (CPT) posts excluding specific pages", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap exclude_post_and_custom_post_type_posts='15,18,...'] to display all pages, posts and custom post type (CPT) posts excluding specific posts and custom post type (CPT) posts", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='post' exclude_post_and_custom_post_type_posts='15,18,...'] to display only the posts excluding specific posts", "really-simple-xml-and-html-sitemap" ); ?></p>
	<p><strong>*</strong> <?php esc_html_e( "[rsxh_sitemap post_types='facilities' exclude_post_and_custom_post_type_posts='15,18,...']  to display only defined post type posts excluding specific post type posts", "really-simple-xml-and-html-sitemap" ); ?></p>
	
	<?php
	if ( isset( $_POST['act'] ) && $_POST['act'] == 'save' ) {
		if ( ! isset( $_POST['rsxh_nonce_field'] ) || ! wp_verify_nonce( $_POST['rsxh_nonce_field'], 'rsxh_nonce_action' ) ) {
			?>
			<div id="message" class="notice notice-error is-dismissible">
				<p><?php esc_html_e( 'Sorry, your nonce did not verify.', 'really-simple-xml-and-html-sitemap' ); ?></p>
				<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'really-simple-xml-and-html-sitemap' ); ?></span></button>
			</div>
			<?php
		} else {
			
			$exc_post_type = !empty( $_POST['exclude_post_type'] ) ? array_map( 'sanitize_text_field', $_POST['exclude_post_type'] ) : '';
			
			$rsxh_exclude_post_type = update_option( 'rsxh-exclude-post-type', $exc_post_type );
			
			$exclude_pages = sanitize_text_field( $_POST['exclude_pages'] );
			
			$exclude_pcpt_posts = sanitize_text_field( $_POST['exclude_pcpt_posts'] );
			
			$rsxh_exclude_pages = update_option( 'rsxh-exclude-pages', $exclude_pages );
			
			$rsxh_exclude_pcpt_posts = update_option( 'rsxh-exclude-pcpt-posts', $exclude_pcpt_posts );
			
			if ( $rsxh_exclude_post_type || $rsxh_exclude_pages || $rsxh_exclude_pcpt_posts ) {
				$exc_pt = array();
				if ( isset( $_POST['exclude_post_type'] ) && !empty( $_POST['exclude_post_type'] ) ) {
					$exc_pt = array_map( 'sanitize_text_field', $_POST['exclude_post_type'] );
				}
				
				$params = array(
					'exclude_post_type' => $exc_pt,
					'exclude_pages' => ( $exclude_pages ? $exclude_pages : '' ),
					'exclude_pcpt_posts' => ( $exclude_pcpt_posts ? $exclude_pcpt_posts : '' ),
				);
				
				?>
				<div id="message" class="updated notice is-dismissible">
					<p><?php esc_html_e( 'Settings Saved', 'really-simple-xml-and-html-sitemap' ); ?></p>
					<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'really-simple-xml-and-html-sitemap' ); ?></span></button>
				</div>
				<?php
				$rsxh_sitemap_admin->generate_xml_sitemap_when_option_updated( $params );
			}
		}
	}
	$rsxh_exclude_post_type = get_option( 'rsxh-exclude-post-type' );
	$rsxh_exclude_pages = get_option( 'rsxh-exclude-pages' );
	$rsxh_exclude_pcpt_posts = get_option( 'rsxh-exclude-pcpt-posts' );
	
	?>
	
	<form id="group-form" class="settings-form" action="admin.php?page=rsxh-sitemap-settings" method="post">
		<input type="hidden" name="act" value="save">
		<table class="form-table">
			<tbody>
				<tr class="post-types">
					<th scope="row"><label for="exclude_post_type"><?php echo esc_html__( 'Exclude post type', 'really-simple-xml-and-html-sitemap' ); ?></label></th>
					<td>
						<input type="checkbox" name="exclude_post_type[]" value="page" <?php if( !empty( $rsxh_exclude_post_type ) && in_array( 'page', $rsxh_exclude_post_type ) ):?>checked<?php endif;?>> Page<br>
						<input type="checkbox" name="exclude_post_type[]" value="post" <?php if( !empty( $rsxh_exclude_post_type ) && in_array( 'post', $rsxh_exclude_post_type ) ):?>checked<?php endif;?>> Post<br>
						<?php if( !empty( Really_Simple_XML_And_HTML_Sitemap_Admin::$custom_post_types ) ):?>
						<?php foreach( Really_Simple_XML_And_HTML_Sitemap_Admin::$custom_post_types as $key => $value ):?>
						<input type="checkbox" name="exclude_post_type[]" value="<?php echo esc_attr( $key );?>" <?php if( !empty( $rsxh_exclude_post_type ) && in_array( $key, $rsxh_exclude_post_type ) ):?>checked<?php endif;?>> <?php echo ucfirst( $value );?><br> 
						<?php endforeach;?>
						<?php endif;?>
					</td>
				</tr>
				
				<tr class="exc_pageids">
					<th scope="row"><label for="exclude_pages"><?php echo esc_html__( 'Exclude pages', 'really-simple-xml-and-html-sitemap' ); ?></label></th>
					<td>
						<input type="text" name="exclude_pages" value="<?php if( !empty( $rsxh_exclude_pages ) ) : echo esc_attr( $rsxh_exclude_pages ); endif;?>"><br/><small><?php esc_html_e( 'Please enter comma(,) separated page ids here. Ex:15,17,18....', 'really-simple-xml-and-html-sitemap' ); ?></small>
					</td>
				</tr>
				
				<tr class="exc_postcusids">
					<th scope="row"><label for="exclude_posts_custom_post_type_posts"><?php echo esc_html__( 'Exclude posts and custom post type posts', 'really-simple-xml-and-html-sitemap' ); ?></label></th>
					<td>
						<input type="text" name="exclude_pcpt_posts" value="<?php if( !empty( $rsxh_exclude_pcpt_posts ) ) : echo esc_attr( $rsxh_exclude_pcpt_posts ); endif;?>"><br/><small><?php esc_html_e( 'Please enter comma(,) separated post and custom post type post ids here. Ex:10,12,20....', 'really-simple-xml-and-html-sitemap' ); ?></small>
					</td>
				</tr>
				
				<tr>
					<?php wp_nonce_field( 'rsxh_nonce_action', 'rsxh_nonce_field' ); ?>
					<th scope="row"><input type="submit" value="<?php echo esc_attr__( 'Save', 'really-simple-xml-and-html-sitemap' ); ?>" class="button button-primary button-large"></th>
					<td></td>
				</tr>
			</tbody>
		</table>

	</form>
	
</div>