<?php
/*-----------------------------------------------------------------------------------

	Plugin Name: Latest Posts Widget Plugin
	Plugin URI: http://www.thunderbuddies.com
	Description: A widget that displays Latest Posts in a widget
	Version: 1.0
	Author: thunderbuddies
	Author URI: http://www.thunderbuddies.com

-----------------------------------------------------------------------------------*/	
	add_action( 'widgets_init', create_function('', 'return register_widget("tb_glisseoPosts");') );
	class tb_glisseoPosts extends WP_Widget {
		function tb_glisseoPosts() {
			$widget_ops = array('classname' => 'tb_glisseoPosts', 'description' => 'A popular/latest posts widget.');
	    	$this->WP_Widget('tb_glisseoPosts', 'Glisseo Popular/Latest Posts', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
	
	        <p><label for="<?php echo $this->get_field_id( 'postcount' ); ?>">Post Count:</label><br /><input type=text class="widefat" id="<?php echo $this->get_field_id( 'postcount' ); ?>" name="<?php echo $this->get_field_name( 'postcount' ); ?>" value="<?php if( isset($instance['postcount']) ) echo $instance['postcount']; ?>" /></p>
	        
	        <?php if( isset($instance['featuredimage']) ) $checked="checked";
	        	  else $checked = "";
	        ?>
	        <p><label for="<?php echo $this->get_field_id( 'featuredimage' ); ?>">Displayed in Sidebar</label><br /><input type=checkbox class="widefat" id="<?php echo $this->get_field_id( 'featuredimage' ); ?>" <?php echo $checked; ?> name="<?php echo $this->get_field_name( 'featuredimage' ); ?>" value="on" /></p>
	        
	        <p><label for="<?php echo $this->get_field_id( 'poplatest' ); ?>">Latest or Popular:</label><br />
	        <select class="widefat" id="<?php echo $this->get_field_id( 'poplatest' ); ?>" name="<?php echo $this->get_field_name( 'poplatest' ); ?>">
	        	<option value="1" <?php 
	        		if( isset($instance['poplatest']) && $instance['poplatest']== 1 ) {
	        			echo "selected"; 
	        		}
	        	?>>Latest Posts</option>
	        	<option value="2" <?php 
	        		if( isset($instance['poplatest']) && $instance['poplatest']== 2 ) {
	        			echo "selected"; 
	        		}
	        	?>>Popular Posts</option>
	        </select>
	        </p>	        
	        <p><p><label for="<?php echo $this->get_field_id( 'category' ); ?>">Show Posts from that Category:</label><br />
	        <select  class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>"> 
				 <option value=""><?php echo 'All Categories'; ?></option> 
				 <?php 
				  $categories=  get_categories(''); 
				  foreach ($categories as $category) {
				  	if(isset($instance['category']) && $instance['category']==$category->cat_ID) $selected = "selected";
				  	else $selected = "";
				  	$option = '<option value="'.$category->cat_ID.'" '.$selected.'>';
					$option .= $category->cat_name;
					$option .= ' ('.$category->category_count.')';
					$option .= '</option>';
					echo $option;
				  }
				 ?>
				</select></p>	
	<?php }
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			if ( isset($instance['postcount']) ) $pcount = $instance['postcount']; else $pcount = 2;
			if ( isset($instance['poplatest']) ) $platest = $instance['poplatest']; else $platest = 1;
			if ( isset($instance['category']) ) $cat_id = $instance['category']; else $cat_id = "";
				
			echo $before_widget;
			if ( $title ) echo $before_title . $title . $after_title;
			
			if($platest==1){
				$popargs = array( 'numberposts' => $pcount, 'orderby' => 'post_date', 'category' => $cat_id );
			}else{
				$popargs = array( 'numberposts' => $pcount, 'orderby' => 'comment_count', 'category' => $cat_id );
			}
			$unique = uniqid();
			$poplist = get_posts( $popargs );
			if ( !isset($instance['featuredimage']) ) echo '<ul class="post-list">';
			else echo '<ul class="posts-list">';
			foreach ($poplist as $poppost) :  setup_postdata($poppost);
				if ( !isset($instance['featuredimage']) ){
	           	    echo '<li>	
							<h4>
								<a class="posttitle" href="'.get_permalink($poppost->ID).'">'.$poppost->post_title.'</a>	
							</h4>
							<div class="meta">'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</div>
						</li>';
				}
				else{
					echo '<li>	
							<div class="featured"><a href="'.get_permalink($poppost->ID).'"><img src="' . aq_resize(wp_get_attachment_url( get_post_thumbnail_id($poppost->ID) ),70,70,true) . '" alt="" /></a></div>
							<div class="meta">
				            	<h6><a href="'.get_permalink($poppost->ID).'">'.$poppost->post_title.'</a></h6>
				            	<em>'.date_i18n(get_option('date_format'), strtotime($poppost->post_date_gmt)).'</em>
				            </div> 
						</li>';
				}
	      endforeach;
	      	echo '</ul>';
	
			echo $after_widget;
		}
	
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['postcount'] = $new_instance['postcount'];
			$instance['poplatest'] = $new_instance['poplatest'];
			$instance['category'] = $new_instance['category'];
			$instance['featuredimage'] = $new_instance['featuredimage'];
			return $instance;
		}
	}

