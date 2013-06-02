<?php
/*
Template Name: Blog
*/
?>
<?php
	//Main Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;
		$template_uri = get_template_directory_uri();

	//Page Options
		if(have_posts()) $pageoptions = getOptions($post_id);	

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
		
	
	//Category, Archive Headline
		if(is_category()){
			$htitle = __('Category', 'tb_glisseo')." ".$current_cat[0]->cat_name;
		}
		elseif(is_archive()){
			wp_link_pages();
			$htitle = __('Archive', 'tb_glisseo');
		}
		if(is_tag()) $htitle =  __('Tag Archive', 'tb_glisseo');
				
	//Sidebar sets Fullwidth automatically
		if(isset($pageoptions["tb_glisseo_sidebar"]) && $pageoptions["tb_glisseo_sidebar"]!="nosidebar") $pageoptions["tb_glisseo_blog_display_type"] = "full";
			
get_header(); ?>

<!-- Begin Head Image -->
<div class="head-image"> 
	<?php if($headline){?>
		<?php if(!empty($himage)){ ?><img src="<?php echo $himage; ?>" alt="" /><?php } ?>
			<div class="page-title">
			    <h1><?php echo $htitle;?></h1>
			</div>
	<?php } ?>
</div>
<!-- End Head Image --> 

<!-- Begin Wrapper -->
<div class="wrapper">
	<div class="intro uppercase center"><?php if(isset($pageoptions["tb_glisseo_page_intro"])) echo $pageoptions["tb_glisseo_page_intro"];?></div>
	<?php $blog_page = get_page($post_id); echo $blog_page->post_content; ?>

	<?php //Checking if Style Columns or Full ?>
		<?php if (!isset($pageoptions["tb_glisseo_blog_display_type"]) || $pageoptions["tb_glisseo_blog_display_type"]!="columns"){ ?>
			<!-- Begin Container -->
			<div class="container">
				
				<?php if(isset($pageoptions["tb_glisseo_sidebar"]) && $pageoptions["tb_glisseo_sidebar"]!="nosidebar"){?>
				 <!-- Begin Content -->
				 <div class="content">
				<?php } //Sidebar ?>	 
				
		<?php } 
			else{
		?>
		  <!-- Begin Posts Grid -->
		  <div class="grid-wrapper">
		  <!-- Begin Content -->
		    <div class="posts-grid">  
	    <?php } ?>
    
    <?php //Postcounter for Linebreaks
		$postcounter = 1;
		while (have_posts()) : the_post(); ?>
    <?php
			//Post Infos
	    		$post_time_day = get_the_time('j');
		        $post_time_month = get_the_time('M');

	    		$postoptions = getOptions($post->ID);

	    		//Checking if Style Columns or Full
	    			if (!isset($pageoptions["tb_glisseo_blog_display_type"]) || $pageoptions["tb_glisseo_blog_display_type"]!="columns"){
			    //Post Type related Object to display in the Head Area of the post
        			$post_top="";
	        		if(isset($postoptions["tb_glisseo_post_type"]))
						switch ($postoptions["tb_glisseo_post_type"]) {
							case 'image':
										$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),960);
										$post_top = '<a href="'.get_permalink().'"><img src="'.$blogimageurl.'" alt=""></a>';											
										break;
							case 'video':
										if($postoptions["tb_glisseo_video_type"]=="youtube"){
											$post_top = '<iframe src="http://www.youtube.com/embed/'.$postoptions["tb_glisseo_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$postoptions["tb_glisseo_video_width"].'" height="'.$postoptions["tb_glisseo_video_height"].'" style="border:0"></iframe>';
										}
										elseif ($postoptions["tb_glisseo_video_type"]=="vimeo") {
											$post_top = '<iframe src="http://player.vimeo.com/video/'.$postoptions["tb_glisseo_vimeo_id"].'?portrait=0&amp;title=0&amp;byline=0&amp;color='.$tb_themeoptions["tb_glisseo_highlight_color"].'" width="'.$postoptions["tb_glisseo_video_width"].'" height="'.$postoptions["tb_glisseo_video_height"].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
										}
										elseif ($postoptions["tb_glisseo_video_type"]=="webm") {
											$post_top_width = 960;
											$video_width = $postoptions["tb_glisseo_video_width"];
											$video_height = $postoptions["tb_glisseo_video_height"];
											
											if($video_width>$post_top_width)
												$video_width_ratio = $video_width/$post_top_width;
											else
												$video_width_ratio = $post_top_width/$video_width;
		
											$video_height = round($video_height*$video_width_ratio);
											$video_width = $post_top_width;
											
											$post_top = '
												<div class="html5video tb-resizemedia" data-width="'.$video_width.'" data-height="'.$video_height.'" style="max-width:'.$post_top_width.'px;"><iframe style="border:0;overflow:hidden;width:100%;max-width:'.$post_top_width.'px;height:'.$video_height.'px;margin-bottom: -6px;"  src="'.$template_uri.'/functions/video.php?post_id='.$post->ID.'&amp;width='.$video_height.'&amp;height='.$video_height.'"></iframe></div>';
										}
										break;
							case 'slider':
										if(get_revslider_property($postoptions["tb_glisseo_slider"],'slider_type')=="fullwidth")
											echo '<style>.featured .fullwidthabanner{height:'.get_revslider_property($postoptions["tb_glisseo_slider"],'height').'px;}</style>'; 
										
										$post_top = do_shortcode('[rev_slider '.$postoptions["tb_glisseo_slider"].']');
										break;
							case 'audio':
										$uniq = uniqid("audio_");
										$post_top = '<div class="html5audio"><audio id="'.$uniq.'" src="'.$postoptions["tb_glisseo_audio_link"].'" controls="controls"></audio></div>
										<script>	
											jQuery(document).ready(function(){
												jQuery("#'.$uniq.'").mediaelementplayer({
													pluginPath: "'.TB_JS.'/mediaplayer/",
													// name of flash file
													flashName: "flashmediaelement.swf",
													// name of silverlight file
													silverlightName: "silverlightmediaelement.xap",
													success: function(player, node) {
														jQuery("#" + node.id + "-mode").html("mode: " + player.pluginType);
													}
												});
											});
										</script>
										';
										break;
							default:
										$post_top = "";
										break;	
						}
			    	}
			    	else{
			    		$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),370,190,true);
						$post_top = '<a href="'.get_permalink().'"><img src="'.$blogimageurl.'" alt=""></a>';	
					}	
				//Categories
					$category_links = "";
					foreach((get_the_category()) as $category) {
						$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
					}
					$category_links = substr($category_links, 2);
					
				//New Row = clear:both
				    $clearrow = $postcounter % 2 ? "" : '<div style="clear:both"></div>';
				    $postcounter++;
	?>
	<?php //Checking if Style Columns or Full ?>
	 	<?php if (!isset($pageoptions["tb_glisseo_blog_display_type"]) || $pageoptions["tb_glisseo_blog_display_type"]!="columns"){ ?>
			<!-- Begin Post Full -->
		    <div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
		      <div class="featured"><?php echo $post_top; ?></div>
		      <div class="info">
		        <div class="date">
		          <div class="day"><?php echo $post_time_day; ?></div>
		          <div class="month"><?php echo $post_time_month; ?></div>
		        </div>
		        <?php if(isset($tb_themeoptions["tb_glisseo_heart"])) echo getPostLikeLink(get_the_ID());?>
		      </div>
		      <div class="post-content">
		        <h2 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
		        <div class="meta"> <?php echo $category_links; ?> <span>|</span> <span class="comments"><?php comments_popup_link(__("0 Comments","tb_glisseo"), __("1 Comment","tb_glisseo"), '% '.__("Comments","tb_glisseo")); ?></span> </div>
		        <?php the_excerpt(); ?></div>
		    </div>
		    <!-- End Post Full -->  
		<?php } 
			else{
		?>
		    <!-- Begin Post Columns -->
		    <div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
		      <div class="info">
		        <div class="date">
		          <div class="day"><?php echo $post_time_day; ?></div>
		          <div class="month"><?php echo $post_time_month; ?></div>
		        </div>
		        <?php if(isset($tb_themeoptions["tb_glisseo_heart"])) echo getPostLikeLink(get_the_ID());?>
		      </div>
		      <div class="post-content">
		      	<div class="featured"><?php echo $post_top; ?></div>
		        <h2 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
		        <?php the_excerpt(); ?>      
		        <div class="meta"> <?php echo $category_links; ?> <span>|</span> <span class="comments"><?php comments_popup_link(__("0 Comments","tb_glisseo"), __("1 Comment","tb_glisseo"), '% '.__("Comments","tb_glisseo")); ?></span> </div>
		      </div>
		    </div>
		    <?php echo $clearrow; ?>
		    <!-- End Post Columns--> 
		<?php } ?>
	<?php endwhile; ?>
	
	<!-- Begin Page Navi -->
	<div style="clear:both"></div>
	<?php if(function_exists('pagination')){ pagination(); }else{ paginate_links(); } ?>    
    <!-- End Page Navi --> 
    <?php if(isset($pageoptions["tb_glisseo_blog_display_type"]) && $pageoptions["tb_glisseo_blog_display_type"]=="columns"){ ?></div><?php } //End Post Column ?>
    
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
  <!-- End Post Grid / Container --> 

</div>
<!-- End Wrapper --> 

<?php 
get_footer(); ?>