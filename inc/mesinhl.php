<?php
/**
 * Mesin HL custom functions and definitions
 *
 * @package Mesin HL
 */

/**
 * Add custom style for login page.
 */
function mesinhl_login_style() {
	wp_enqueue_style( 'login-css', get_template_directory_uri() . '/css/theme-login.min.css' );
}
add_action( 'login_enqueue_scripts', 'mesinhl_login_style' );

/**
 * Login logo URL.
 */
function mesinhl_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'mesinhl_login_logo_url' );

/**
 * Login logo URL title.
 */
function mesinhl_login_logo_url_title() {
	return 'Mesin HL';
}
add_filter( 'login_headertitle', 'mesinhl_login_logo_url_title' );

/**
 * Remove WP logo.
 */
function mesinhl_remove_wp_logo($wp_admin_bar) {
	$wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'mesinhl_remove_wp_logo', 999);

/**
 * Left & right bottom credit.
 */
function mesinhl_dashboard_footer_left($text) {
	return sprintf(__('<a href="https://mesinhl.com/" title="Mesin HL" target="_blank">Powered by Mesin HL</a>'), 'www.mesinhl.com');
}
add_filter('admin_footer_text', 'mesinhl_dashboard_footer_left');

function mesinhl_admin_dashboard_footer_right() {
	remove_filter('update_footer', 'core_update_footer');
}
add_action('admin_menu', 'mesinhl_admin_dashboard_footer_right');

/**
 * If wordpress update.
 */
function mesinhl_admin_dashboard_footer() {
	if( ! current_user_can('update_core')) {
		remove_filter('update_footer', 'core_update_footer');
	}
}
add_action('admin_menu', 'mesinhl_admin_dashboard_footer');

/**
 * Remove CSS & JS Version
 */
function mesinhl_remove_css_js_version( $src ) {
	if( strpos( $src, '?ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
	}
add_filter( 'style_loader_src', 'mesinhl_remove_css_js_version', 9999 );
add_filter( 'script_loader_src', 'mesinhl_remove_css_js_version', 9999 );

/**
 * Wordpress login page title.
 */
function mesinhl_login_title( $login_title ) {
	return str_replace(array( ' &lsaquo;', ' &#8212; WordPress'), array( ' &raquo;', ''),$login_title );
}
add_filter( 'login_title', 'mesinhl_login_title' );

/**
 * WP admin dashboard title.
 */
function mesinhl_dashboard_admin_title($admin_title, $title) {
	return get_bloginfo('name').' &raquo; '.$title;
}
add_filter('admin_title', 'mesinhl_dashboard_admin_title', 10, 2);

/**
 * Remove some junks.
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

/**
 * Remove annoying Elementor license notice
 */
add_action("admin_enqueue_scripts", function() {
	?>
	<style>
		.e-notice--extended.e-notice--dismissible.e-notice.notice {
			display: none !important;
		}
	</style><?php
});