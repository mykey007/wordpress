<?php
/**
 * Initializes the theme's input example by registering the Sections,
 * Fields, and Settings. This particular group of options is used to demonstration
 * validation and sanitization.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function tb_glisseo_theme_initialize_body_options() {

	if( false == get_option( 'tb_glisseo_theme_body_options' ) ) {	
		add_option( 'tb_glisseo_theme_body_options' );
	} // end if

	add_settings_section(
		'tb_glisseo_body_options_section',
		'Body Options',
		'tb_glisseo_body_options_callback',
		'tb_glisseo_theme_body_options'
	);
	
	add_settings_field(	
		'tb_glisseo_body_background_image',						
		'Body Background Tile',							
		'tb_glisseo_image_callback',	
		'tb_glisseo_theme_body_options',	
		'tb_glisseo_body_options_section',
		array(
			'tb_glisseo_body_background_image','tb_glisseo_theme_body_options','Upload or Choose a page Background for the body background.'
		)			
	);
	
	add_settings_field(	
		'tb_glisseo_body_head_image',						
		'Default Page Head Image',							
		'tb_glisseo_image_callback',	
		'tb_glisseo_theme_body_options',	
		'tb_glisseo_body_options_section',
		array(
			'tb_glisseo_body_head_image','tb_glisseo_theme_body_options','Upload or Choose a page head, you can choose alternative ones on the single pages/posts.'
		)			
	);
	
	register_setting(
		'tb_glisseo_theme_body_options',
		'tb_glisseo_theme_body_options',
		'tb_glisseo_theme_validate_body_options'
	);

} // end tb_glisseo_theme_initialize_body_options
add_action( 'admin_init', 'tb_glisseo_theme_initialize_body_options' );


/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 
/**
 * This function provides a simple description for the Input Examples page.
 *
 * It's called from the 'tb_glisseo_theme_intialize_body_options_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function tb_glisseo_body_options_callback() {
	echo '<p>Things to set in the body/content area of this theme.</p>';
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
function tb_glisseo_theme_validate_body_options( $input ) {

	// Create our array for storing the validated options
	$output = array();
	
	// Loop through each of the incoming options
	foreach( $input as $key => $value ) {
		
		// Check to see if the current option has a value. If so, process it.
		if( isset( $input[$key] ) ) {
		
			// Strip all HTML and PHP tags and properly handle quoted strings
			$output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
			
		} // end if
		
	} // end foreach
	
	// Return the array processing any additional functions filtered by this action
	return apply_filters( 'tb_glisseo_theme_validate_body_options', $output, $input );

} // end tb_glisseo_theme_validate_body_options
