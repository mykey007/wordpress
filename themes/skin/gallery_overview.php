<?php
/* 
Template Name: Gallery Overview
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

	//Gallery Options
	$cols = isset($pageoptions["tb_glisseo_gallery_display_type"]) ? $pageoptions["tb_glisseo_gallery_display_type"] : "2";

	get_header();
?>

<!-- Begin Head Image -->
<div class="head-image"> 
	<?php if($headline){?>
		<?php if(!empty($himage)){ ?><img src="<?php echo $himage; ?>" alt="" /><?php } ?>
		<div class="page-title">
		    <h1><?php echo $htitle; ?></h1>
		</div>
	<?php } ?>
</div>
<!-- End Head Image -->  

<!-- Begin Wrapper -->
<div class="wrapper">
	<div class="intro uppercase center"><?php echo $pageoptions["tb_glisseo_page_intro"];?></div>
</div>
<!-- End Wrapper -->

<!-- Begin ZetaSlider -->
<div class="zetaSlider zetaTop" id="zetaSlider">
  <div class="thumbnail-wrapper col<?php echo $cols;?>">
    <ul class="zetaThumbs clearfix">
		<?php
		//list terms in a given taxonomy (useful as a widget for twentyten)
		$taxonomy = 'category_gallery';
		//$tax_terms = get_terms($taxonomy);
		$tax_terms = get_terms($taxonomy, array(
		 	'orderby'    => 'slug'
		 ));
		?>
		<ul>
		<?php
		$counter = 1; //counts galleries for the line break clear
		foreach ($tax_terms as $tax_term) {
			if(!is_array($pageoptions["tb_glisseo_gallery_categories"]) || in_array($tax_term->slug,$pageoptions["tb_glisseo_gallery_categories"]) || in_array("all",$pageoptions["tb_glisseo_gallery_categories"]) ){
				$term_meta = get_option( "taxonomy_".$tax_term->term_id);
				$image = wp_get_attachment_image_src($term_meta["img"], 'full');	
				$image = $cols == 2 ? aq_resize($image[0],470,220,true) : aq_resize($image[0],228,170,true);
				if(($cols == 2 && $counter == 3) || ($cols == 4 && $counter == 5)){
					$clear = "style='clear:left;'";
				}
				else{
					$clear = "";
				}
				$counter++;
				echo'<li data-id="'.$tax_term->slug.'" class="item" ' . $clear . '> <a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '"><img src="'.$image.'" alt="" /></a>
				        <div class="text">
				          <h4>'.$tax_term->name.'</h4>
				          <p>'.$tax_term->description.'</p>
				        </div>
				      </li>
				';
			}
		}
		?>
	</ul>
  </div>
  <div class="zetaHolder">
    <div class="zetaWrapper">
      <div class="zetaEmpty isDraggingFalse"> 
        <!-- populated by script --> 
      </div>
    </div>
    <div class="zetaControls"> <a class="zetaBtnClose" href="#"><?php _e("Close","tb_glisseo"); ?></a> <a class="zetaBtnPrev" href="#"><?php _e("Previous","tb_glisseo"); ?></a> <a class="zetaBtnNext" href="#"><?php _e("Next","tb_glisseo"); ?></a> </div>
    <div class="zetaWarning">
      <div class="navigate"><?php _e("Navigate by","tb_glisseo"); ?></div>
      <div class="drag"><?php _e("Dragging","tb_glisseo"); ?></div>
      <div class="arrow"><?php _e("Arrows","tb_glisseo"); ?></div>
      <div class="keys"><?php _e("Keyboard","tb_glisseo"); ?></div>
      <div class="clear"></div>
    </div>
  </div>
</div>
<!-- End ZetaSlider -->
<div class="clear"></div>
<?php if(!isset($pageoptions["tb_glisseo_gallery_detail_link"]) || $pageoptions["tb_glisseo_gallery_detail_link"]=="same" ):?>
	<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#zetaSlider').zetaSlider({
			warningMessage:true,
			warningMessageTimeout:8000
		});
	});
	</script> 
<?php endif; ?>
<?php get_footer(); ?>