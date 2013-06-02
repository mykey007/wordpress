<?php

/* ------------------------------------- */
/* SHORTCODES */
/* ------------------------------------- */


/* COLUMN 1/2 */

$template_uri_shortcodes = get_template_directory_uri();


//COLUMNS
	if (!function_exists('one_third_shortcode')) {
		function one_third_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="one-third' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('one-third', 'one_third_shortcode');
	}
	
	if (!function_exists('two_third_shortcode')) {
		function two_third_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="two-third' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('two-third', 'two_third_shortcode');
	}
	
	if (!function_exists('one_fourth_shortcode')) {
		function one_fourth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="one-fourth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('one-fourth', 'one_fourth_shortcode');
	}
	
	if (!function_exists('three_fourth_shortcode')) {
		function three_fourth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="three-fourth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('three-fourth', 'three_fourth_shortcode');
	}
	
	if (!function_exists('one_fifth_shortcode')) {
		function one_fifth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="one-fifth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('one-fifth', 'one_fifth_shortcode');
	}
	
	if (!function_exists('two_fifth_shortcode')) {
		function two_fifth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="two-fifth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('two-fifth', 'two_fifth_shortcode');
	}
	
	if (!function_exists('three_fifth_shortcode')) {
		function three_fifth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="three-fifth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('three-fifth', 'three_fifth_shortcode');
	}
	
	if (!function_exists('four_fifth_shortcode')) {
		function four_fifth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="four-fifth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('four-fifth', 'four_fifth_shortcode');
	}
	
	if (!function_exists('one_sixth_shortcode')) {
		function one_sixth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="one-sixth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('one-sixth', 'one_sixth_shortcode');
	}
	
	if (!function_exists('five_sixth_shortcode')) {
		function five_sixth_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="five-sixth' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('five-sixth', 'five_sixth_shortcode');
	}
	
	if (!function_exists('one_half_shortcode')) {
		function one_half_shortcode($atts, $content = null){
			$last = !empty($atts) ? ' ' . $atts[0] : '';
			$clear = !empty($atts) ? '<div class="clear"></div>' : ''; 
			$html = '<div class="one-half' . $last . '">' . do_shortcode($content) . '</div>'.$clear;
			return $html;
		}
		add_shortcode('one-half', 'one_half_shortcode');
	}
	
//INTRO
	if (!function_exists('introtext_shortcode')) {
		function introtext_shortcode($atts,$content = null){
			return '<div class="intro">' . do_shortcode($content) . '</div>';
		}
		add_shortcode('intro', 'introtext_shortcode');
	}	

//BUTTONS
	if (!function_exists('button_shortcode')) {
		function button_shortcode($atts, $content = null){
			$atts['target'] = empty($atts['target']) ? '_self' : $atts['target'];
			$atts['hover'] = empty($atts['hover']) ? '' : $atts['hover'];
			$atts['link'] = empty($atts['link']) ? '#' : $atts['link'];
			$html = '<a class="button ' . $atts['hover'] . '" href="' . $atts['link'] . '" target="' . $atts['target'] . '">' . $content . '</a>';
			return $html;
		}
		add_shortcode('button', 'button_shortcode');
	}

//DIVIDER
	if (!function_exists('divider_shortcode')) {
		function divider_shortcode(){
			return "<hr />";
		}
		add_shortcode('divider', 'divider_shortcode');
	}

