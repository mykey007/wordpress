<?php

function the_breadcrumb(){
	global $post_id;
	echo '<a href="'.home_url('/').'">'.get_bloginfo('name').'</a>';
	if(is_home()){
		echo ' &raquo; '.get_the_title($post_id);
	}
	elseif (is_category() || is_single()) {
		$entrycategory="";
		foreach((get_the_category()) as $category) {
			$entrycategory .= ', <a href="'.get_category_link($category->term_id ).'">'.$category->cat_name.'</a>';
		}
		$entrycategory = substr($entrycategory, 2);
		echo ' &raquo; '.$entrycategory."";
		
		if (is_single()) {
			if ( get_post_type() != 'post' && isset($_GET["tp"]) ) {
	      	  $parent_id = $_GET["tp"];
		      echo '<a href="'.get_permalink($parent_id).'">'.get_the_title($parent_id).'</a>';
		    }
		    elseif ( get_post_type() != 'post' && !isset($_GET["tp"]) ){
		    	$tb_glisseo_portfolio = __("Portfolio","tb_glisseo");
			    echo ''.$tb_glisseo_portfolio.'';
		    }
		    
		    echo ' &raquo; ';
			echo ''.get_the_title().'';
		}
	} 
	elseif ( is_search() ) {
      echo ' &raquo; ' . 'Search results for "' . get_search_query() . '"';
 
    } elseif ( is_day() ) {
      echo ' &raquo; <a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
      echo ' &raquo; <a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . '';
      echo ' &raquo; ' . get_the_time('d') . '';
 
    } elseif ( is_month() ) {
      echo '<div class="breaddivider"></div><div class="bread">' .'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . '</div>';
      echo ' &raquo; ' . get_the_time('F') . '';
 
    } elseif ( is_year() ) {
      echo ' &raquo; ' . get_the_time('Y') . '';
 
    }
	elseif (is_page()) {	
		echo ' &raquo; ';
		echo ''.get_the_title().'';
	} 
	
}



?>