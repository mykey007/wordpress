<?php
/**
 * Initializes the theme's input example by registering the Sections,
 * Fields, and Settings. This particular group of options is used to demonstration
 * validation and sanitization.
 *
 * This function is registered with the 'admin_init' hook.
 */ 
function tb_glisseo_theme_initialize_blog_options() {

	if( false == get_option( 'tb_glisseo_theme_blog_options' ) ) {	
		add_option( 'tb_glisseo_theme_blog_options' );
	} // end if

	add_settings_section(
		'tb_glisseo_blog_options_section',
		'Blog Options',
		'tb_glisseo_blog_options_callback',
		'tb_glisseo_theme_blog_options'
	);
	
	add_settings_field(	
		'tb_glisseo_heart',						// ID used to identify the field throughout the theme
		'Heart(Like) Active?',							// The label to the left of the option interface element
		'tb_glisseo_checkbox_callback',	// The name of the function responsible for rendering the option interface
		'tb_glisseo_theme_blog_options',	// The page on which this option will be displayed
		'tb_glisseo_blog_options_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			'tb_glisseo_heart','tb_glisseo_theme_blog_options','Turn on the heart shaped Glisseo Like Button'
		)
	);
	
	add_settings_field(	
		'tb_glisseo_heart_time',						
		'Heart Like TimeOut',							
		'tb_glisseo_input_callback',	
		'tb_glisseo_theme_blog_options',	
		'tb_glisseo_blog_options_section',
		array(
			'tb_glisseo_heart_time','tb_glisseo_theme_blog_options','How much time must pass before one can Like again with the heart shaped button in the posts? Please enter minutes here, 0 = no timeout.'
		)			
	);
	
	add_settings_field(	
		'tb_glisseo_related_posts_active',						// ID used to identify the field throughout the theme
		'Show Related Posts?',							// The label to the left of the option interface element
		'tb_glisseo_checkbox_callback',	// The name of the function responsible for rendering the option interface
		'tb_glisseo_theme_blog_options',	// The page on which this option will be displayed
		'tb_glisseo_blog_options_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			'tb_glisseo_related_posts_active','tb_glisseo_theme_blog_options','Show related Posts in Blog Posts (this overrules the single post option)?'
		)
	);
	
	add_settings_field(	
		'tb_glisseo_blog_hide_default_head_image',						// ID used to identify the field throughout the theme
		'Hide Body Default Image for Posts?',							// The label to the left of the option interface element
		'tb_glisseo_checkbox_callback',	// The name of the function responsible for rendering the option interface
		'tb_glisseo_theme_blog_options',	// The page on which this option will be displayed
		'tb_glisseo_blog_options_section',			// The name of the section to which this field belongs
		array(								// The array of arguments to pass to the callback. In this case, just a description.
			'tb_glisseo_blog_hide_default_head_image','tb_glisseo_theme_blog_options','Hide the default image for the body header (Options Tab "Body" on post pages)'
		)
	);
		
	register_setting(
		'tb_glisseo_theme_blog_options',
		'tb_glisseo_theme_blog_options',
		'tb_glisseo_theme_validate_blog_options'
	);

} // end tb_glisseo_theme_initialize_blog_options
add_action( 'admin_init', 'tb_glisseo_theme_initialize_blog_options' );


/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */ 
/**
 * This function provides a simple description for the Input Examples page.
 *
 * It's called from the 'tb_glisseo_theme_intialize_blog_options_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function tb_glisseo_blog_options_callback() {
	echo '<p>Certain options that influence the appearance of the blog part of Glisseo.</p>';
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
function tb_glisseo_theme_validate_blog_options( $input ) {

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
	return apply_filters( 'tb_glisseo_theme_validate_blog_options', $output, $input );

} // end tb_glisseo_theme_validate_blog_options
