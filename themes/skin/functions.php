<?php

$templatepath = get_template_directory();

define('TB_FUNCTIONS', $templatepath . '/functions/');
define('TB_THEME', get_template_directory_uri());
define('TB_JS', get_template_directory_uri() . '/style/js');
define('TB_CSS', get_template_directory_uri() . '/style/css');


/* Admin Functionality */

if (is_admin()){
	require_once(TB_FUNCTIONS . '/theme_firstinstall.php');
	require_once(TB_FUNCTIONS . '/page_options/theme_page_options.php');
	require_once(TB_FUNCTIONS . '/theme_options/theme_settings.php');
	require_once(TB_FUNCTIONS . '/thundercodes/thundercodes.php');
	require_once(TB_FUNCTIONS . '/thundercodes/thundercolumns.php');
	require_once(TB_FUNCTIONS . '/theme_featured_image_preview.php');
}

/* Theme Functionality */
require_once(TB_FUNCTIONS . '/theme_functions.php');
require_once(TB_FUNCTIONS . '/theme_pagination.php');

/* JavaScripts, Widgets, Sidebars, Shortcodes */
require_once(TB_FUNCTIONS . '/theme_javascriptcss.php');
require_once(TB_FUNCTIONS . '/theme_widgets.php');
require_once(TB_FUNCTIONS . '/theme_sidebars.php');
require_once(TB_FUNCTIONS . '/theme_shortcodes.php');

/* Post Comments, Custom Post Types */
require_once(TB_FUNCTIONS . '/theme_post_comments.php');
require_once(TB_FUNCTIONS . '/theme_post_customtypes.php');
require_once(TB_FUNCTIONS . '/theme_post_like.php');

/* Theme Language */
require_once(TB_FUNCTIONS . '/theme_language.php');



function get_content_in_wp_pointer() {
	$pointer_content  = '<h3>Thanks for choosing <strong>Glisseo</strong>!</h3>';
	$pointer_content .= '<p>Please make sure to follow the instructions about how to configure the Theme in the Documentation Folder in the downloaded Zip file first!<br><br>Especially the part about installing the <strong>Slider Revolution Plugin</strong> and the <strong>Contact Form 7 Plugin</strong>!</p>';
?>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready( function($) {
	$('#wpadminbar').pointer({
		content: '<?php echo $pointer_content; ?>',
		position: {
			my: 'left top',
			at: 'center bottom',
			offset: '-25 0'
		},
		close: function() {
			setUserSetting( 'p5', '1' );
		}
	}).pointer('open');
});
//]]>
</script>
<?php
}
function fb_enqueue_wp_pointer( $hook_suffix ) {
	$enqueue = FALSE;
	$admin_bar = get_user_setting( 'p5', 0 ); // check settings on user
	// check if admin bar is active and default filter for wp pointer is true
	if ( ! $admin_bar && apply_filters( 'show_wp_pointer_admin_bar', TRUE ) ) {
		$enqueue = TRUE;
		add_action( 'admin_print_footer_scripts', 'get_content_in_wp_pointer' );
	}
	// in true, include the scripts
	if ( $enqueue ) {
		wp_enqueue_style( 'wp-pointer' );
		wp_enqueue_script( 'wp-pointer' );
		wp_enqueue_script( 'utils' ); // for user settings
	}
}
add_action( 'admin_enqueue_scripts', 'fb_enqueue_wp_pointer' );

?>