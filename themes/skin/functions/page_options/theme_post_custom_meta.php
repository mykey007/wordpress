<?php
// Array that holds all Post Options
// class is used to trigger some jQuery action

$custom_post_meta_fields = array(
		array(
			'label'	=> 'Hide Page Headline Area?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the headline area on top?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content portfolio  index home_page contact'
		),
		array(
			'label'	=> 'Alternative Page Headline<br>(optional)',
			'desc'	=> 'Alternative Headline, leave blank for same as Page Title',
			'id'	=> $prefix.'page_head_alternative_title',
			'type'	=> 'text',
			'class' => 'tp_options content contact portfolio  index index_full  headline'
		),
		array(
			'label'	=> 'Alternative Page Headline Image',
			'text' => '',
			'desc'	=> 'Upload or Choose a page title image (default is set in the theme options)',
			'id'	=> $prefix.'page_head_image',
			'type'	=> 'image',
			'default' => 'checked',
			'class' => 'tp_options content contact portfolio  page_background index index_full headline contact'
		),
		array(
			'label'	=> 'Page Intro Text',
			'desc'	=> 'Intro Text appearing before the content',
			'id'	=> $prefix.'page_intro',
			'type'	=> 'textarea',
			'class' => 'tp_options content portfolio index home_page contact'
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
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list'
		)
);

$custom_post_type_meta_fields = array(
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
			'desc'	=> 'Please use the "<strong>featured image</strong>" option of WP below to display thumb preview pics and optional lightbox pics',
			'type'	=> 'desc',
			'class' => ''
		)
);
?>