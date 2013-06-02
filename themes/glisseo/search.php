<?php
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

		
	$allsearch = &new WP_Query("s=$s&showposts=-1");
	$count = $allsearch->post_count;
	wp_reset_query();


	$hits = $count == 1 ? $count." ".__("hit for","tb_glisseo") : $count." ".__("hits for","tb_glisseo");

	get_header();
?>

<!-- Begin Head Image -->
<div class="head-image"> 
	<?php if($headline){?>
		<?php if(!empty($himage)){ ?><img src="<?php echo $himage; ?>" alt="" /><?php } ?>
		<div class="page-title">
		    <h1><?php _e("Search","tb_glisseo"); ?></h1>
		</div>
	<?php } ?>
</div>
<!-- End Head Image -->  

<!-- Begin Wrapper -->
<div class="wrapper">
	<div class="intro uppercase center"><?php echo $hits; ?> "<?php the_search_query(); ?>"</div>
	
							<?php 
		    			$paged =
		    				( get_query_var('paged') && get_query_var('paged') > 1 )
		    				? get_query_var('paged')
		    				: 1;
		    			$args = array(
		    				'posts_per_page' => 10,
		    				'paged' => $paged
		    			);
		    			$args =
		    				( $wp_query->query && !empty( $wp_query->query ) )
		    				? array_merge( $wp_query->query , $args )
		    				: $args;
		    			query_posts( $args );
		    			?>
		    		    <?php if (have_posts()) : ?>
		    		    <?php while (have_posts()) : the_post(); ?>
		    		
		    			<?php
		    			$timevar = get_post_time('F jS,Y', true); 

		    				if(get_post_type()!="post" && get_post_type()!="page"){
			    					$post_content = strip_tags(substr(get_the_content(), 0 , 250));
			    					$post_link = '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
			    			}
			    			else{
				    			$post_content_org = do_shortcode(get_the_content());
				    			$post_content = strip_tags(substr($post_content_org, 0 , 250));
				    			if(strlen($post_content_org)>250) $post_content .= "...";
				    			 $post_link = '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
				    		} 
			    		
		    			//
		    			?>
		    		
		    		                <h5 style="padding:0"><?php echo $post_link; ?></h5>
		    		                <p><?php echo $post_content;?></p>
		    		                <hr/>

		    					<?php endwhile; ?>
					<?php else : ?>
					<h1>
					        <?php echo $searchnotfound ?>
					   </h1>
					<div style="clear:both"></div>
					<?php  endif; ?>

	
</div>
<!-- End Wrapper -->
<?php get_footer(); ?>