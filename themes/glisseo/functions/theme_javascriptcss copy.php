<?php
/* ------------------------------------- */
/* ENQUEUE JAVASCRIPTS + CSS */
/* ------------------------------------- */
function loadJSCSS() {
	if (!is_admin()) {
		wp_enqueue_script( 'jquery' );
	// Load Theme Options
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_header_options"));	
		
	// Enqueue the Theme Styles
		//Basic 
		wp_enqueue_style( 'tb_base_style',TB_THEME.'/style.css');
		//Responsive?
		if(isset($tb_themeoptions["tb_glisseo_responsive_active"])){
			wp_enqueue_style( 'tb_mediaquery_style',TB_CSS.'/media-queries.css');
		}
		//FancyBox 
		wp_enqueue_style( 'tb_fancybox_style',TB_JS.'/fancybox/jquery.fancybox.css');
		wp_enqueue_style( 'tb_fancybox_buttons_style',TB_JS.'/fancybox/helpers/jquery.fancybox-buttons.css');
		wp_enqueue_style( 'tb_fancybox_thumbs_style',TB_JS.'/fancybox/helpers/jquery.fancybox-thumbs.css');
		//Google Font
		$google_font = $tb_themeoptions["tb_glisseo_main_font"];
	    if(!empty($google_font)) wp_enqueue_style( 'tb_googlefont_style',$google_font);
	    //Media Player
	    wp_enqueue_style( 'tb_media_style',TB_JS.'/mediaplayer/mediaelementplayer.min.css');
	    
	// Enqueue the Theme JS  
		//FancyBox 
		wp_enqueue_script('tb_fancybox_script', TB_JS."/jquery.fancybox.pack.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fancybox_buttons_script', TB_JS."/fancybox/helpers/jquery.fancybox-buttons.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fancybox_media_script', TB_JS."/fancybox/helpers/jquery.fancybox-media.js", array('jquery'),false,true);
		//Navigation
		wp_enqueue_script('tb_ddsmoothmenu_script', TB_JS."/ddsmoothmenu.js", array('jquery'),false,true);
		wp_enqueue_script('tb_selectnav_script', TB_JS."/selectnav.js", array('jquery'),false,true);
		//Basics
		wp_enqueue_script('tb_easing_script', TB_JS."/jquery.easing.1.3.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_easytabs_script', TB_JS."/jquery.easytabs.js", array('jquery'),false,true);
		wp_enqueue_script('tb_isotope_script', TB_JS."/jquery.isotope.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_twitter_script', TB_JS."/twitter.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_fitvids_script', TB_JS."/jquery.fitvids.js", array('jquery'),false,true);
		wp_enqueue_script('tb_jqaddress_script', TB_JS."/jquery.address-1.4.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_media_script', TB_JS."/mediaplayer/mediaelement-and-player.min.js", array('jquery'),false,true);
		wp_enqueue_script('tb_sharrre_script', TB_JS."/jquery.sharrre-1.3.3.php", array('jquery'),false,true);
		wp_enqueue_script('tb_zeta_script', TB_JS."/zeta-slider.js", array('jquery'),false,true);
		
		//Main Script
		wp_enqueue_script('tb_glisseo_script', TB_JS."/scripts.js", array('jquery'),false,true);
	}
}
add_action('wp_enqueue_scripts', 'loadJSCSS');
?>