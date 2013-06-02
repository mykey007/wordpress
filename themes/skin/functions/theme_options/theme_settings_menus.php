<?php

/**
 * This function introduces the theme options into the 'Appearance' menu and into a top-level 
 * 'tb_glisseo Theme' menu.
 */
function tb_glisseo_example_theme_menu() {

	add_theme_page(
		'tb_glisseo Theme', 					// The title to be displayed in the browser window for this page.
		'Glisseo Theme',					// The text to be displayed for this menu item
		'administrator',					// Which type of users can see this menu item
		'tb_glisseo_theme_options',			// The unique ID - that is, the slug - for this menu item
		'tb_glisseo_theme_display'				// The name of the function to call when rendering this menu's page
	);
	
	add_menu_page(
		'tb_glisseo Theme',					// The value used to populate the browser's title bar when the menu page is active
		'Glisseo Theme',					// The text of the menu in the administrator's sidebar
		'administrator',					// What roles are able to access the menu
		'tb_glisseo_theme_menu',			// The ID used to bind submenu items to this menu 
		'tb_glisseo_theme_display',			// The callback function used to render this menu
		get_template_directory_uri()."/style/images/favicon.png"				
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',				// The ID of the top-level menu page to which this submenu item belongs
		'General',					// The value used to populate the browser's title bar when the menu page is active
		'General',					// The label of this submenu item displayed in the menu
		'administrator',					// What roles are able to access this submenu item
		'tb_glisseo_theme_general_options',	// The ID used to represent this submenu item
		'tb_glisseo_theme_display'				// The callback function used to render the options for this submenu item
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Head',
		'Head',
		'administrator',
		'tb_glisseo_theme_header_options',
		create_function( null, 'tb_glisseo_theme_display( "header_options" );' )
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Body',
		'Body',
		'administrator',
		'tb_glisseo_theme_body_options',
		create_function( null, 'tb_glisseo_theme_display( "body_options" );' )
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Foot',
		'Foot',
		'administrator',
		'tb_glisseo_theme_footer_options',
		create_function( null, 'tb_glisseo_theme_display( "footer_options" );' )
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Blog',
		'Blog',
		'administrator',
		'tb_glisseo_theme_blog_options',
		create_function( null, 'tb_glisseo_theme_display( "blog_options" );' )
	);

	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Portfolios',
		'Portfolios',
		'administrator',
		'tb_glisseo_theme_portfolio_options',
		create_function( null, 'tb_glisseo_theme_display( "portfolio_options" );' )
	);
	
	add_submenu_page(
		'tb_glisseo_theme_menu',
		'Sidebars',
		'Sidebars',
		'administrator',
		'tb_glisseo_theme_sidebar_options',
		create_function( null, 'tb_glisseo_theme_display( "sidebar_options" );' )
	);


} // end tb_glisseo_example_theme_menu
add_action( 'admin_menu', 'tb_glisseo_example_theme_menu' );

/**
 * Renders a simple page to display for the theme menu defined above.
 */
function tb_glisseo_theme_display( $active_tab = '' ) {
?>
	<!-- Create a header in the default WordPress 'wrap' container -->
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><div style="background-image: url(<?php echo get_template_directory_uri()."/style/images/favicon.png";?>);padding-left: 13px;margin-top: 8px;float: left;padding-top: 16px;"></div>lisseo Theme Options</h2>
		<?php settings_errors(); ?>
		
		<?php if( isset( $_GET[ 'tab' ] ) ) {
			$active_tab = $_GET[ 'tab' ];
		} else if( $active_tab == 'header_options' ) {
			$active_tab = 'header_options';
		} else if( $active_tab == 'body_options' ) {
			$active_tab = 'body_options';
		} else if( $active_tab == 'footer_options' ) {
			$active_tab = 'footer_options';
		} else if( $active_tab == 'blog_options' ) {
			$active_tab = 'blog_options';
		} else if( $active_tab == 'portfolio_options' ) {
			$active_tab = 'portfolio_options';
		} else if( $active_tab == 'sidebar_options' ) {
			$active_tab = 'sidebar_options';
		} else {
			$active_tab = 'general_options';
		} // end if/else ?>
		
		<h2 class="nav-tab-wrapper">
			<a href="?page=tb_glisseo_theme_options&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">General</a>
			<a href="?page=tb_glisseo_theme_options&tab=header_options" class="nav-tab <?php echo $active_tab == 'header_options' ? 'nav-tab-active' : ''; ?>">Header</a>
			<a href="?page=tb_glisseo_theme_options&tab=body_options" class="nav-tab <?php echo $active_tab == 'body_options' ? 'nav-tab-active' : ''; ?>">Body</a>
			<a href="?page=tb_glisseo_theme_options&tab=footer_options" class="nav-tab <?php echo $active_tab == 'footer_options' ? 'nav-tab-active' : ''; ?>">Footer</a>
			<a href="?page=tb_glisseo_theme_options&tab=blog_options" class="nav-tab <?php echo $active_tab == 'blog_options' ? 'nav-tab-active' : ''; ?>">Blog</a>
			<a href="?page=tb_glisseo_theme_options&tab=portfolio_options" class="nav-tab <?php echo $active_tab == 'portfolio_options' ? 'nav-tab-active' : ''; ?>">Portfolios</a>
			<a href="?page=tb_glisseo_theme_options&tab=sidebar_options" class="nav-tab <?php echo $active_tab == 'sidebar_options' ? 'nav-tab-active' : ''; ?>">Sidebars</a>
		</h2>
		
		<form method="post" action="options.php">
			<?php
			
				if( $active_tab == 'general_options' ) {
				
					settings_fields( 'tb_glisseo_theme_general_options' );
					do_settings_sections( 'tb_glisseo_theme_general_options' );
					
				} elseif( $active_tab == 'header_options' ) {
				
					settings_fields( 'tb_glisseo_theme_header_options' );
					do_settings_sections( 'tb_glisseo_theme_header_options' );
				
				} elseif( $active_tab == 'blog_options' ) {
				
					settings_fields( 'tb_glisseo_theme_blog_options' );
					do_settings_sections( 'tb_glisseo_theme_blog_options' );
					
				} elseif( $active_tab == 'portfolio_options' ) {
				
					settings_fields( 'tb_glisseo_theme_portfolio_options' );
					do_settings_sections( 'tb_glisseo_theme_portfolio_options' );
					
				} elseif( $active_tab == 'sidebar_options' ) {
				
					settings_fields( 'tb_glisseo_theme_sidebar_options' );
					do_settings_sections( 'tb_glisseo_theme_sidebar_options' );
					
				} elseif( $active_tab == 'footer_options' ) {
				
					settings_fields( 'tb_glisseo_theme_footer_options' );
					do_settings_sections( 'tb_glisseo_theme_footer_options' );
				
				} else {
					settings_fields( 'tb_glisseo_theme_body_options' );
					do_settings_sections( 'tb_glisseo_theme_body_options' );
					
				} // end if/else
				
				submit_button();
			
			?>
		</form>
		
	</div><!-- /.wrap -->
<?php
} // end tb_glisseo_theme_display

add_action('admin_menu', 'add_tb_scripts');

$themeurl = get_template_directory_uri();

function add_tb_scripts()
{
	global $themeurl;
	if(is_admin() && isset($_GET["page"])){
		wp_enqueue_script( 'tb_colorpicker',$themeurl.'/functions/theme_options/jscolor/jscolor.js');
   }
}	    
?>