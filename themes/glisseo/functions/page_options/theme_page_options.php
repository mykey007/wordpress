<?php
/* ------------------------------------- */
/* PAGE/POST/PORTFOLIO OPTIONS */
/* ------------------------------------- */

// Prefix for Valiano Page/Post/Portfolio Options
$prefix="tb_glisseo_";

// Load the Page Option Meta Fields
$custom_meta_fields=array();
require_once(TB_FUNCTIONS . '/page_options/theme_page_custom_meta.php');
require_once(TB_FUNCTIONS . '/page_options/theme_post_custom_meta.php');
require_once(TB_FUNCTIONS . '/page_options/theme_portfolio_custom_meta.php');
require_once(TB_FUNCTIONS . '/page_options/theme_video_custom_meta.php');

// Generate Page/Post/Portfolio Options
add_action('admin_init', 'init_page_options');
function init_page_options() {
	add_meta_box("page-options", "Page Options", "show_custom_page_meta_box", "page", "normal", "high");
	add_meta_box("page-video-options", "Choose Video Categories", "show_custom_page_video_meta_box", "page", "side", "high");
	add_meta_box("page-gallery-options", "Choose Galleries", "show_custom_page_gallery_meta_box", "page", "side", "high");
	
	add_meta_box("post-options", "Post Options", "show_custom_post_meta_box", "post", "normal", "high");
	
	add_meta_box("post-type-options", "Post Type Options", "show_custom_post_type_meta_box", "post", "side", "high");
	
	add_meta_box("video-type-options", "Video Type Options", "show_custom_post_video_type_meta_fields", "video", "side", "high");
	
	
	$portfolio_slugs = get_registered_post_types(); 
	
	if(is_array($portfolio_slugs))
		foreach ( $portfolio_slugs as $slug ){
			if(strstr($slug,"portfolio_") !== false){
		    	add_meta_box("portfolio-post-options", "Portfolio Item Options", "show_custom_portfolio_meta_box", $slug, "normal", "high");	
		    	add_meta_box("portfolio-post-type-options", "Portfolio Type Options", "show_custom_post_portfolio_type_meta_fields", $slug, "side", "high"); 
		    }
		}
	}

// Include the Page Option Framework Functions
require_once(TB_FUNCTIONS . '/page_options/theme_page_options_functions.php');
?>