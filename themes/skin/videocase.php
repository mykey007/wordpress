<?php
/* 
Template Name: Videocase
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

	//Video Query
		//if "all" categories selected, no argument for queriying categories necessary
		$video_categories = in_array("all",$pageoptions["tb_glisseo_video_categories"]) ? '' : implode(",",$pageoptions["tb_glisseo_video_categories"]);
		$video_args=array(
			'post_type' => "video",
			'category_video' => $video_categories,
			'posts_per_page' => 99
		);
		$videos = get_posts($video_args);

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
  <!-- Begin Container -->
  <div class="container"> 
    <!-- The Video Section -->
    <div id="videocontainer">
	<?php foreach ($videos as $video) :
				$postoptions = getOptions($video->ID);
        		if($postoptions["tb_glisseo_video_type"]=="youtube"){
					$video_frame = '<iframe src="http://www.youtube.com/embed/'.$postoptions["tb_glisseo_youtube_id"].'?hd=1&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" width="'.$postoptions["tb_glisseo_video_width"].'" height="'.$postoptions["tb_glisseo_video_height"].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
				elseif ($postoptions["tb_glisseo_video_type"]=="vimeo") {
					$video_frame = '<iframe src="http://player.vimeo.com/video/'.$postoptions["tb_glisseo_vimeo_id"].'?title=0&amp;byline=0&amp;portrait=0&amp;color='.$tb_themeoptions["tb_glisseo_highlight_color"].'" width="'.$postoptions["tb_glisseo_video_width"].'" height="'.$postoptions["tb_glisseo_video_height"].'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
				}
	?>      
			      <div class="video">
			        <?php echo $video_frame; ?>
			        <h2><?php echo $video->post_title;?></h2>
			        <p><?php echo $video->post_content;?></p>
			      </div>
	 <?php endforeach; ?>    
     </div>
    <!-- End The Video Section --> 
    
    <!-- Begin Videocase Items -->
    <div id="videocase">
	  <?php if(!(sizeof($pageoptions["tb_glisseo_video_categories"])<2 && !in_array("all",$pageoptions["tb_glisseo_video_categories"])) ) :?>
	      <ul class="filter">
	        <li><a class="active" href="#" data-filter="*"><?php _e("All","tb_glisseo"); ?></a></li>
	        <?php
		        if(in_array("all",$pageoptions["tb_glisseo_video_categories"])){
			        $tax_terms = get_terms("category_video");
					foreach($tax_terms as $tax_term){	
						echo '<li><a href="#" data-filter=".'.$tax_term->slug.'">'.$tax_term->name.'</a></li>
						';
					}
		        }
	        	else{
		        	foreach($pageoptions["tb_glisseo_video_categories"] as $category){
			        	if($category!="all"){
				        	$term = get_term_by('slug', $category, 'category_video'); 
						    $category_name = $term->name;
						    echo '<li><a href="#" data-filter=".'.$category.'">'.$category_name.'</a></li>
						    ';
			        	}
		        	}
		        }
	        ?>
	      </ul>
	  <?php endif; ?>
      <ul class="items">
      <?php $video_counter=1;
       foreach ($videos as $video) : 
   		//Portfolio Featured Image
				$postimage = wp_get_attachment_url( get_post_thumbnail_id($video->ID));
				$postimage_resized = aq_resize($postimage,228,170,true);
				$terms = get_the_terms( $video->ID , "category_video" );
				$slug = "";
				foreach($terms as $term){
					$slug .= " ".$term->slug;
				}
       ?>
        <li class="item <?php echo $slug; ?>" data-address="id<?php echo $video_counter++;?>"> <a href="#"> <img src="<?php echo $postimage_resized;?>" alt="" /> </a> </li>
       <?php endforeach; ?>
      </ul>
    </div>
    <!-- End Videocase Items --> 
    
  </div>
  <!-- End Container --> 
</div>
<!-- End Wrapper -->
<?php get_footer(); ?>