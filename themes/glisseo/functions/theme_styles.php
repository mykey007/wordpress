<?php
/*
Plugin Name: Custom Styles
Plugin URI: http://www.speckygeek.com
Description: Add custom styles in your posts and pages content using TinyMCE WYSIWYG editor. The plugin adds a Styles dropdown menu in the visual post editor.
Based on TinyMCE Kit plug-in for WordPress

http://plugins.svn.wordpress.org/tinymce-advanced/branches/tinymce-kit/tinymce-kit.php

*/
/**
 * Apply styles to the visual editor
 */
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {

    if ( !empty($url) )
        $url .= ',';

    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';

    return $url;
}

/**
 * Add "Styles" drop-down
 */
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );

function tuts_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'tuts_mce_before_init' );

function tuts_mce_before_init( $settings ) {

    $style_formats = array(
        array(  
            'title' => 'Code',  
            'block' => 'pre',  
            'classes' => '',  
            'wrapper' => true  
        ),
        array(  
            'title' => 'Darkbox',  
            'block' => 'div',  
            'classes' => 'darkbox',  
            'wrapper' => true  
        ),  
        array(  
            'title' => 'BlockQuote',  
            'block' => 'blockquote',  
            'classes' => '',  
            'wrapper' => true  
        ),
        array(
            'title' => 'List > Small Arrow',
            'selector' => 'ul',
            'classes' => 'style1',
        ),
        array(
            'title' => 'List > Fat Arrow',
            'selector' => 'ul',
            'classes' => 'style2 grey',
        ),
        array(
            'title' => 'List > Circle Arrow',
            'selector' => 'ul',
            'classes' => 'style3 ',
        ),
        array(
            'title' => 'Dropcap > Normal',
            'selector' => 'p',
            'classes' => 'dropcap',
        ),
        array(
            'title' => 'Dropcap > Circle #1',
            'selector' => 'p',
            'classes' => 'dropcap circle color_1',
        ),
        array(
            'title' => 'Dropcap > Circle #2',
            'selector' => 'p',
            'classes' => 'dropcap circle color_2',
        ),
        array(
            'title' => 'Dropcap > Circle #3',
            'selector' => 'p',
            'classes' => 'dropcap circle color_3',
        ),
        array(
            'title' => 'Dropcap > Rounded #1',
            'selector' => 'p',
            'classes' => 'dropcap minirounding color_1',
        ),
        array(
            'title' => 'Dropcap > Rounded #2',
            'selector' => 'p',
            'classes' => 'dropcap minirounding color_2',
        ),
        array(
            'title' => 'Dropcap > Rounded #3',
            'selector' => 'p',
            'classes' => 'dropcap minirounding color_3',
        ),
        array(  
            'title' => 'Highlight',  
            'block' => 'span',  
            'classes' => 'texthighlight color_1',  
            'wrapper' => true  
        ), 
        array(  
            'title' => 'Highlight Blue',  
            'block' => 'span',  
            'classes' => 'texthighlight color_2',  
            'wrapper' => true  
        ), 
         array(  
            'title' => 'Highlight Red',  
            'block' => 'span',  
            'classes' => 'texthighlight color_3',  
            'wrapper' => true  
        )
          
       
        /*array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )*/
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */

/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');

/*
 * Enqueue stylesheet, if it exists.
 */
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}
?>
