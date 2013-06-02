<?php
/* ------------------------------------- */
/* OPTION TREE INSTALL NOTICE */
/* ------------------------------------- */

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');

$template_url_first = get_template_directory_uri();

if(get_option('tb_glisseo_first_import')!="on"){
	tb_glisseo_first_import_check();
}



function tb_glisseo_first_import_check(){
	global $template_url_first;
	update_option('tb_glisseo_first_import','on');

	update_option('tb_glisseo_theme_general_options',array("tb_glisseo_responsive_active" => "1", "tb_glisseo_highlight_color" => "3CAB88", "tb_glisseo_highlight_hover_color" => "CD5465", "tb_glisseo_main_font" => "http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,700,700italic", "tb_glisseo_main_fontfamily" => "font-family: 'Open Sans', sans-serif;", "tb_glisseo_favicon_icon" => $template_url_first."/style/images/favicon.png", "tb_glisseo_css" => "", "tb_glisseo_analytics" => ""));


	update_option('tb_glisseo_theme_header_options',array("tb_glisseo_header_logo" => $template_url_first."/style/images/logo.png", "tb_glisseo_header_logo_background_color" => "BBBBBB", "tb_glisseo_header_logo_background_border_color" => "CCCCCC"));
	
	
	update_option('tb_glisseo_theme_body_options',array("tb_glisseo_body_background_image" => $template_url_first."/style/images/bg.jpg", "tb_glisseo_body_head_image" => $template_url_first."/style/images/head3.jpeg"));
	
	
	update_option('tb_glisseo_theme_footer_options',array("tb_glisseo_footer" => "1", "tb_glisseo_subfooter" => "1"));
	
	
	update_option('tb_glisseo_theme_portfolio_options',array("portfolio_builder_name-0" => "Portfolio CL", "portfolio_builder_slug-0" => "portfolio_1349969562", "portfolio_builder_page-0" => "926", "portfolio_builder_type-0" => "classic", "portfolio_builder_name-1" => "Portfolio LB", "portfolio_builder_slug-1" => "portfolio_1350304481", "portfolio_builder_page-1" => "932", "portfolio_builder_type-1" => "lightbox"));
	
	
	update_option('tb_glisseo_theme_sidebar_options',array("sidebar_builder_name-0" => "Blog Sidebar", "sidebar_builder_slug-0" => "sidebar_508e8d92f34d8", "sidebar_builder_name-1" => "Page Sidebar", "sidebar_builder_slug-1" => "sidebar_1351519948"));
	
	
	update_option('tb_glisseo_theme_blog_options',array("tb_glisseo_heart" => "1", "tb_glisseo_heart_time" => "120", "tb_glisseo_related_posts_active" => "1"));
}



?>