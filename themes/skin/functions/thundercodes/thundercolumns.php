<?php


if ( ! defined( 'ABSPATH' ) )
	die( "Can't load this file directly" );

class ThunderColumns
{
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		// add a separation before our button, here our button's id is "mygallery_button"
		array_push( $buttons, '|', 'thundercolumns_button' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		// this plugin file will work the magic of our button
		$plugins['thundercolumns'] = get_template_directory_uri() . '/functions/thundercodes/thundercolumns_plugin.php?dir='.urlencode(get_template_directory_uri());
		return $plugins;
	}
}

$thunderCode = new ThunderColumns();?>