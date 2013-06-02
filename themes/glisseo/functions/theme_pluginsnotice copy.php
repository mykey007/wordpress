<body><?php body_class() ;?></body><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
/* ------------------------------------- */
/* OPTION TREE INSTALL NOTICE */
/* ------------------------------------- */

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp.'/wp-load.php' );
require_once( $path_to_wp.'/wp-includes/functions.php');

$template_url_first = get_template_directory_uri();

if(get_option('tp_escalation_first_import')!="on"){
	tp_escalation_first_import_check();
}

function tp_escalation_first_import_check(){
	global $template_url_first;
	update_option('tp_escalation_first_import','on');

// GENERAL

	update_option('tp_escalation_tagline_active','On');

	update_option('tp_escalation_homeblur_active','On');

	update_option('tp_escalation_teaser_zoom','On');

	update_option('tp_escalation_mobile_expand','On');

	update_option('tp_escalation_favicon_icon',$template_url_first.'/images/favicon.ico');

	update_option('tp_escalation_favicon57_png',$template_url_first.'/images/apple-touch-icon.png');

	update_option('tp_escalation_favicon72_png',$template_url_first.'/images/apple-touch-icon-72x72.png');

	update_option('tp_escalation_favicon114_png',$template_url_first.'/images/apple-touch-icon-114x114.png');

	update_option('tp_escalation_fonts_mainmenu_font','http://fonts.googleapis.com/css?family=Oswald');

	update_option('tp_escalation_fonts_mainmenu_fontfamily','font-family:\'Oswald\';');

	update_option('tp_escalation_fonts_menu_textfont_size','15px');

	update_option('tp_escalation_fonts_menu_textfont_padding','15px');

	update_option('tp_escalation_fonts_submenu_textfont_size','12px');

	update_option('tp_escalation_fonts_submenu_textfont_padding','30px');

	update_option('tp_escalation_fonts_menuidle_color','#999999');

	update_option('tp_escalation_fonts_menuhover_color','#ffffff');

	update_option('tp_escalation_fonts_headline_font','http://fonts.googleapis.com/css?family=Oswald');

	update_option('tp_escalation_fonts_headline_fontfamily','font-family:\'Oswald\';');

	update_option('tp_escalation_fonts_headline_h1','32px');

	update_option('tp_escalation_fonts_headline_h2','28px');

	update_option('tp_escalation_fonts_headline_h3','24px');

	update_option('tp_escalation_fonts_headline_h4','20px');

	update_option('tp_escalation_fonts_headline_h5','16px');

	update_option('tp_escalation_fonts_headline_h6','13px');

	update_option('tp_escalation_fonts_body_textfont_size','12px');

	update_option('tp_escalation_fonts_body_textfont_lineheight','20px');

	update_option('tp_escalation_fonts_body_textfont_color','#777777');

	update_option('tp_escalation_fonts_body_textfont_link_color','#cccccc');

	update_option('tp_escalation_fonts_body_textfont_link_hover_color','#ffffff');

	update_option('tp_escalation_topfoot_top_active','On');

	update_option('tp_escalation_topfoot_foot_active','On');

	update_option('tp_escalation_topfoot_layout','full');

	update_option('tp_escalation_subfoot_layout','full');

	update_option('tp_escalation_topfoot_textfont_size','12px');

	update_option('tp_escalation_topfoot_background_color','#090909');

	update_option('tp_escalation_topfoot_arrow_down',$template_url_first.'/images/tiles/down.png');

	update_option('tp_escalation_topfoot_arrow_up',$template_url_first.'/images/tiles/up.png');

	update_option('tp_escalation_subfoot_arrow_down',$template_url_first.'/images/tiles/down_bottom.png');

	update_option('tp_escalation_subfoot_arrow_up',$template_url_first.'/images/tiles/up_bottom.png');

	update_option('tp_escalation_header_background',$template_url_first.'/images/demoimages/sitebackground.jpg');

	update_option('tp_escalation_header_shadowleft',$template_url_first.'/images/tiles/bannershadow_left.png');

	update_option('tp_escalation_header_shadowright',$template_url_first.'/images/tiles/bannershadow_right.png');

	update_option('tp_escalation_header_logo',$template_url_first.'/images/logo.png');

	update_option('tp_escalation_header_logo_height','53px');

	update_option('tp_escalation_header_logo_width','246px');

	update_option('tp_escalation_background_active','On');

	update_option('tp_escalation_body_background_color','#111111');

	update_option('tp_escalation_body_background_image',$template_url_first.'/images/grain.png');

	update_option('tp_escalation_footer_active','On');

	update_option('tp_escalation_footer_layout','column');

	update_option('tp_escalation_footer_background_color','#090909');

	update_option('tp_escalation_footer_background_image',$template_url_first.'/images/grain.png');

	update_option('tp_escalation_fonts_footer_textfont_size','12px');

	update_option('tp_escalation_fonts_footer_textfont_color','#777777');

	update_option('tp_escalation_fonts_footer_textfont_link_color','#cccccc');

	update_option('tp_escalation_fonts_footer_textfont_link_hover_color','#ffffff');


// PANELS

	update_option('tp_escalation_topfoot_top_active','On');

	update_option('tp_escalation_topfoot_top_html','Interested in Working with us? &lt;a href=&quot;#&quot;&gt;Contact Us&lt;/a&gt;');

	update_option('tp_escalation_topfoot_foot_active','On');

	update_option('tp_escalation_topfoot_foot_html','Interested in Working with us? &lt;a href=&quot;#&quot;&gt;Contact Us&lt;/a&gt;');

	update_option('tp_escalation_topfoot_foot_social_link',array('http://www.facebook.com','http://www.google.com','http://www.youtube.com','http://www.twitter.com','http://www.vimeo.com','http://www.flickr.com','http://www.linkedin.com'));

	update_option('tp_escalation_topfoot_foot_social_link_icon',array($template_url_first.'/images/social/facebook.png',$template_url_first.'/images/social/googleplus.png',$template_url_first.'/images/social/youtube.png',$template_url_first.'/images/social/twitter.png',$template_url_first.'/images/social/vimeo.png',$template_url_first.'/images/social/flickr.png',$template_url_first.'/images/social/linkedin.png'));


// SIDEBARS

	update_option('tp_escalation_sidebar_name',array('Custom Sidebar')); 

	update_option('tp_escalation_sidebar_slug_nr',array('1332500442'));


// PORTFOLIOS

	 update_option('save','yes');

	 update_option('tp_escalation_portfolio_name',array('Portfolio'));

	 update_option('tp_escalation_portfolio_slug',array('portfolio'));

	 update_option('tp_escalation_portfolio_readmore',array('On'));

	 update_option('tp_escalation_portfolio_postinfo_author_detail',array('Off'));

	 update_option('tp_escalation_portfolio_postinfo_comments_detail',array('Off'));

	 update_option('tp_escalation_portfolio_postinfo_categories_detail',array('On'));

	 update_option('tp_escalation_portfolio_postinfo_date_detail',array('Off'));

	 update_option('tp_escalation_portfolio_postinfo_tags_detail',array('Off'));

	 update_option('tp_escalation_portfolio_share_detail',array('On'));

	 update_option('tp_escalation_portfolio_prevnext',array('On'));

	 update_option('tp_escalation_portfolio_prevnext_expanded',array('On'));

	 update_option('tp_escalation_portfolio_comments_expanded',array('On'));

	 update_option('tp_escalation_portfolio_category_sidebar_active',array('false'));

	 update_option('tp_escalation_portfolio_category_sidebar',array(''));

	 update_option('tp_escalation_portfolio_category_sidebar_orientation',array(''));


// BLOG

	 update_option('tp_escalation_blog_readmore_button','On');

	 update_option('tp_escalation_blog_postinfo_author_detail','On');

	 update_option('tp_escalation_blog_postinfo_comments_detail','On');

	 update_option('tp_escalation_blog_postinfo_categories_detail','On');

	 update_option('tp_escalation_blog_postinfo_date_detail','On');

	 update_option('tp_escalation_blog_postinfo_tags_detail','On');

	 update_option('tp_escalation_blog_share_detail','On');

	 update_option('tp_escalation_blog_prevnext','On');

	 update_option('tp_escalation_blog_prevnext_expanded','On');

	 update_option('tp_escalation_blog_comments_expanded','On');

	 update_option('tp_escalation_blog_archive_sidebar_active','On');

	 update_option('tp_escalation_blog_archive_sidebar','Blog Sidebar');

	 update_option('tp_escalation_blog_archive_sidebar_orientation','right');

	 update_option('tp_escalation_blog_category_sidebar_active','On');

	 update_option('tp_escalation_blog_category_sidebar','Blog Sidebar');

	 update_option('tp_escalation_blog_category_sidebar_orientation','right');


// TEASERS

	 update_option('tp_showbiz_slug_4f4e1afd0b898','Our Services');

	 update_option('tp_showbiz_expand_4f4e1afd0b898','On');

	 update_option('tp_showbiz_uniq',array('4f4e1afd0b898','4f50f61e7be6c','4f5e08f3896f0'));

	 update_option('tp_showbiz_type_4f4e1afd0b898','custom');

	 update_option('tp_showbiz_category_4f4e1afd0b898','1');

	 update_option('tp_showbiz_portfolio_4f4e1afd0b898','');

	 update_option('tp_showbiz_layout_4f4e1afd0b898','image');

	 update_option('tp_showbiz_number_4f4e1afd0b898','4x');

	 update_option('tp_showbiz_blog_latestpop_4f4e1afd0b898','comment_count');

	 update_option('tp_showbiz_blog_number_4f4e1afd0b898','0x');

	 update_option('tp_showbiz_blog_postinfo_author_4f4e1afd0b898','On');

	 update_option('tp_showbiz_blog_postinfo_comments_4f4e1afd0b898','On');

	 update_option('tp_showbiz_blog_postinfo_categories_4f4e1afd0b898','On');

	 update_option('tp_showbiz_blog_postinfo_date_4f4e1afd0b898','On');

	 update_option('tp_showbiz_blog_postinfo_tags_4f4e1afd0b898','On');

	 update_option('tp_showbiz_blog_readmore_4f4e1afd0b898','On');

	 update_option('tp_home_teaser_headline_4f4e1afd0b898',array('A Luxury Theme','Visit Our Studios','Another Caption','Big City'));

	 update_option('tp_home_teaser_image_main_4f4e1afd0b898',array($template_url_first.'/images/demoimages/teaserimage.jpg',$template_url_first.'/images/demoimages/teaserimage.jpg',$template_url_first.'/images/demoimages/teaserimage.jpg',$template_url_first.'/images/demoimages/teaserimage.jpg'));

	 update_option('tp_home_teaser_lightbox_4f4e1afd0b898',array('On','On','Off','Off'));

	 update_option('tp_home_teaser_video_type_4f4e1afd0b898',array('vimeo','none','none','none'));

	 update_option('tp_home_teaser_video_4f4e1afd0b898',array('35871458','','',''));

	 update_option('tp_home_teaser_link_4f4e1afd0b898',array('#','#','#','#'));

	 update_option('tp_home_teaser_link_target_4f4e1afd0b898',array('On','On','On','On'));

	 update_option('tp_showbiz_slug_4f50f61e7be6c','From The Blog');

	 update_option('tp_showbiz_expand_4f50f61e7be6c','On');

	 update_option('tp_showbiz_type_4f50f61e7be6c','blog');

	 update_option('tp_showbiz_category_4f50f61e7be6c','all');

	 update_option('tp_showbiz_portfolio_4f50f61e7be6c','');

	 update_option('tp_showbiz_layout_4f50f61e7be6c','text');

	 update_option('tp_showbiz_number_4f50f61e7be6c','2x');

	 update_option('tp_showbiz_blog_latestpop_4f50f61e7be6c','post_date');

	 update_option('tp_showbiz_blog_number_4f50f61e7be6c','4x');

	 update_option('tp_showbiz_blog_postinfo_author_4f50f61e7be6c','Off');

	 update_option('tp_showbiz_blog_postinfo_comments_4f50f61e7be6c','On');

	 update_option('tp_showbiz_blog_postinfo_categories_4f50f61e7be6c','Off');

	 update_option('tp_showbiz_blog_postinfo_date_4f50f61e7be6c','On');

	 update_option('tp_showbiz_blog_postinfo_tags_4f50f61e7be6c','Off');

	 update_option('tp_showbiz_blog_readmore_4f50f61e7be6c','On');

	 update_option('tp_home_teaser_headline_4f50f61e7be6c',array(''));

	 update_option('tp_home_teaser_image_main_4f50f61e7be6c',array(''));

	 update_option('tp_home_teaser_lightbox_4f50f61e7be6c',array('On'));

	 update_option('tp_home_teaser_video_type_4f50f61e7be6c',array(''));

	 update_option('tp_home_teaser_video_4f50f61e7be6c',array('',''));

	 update_option('tp_home_teaser_link_4f50f61e7be6c',array(''));

	 update_option('tp_home_teaser_link_target_4f50f61e7be6c',array('On'));

	 update_option('tp_showbiz_slug_4f5e08f3896f0','Latest Projects');

	 update_option('tp_showbiz_expand_4f5e08f3896f0','On');

	 update_option('tp_showbiz_type_4f5e08f3896f0','portfolio');

	 update_option('tp_showbiz_category_4f5e08f3896f0','');

	 update_option('tp_showbiz_portfolio_4f5e08f3896f0','Portfolio');

	 update_option('tp_showbiz_layout_4f5e08f3896f0','text');

	 update_option('tp_showbiz_number_4f5e08f3896f0','4x');

	 update_option('tp_showbiz_blog_latestpop_4f5e08f3896f0','post_date');

	 update_option('tp_showbiz_blog_number_4f5e08f3896f0','4x');

	 update_option('tp_showbiz_blog_postinfo_author_4f5e08f3896f0','Off');

	 update_option('tp_showbiz_blog_postinfo_comments_4f5e08f3896f0','Off');

	 update_option('tp_showbiz_blog_postinfo_categories_4f5e08f3896f0','Off');

	 update_option('tp_showbiz_blog_postinfo_date_4f5e08f3896f0','Off');

	 update_option('tp_showbiz_blog_postinfo_tags_4f5e08f3896f0','Off');

	 update_option('tp_showbiz_blog_readmore_4f5e08f3896f0','On');

	 update_option('tp_home_teaser_headline_4f5e08f3896f0',array(''));

	 update_option('tp_home_teaser_image_main_4f5e08f3896f0',array(''));

	 update_option('tp_home_teaser_lightbox_4f5e08f3896f0',array('On'));

	 update_option('tp_home_teaser_video_type_4f5e08f3896f0',array(''));

	 update_option('tp_home_teaser_video_4f5e08f3896f0',array('',''));

	 update_option('tp_home_teaser_link_4f5e08f3896f0',array(''));

	 update_option('tp_home_teaser_link_target_4f5e08f3896f0',array('On'));


// TAGLINES

	 update_option('tp_escalation_tagline_timer','9sec');

	 update_option('tp_escalation_tagline_name',array('&lt;span style=&quot;color:#fd0000;&quot;&gt;*&lt;/span&gt; We Are A Full-Service Rockstar Design Studio','Call Us Toll Free: &lt;span class=&quot;texthighlight&quot;&gt;1-555-9876543&lt;/span&gt;'));


// CONTACT

update_option('tp_escalation_quick_contact_form','you@yourdomain.com');


// SLIDERS

	 update_option('tp_escalation_slider_slug_4f606e16b3a48','Home Slider');

	 update_option('tp_escalation_slider_uniq',array('4f606e16b3a48','4f67174ca1028','4f6765d90f013','4f69cc799c985'));

	 update_option('tp_escalation_slider_type_4f606e16b3a48','kenburner');

	 update_option('tp_escalation_slider_height_4f606e16b3a48','310px');

	 update_option('tp_escalation_slider_thumbnail_style_4f606e16b3a48','thumb');

	 update_option('tp_escalation_slider_thumbs_number_4f606e16b3a48','5x');

	 update_option('tp_escalation_slider_thumbs_autohide_4f606e16b3a48','off');

	 update_option('tp_escalation_slider_thumbs_position_4f606e16b3a48','center,bottom');

	 update_option('tp_escalation_slider_thumbs_position_y_4f606e16b3a48','39px');

	 update_option('tp_escalation_slider_thumbs_position_x_4f606e16b3a48','0px');

	 update_option('tp_escalation_slider_timer_4f606e16b3a48','7sec');

	 update_option('tp_escalation_slide_transition_4f606e16b3a48',array('fade','slide','slide','slide','fade'));

	 update_option('tp_escalation_slide_image_main_4f606e16b3a48',array($template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg'));

	 update_option('tp_escalation_slide_thumb_crop_4f606e16b3a48',array('center,center','left,center','left,center','right,center','left,center'));

	 update_option('tp_escalation_slide_kbstart_4f606e16b3a48',array('left,top','right,center','right,center','center,center','right,center'));

	 update_option('tp_escalation_slide_kbend_4f606e16b3a48',array('right,bottom','left,center','left,center','center,center','left,center'));

	 update_option('tp_escalation_slide_zoom_direction_4f606e16b3a48',array('in','out','in','out','none'));

	 update_option('tp_escalation_slide_zoom_factor_4f606e16b3a48',array('3x','2x','2x','1x','1x'));

	 update_option('tp_escalation_slide_zoom_speed_4f606e16b3a48',array('12sec','9sec','9sec','12sec','10sec'));

	 update_option('tp_escalation_slide_headline_position_4f606e16b3a48',array('left','right','bottom','top','bottom'));

	 update_option('tp_escalation_slide_headline_4f606e16b3a48',array('&lt;h3&gt;An Exquisite Treat&lt;/h3&gt;
	&lt;p&gt;The &lt;em&gt;&lt;strong&gt;Valiano Studios Theme&lt;/strong&gt;&lt;/em&gt; is the finest solution&lt;br&gt; for your Design Studio or general Company Website.&lt;/p&gt;
	&lt;p&gt;A fully-responsive layout for maximum viewing&lt;br&gt; pleasure on &lt;span class=&quot;texthighlight_black&quot;&gt;iPhones &amp; Ipads&lt;/span&gt; paired with cutting-edge&lt;br&gt; effects!&lt;/p&gt;
	&lt;a style=&quot;margin-top:10px&quot; class=&quot;kb-button&quot; href=&quot;light.html&quot;&gt;More Features&lt;/a&gt;','&lt;h3&gt;Highly Configurable&lt;/h3&gt;
	&lt;p&gt;You can configure about everything&lt;br/&gt; in the Slider you can think of.&lt;/p&gt;
	&lt;ul class=&quot;square&quot;&gt;
	&lt;li&gt;&lt;span class=&quot;texthighlight_black&quot;&gt;Ken Burns Effect&lt;/span&gt;&lt;/li&gt;
	&lt;li&gt;&lt;span class=&quot;texthighlight_black&quot;&gt;Caption Position&lt;/span&gt;&lt;/li&gt;
	&lt;li&gt;&lt;span class=&quot;texthighlight_black&quot;&gt;Animation Timings&lt;/span&gt;&lt;/li&gt;
	&lt;/ul&gt;
	','&lt;span class=&quot;texthighlight&quot;&gt;Sliders For Everyone!&lt;/span&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;Its also possible to add Sliders to any content page or as a blog post format.&lt;/span&gt;','&lt;span class=&quot;texthighlight&quot;&gt;Youtube Video Support&lt;/span&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;You can easily add videos to any slide.&lt;/span&gt;','&lt;span class=&quot;texthighlight&quot;&gt;Vimeo Video Support&lt;/span&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;You can easily add videos to any slide.&lt;/span&gt;'));

	 update_option('tp_escalation_slide_headline_animation_4f606e16b3a48',array('On','off','On','On','On'));

	 update_option('tp_escalation_slide_video_type_4f606e16b3a48',array('none','none','','youtube','vimeo'));

	 update_option('tp_escalation_slide_video_id_4f606e16b3a48',array('-BrDlrytgm8','','','W4xsRZ2zHX4','7809605'));

	 update_option('tp_escalation_slide_video_caption_4f606e16b3a48',array('','','','&lt;h3&gt;Youtube Video&lt;/h3&gt;
	&lt;p&gt;This is the product that you&lt;br&gt;&lt;i&gt;&lt;strong&gt;all have been waiting for!&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;
	&lt;p&gt;A Ken Burns JQuery Banner solution which&lt;br&gt;is fully-responsive and offering cutting-edge&lt;br&gt;caption effects!&lt;/p&gt;','&lt;h3&gt;Vimeo Video&lt;/h3&gt;
	&lt;p&gt;This is the product that you&lt;br&gt;&lt;i&gt;&lt;strong&gt;all have been waiting for!&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;
	&lt;p&gt;A Ken Burns JQuery Banner solution which&lt;br&gt;is fully-responsive and offering cutting-edge&lt;br&gt;caption effects!&lt;/p&gt;'));

	 update_option('tp_escalation_slider_slug_4f67174ca1028','Blog Slider One');

	 update_option('tp_escalation_slider_type_4f67174ca1028','kenburner');

	 update_option('tp_escalation_slider_height_4f67174ca1028','300px');

	 update_option('tp_escalation_slider_thumbnail_style_4f67174ca1028','bullet');

	 update_option('tp_escalation_slider_thumbs_number_4f67174ca1028','4x');

	 update_option('tp_escalation_slider_thumbs_autohide_4f67174ca1028','on');

	 update_option('tp_escalation_slider_thumbs_position_4f67174ca1028','right,bottom');

	 update_option('tp_escalation_slider_thumbs_position_y_4f67174ca1028','-17px');

	 update_option('tp_escalation_slider_thumbs_position_x_4f67174ca1028','0px');

	 update_option('tp_escalation_slider_timer_4f67174ca1028','8sec');

	 update_option('tp_escalation_slide_transition_4f67174ca1028',array('slide','',''));

	 update_option('tp_escalation_slide_image_main_4f67174ca1028',array($template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg'));

	 update_option('tp_escalation_slide_thumb_crop_4f67174ca1028',array('right,center','center,center','right,center'));

	 update_option('tp_escalation_slide_kbstart_4f67174ca1028',array('right,top','center,center','left,top'));

	 update_option('tp_escalation_slide_kbend_4f67174ca1028',array('left,bottom','center,center','right,bottom'));

	 update_option('tp_escalation_slide_zoom_direction_4f67174ca1028',array('out','',''));

	 update_option('tp_escalation_slide_zoom_factor_4f67174ca1028',array('1x','1x','1x'));

	 update_option('tp_escalation_slide_zoom_speed_4f67174ca1028',array('9sec','8sec','0sec'));

	 update_option('tp_escalation_slide_headline_position_4f67174ca1028',array('top','left',''));

	 update_option('tp_escalation_slide_headline_4f67174ca1028',array('&lt;span class=&quot;texthighlight&quot;&gt;Sliders Anywhere!&lt;/span&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;You can easily add sliders to pages/posts.&lt;/span&gt;','&lt;h4&gt;An Exquisite Treat&lt;/h4&gt;
	&lt;p&gt;The &lt;em&gt;&lt;strong&gt;Valiano Studios Theme&lt;/strong&gt;&lt;/em&gt;&lt;br/&gt; is the finest solution for your&lt;br/&gt;&lt;span class=&quot;texthighlight&quot;&gt;Design Studio&lt;/span&gt; or general&lt;br/&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;Company Website&lt;/span&gt;&lt;/p&gt;',''));

	 update_option('tp_escalation_slide_headline_animation_4f67174ca1028',array('On','On','On'));

	 update_option('tp_escalation_slide_video_type_4f67174ca1028',array('none','','vimeo'));

	 update_option('tp_escalation_slide_video_id_4f67174ca1028',array('','','7809605'));

	 update_option('tp_escalation_slide_video_caption_4f67174ca1028',array('','','&lt;h4&gt;Vimeo Video&lt;/h4&gt;
	&lt;p&gt;The blog/portfolio post slider has the same options as the homepage slider.&lt;/p&gt;'));

	 update_option('tp_escalation_slider_slug_4f6765d90f013','Portfolio Slider');

	 update_option('tp_escalation_slider_type_4f6765d90f013','simple');

	 update_option('tp_escalation_slider_height_4f6765d90f013','310px');

	 update_option('tp_escalation_slider_thumbnail_style_4f6765d90f013','thumb');

	 update_option('tp_escalation_slider_thumbs_number_4f6765d90f013','3x');

	 update_option('tp_escalation_slider_thumbs_autohide_4f6765d90f013','on');

	 update_option('tp_escalation_slider_thumbs_position_4f6765d90f013','center,bottom');

	 update_option('tp_escalation_slider_thumbs_position_y_4f6765d90f013','36px');

	 update_option('tp_escalation_slider_thumbs_position_x_4f6765d90f013','0px');

	 update_option('tp_escalation_slider_timer_4f6765d90f013','10sec');

	 update_option('tp_escalation_slide_transition_4f6765d90f013',array('slide','fade','slide'));

	 update_option('tp_escalation_slide_image_main_4f6765d90f013',array($template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg'));

	 update_option('tp_escalation_slide_thumb_crop_4f6765d90f013',array('center,center','center,center','right,center'));

	 update_option('tp_escalation_slide_kbstart_4f6765d90f013',array('','left,top','right,top'));

	 update_option('tp_escalation_slide_kbend_4f6765d90f013',array('','right,bottom','left,bottom'));

	 update_option('tp_escalation_slide_zoom_direction_4f6765d90f013',array('','out','in'));

	 update_option('tp_escalation_slide_zoom_factor_4f6765d90f013',array('3x','1x','5x'));

	 update_option('tp_escalation_slide_zoom_speed_4f6765d90f013',array('5sec','10sec','12sec'));

	 update_option('tp_escalation_slide_headline_position_4f6765d90f013',array('left','none','none'));

	 update_option('tp_escalation_slide_headline_4f6765d90f013',array('&lt;h4&gt;An Exquisite Treat&lt;/h4&gt;
	&lt;p&gt;The &lt;em&gt;&lt;strong&gt;Valiano Studios Theme&lt;/strong&gt;&lt;/em&gt;&lt;br/&gt; is the finest solution for your&lt;br/&gt;&lt;span class=&quot;texthighlight&quot;&gt;Design Studio&lt;/span&gt; or general&lt;br/&gt; &lt;span class=&quot;texthighlight_black&quot;&gt;Company Website&lt;/span&gt;&lt;/p&gt;','',''));

	 update_option('tp_escalation_slide_headline_animation_4f6765d90f013',array('on','on','off'));

	 update_option('tp_escalation_slide_video_type_4f6765d90f013',array('','none','youtube'));

	 update_option('tp_escalation_slide_video_id_4f6765d90f013',array('','','W4xsRZ2zHX4'));

	 update_option('tp_escalation_slide_video_caption_4f6765d90f013',array('','','&lt;h3&gt;Youtube Video&lt;/h3&gt;
	&lt;p&gt;This is the product that you&lt;br&gt;&lt;i&gt;&lt;strong&gt;all have been waiting for!&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;
	&lt;p&gt;A Ken Burns JQuery Banner solution which&lt;br&gt;is fully-responsive and offering cutting-edge&lt;br&gt;caption effects!&lt;/p&gt;'));

	 update_option('tp_escalation_slider_slug_4f69cc799c985','Home Alternative Slider');

	 update_option('tp_escalation_slider_type_4f69cc799c985','simple');

	 update_option('tp_escalation_slider_height_4f69cc799c985','360px');

	 update_option('tp_escalation_slider_thumbnail_style_4f69cc799c985','bullet');

	 update_option('tp_escalation_slider_thumbs_number_4f69cc799c985','0x');

	 update_option('tp_escalation_slider_thumbs_autohide_4f69cc799c985','on');

	 update_option('tp_escalation_slider_thumbs_position_4f69cc799c985','center,bottom');

	 update_option('tp_escalation_slider_thumbs_position_y_4f69cc799c985','-20px');

	 update_option('tp_escalation_slider_thumbs_position_x_4f69cc799c985','0px');

	 update_option('tp_escalation_slider_timer_4f69cc799c985','7sec');

	 update_option('tp_escalation_slide_transition_4f69cc799c985',array('fade','slide',''));

	 update_option('tp_escalation_slide_image_main_4f69cc799c985',array($template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg',$template_url_first.'/images/demoimages/sliderimage.jpg'));

	 update_option('tp_escalation_slide_thumb_crop_4f69cc799c985',array('center,center','',''));

	 update_option('tp_escalation_slide_kbstart_4f69cc799c985',array('','',''));

	 update_option('tp_escalation_slide_kbend_4f69cc799c985',array('','',''));

	 update_option('tp_escalation_slide_zoom_direction_4f69cc799c985',array('','',''));

	 update_option('tp_escalation_slide_zoom_factor_4f69cc799c985',array('0x','0x','0x'));

	 update_option('tp_escalation_slide_zoom_speed_4f69cc799c985',array('10sec','6sec','0sec'));

	 update_option('tp_escalation_slide_headline_position_4f69cc799c985',array('left','none','top'));

	 update_option('tp_escalation_slide_headline_4f69cc799c985',array('&lt;h3&gt;An Exquisite Treat&lt;/h3&gt;
	&lt;p&gt;The &lt;em&gt;&lt;strong&gt;Valiano Studios Theme&lt;/strong&gt;&lt;/em&gt; is the finest solution&lt;br&gt; for your Design Studio or general Company Website.&lt;/p&gt;
	&lt;p&gt;A fully-responsive layout for maximum viewing&lt;br&gt; pleasure on &lt;span class=&quot;texthighlight_black&quot;&gt;iPhones &amp; Ipads&lt;/span&gt; paired with cutting-edge&lt;br&gt; effects!&lt;/p&gt;
	&lt;a style=&quot;margin-top:10px&quot; class=&quot;kb-button&quot; href=&quot;light.html&quot;&gt;More Features&lt;/a&gt;','','We hope that you enjoy the show. Get the Valiano WordPress Theme now!'));

	 update_option('tp_escalation_slide_headline_animation_4f69cc799c985',array('On','on','On'));

	 update_option('tp_escalation_slide_video_type_4f69cc799c985',array('','',''));

	 update_option('tp_escalation_slide_video_id_4f69cc799c985',array('','',''));

	 update_option('tp_escalation_slide_video_caption_4f69cc799c985',array('','',''));
	 
	 
}

<body><?php body_class() ;?> ); ?></body>
 <?php comment_form(); the_tags();?>
?>