//TABS
	if (!function_exists('tabs_shortcode')) {
		function tabs_shortcode( $atts, $content = null ) {
			$defaults = array();
			extract( shortcode_atts( $defaults, $atts ) );
			$atts["align"] = empty($atts["align"]) ? "" : $atts["align"];
			// Extract the tab titles for use in the tab widget.
			preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
	
			$tab_titles = array();
			if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
	
			$html = '<div id="services-container" class="tab-container">';
	
			$uniq = uniqid("tabs_");
	
			if( count($tab_titles) ){
			   $html .= '<ul id="'.$uniq.'" class="etabs '.$atts["align"].'">';
	
				foreach( $tab_titles as $tab ){
					$html .= '<li class="tab"><a href="#tab-'. str_replace("%","",sanitize_title( $tab[0] )) .'"  data-toggle="tab">' . $tab[0] . '</a></li>';
				}
	
			    $html .= '</ul><div id="myTabContent" class="panel-container">';
			    $html .= do_shortcode( $content );
			    $html .= '</div></div><script>jQuery("#myTabContent div:first , #'.$uniq.' li:first").addClass("active in");</script>';
			} else {
				$html .= do_shortcode( $content );
			}
	
			return $html;
		}
		add_shortcode( 'tabs', 'tabs_shortcode' );
	}
	
	if (!function_exists('tab_shortcode')) {
		function tab_shortcode( $atts, $content = null ) {
			$defaults = array( 'title' => 'Tab' );
			extract( shortcode_atts( $defaults, $atts ) );
	
			return '<div id="tab-'. str_replace("%","",sanitize_title( $title )) .'" class="tab-pane fade">'. do_shortcode( $content ) .'</div>';
		}
		add_shortcode( 'tab', 'tab_shortcode' );
	}

//TOGGLES
	if (!function_exists('toggle_shortcode')) {
		function toggle_shortcode( $atts, $content = null ) {
			$html = '<!-- Begin Toggle -->
			    <div class="toggle">
			      <h4 class="title">' . $atts["title"] . '</h4>
			      <div class="togglebox">
			        <div>
			          ' . do_shortcode($content) . '
			        </div>
			      </div>
			    </div>
		    <!-- End Toggle --> ';
		    return $html;
	    }
		add_shortcode( 'toggle', 'toggle_shortcode' );
	}    
	
//DROPCAP
	if (!function_exists('dropcap_shortcode')) {
		function dropcap_shortcode( $atts, $content = null ) {
			return '<span class="dropcap">'. $content .'</span>';
		}
		add_shortcode( 'dropcap', 'dropcap_shortcode' );
	}
	
//SOCIALBAR
	if (!function_exists('socialbar_shortcode')) {
		function socialbar_shortcode( $atts, $content = null ) {
			$html = '<ul class="social team">';
			foreach($atts as $social => $link){
				$html .= '<li><a class="'.$social.'" href="'.$link.'" target="_blank" style="opacity: 1; "></a></li>';	
			}
			$html .= "</ul>";
			return $html;
		}
		add_shortcode( 'socialbar', 'socialbar_shortcode' );
	}

//HEADLINEwithSUBLINE
	if (!function_exists('subline_shortcode')) {
		function subline_shortcode( $atts, $content = null ) {
			return "<h5>$content <span>" . $atts['subline'] . "</span></h5>";
		}
		add_shortcode( 'headsubline', 'subline_shortcode' );
	}

//BOXES
	if (!function_exists('box_shortcode')) {
		function box_shortcode( $atts, $content = null ) {
			return '<div class="' . $atts["style"] . '-box">' . do_shortcode($content) . '</div>';
		}
		add_shortcode( 'box', 'box_shortcode' );
	}

//HIGHLIGHT
	if (!function_exists('highlight_shortcode')) {
		function highlight_shortcode( $atts, $content = null ) {
			$atts['style'] = empty($atts['style']) ? '1' : $atts['style'];
			return '<span class="lite' . $atts["style"] . '">' . do_shortcode($content) . '</span>';
		}
		add_shortcode( 'highlight', 'highlight_shortcode' );
	}

//CODEBOX
	if (!function_exists('codebox_shortcode')) {
		function codebox_shortcode( $atts, $content = null ) {
			return str_replace('<br />','','<pre><code>' . do_shortcode($content) . '</code></pre>');
		}
		add_shortcode( 'codebox', 'codebox_shortcode' );
	}
	
//SUP
	if (!function_exists('sup_shortcode')) {
		function sup_shortcode( $atts, $content = null ) {
			return '<sup>' . do_shortcode($content) . '</sup>';
		}
		add_shortcode( 'sup', 'sup_shortcode' );
	}

