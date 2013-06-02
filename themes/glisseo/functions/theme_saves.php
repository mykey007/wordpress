<?php
$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');
		
$template_uri = get_template_directory_uri();
$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_header_options"),get_option("tb_glisseo_theme_body_options"),get_option("tb_glisseo_theme_portfolio_options"),get_option("tb_glisseo_theme_sidebar_options"),get_option("tb_glisseo_theme_footer_options"),get_option("tb_glisseo_theme_blog_options"));   

$general = get_option("tb_glisseo_theme_general_options");

foreach ($general as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}

echo "


";

echo "update_option('tb_glisseo_theme_general_options',array(".substr($update, 2)."));";

$update = "";


$header = get_option("tb_glisseo_theme_header_options");

foreach ($header as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_header_options',array(".substr($update, 2)."));";

$update = "";

$body = get_option("tb_glisseo_theme_body_options");

foreach ($body as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_body_options',array(".substr($update, 2)."));";

$update = "";

$footer = get_option("tb_glisseo_theme_footer_options");

foreach ($footer as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_footer_options',array(".substr($update, 2)."));";


$update = "";

$portfolio = get_option("tb_glisseo_theme_portfolio_options");

foreach ($portfolio as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_portfolio_options',array(".substr($update, 2)."));";




$update = "";

$sidebar = get_option("tb_glisseo_theme_sidebar_options");

foreach ($sidebar as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_sidebar_options',array(".substr($update, 2)."));";



$update = "";

$blog = get_option("tb_glisseo_theme_blog_options");

foreach ($blog as $key => $value){
	$update .= ', "' . $key . '" => '.'"'.$value.'"'; 
}


echo "


";

echo "update_option('tb_glisseo_theme_blog_options',array(".substr($update, 2)."));";

?>