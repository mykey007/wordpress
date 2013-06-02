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
			$himage = !isset($tb_themeoptions["tb_glisseo_blog_hide_default_head_image"]) ? $himage : "";
		}
		
	//Highlight Color	
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_blog_options"));
				
	get_header(); ?>

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
  
  	<?php if(isset($pageoptions["tb_glisseo_sidebar"]) && $pageoptions["tb_glisseo_sidebar"]!="nosidebar"){ ?>
		 <!-- Begin Content -->
		 <div class="content">
	<?php } //Sidebar ?>
  
    <?php while (have_posts()) : the_post(); ?>
    <?php
			//Post Infos
	    		$post_time_day = get_the_time('j', true);
		        $post_time_month = get_the_time('M', true);

	    		$postoptions = getOptions($post->ID);

        		//Post Type related Object to display in the Head Area of the post
        			$post_top="";
	        		if(isset($postoptions["tb_glisseo_post_type"]))
						switch ($postoptions["tb_glisseo_post_type"]) {
							case 'image':
										$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID) ),960);
										$post_top = '<img src="'.$blogimageurl.'" alt="">';											
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
				//Categories
					$category_links = "";
					foreach((get_the_category()) as $category) {
						$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
					}
					$category_links = substr($category_links, 2);
	?>

    <!-- Begin Post -->
    <div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
      <div class="featured"><?php echo $post_top; ?></div>
      <div class="info">
        <div class="date">
          <div class="day"><?php echo $post_time_day; ?></div>
          <div class="month"><?php echo $post_time_month; ?></div>
        </div>
        <?php if(isset($tb_themeoptions["tb_glisseo_heart"])) echo getPostLikeLink(get_the_ID());?>
        <ul class="share">
          <li><div id="facebook" data-url="<?php the_permalink();?>" data-text="<?php the_title();?>"></div></li>
          <li><div id="twitter" data-url="<?php the_permalink();?>" data-text="<?php the_title();?>"></div></li>
          <li><div id="google" data-url="<?php the_permalink();?>" data-text="<?php the_title();?>"></div></li>
          <li><div id="pinterest" data-url="<?php the_permalink();?>" data-text="<?php the_title();?>"></div></li>
        </ul>
        <script>
        	jQuery(document).ready(function(){
				jQuery('#twitter').sharrre({
				  share: {
				    twitter: true
				  },
				  template: '<a class="box" href="javascript:void();">&nbsp;</a>',
				  enableHover: false,
				  enableTracking: true,
				  click: function(api, options){
				    api.simulateClick();
				    api.openPopup('twitter');
				  }
				});
				
				jQuery('#facebook').sharrre({
				  share: {
				    facebook: true
				  },
				  template: '<a class="box" href="javascript:void();">&nbsp;</a>',
				  enableHover: false,
				  enableTracking: true,
				  click: function(api, options){
				    api.simulateClick();
				    api.openPopup('facebook');
				  }
				});
				
				jQuery('#google').sharrre({
				  share: {
				    googlePlus: true
				  },
				  template: '<a class="box" href="javascript:void();">&nbsp;</a>',
				  enableHover: false,
				  enableTracking: true,
				  click: function(api, options){
				    api.simulateClick();
				    api.openPopup('googlePlus');
				  }
				});
				<?php 
					if(empty($blogimageurl)) {
						$imageurl = get_option("tb_glisseo_header_logo");
						echo "jQuery('head').append('<meta property=\'og:image\' content=\'$imageurl\'/>');";
						echo "jQuery('head').append('<link rel=\'image_src\' href=\'$imageurl\'/>');";
					}
					else{
						$imageurl = $blogimageurl;
					}
					
				?>
				jQuery('#pinterest').sharrre({
				  share: {
				    pinterest: true
				  },
				  template: '<a class="box" href="javascript:void();">&nbsp;</a>',
				  enableHover: false,
				  enableTracking: true,
				  buttons:{pinterest: {media: '<?php echo $imageurl;?>'}},
				  click: function(api, options){
				    api.simulateClick();
				    api.openPopup('pinterest');
				  }
				});
			});
        </script>
      </div>
        
      <div class="post-content">
        <h2 class="title"><?php the_title(); ?></h2>
        <div class="meta"> <?php echo $category_links; ?> <span>|</span> <span class="comments"><?php comments_popup_link(__("0 Comments","tb_glisseo"), __("1 Comment","tb_glisseo"), '% '.__("Comments","tb_glisseo")); ?></span> </div>
        <?php the_content(); ?>      
      </div>
        
	   <?php	if(isset($tb_themeoptions["tb_glisseo_related_posts_active"])) :
		   			if(!isset($pageoptions["tb_glisseo_related_posts_attribute"])) $pageoptions["tb_glisseo_related_posts_attribute"]="tags";
		   			
		   			$tags = wp_get_post_tags($post->ID);
		   			if($pageoptions["tb_glisseo_related_posts_attribute"]!="category" && $tags){
		        		$tag_ids = array();
						foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
						$args=array(
							'tag__in' => $tag_ids,
							'post__not_in' => array($post->ID),
							'showposts'=> 4, 
							'ignore_sticky_posts'=>1,
						);
					}
					else {
						$cat = "";
						foreach((get_the_category()) as $category) { 
						    $cat .= ",".$category->cat_ID ;
						} 
						$cat = substr($cat, 1);
						$args=array(
							'cat' => $cat,
							'post__not_in' => array($post->ID),
							'showposts'=> 4, 
							'ignore_sticky_posts'=>1,
							
						);
					}
					$temp = $wp_query; 
					$my_query = new wp_query($args);
					if( $my_query->have_posts() ) {
						?>
					<!-- Begin Related Posts -->
					<div class="clear"></div>
					<div class="related">
						<h3><?php _e("Related Posts","tb_glisseo");?></h3>
						<ul>
						<?php
							while ($my_query->have_posts()) {
								$my_query->the_post();
								$postcustoms = getOptions($post->ID);
						?>
							<li>
					            <div class="featured"><a href="<?php the_permalink(); ?>"><img src="<?php echo aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post->ID)),228,160,true); ?>" alt="" /></a></div>
					        </li>
					        <?php
							}
								$wp_query = null; 
								$wp_query = $temp;
								wp_reset_query();
							?>
						</ul>
					</div>
					<!-- End Related Posts -->
					<?php } //if have_posts()
				endif; //if related posts		
					?>
    </div>
    <!-- End Post --> 
    
	<?php endwhile; ?>
	
	<?php comments_template('', true); ?>
    
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
  <!-- End Container --> 
</div>
<!-- End Wrapper --> 

<?php 
get_footer(); ?>