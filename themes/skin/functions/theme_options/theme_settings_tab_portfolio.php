<?php
/**
 * Initializes the theme's input example by registering the Sections,
 * Fields, and Settings. This particular group of options is used to demonstration
 * validation and sanitization.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function tb_glisseo_theme_initialize_portfolio_options() {

	if( false == get_option( 'tb_glisseo_theme_portfolio_options' ) ) {	
		add_option( 'tb_glisseo_theme_portfolio_options' );
	} // end if

	add_settings_section(
		'portfolio_options_section',
		'Portfolios',
		'tb_glisseo_portfolio_options_callback',
		'tb_glisseo_theme_portfolio_options'
	);
	
	add_settings_field(
		'portfolio_builder',
		'Portfolios',
		'tb_glisseo_portfolio_build_callback',
		'tb_glisseo_theme_portfolio_options',
		'portfolio_options_section',
		array(
			'portfolio_builder','tb_glisseo_theme_portfolio_options','Activate this setting to display the header.'
		)
	);
		
	register_setting(
		'tb_glisseo_theme_portfolio_options',
		'tb_glisseo_theme_portfolio_options',
		'tb_glisseo_theme_validate_portfolio_options'
	);

} // end tb_glisseo_theme_initialize_portfolio_options
add_action( 'admin_init', 'tb_glisseo_theme_initialize_portfolio_options' );


/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 
/**
 * This function provides a simple description for the Input Examples page.
 *
 * It's called from the 'tb_glisseo_theme_intialize_portfolio_options_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function tb_glisseo_portfolio_options_callback() {
	echo '<p>Build unlimited Portfolios here. Insert a human readable <strong>name</strong> and choose the <strong>page</strong> that holds the Portfolio.</p><p>When you create a new portfolio it will be visible in the WP menu after saving.</p><p>You can only select from Pages of the Template type "Portfolio". You must set the Page Attribute -> Template -> "Portfolio" first in the "Edit Page" screen.</p><p>You can copy the slug here if you want to use it in a shortcode (or use our ShortCode Button). You could also change the slug here but only if you really, really need to and know what you are up to!!</p>';
} // end tb_glisseo_general_options_callback


/* ------------------------------------------------------------------------ *
 * Setting Callbacks
 * ------------------------------------------------------------------------ */ 
 
 /**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function tb_glisseo_theme_validate_portfolio_options( $input ) {

	// Create our array for storing the validated options
	$output = array();
	
	// Loop through each of the incoming options
	
	if(is_array($input))
	foreach( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			
		} // end if
		
	} // end foreach
	
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'tb_glisseo_theme_validate_portfolio_options', $output, $input );

} // end tb_glisseo_theme_validate_portfolio_options
