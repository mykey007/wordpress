<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');


$custom_portfolio_meta_fields = array(
		array(
			'label'	=> 'Skills<br>(optional)',
			'desc'	=> 'Leave blank for no display, you can change "Skills" to whatever you like via "Localization"',
			'id'	=> $prefix.'portfolio_skills',
			'type'	=> 'text',
			'class' => ''
		),
		array(
			'label'	=> 'Client<br>(optional)',
			'desc'	=> 'Leave blank for no display, you can change "Client" to whatever you like via "Localization"',
			'id'	=> $prefix.'portfolio_client',
			'type'	=> 'text',
			'class' => ''
		),
		array(
			'label'	=> 'Link<br>(optional)',
			'desc'	=> 'Leave blank for no display, you can change "Link" to whatever you like via "Localization"',
			'id'	=> $prefix.'portfolio_link',
			'type'	=> 'text',
			'class' => ''
		),
		array(
			'label'	=> 'Hide Related Posts?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the related Posts in the post detail view?',
			'id'	=> $prefix.'activate_related_posts',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options index'
		),
		array (
			'label'	=> 'Related Posts Attribute',
			'desc'	=> '',
			'id'	=> $prefix.'related_posts_attribute',
			'type'	=> 'posttype',
			'default' => 'tags',
			'options' => array (
				'tags' => array ('label' => 'Tags','value'	=> 'tags'),
				'category' => array ('label' => 'Category','value'	=> 'category')
			),
			'class' => ''
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Post',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list'
		)
);

$custom_post_portfolio_type_meta_fields = array(
		array (
			'label'	=> 'Post Type',
			'desc'	=> '',
			'id'	=> $prefix.'post_type',
			'type'	=> 'posttype',
			'default' => 'image',
			'options' => array (
				'tp_valiano_post_type_text' => array ('label' => 'Text','value'	=> 'text'),
				'tp_valiano_post_type_image' => array ('label' => 'Image','value'	=> 'image'),
				'tp_valiano_post_type_video' => array ('label' => 'Video','value'	=> 'video'),
				'tp_valiano_post_type_audio' => array ('label' => 'Audio','value'	=> 'audio'),
				'tp_valiano_post_type_slider' => array ('label' => 'Slider','value'	=> 'slider')
			),
			'class' => ''
		),
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
			'class' => 'post_type video youtube vimeo webm'
		),
		array(
			'label'	=> 'Youtube ID',
			'desc'	=> 'ID of the Youtube Video',
			'id'	=> $prefix.'youtube_id',
			'type'	=> 'text',
			'class' => 'post_type youtube'
		),
		array(
			'label'	=> 'Vimeo ID',
			'desc'	=> 'ID of the Vimeo Video',
			'id'	=> $prefix.'vimeo_id',
			'type'	=> 'text',
			'class' => 'post_type vimeo'
		),
		array(
			'label'	=> 'MP4 URL Link',
			'desc'	=> 'Link to the MP4 (MP4 file)',
			'id'	=> $prefix.'mp4_link',
			'type'	=> 'text',
			'class' => 'post_type webm'
		),
		array(
			'label'	=> 'Video Width',
			'desc'	=> 'Width of the Video',
			'id'	=> $prefix.'video_width',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo webm'
		),
		array(
			'label'	=> 'Video Height',
			'desc'	=> 'Height of the Video',
			'id'	=> $prefix.'video_height',
			'type'	=> 'text',
			'class' => 'post_type youtube vimeo webm'
		),
		array(
			'label'	=> 'Audio URL Link',
			'desc'	=> 'Link to the MP3 file',
			'id'	=> $prefix.'audio_link',
			'type'	=> 'text',
			'class' => 'post_type audio'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider to this Page (<strong>MUST be FULLWIDTH</strong> Slider in the RevSlider Admin to fit the container)',
			'id'	=>  $prefix.'slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'post_type slider'
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