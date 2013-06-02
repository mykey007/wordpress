<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');


$custom_post_video_type_meta_fields = array(
		array (
			'label'	=> 'Video Type',
			'desc'	=> 'Where is the video located?',
			'id'	=> $prefix.'video_type',
			'type'	=> 'radio',
			'default' => '',
			'options' => array (
				'youtube' => array ('label' => 'Youtube','value'	=> 'youtube'),
				'vimeo' => array ('label' => 'Vimeo','value'	=> 'vimeo'),
				'webm' => array ('label' => 'HTML5','value'	=> 'webm')
			),
			'class' => 'youtube vimeo webm'
		),
		array(
			'label'	=> 'Youtube ID',
			'desc'	=> 'ID of the Youtube Video',
			'id'	=> $prefix.'youtube_id',
			'type'	=> 'text',
			'class' => 'post_type video_type youtube'
		),
		array(
			'label'	=> 'Vimeo ID',
			'desc'	=> 'ID of the Vimeo Video',
			'id'	=> $prefix.'vimeo_id',
			'type'	=> 'text',
			'class' => 'post_type video_type vimeo'
		),
		array(
			'label'	=> 'MV4 URL Link',
			'desc'	=> 'Link to the MV4 (MV4 file)',
			'id'	=> $prefix.'mp4_link',
			'type'	=> 'text',
			'class' => 'post_type video_type webm'
		),
		array(
			'label'	=> 'Video Width',
			'desc'	=> 'Width of the Video',
			'id'	=> $prefix.'video_width',
			'type'	=> 'text',
			'class' => 'post_type video_type youtube vimeo webm'
		),
		array(
			'label'	=> 'Video Height',
			'desc'	=> 'Height of the Video',
			'id'	=> $prefix.'video_height',
			'type'	=> 'text',
			'class' => 'post_type video_type youtube vimeo webm'
		),
		array(
			'label'	=> '',
			'id' 	=> '',
			'desc'	=> 'Please use the "<strong>featured image</strong>" option of WP to display thumb preview pics and optional lightbox pics',
			'type'	=> 'desc',
			'class' => ''
		)
);
?>