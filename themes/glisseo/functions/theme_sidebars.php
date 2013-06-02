<?php
/* ------------------------------------- */
/* SIDEBAR REGISTRATION */
/* ------------------------------------- */

if ( function_exists('register_sidebar')) {
	 
	 //DEFAULT SIDEBARS
	    register_sidebar(array(
	        'name' => 'Footer Widget Slot 1',
	        'id' => 'sidebar-1',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));
	    register_sidebar(array(
	        'name' => 'Footer Widget Slot 2',
	        'id' => 'sidebar-2',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));
	    register_sidebar(array(
	        'name' => 'Footer Widget Slot 3',
	        'id' => 'sidebar-3',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));
	    register_sidebar(array(
	        'name' => 'Footer Widget Slot 4',
	        'id' => 'sidebar-4',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));
	    register_sidebar(array(
	        'name' => 'SubFooter Widget Left',
	        'id' => 'sidebar-5',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));
	    register_sidebar(array(
	        'name' => 'SubFooter Widget Right',
	        'id' => 'sidebar-6',
	        'before_widget' => '',
	        'after_widget' => '<div class="clear"></div>',
	        'before_title' => '<h3>',
	        'after_title' => '</h3>'
	    ));

	//CUSTOM SIDEBARS   
	    $sidebars = get_option("tb_glisseo_theme_sidebar_options");
		$i = 0;
	    $j = 1; 
	    if (is_array($sidebars) && !empty($sidebars)) {  
	        foreach($sidebars as $row) {
	        	if($j%2==0){
	        		register_sidebar(array(
		               'name' => $sidebar,
		               'id' => 'sidebar-'.$row,
		               'before_widget' => '<div class="sidebox">',
		               'after_widget' => '<div class="clear"></div></div>',
		               'before_title' => '<h3>',
		               'after_title' => '</h3>'
		            )); 
	                $j = 0;
		        }
		        else{
			        $sidebar = $row;
			    }
			    $j++;
	        }
	    }
}?>