<?php
	//Main Post ID
		global $wp_query;
	    $content_array = $wp_query->get_queried_object();
		if(isset($content_array->ID)){
	    	$post_id = $content_array->ID;
		}
		else $post_id=0;
		$template_uri = get_template_directory_uri();
		global $post;

	//Page Options
		if(have_posts()) $pageoptions = getOptions($post_id);	

	//Page Head Area
		if(isset($pageoptions['tb_glisseo_activate_page_title'])){ 
			$headline = false;
		} 
		else {
			$headline = true;
			//Headline
			$htitle = isset($pageoptions["tb_glisseo_page_head_alternative_title"]) ? $pageoptions['tb_glisseo_page_head_alternative_title'] : get_the_title();
			//Head Image
			if(isset($pageoptions["tb_glisseo_page_head_image"])){
				$himage = wp_get_attachment_image_src($pageoptions["tb_glisseo_page_head_image"],'full');
				$himage = $himage[0]; 
			} 
			else {
				$himage = get_option("tb_glisseo_body_head_image");
			}
		}
		
	//Highlight Color	
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_portfolio_options"));
		
	get_header(); 
?>

<?php

	$postoptions = getOptions($post_id);
	if(isset($postoptions["tb_glisseo_post_type"]) && $postoptions["tb_glisseo_post_type"]=="slider"){
		
		$slider = $postoptions["tb_glisseo_slider"];
	
		global $wpdb;
		global $table_prefix;
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
		
		if($return_value!="fullwidth")
			echo "<div style='height:50px'></div>";

		
		echo do_shortcode('[rev_slider '.$postoptions["tb_glisseo_slider"].']');
	}
?>


<!-- Begin Wrapper -->
<div class="wrapper"> 
  
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

	    		

        		//Post Type related Object to display in the Head Area of the post
        			$post_top="";
	        		if(isset($postoptions["tb_glisseo_post_type"]))
						switch ($postoptions["tb_glisseo_post_type"]) {
							case 'image':
										$blogimageurl = aq_resize(wp_get_attachment_url( get_post_thumbnail_id($post_id) ),960);
										$post_top = '<img style="width:960px" src="'.$blogimageurl.'" alt="">';											
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
	?>

    <!-- Begin Post -->
    <div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
      <div class="featured"><?php echo $post_top; ?></div>
        <h1 class="title"><?php the_title(); ?></h1>
        <div class="three-fourth">
	      <?php the_content(); ?>
	    </div>
	    <div class="one-fourth last"> 
	    	<!-- Begin Meta -->
		      <div class="item-info">
		        <ul class="portfolio-meta">
		          	<li><span><?php _e("Date:","tb_glisseo"); ?></span> <?php echo date_i18n(get_option('date_format'), strtotime($post->post_date_gmt)); ?></li>
		          <?php if(isset($postoptions["tb_glisseo_portfolio_skills"])){ ?>
		          	<li><span><?php _e("Skills:","tb_glisseo"); ?></span> <?php echo $postoptions["tb_glisseo_portfolio_skills"]; ?></li>
		          <?php } if(isset($postoptions["tb_glisseo_portfolio_client"])){ ?>
		          	<li><span><?php _e("Client:","tb_glisseo"); ?></span> <?php echo $postoptions["tb_glisseo_portfolio_client"]; ?></li>
		          <?php } if(isset($postoptions["tb_glisseo_portfolio_link"])){ ?>
		          	<li><span><?php _e("Link:","tb_glisseo"); ?></span> <a href="<?php echo $postoptions["tb_glisseo_portfolio_link"]; ?>"><?php echo $postoptions["tb_glisseo_portfolio_link"]; ?></a></li>
		          <?php }?>
		        </ul>
		        <div class="portfolio-nav"> 
		        <?php if(get_adjacent_post(false, '', false)) : ?>
	   				<span class="prev"><?php echo next_post_link('%link', '', false); ?></span>
	   			<?php endif; ?>
	   				<?php
	   					$portfolios = get_option("tb_glisseo_theme_portfolio_options");
						$portfolio_count = 0;
						foreach($portfolios as $key => $value){
							if($value == get_post_type($post_id)){ 
								$portfolio_key = $key;
								break;
							}
						}
						$portfolio_nr = split("-",$portfolio_key);
						$portfolio_nr = $portfolio_nr[1];
						$portfolio_page = $portfolios["portfolio_builder_page-".$portfolio_nr];
	   				?>
		        	<span class="up"><a href="<?php echo get_permalink($portfolio_page);?>" title="<?php _e("All Items","tb_glisseo");?>"></a></span> 
		        <?php if(get_adjacent_post(false, '', true)) : ?>
	   				<span class="next"><?php echo previous_post_link('%link', '', false); ?></span>
	   			<?php endif; ?>
		        </div>
		      </div>
		      <!-- End Meta --> 
	    </div>
	    	<?php	
	    		$portfolio_options = getOptions($portfolio_page);
	    		if(!isset($portfolio_options["tb_glisseo_hide_related_projects"])) :
		   			if(!isset($pageoptions["tb_glisseo_related_posts_attribute"])) $pageoptions["tb_glisseo_related_posts_attribute"]="tags";
		   			
		   			$tags = wp_get_post_tags($post->ID);
		   			if($pageoptions["tb_glisseo_related_posts_attribute"]!="category" && $tags){
		        		$tag_ids = array();
						foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
						$args=array(
							'post_type' => get_post_type( $post_id),
							'tag__in' => $tag_ids,
							'post__not_in' => array($post_id),
							'showposts'=> 4, 
							'ignore_sticky_posts'=>1,
						);
					}
					else {
						$args=array(
							'post_type' => get_post_type( $post_id),
							'post__not_in' => array($post_id),
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
				endif; // if related projects
					?>
    </div> 
    
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