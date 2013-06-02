<?php
/* ------------------------------------------------------------------------ *
 * Menus and Main Page
 * ------------------------------------------------------------------------ */ 
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_menus.php');

/* ------------------------------------------------------------------------ *
 * Fields
 * ------------------------------------------------------------------------ */	
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_fields.php');

/* ------------------------------------------------------------------------ *
 * Pages (Tabs)
 * ------------------------------------------------------------------------ */	
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_general.php');
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_header.php');
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_body.php');
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_footer.php');
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_portfolio.php');
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_sidebars.php'); 
require_once(TB_FUNCTIONS.'/theme_options/theme_settings_tab_blog.php');   

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}

if (isset($_GET['page']) && $_GET['page'] == 'tb_glisseo_theme_options') {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
}
?>