/*-----------------------------------------------------------------------------------

	Plugin Name: Twitter Widget Plugin
	Plugin URI: http://www.thunderbuddies.com
	Description: A widget that displays a twitter feed
	Version: 1.0
	Author: thunderbuddies
	Author URI: http://www.thunderbuddies.com

-----------------------------------------------------------------------------------*/
	add_action( 'widgets_init', create_function('', 'return register_widget("tb_glisseoTwitterfeed");') );	
	class tb_glisseoTwitterfeed extends WP_Widget {

	function tb_glisseoTwitterfeed() {
		$widget_ops = array('classname' => 'tb_glisseoTwitterfeed', 'description' => 'Twitter Feed Widget');
    	$this->WP_Widget('tb_glisseoTwitterfeed', 'Glisseo Twitter Feed', $widget_ops);
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance ); ?>
        
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
        
        <p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Twitter User Name:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php if( isset($instance['username']) ) echo $instance['username']; ?>" /></p> 
        
        <p><label for="<?php echo $this->get_field_id( 'feedcount' ); ?>">Feed Count:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'feedcount' ); ?>" name="<?php echo $this->get_field_name( 'feedcount' ); ?>" value="<?php if( isset($instance['feedcount']) ) echo $instance['feedcount']; ?>" /></p> 
        
	<?php
	}

	function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			$user = $instance['username'];
			$feeds = $instance['feedcount'];
			$uniqid = uniqid("tw_");
			echo $before_widget;
			
		   	if ( $title ) echo $before_title . $title . $after_title;
			echo '<div id="twitter-wrapper"><div class="twitter" id="twitter_'.$uniqid.'"></div><span class="username"><a href="http://twitter.com/'.$user.'">→ Follow @'.$user.'</a></span></div>';
			echo "<script>jQuery(document).ready(function(){
					getTwitters('twitter_$uniqid', {
								id: '$user',
								count: $feeds,
								enableLinks: true,
								ignoreReplies: false,
								template: '<span class=\"twitterPrefix\"><span class=\"twitterStatus\">%text%</span><br /><em class=\"twitterTime\"><a href=\"http://twitter.com/%user_screen_name%/statuses/%id%\">%time%</a></em>',
								newwindow: true
					});
				});</script>";
			echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['username'] = $new_instance['username'];
		$instance['feedcount'] = $new_instance['feedcount'];
		return $instance;
	}
}
/*-----------------------------------------------------------------------------------

	Plugin Name: Shortcode Widget Plugin
	Plugin URI: http://www.thunderbuddies.com
	Description: A widget that displays all shortcodes in a widget
	Version: 1.0
	Author: thunderbuddies
	Author URI: http://www.thunderbuddies.com

-----------------------------------------------------------------------------------*/	
	add_action( 'widgets_init', create_function('', 'return register_widget("tb_glisseoShortcodes");') );
	class tb_glisseoShortcodes extends WP_Widget {
	
		function tb_glisseoShortcodes() {
			$widget_ops = array('classname' => 'tb_glisseoShortcodes', 'description' => 'A sidebar shortcode widget. Please enter the HTML with Shortcodes in the corresponding textarea.');
	    	$this->WP_Widget('tb_glisseoShortcodes', 'Glisseo Shortcodes HTML Text', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	
			<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>
			
	        <p><label for="<?php echo $this->get_field_id( 'text' ); ?>">HTML with Shortcodes Text</label><br /><textarea class="widefat" style="height:150px;" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php if( isset($instance['text']) ) echo $instance['text']; ?></textarea></p>  
		<?php
		}
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];
			$text = $instance['text'];
			
			echo $before_widget;
			
		   	if ( $title ) echo $before_title . $title . $after_title;
			echo do_shortcode($text);
			echo $after_widget;
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['text'] = $new_instance['text'];
			return $instance;
		}
	}

	
	/*-----------------------------------------------------------------------------------

	Plugin Name: Social Buttons Widget Plugin
	Plugin URI: http://www.thunderbuddies.com
	Description: A widget that displays a simple list of social profile icons
	Version: 1.0
	Author: thunderbuddies
	Author URI: http://www.thunderbuddies.com

-----------------------------------------------------------------------------------*/	
	add_action( 'widgets_init', create_function('', 'return register_widget("tb_glisseoSocials");') );
	class tb_glisseoSocials extends WP_Widget {
	
		function tb_glisseoSocials() {
			$widget_ops = array('classname' => 'tb_glisseoSocials', 'description' => 'Simple list of Social Profile icons');
	    	$this->WP_Widget('tb_glisseoSocials', 'Glisseo Socials Widget', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
	        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" type="text" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" />
	        <label>Socials:</label><hr><br>
		    <div>
		        <div style="display:none;">
		        	<select class="widefat" data-name="<?php echo $this->get_field_name( 'socialicon' ); ?>[]">
			        	<option value="dribbble">Dribbble</option>
			        	<option value="facebook">Facebook</option>
			        	<option value="flickr">Flickr</option>
			        	<option value="forrst">Forrst</option>
			        	<option value="google">Google</option>
			        	<option value="lastfm">LastFM</option>
			        	<option value="linkedin">LinkedIn</option>
			        	<option value="pinterest">Pinterest</option>
			        	<option value="rss">RSS</option>
			        	<option value="skype">Skype</option>
			        	<option value="tumblr">Tumblr</option>
			        	<option value="twitter">Twitter</option>
			        	<option value="vimeo">Vimeo</option>
			        	<option value="youtube">Youtube</option>
			        </select>
			        <label for="<?php echo $this->get_field_name( 'link' ); ?>[]">URL Link:</label>
			        <input type="text" class="widefat" data-name="<?php echo $this->get_field_name( 'link' ); ?>[]"/>
			        <br><a href="#" class="tb_glisseo_delete_social">Delete Social</a>
		        </div>
		        <?php 
		        	$social_count=0;
		        	$social_selected="";
		        	$uniq = uniqid();
		        	if(isset($instance['socialicon'])){
			        	foreach($instance['socialicon'] as $socialicon){
				        	if(!empty($socialicon))
				        		echo '<div><select class="widefat" name="'.$this->get_field_name( 'socialicon' ).'[]">';
				        		if($socialicon=="dribbble") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="dribbble" '.$social_selected.'>Dribbble</option>';
						        
						        if($socialicon=="facebook") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="facebook" '.$social_selected.'>Facebook</option>';
						        
						        if($socialicon=="flickr") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="flickr" '.$social_selected.'>Flickr</option>';
						        
						        if($socialicon=="forrst") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="forrst" '.$social_selected.'>Forrst</option>';
						        
						        if($socialicon=="google") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="google" '.$social_selected.'>Google</option>';
						        
						        if($socialicon=="lastfm") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="lastfm" '.$social_selected.'>LastFM</option>';
						        
						        if($socialicon=="linkedin") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="linkedin" '.$social_selected.'>LinkedIn</option>';
						        
						        if($socialicon=="pinterest") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="pinterest" '.$social_selected.'>Pinterest</option>';
						        
						        if($socialicon=="rss") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="rss" '.$social_selected.'>RSS</option>';
						        
						        if($socialicon=="skype") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="skype" '.$social_selected.'>Skype</option>';
						        
						        if($socialicon=="tumblr") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="tumblr" '.$social_selected.'>Tumblr</option>';
						        
						        if($socialicon=="twitter") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="twitter" '.$social_selected.'>Twitter</option>';
						        
						        if($socialicon=="vimeo") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="vimeo" '.$social_selected.'>Vimeo</option>';
						        
						        if($socialicon=="youtube") $social_selected="selected"; else $social_selected ="";
						        echo '<option value="youtube" '.$social_selected.'>Youtube</option>
						        </select>';
						        
						        $link = "";
						        if( isset($instance['link'][$social_count]) ) $link = $instance['link'][$social_count++]; 
						        echo '<label for="'.$this->get_field_name( 'link' ).'">URL Link:</label><input type="text" class="widefat" name="'.$this->get_field_name( 'link' ).'[]" value="'.$link.'" />';

						        echo '<br><a href="#" class="tb_glisseo_delete_social">Delete Social</a></div><br>';
			        	}
			        }?>
	        	<span></span>
	        	<br><hr><a href='#' class="tb_glisseo_add_social_<?php echo $uniq;?>">Add Social</a>
	        </div>
	        
	        <script>
		       
		        	jQuery(".tb_glisseo_add_social_<?php echo $uniq;?>").live("click",function(){
		        		$parent = jQuery(this).closest("div");
		        		$field = $parent.find("div:first").clone(true);
			        	$field.find("select,input").each(function(){
				        	$this = jQuery(this);
				        	$this.attr("name",$this.data("name"));
				        	});
			        	$field.css("display","");
			        	$parent.find("span").before($field);
			        	return false;
			        });
		        	jQuery(".tb_glisseo_delete_social").live("click",function(){
			        	jQuery(this).closest("div").remove();	
			        	return false;
		        	});

	        </script>
	    <?php
		}
		
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			$instance['socialicon'] = $new_instance['socialicon'];
			$instance['link'] = $new_instance['link'];

			return $instance;
		}
	
		function widget( $args, $instance ) {
			extract( $args );
	
			$title = apply_filters('widget_title', $instance['title'] );
			if ( isset($instance['id']) ) $id = $instance['id'];

						
			echo $before_widget;
		   	if ( !empty($title) ) echo $before_title . $title . $after_title;
			echo '<ul class="social">';
				$social_count = 0;
				foreach($instance['socialicon'] as $class){
					echo '<li><a class="'.$class.'" href="'.$instance['link'][$social_count++].'"></a></li>';
				}
			echo '</ul>';	
		}
	}
	
	/*-----------------------------------------------------------------------------------

	Plugin Name: Taglist Widget Plugin
	Plugin URI: http://www.thunderbuddies.com
	Description: A widget that displays a list of tags
	Version: 1.0
	Author: thunderbuddies
	Author URI: http://www.thunderbuddies.com
	-----------------------------------------------------------------------------------*/
		add_action( 'widgets_init', create_function('', 'return register_widget("tb_glisseoTaglist");') );	
		class tb_glisseoTaglist extends WP_Widget {
	
		function tb_glisseoTaglist() {
			$widget_ops = array('classname' => 'tb_glisseoTaglist', 'description' => 'Taglist Widget');
	    	$this->WP_Widget('tb_glisseoTaglist', 'Glisseo Taglist', $widget_ops);
		}
		
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance ); ?>
	        
	        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br /><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( isset($instance['title']) ) echo $instance['title']; ?>" /></p>	        
		<?php
		}
	
		function widget( $args, $instance ) {
				extract( $args );
		
				$title = apply_filters('widget_title', $instance['title'] );
				if ( isset($instance['id']) ) $id = $instance['id'];
				$user = $instance['username'];
				$feeds = $instance['feedcount'];
				$uniqid = uniqid("tw_");
				echo $before_widget;
				
			   	if ( $title ) echo $before_title . $title . $after_title;
			   	echo '<ul class="tag-list">';
			   	wp_get_all_tags();
			   	echo '</ul>';
				echo $after_widget;
		}
	
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			return $instance;
		}
	}
	
	
	
	
?>