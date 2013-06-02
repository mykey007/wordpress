<?php
// Array that holds all Page Options
// class is used to trigger some jQuery action

$custom_page_meta_fields = array(
		array (
			'label'	=> 'Blog Display Style',
			'desc'	=> 'Decide whether you want a preview of the post type special elements in fullwidth or a display of the featured Images in columns',
			'id'	=> $prefix.'blog_display_type',
			'type'	=> 'radio',
			'default' => 'full',
			'options' => array (
				'full' => array (
					'label' => 'Full Display Post Types Elements',
					'value'	=> 'full'
				),
				'columns' => array (
					'label' => '2 Columns with featured Images',
					'value'	=> 'columns'
				)
			),
			'class' => 'tp_options index'
		),	
		array(
			'label'	=> 'Hide Page Headline Area?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the headline area on top?',
			'id'	=> $prefix.'activate_page_title',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options content portfolio videocase gallery_overview index contact'
		),
		array(
			'label'	=> 'Alternative Page Headline(optional)',
			'desc'	=> 'Alternative Headline, leave blank for same as Page Title',
			'id'	=> $prefix.'page_head_alternative_title',
			'type'	=> 'text',
			'class' => 'tp_options content contact portfolio  videocase gallery_overview index headline'
		),
		array(
			'label'	=> 'Alternative Page Headline Image',
			'text' => '',
			'desc'	=> 'Upload or Choose a page title image (default is set in the theme options)',
			'id'	=> $prefix.'page_head_image',
			'type'	=> 'image',
			'default' => 'checked',
			'class' => 'tp_options content portfolio gallery_overview  videocase page_background index index-full headline headimage'
		),
		array(
			'label'	=> 'Google Map Link',
			'text' => '',
			'desc'	=> 'Search your needed destination at maps.google.com and copy the URL from the window to this field',
			'id'	=> $prefix.'page_head_gmap',
			'type'	=> 'text',
			'default' => 'checked',
			'class' => 'tp_options contact headline gmap'
		),
		array(
			'label'	=> 'Page Intro Text',
			'desc'	=> 'Intro Text appearing before the content (Leave blank for no Intro)',
			'id'	=> $prefix.'page_intro',
			'type'	=> 'textarea',
			'class' => 'tp_options content portfolio index gallery_overview  videocase home_page contact'
		),
		array(
			'label'	=> 'Activate Slider',
			'text' => 'Active',
			'desc'	=> 'Use a slider at the top of this page',
			'id'	=> $prefix.'activate_slider',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options home_page'
		),
		array(
			'label'	=> 'Select Slider',
			'desc'	=> 'Choose the Slider that will be displayed on top of the Home Page',
			'id'	=>  $prefix.'header_slider',
			'default' => '',
			'type'	=> 'slider_list',
			'class' => 'tp_options slider_content'
		),
		array(
			'label'	=> 'Hide Related Projects?',
			'text' => 'Hidden',
			'desc'	=> 'Hide the related projects section',
			'id'	=> $prefix.'hide_related_projects',
			'type'	=> 'checkbox',
			'default' => 'checked',
			'class' => 'tp_options portfolio'
		),
		array(
			'label'	=> 'Select Sidebar',
			'desc'	=> 'Choose the Sidebar to this Page',
			'id'	=>  $prefix.'sidebar',
			'default' => 'Blog Sidebar',
			'type'	=> 'sidebar_list',
			'class' => 'tp_options content index template_blog_sidebar contact'
		)
);

$custom_page_video_meta_fields = array(
		array(
			'label'	=> 'Video Categories',
			'desc'	=> 'Choose all Categories you like to see in this page (use shift,strg,cmd key for multiple selection)',
			'id'	=> $prefix.'video_categories',
			'type'	=> 'video_category_list',
			'class' => ''
		)
);

$custom_page_gallery_meta_fields = array(
		array(
			'label'	=> 'Galleries',
			'desc'	=> 'Choose all Galleries you like to see in this overview (use shift,strg,cmd key for multiple selection)',
			'id'	=> $prefix.'gallery_categories',
			'type'	=> 'gallery_category_list',
			'class' => ''
		),
		array (
			'label'	=> 'Overview Style',
			'desc'	=> 'Decide whether you want to display the Gallery Overview in 2 or 4 columns',
			'id'	=> $prefix.'gallery_display_type',
			'type'	=> 'radio',
			'default' => 'same',
			'options' => array (
				'2' => array (
					'label' => '2 Columns',
					'value'	=> '2'
				),
				'4' => array (
					'label' => '4 Columns',
					'value'	=> '4'
				)
			),
			'class' => ''
		),
		array (
			'label'	=> 'Gallery Detail Style',
			'desc'	=> 'Decide whether you want to display the Gallery in the same page or in a detail page',
			'id'	=> $prefix.'gallery_detail_link',
			'type'	=> 'radio',
			'default' => 'same',
			'options' => array (
				'same' => array (
					'label' => 'Same Page(ZetaSlider)',
					'value'	=> 'same'
				),
				'detail' => array (
					'label' => 'Detail Page',
					'value'	=> 'detail'
				)
			),
			'class' => ''
		)	
		
);
?>