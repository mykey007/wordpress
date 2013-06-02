<?php
	/* ------------------------------------- */
	/* DYNAMIC PORTFOLIO POST TYPES */
	/* ------------------------------------- */
	
	//Get Portfolio Slugs & Names
		$portfolios = get_option("tb_glisseo_theme_portfolio_options");
		$portfolio_slugs = array();
		$portfolio_names = array();
		$j = 1;
		if(is_array($portfolios)){
			foreach($portfolios as $key => $value){
				if($j%4==0){
					$j = 0 ;
				}
				else if($j%3==0){
				
				}
				else if($j%2==0){
		            array_push($portfolio_slugs,$value);
		        }
		        else{
		            array_push($portfolio_names,$value);
		        }
		    	$j++;
			}

			//Create Post Types
			$portfolio_counter = 0;
			foreach ( $portfolio_slugs as $slug ){
					add_action('init', 'create_portfolio');
					register_taxonomy("category_".$slug, array($slug), array("hierarchical" => true, "label" => "$portfolio_names[$portfolio_counter] Categories", "singular_label" => "$slug Category", "rewrite" => true));
			}
		}		
		
	function create_portfolio() {
		global $portfolio_slugs,$portfolio_names;
		$portfolio_counter = 0;
		foreach ( $portfolio_slugs as $slug ){
			$portfolio_args = array(
				'label' => "Portfolio '".$portfolio_names[$portfolio_counter]."'",
				'singular_label' => $portfolio_names[$portfolio_counter++],
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => $slug, 'with_front' => true),
				'supports' => array('title', 'editor', 'thumbnail', 'author', 'comments', 'excerpt'),
				'taxonomies' => array('category_'.$slug,'post_tag') // this is IMPORTANT
			);
			register_post_type($slug,$portfolio_args);
			
		}
	}
	
	function portfolioSingleRedirect(){
	    global $wp_query;
	    $queryptype = $wp_query->query_vars["post_type"];
		global $portfolio_slugs;
		if(is_array($portfolio_slugs))
			foreach ( $portfolio_slugs as $slug ){
				if ($queryptype == $slug){
					if (have_posts()){
						global $pcat;
						$pcat = "category_".$slug;
						require(TEMPLATEPATH . '/single_portfolio.php');
						die();
					}else{
						$wp_query->is_404 = true;
					}
				}
			}
	}
	add_action("template_redirect", 'portfolioSingleRedirect');
	
	/* ------------------------------------- */
	/* VIDEO POST TYPE */
	/* ------------------------------------- */
	add_action('init', 'create_video');
	register_taxonomy("category_video", array("video"), array("hierarchical" => true, "label" => "Video Categories", "singular_label" => "Video Category", "rewrite" => true));
	
	function create_video() {
		$portfolio_args = array(
				'label' => "Videos",
				'singular_label' => 'Video',
				'public' => true,
				'show_ui' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'rewrite' => array('slug' => 'video', 'with_front' => true),
				'supports' => array('title', 'editor', 'thumbnail', 'author')
		);
		register_post_type('video',$portfolio_args);
	}
	
	
	/* ------------------------------------- */
	/* GALLERY POST TYPE */
	/* ------------------------------------- */
	
	//Register Gallery Image PostType and Gallery Taxonomy
		add_action('init', 'create_gallery');
		register_taxonomy("category_gallery", array("gallery"), array("hierarchical" => true, "label" => "Galleries", "singular_label" => "Gallery", "rewrite" => true));

	//Create New Custom Fields For Taxonomy
		add_action('category_gallery_add_form_fields','extra_tax_fields', 10, 2 ); 
		add_action('category_gallery_edit_form_fields','extra_tax_fields', 10, 2 ); 
	//Save New Custom Fields Values For Taxonomy
		add_action('edited_category_gallery','save_extra_taxonomy_fields', 10, 2); 
		add_action('created_category_gallery','save_extra_taxonomy_fields', 10, 2);
	//Add Media Upload Functionality to Custom Fields
		add_action('category_gallery_add_form_fields','init_media_upload', 10, 2 ); 
		add_action('category_gallery_edit_form_fields','init_media_upload', 10, 2 ); 
	
	//Add special Icons to the CPTs	
		add_action( 'admin_head', 'cpt_icons' );
	

	function create_gallery() {
		$portfolio_args = array(
			'label' => "Gallery Images",
			'singular_label' => 'Gallery',
			'public' => true,
			'show_ui' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array('slug' => 'gallery', 'with_front' => true),
			'supports' => array('title', 'editor', 'thumbnail', 'author')
		);
		register_post_type('gallery',$portfolio_args);
	}
	
	
	
	function extra_tax_fields($tag) {
	   //check for existing taxonomy meta for term ID
	    $t_id = $tag->term_id;
	    $term_meta = get_option( "taxonomy_$t_id");
	    
	    // Render the output
		echo "
			<script>
				jQuery(document).ready(function(jQuery) {
						jQuery('.custom_upload_image_button').click(function() {
							formfield = jQuery(this).siblings('.custom_upload_image');
							preview = jQuery(this).siblings('.custom_preview_image');
							tb_show('', 'media-upload.php?type=image&TB_iframe=true');
							window.send_to_editor = function(html) {
								imgurl = jQuery('img',html).attr('src');
								classes = jQuery('img', html).attr('class');
								id = classes.replace(/(.*?)wp-image-/, '');
								formfield.val(id);
								preview.attr('src', imgurl);
								tb_remove();
							}
							return false;
						});
						jQuery('.custom_clear_image_button').click(function() {
							var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
							jQuery(this).parent().siblings('.custom_upload_image').val('');
							jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
							return false;
						});
					});
			</script>
		";
			    
	?>
		<tr class="form-field">
		<th scope="row" valign="top"><label for="cat_Image_url">Gallery Overview Image</label></th>
		<td>
		<?php 
			$image = get_template_directory_uri().'/style/images/icon-bullet.png';
		echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
		if ($term_meta['img']) { $image = wp_get_attachment_image_src($term_meta['img'], 'medium');	$image = $image[0]; }
		echo	'<input name="term_meta[img]" type="hidden" class="custom_upload_image" value="'.$term_meta['img'].'" />
					<img src="'.$image.'" class="custom_preview_image" alt="" style="max-width:300px" /><br />
						<input class="custom_upload_image_button button" type="button" style="max-width: 90px;" value="Choose Image" />
						<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
						<br clear="all" /><span class="description">The Image that will shown as preview in the Gallery Overiew (Page Template "Gallery Overview")</span><br clear="all" />';
		?>
		        </td>
		</tr>
<?php
	} 
	
	function save_extra_taxonomy_fields( $term_id ) {
	    if ( isset( $_POST['term_meta'] ) ) {
	        $t_id = $term_id;
	        $term_meta = get_option( "taxonomy_$t_id");
	        $cat_keys = array_keys($_POST['term_meta']);
	            foreach ($cat_keys as $key){
	            if (isset($_POST['term_meta'][$key])){
	                $term_meta[$key] = $_POST['term_meta'][$key];
	            }
	        }
	        //save the option array
	        update_option( "taxonomy_$t_id", $term_meta );
	    }
	}	

	function init_media_upload(){
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	}
	

	function cpt_icons() {
	    echo '<style type="text/css" media="screen">
	        #menu-posts-video .wp-menu-image {
	            background: url('.get_template_directory_uri().'/style/images/video.png) no-repeat 6px -17px !important;
	        }
	        #menu-posts-video:hover .wp-menu-image, #menu-posts-video.wp-has-current-submenu .wp-menu-image {
	            background-position:6px 7px!important;
	        }
	        
	        #menu-posts-gallery .wp-menu-image {
	            background: url('.get_template_directory_uri().'/style/images/gallery.png) no-repeat 6px -17px !important;
	        }
	        #menu-posts-gallery:hover .wp-menu-image, #menu-posts-gallery.wp-has-current-submenu .wp-menu-image {
	            background-position:6px 7px!important;
	        }
	        
	    </style>';
	}

?>