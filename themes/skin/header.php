<?php
	$template_uri = get_template_directory_uri();
	
	//Theme Options
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_header_options"));
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<?php if(isset($tb_themeoptions["tb_glisseo_responsive_active"])){ ?>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php } ?>
<meta http-equiv="Content-Type" content="<?php echo get_bloginfo('html_type'); ?>; charset=<?php echo get_bloginfo('charset'); ?>" />
<meta name="robots" content="index, follow" />
<!--meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" /-->
<!--meta http-equiv="X-UA-Compatible" content="IE=edge" /-->
<title><?php echo wp_title(" &raquo; ",1,'right'); ?><?php echo get_bloginfo('name'); ?></title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $tb_themeoptions["tb_glisseo_favicon_icon"];?>" />
<?php wp_head(); ?>
<!--[if IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $template_uri; ?>/style/css/ie8.css" media="all" />
<![endif]-->
<!--[if IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo $template_uri; ?>/style/css/ie9.css" media="all" />
<![endif]-->
</head>
<body <?php body_class('page'); ?>>
<!-- Begin Header -->
<div class="header-wrapper">
  <div class="header"> 
    <!-- Begin Logo -->
    <div class="logo"> <a href="<?php echo home_url(); ?>"><img src="<?php echo $tb_themeoptions["tb_glisseo_header_logo"];?>" alt="" /></a> </div>
    <!-- End Logo --> 
    <!-- Begin Menu -->
	<?php $defaults = array(
		'theme_location'  => 'navigation',
		'container'       => 'div', 
		'container_class' => 'menu', 
		'container_id'    => 'menu',
		'menu_class'      => '', 
		'menu_id'    	  => 'tiny',
		'fallback_cb'     => 'wp_page_menu'
	);
	wp_nav_menu( $defaults ); ?>
    <div class="clear"></div>
    <!-- End Menu --> 
  </div>
</div>
<!-- End Header --> 