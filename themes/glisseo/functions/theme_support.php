<?php
/* ------------------------------------- */
/* ENABLING FUNCTION SUPPORT */
/* ------------------------------------- */

if (function_exists('add_theme_support')){
	add_theme_support( 'post-thumbnails');
}
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
}
if ( function_exists('automatic-feed-links')) {
	add_theme_support( 'automatic-feed-links');
}

remove_action ('wp_head', 'rsd_link');
remove_action ('wp_head', 'wlwmanifest_link');
remove_action ('wp_head', 'wp_generator');
?>