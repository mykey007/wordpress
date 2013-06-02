<?php
/* 
Template Name: Home
*/
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

	//Language Options
		$tb_glisseo_readmore = __('Read More', 'tb_glisseo');
		$tb_glisseo_sharethis = __('Share This', 'tb_glisseo');
		$tb_glisseo_archive = __('Archive', 'tb_glisseo');
		$tb_glisseo_tags = __('Tag Archive', 'tb_glisseo');
		$tb_glisseo_category = __('Category', 'tb_glisseo');

	//Page Options
		if(have_posts()) $pageoptions = getOptions();

	//Theme Options	
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_header_options"),get_option("tb_glisseo_theme_body_options"),get_option("tb_glisseo_theme_blog_options"),get_option("tb_glisseo_theme_portfolio_options"));

	//Page Head Area
		if(isset($pageoptions['tb_glisseo_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
			//Headline
			$htitle = isset($pageoptions["tb_glisseo_page_head_alternative_title"]) ? $pageoptions['tb_glisseo_page_head_alternative_title'] : get_the_title();
			//Head Image
			if(!empty($pageoptions["tb_glisseo_page_head_image"])){
				$himage = wp_get_attachment_image_src($pageoptions["tb_glisseo_page_head_image"],'full');
				$himage = $himage[0]; 
			} 
			else {
				$himage = $tb_themeoptions["tb_glisseo_body_head_image"];
			}
		}

	get_header();
?>
<!-- Begin Slider -->
<?php 
		$slider = $pageoptions["tb_glisseo_header_slider"];
	
		global $wpdb;
		global $table_prefix;
		$table_prefix = $wpdb->base_prefix;
		if (!isset($wpdb->tablename)) {
			$wpdb->tablename = $table_prefix . 'revslider_sliders';
		}
		$revolution_sliders = $wpdb->get_results(
			"
			SELECT params
			FROM $wpdb->tablename
			WHERE alias='$slider'
			"
		);
		
		$return_value="";
		if(is_array($revolution_sliders))
			foreach($revolution_sliders[0] as $key => $value){
				$vowels = array("{", "}", '"');
			 	$sliderparams = str_replace($vowels,"",$value);
			 	$sliderparams_array = split(",", $sliderparams);
			 	foreach($sliderparams_array as $sliderparam){
				 	$sliderparam_array = split(":",$sliderparam);
				 	
				 	if(isset($sliderparam_array[0]) && $sliderparam_array[0]=="slider_type"){
					 	$return_value = $sliderparam_array[1];
					 	break;
				 	}
			 	}
			}
			
if($return_value!="fullwidth") echo '<div class="bannercontainer">';
	echo do_shortcode('[rev_slider '.$pageoptions["tb_glisseo_header_slider"].']');
	if($return_value!="fullwidth") echo '</div>';
?>
<!-- End Slider -->
<!-- Begin Wrapper -->
<div class="wrapper">
<div class="intro uppercase center"><?php echo $pageoptions["tb_glisseo_page_intro"];?></div>
<?php if(have_posts()) : 
	    	while(have_posts()) : the_post();	
	    		the_content();	
	    	endwhile;  //have_posts 
	   else : ?>
	    <div>
	        <p><?php _e('Oops, we could not find what you were looking for...', 'tb_glisseo'); ?></p>
	    </div>
<?php endif; ?>

</div>
<!-- End Wrapper -->
<?php get_footer(); ?>