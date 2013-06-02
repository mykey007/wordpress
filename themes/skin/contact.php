<?php
/* 
Template Name: Contact
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

<!-- Begin Head Image -->
<div class="head-image"> 
	<?php if($headline){?>
		<?php
			$pageoptions["tb_glisseo_page_head_gmap"] = empty($pageoptions["tb_glisseo_page_head_gmap"]) ? 'https://maps.google.com/maps?q=New+York,+NY,+United+States&hl=en&ll=41.001925,-74.030943&spn=0.016226,0.01929&sll=37.0625,-95.677068&sspn=68.054114,79.013672&oq=new+york&hnear=New+York&t=m&z=16' : $pageoptions["tb_glisseo_page_head_gmap"];
			echo '<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $pageoptions["tb_glisseo_page_head_gmap"] . '.&amp;output=embed"></iframe>';	
		?>
		
						
		<div class="page-title">
		    <h1><?php echo $htitle; ?></h1>
		</div>
	<?php } ?>
</div>
<!-- End Head Image -->  

<!-- Begin Wrapper -->
<div class="wrapper">
	<div class="intro uppercase center"><?php if(isset($pageoptions["tb_glisseo_page_intro"])) echo $pageoptions["tb_glisseo_page_intro"];?></div>

<?php if(isset($pageoptions["tb_glisseo_sidebar"]) && $pageoptions["tb_glisseo_sidebar"]!="nosidebar"){ ?>
		 <!-- Begin Content -->
		 <div class="content">
<?php } //Sidebar ?>
	
<?php if(have_posts()) : 
	    	while(have_posts()) : the_post();	
	    		the_content();	
	    	endwhile;  //have_posts 
	   else : ?>
	    <div>
	        <p><?php _e('Oops, we could not find what you were looking for...', 'tb_glisseo'); ?></p>
	    </div>
<?php endif; ?>

<?php if(isset($pageoptions["tb_glisseo_sidebar"]) && $pageoptions["tb_glisseo_sidebar"]!="nosidebar"):?>
		 <!-- Begin Content -->
		 </div><!-- End Content --> 
	    <div class="sidebar">
	    <!-- Begin Sidebar --> 
	    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($pageoptions["tb_glisseo_sidebar"]) ) : ?>
		    
			    <div class="sidebox">
			      <h3>Sidebar Widget</h3>
			      Please configure this Widget Area in the Admin Panel under Appearance -> Widgets
			    </div>
		<?php endif; ?>
		</div>
	    <div class="clear"></div>
	    <!-- End Sidebar --> 
<?php endif; //Sidebar ?>

</div>
<!-- End Wrapper -->
<?php get_footer(); ?>