<?php
/* 
Template Name: Portfolio
*/
	//Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;

	$template_uri = get_template_directory_uri();

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
		
	//Portfolio Options
		$portfolios = get_option("tb_glisseo_theme_portfolio_options");
		$portfolio_count = 0;
		foreach($portfolios as $key => $value){
			if($value == $post_id){ 
				$portfolio_key = $key;
				break;
			}
		}
		$portfolio_nr = split("-",$portfolio_key);
		$portfolio_nr = $portfolio_nr[1];
		$ptype = $portfolios["portfolio_builder_slug-".$portfolio_nr];
		$pcat = "category_".$ptype;
		$portfolio_style = $portfolios["portfolio_builder_type-".$portfolio_nr];
		
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
	<div class="intro uppercase center"><?php if(isset($pageoptions["tb_glisseo_page_intro"])) echo $pageoptions["tb_glisseo_page_intro"];?></div>
  
  <!-- Begin Container -->
  <div class="container">
    <div id="portfolio">
      <?php 
		$tax_terms = get_terms($pcat);
		if(sizeof($tax_terms)>1) {
	  ?>
      <ul class="filter">
        <li><a class="active" href="#" data-filter="*"><?php _e("All","tb_glisseo"); ?></a></li>
        <?php 
		foreach ($tax_terms as $tax_term) {?>
        	<li><a href="#" data-filter=".<?php echo $tax_term->slug; ?>"><?php echo $tax_term->name; ?></a></li>
        <?php } ?>
      </ul>
      <?php } ?>
      <ul class="items">
      	<?php 
		// Query for Portfolio
			$paged =
				( get_query_var('paged') && get_query_var('paged') > 1 )
				? get_query_var('paged')
				: 1;			
			$args=array(
				'post_type' => $ptype,
				'posts_per_page' => 9999,
				'paged' => $paged
			);
			
			$temp = $wp_query; 
			$wp_query = null;
			$wp_query = new WP_Query();
			$wp_query->query($args);
		?>

		<?php if(have_posts()) : while(have_posts()) : the_post();?>
			<?php 
				//Portfolio Featured Image
					$postimage = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
					$postimage_lightbox =  aq_resize($postimage,800); 
					$postimage_resized = aq_resize($postimage,228,170,true); 
				//Portfolio Categories
					$categories = get_the_terms($post->ID,$pcat);
					$categorylist="";
					
					if(is_array($categories)){
						foreach ($categories as $category) {
							$categorylist.=" ".$category->slug; 
						}
					}
					
					if($portfolio_style=="lightbox"){
						$uniqid = uniqid("pi_");
						//Post Type related Object to display in the Head Area of the post
        			$post_top="";
        			$postoptions = getOptions($post->ID);
	        		if(isset($postoptions["tb_glisseo_post_type"]))
						switch ($postoptions["tb_glisseo_post_type"]) {
							case 'video':
										if($postoptions["tb_glisseo_video_type"]=="youtube"){
											$postlightbox = 'http://www.youtube.com/embed/'.$postoptions["tb_glisseo_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0';
										}
										elseif ($postoptions["tb_glisseo_video_type"]=="vimeo") {
											$postlightbox = 'http://player.vimeo.com/video/'.$postoptions["tb_glisseo_vimeo_id"].'?title=0&amp;byline=0&amp;color='.$tb_themeoptions["tb_glisseo_highlight_color"];
										}
										$iframe = " fancybox.iframe";
										break;
							default:
								$postlightbox = $postimage_lightbox;
								$iframe = "";
								break;
						}

					?>
						 <li class="item <?php echo $categorylist; ?>"> <a href="<?php echo $postlightbox; ?>" class="fancybox-media <?php echo $iframe;?>" rel="portfolio" data-title-id="<?php echo $uniqid; ?>"> <img src="<?php echo $postimage_resized; ?>" alt="" /> </a>
				          <div id="<?php echo $uniqid; ?>" class="info hidden">
				            <h2><?php the_title(); ?></h2>
				            <div class="fancybox-desc"><?php the_content(); ?></div>
				          </div>
				        </li>
					<?php }
					else{?>
						<li class="item <?php echo $categorylist; ?>"> <a href="<?php the_permalink();?>"><img src="<?php echo $postimage_resized; ?>" alt="" /> </a> </li>
					<?php }
			?>
        <?php endwhile; endif; //have_posts ?>
      </ul>
    </div>
    <!-- End Portfolio --> 
    
  </div>
  <!-- End Container --> 
</div>
<!-- End Wrapper --> 


<?php get_footer(); ?>