//SUB
	if (!function_exists('sub_shortcode')) {
		function sub_shortcode( $atts, $content = null ) {
			return '<sub>' . do_shortcode($content) . '</sub>';
		}
		add_shortcode( 'sub', 'sub_shortcode' );
	}
	
//CITE
	if (!function_exists('cite_shortcode')) {
		function cite_shortcode( $atts, $content = null ) {
			return '<cite>' . do_shortcode($content) . '</cite>';
		}
		add_shortcode( 'cite', 'cite_shortcode' );
	}

//ABBR
	if (!function_exists('abbr_shortcode')) {
		function abbr_shortcode( $atts, $content = null ) {
			return '<abbr title="' . $atts["title"] . '">' . do_shortcode($content) . '</abbr>';
		}
		add_shortcode( 'abbr', 'abbr_shortcode' );
	}

//LATEST POSTS
	if (!function_exists('latest_posts_shortcode')) {
		function latest_posts_shortcode($atts, $content){
			global $post; 
			$atts['number'] = isset($atts['number']) ? $atts['number'] : 2;
			$counter = 0;
			
			if($atts['number'] - 2 < 1) $latest = "latest";
		    else $latest = "";
			$html = '<div class="grid-wrapper">
						<div class="posts-grid '.$latest.'">';
			
			$posts = get_posts( array('numberposts' => $atts['number'] ));
			foreach($posts as $post) : setup_postdata($post);
				$category_links = "";
				foreach((get_the_category()) as $category) {
					$category_links .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
				}
				$category_links = substr($category_links, 2);
				$numOfComments = get_comments_number();
				$numOfComments = $numOfComments == 1 ? __("1 Comment","tb_glisseo") : $numOfComments . __(" Comments","tb_glisseo");
				
				//Like Button
				$tb_themeoptions = get_option("tb_glisseo_theme_blog_options");
				$like = isset($tb_themeoptions["tb_glisseo_heart"]) ? getPostLikeLink(get_the_ID()) : "";
				
				$html .= '<div class="post">
					        <div class="info">
					          <div class="date">
					            <div class="day">' . get_the_time('j') . '</div>
					            <div class="month">' . get_the_time('M') . '</div>
					          </div>
					          ' . $like . '
					        </div>
					        <div class="post-content">
					          <div class="featured"><a href="' . get_permalink() . '"><img src="' . aq_resize(wp_get_attachment_url( get_post_thumbnail_id() ),370,175,true) . '" alt="" /></a></div>
					          <h2 class="title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
					          <p>' . excerpt(25) . '</p>
					          <div class="meta"> ' . $category_links . ' <span>|</span> <span class="comments"><a href="' . get_comments_link() . '">' . $numOfComments . '</a></span></div>
					        </div>
					      </div>
		      ';
		      if(++$counter - $atts['number'] <3) $latest = "latest";
		      else $latest = "";
			
		      if($atts['number'] - 2 > 0 && $counter%2==0) $html .='</div><div class="posts-grid ' . $latest . '">';
		    
		    endforeach;
					
			$html .= '</div></div>';
			return $html;
		}
		add_shortcode( 'latest_posts', 'latest_posts_shortcode' );
	}
	
//LATEST PROJECTS
	if (!function_exists('latest_projects_shortcode')) {	
		function latest_projects_shortcode($atts, $content){	
			global $post;
			$atts['number'] = isset($atts['number']) ? $atts['number'] : 4;
			$html = '<div class="grid-wrapper"><ul class="items">';
		
			$args = array( 'posts_per_page' => $atts['number'], 
				   'offset'=> 0,
				   'post_type' => $atts['portfolioslug']);
			$all_posts = new WP_Query($args);
		
			while($all_posts->have_posts()) : $all_posts->the_post();
		
				$html .= '<li><a href="' . get_permalink() . '"> <img src="' . aq_resize(wp_get_attachment_url( get_post_thumbnail_id() ),228,170,true) . '" alt="" /> </a> </li>
				';
		
			endwhile;
		
			$html .= '</ul></div>';
			return $html;
			}
		add_shortcode( 'latest_projects', 'latest_projects_shortcode' );
	}
?>