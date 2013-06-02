<?php
	// use page meta fields if page
function show_custom_page_meta_box(){
	global $custom_page_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_meta_fields;
	show_custom_meta_box();
}

function show_custom_page_video_meta_box(){
	global $custom_page_video_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_video_meta_fields;
	show_custom_meta_box();
}

function show_custom_page_gallery_meta_box(){
	global $custom_page_gallery_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_page_gallery_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_meta_box(){
	global $custom_post_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_meta_fields;
	show_custom_meta_box();
}

// use post meta fields if post
function show_custom_post_type_meta_box(){
	global $custom_post_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_type_meta_fields;
	show_custom_meta_box();
}

function show_custom_portfolio_meta_box(){
	global $custom_portfolio_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_portfolio_meta_fields;
	show_custom_meta_box();
}

function show_custom_post_portfolio_type_meta_fields(){
	global $custom_post_portfolio_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_portfolio_type_meta_fields;
	show_custom_meta_box();
}

function show_custom_post_video_type_meta_fields(){
	global $custom_post_video_type_meta_fields,$custom_meta_fields;
	$custom_meta_fields=$custom_post_video_type_meta_fields;
	show_custom_meta_box();
}

// add some custom js to the head of the page
function add_custom_scripts() {
	global $custom_meta_fields, $post;
	$output = '<style>
				#page-video-options , #page-gallery-options, .tp_options {display:none;}
			</style>';
	//if(isset($_GET["post"]) && !isset($_GET['type']) ||  isset($_GET['post_type'])){
		wp_enqueue_script('custom-js', get_template_directory_uri() . '/functions/page_options/page-options.js');
		echo $output;
	//}
}
add_action('edit_page_form','add_custom_scripts');
add_action('edit_form_advanced','add_custom_scripts');

// The Callback
function show_custom_meta_box() {
	global $custom_meta_fields,$post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table padding=20 class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		$field['class'] = isset($field['class']) ? $field['class'] : "";
		echo '<tr class="'.$field['class'].'" >
				<td style="margin-bottom:20px;"><strong><label for="'.$field['id'].'">'.$field['label'].'</label></strong><br>
				';
				switch($field['type']) {
			//Description
					case 'desc':
						//echo '<span class="description">'.$field['desc'].'</span>';
					break;
			//Text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" style="width:100%;max-width:500px" /><br>';
					break;
			
			//Textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4" style="width:100%;max-width:500px">'.$meta.'</textarea><br>';
					break;
			
			//Checkbox
					case 'checkbox':
						echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
								<label for="'.$field['id'].'">'.$field['text'].'</label><br>';
					break;
			
			//Select
					case 'select':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {
							echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select>';
					break;
			//Radio
					case 'radio':
						foreach ( $field['options'] as $option ) {
							if ($meta=="") $meta=$field['default'];
							echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id']."_".$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
					break;
			
			//Posttype
					case 'posttype':
						foreach ( $field['options'] as $option ) {
							if ($meta=="") $meta=$field['default'];
							echo '<input type="radio" name="'.$field['id'].'" id="'.$field['id']."_".$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
					break;
			
			//Checkbox_group
					case 'checkbox_group':
						foreach ($field['options'] as $option) {
							echo '<td valign="top"><input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
									<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
						}
						echo '</td><td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
			
			//Tax_select
					case 'tax_select':
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
						$terms = get_terms($field['id'], 'get=all');
						$selected = wp_get_object_terms($post->ID, $field['id']);
						foreach ($terms as $term) {
							if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
								echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
							else
								echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
						}
						$taxonomy = get_taxonomy($field['id']);
						echo '</select></td>
						<td width="200px" valign="top"><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span></td>';
					break;
			
			//Post_list
					case 'post_list':
					$items = get_posts( array (
						'post_type'	=> $field['post_type'],
						'posts_per_page' => -1
					));
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">
								<option value="">Select One</option>'; // Select One
							foreach($items as $item) {
								echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
							} // end foreach
						echo '</select></td>
							<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
			
			//Sidebars
					case 'sidebar_list':
						global $wp_registered_sidebars;
					    if( empty( $wp_registered_sidebars ) )
					        return;
					    $name = $field['id'];
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo "<select name='$name'><option value='nosidebar'>No Sidebar</option>";
					    foreach( $wp_registered_sidebars as $sidebar ) : 
					        if( $current ) 
					            if($sidebar['name'] == $current)
					            	$selected = "selected";
					            else 
					            	$selected = "";
					        echo "<option value='".$sidebar['name']."' $selected>";
					        echo $sidebar['name'];
					    	echo "</option>";
					    endforeach;
					    echo "</select><br>";
					break;  
					case 'menu_list':
						$menus = get_terms('nav_menu');
						$name = $field['id'];
					    $current = ( $meta ) ? esc_attr( $meta ) : false;     
					    $selected = '';
					    echo "<td valign='top'><select name='$name'>";
					    echo "<!--option value=''>No Menu</option--><option value=''>Default Menu</option>";
					    foreach($menus as $menu) : 
					        if( $current ) 
					            if($menu->slug == $current)
					            	$selected = "selected";
					            else 
					            	$selected = "";
					        echo "<option value='".$menu->slug."' $selected>";
					        echo $menu->name;
					    	echo "</option>";
					    endforeach;
					    echo "</select></td>";
						echo '<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
					case 'slider_list':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                		
                		global $wpdb;
                		global $table_prefix;
                		$table_prefix = $wpdb->base_prefix;
                		
                		if (!isset($wpdb->tablename)) {
							$wpdb->tablename = $table_prefix . 'revslider_sliders';
						}
                		$revolution_sliders = $wpdb->get_results( 
							"
							SELECT title,alias 
							FROM $wpdb->tablename
							"
						);
					foreach ( $revolution_sliders as $revolution_slider ) 
					{
						$checked="";
            		 	if($revolution_slider->alias==$meta) $checked="selected";
            		 	echo "<option value='$revolution_slider->alias' $checked>".$revolution_slider->title."</option>";
					}
                	echo '</select><br>';
					break;
			
			//Portfolio List
					case 'portfolio_list':
						echo '<td valign="top"><select name="'.$field['id'].'" id="'.$field['id'].'">';
                		
                		$portfolio_slugs = get_registered_post_types(); 
	
						if(is_array($portfolio_slugs))
							foreach ( $portfolio_slugs as $slug ){
								if(strstr($slug,"portfolio_") !== false){
									$obj = get_post_type_object($slug);
									$name = $obj->labels->singular_name;
									$checked="";
									if($slug==$meta) $checked="selected";
							    	echo '<option value="'.$slug.'" '.$checked.'>'.str_replace("'","",str_replace("Portfolio '","",$name)).'</option>'; 
							    }
							}
                       		echo '</select>';
					break;
			
			//Date
					case 'date':
						echo '<td valign="top"><input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" /></td>
								<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
					
			//Video Categories
					case 'video_category_list':
						echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" size="5" style="height:100px;width:100%" multiple>';
						$selected = in_array("all",$meta) ? 'selected' : '';
						echo '<option value="all" '.$selected.'>All</option>';
                		$tax_terms = get_terms("category_video");
						foreach($tax_terms as $tax_term){	
							$selected = in_array($tax_term->slug,$meta) ? 'selected' : '';
							echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
						}
	                    echo '</select>';
					break;
					
			//Gallery Categories
					case 'gallery_category_list':
						if(!is_array($meta)) $meta = array();
						echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'" size="5" style="height:100px;width:100%;" multiple>';
						$selected = in_array("all",$meta) ? 'selected' : '';
						echo '<option value="all" '.$selected.'>All</option>';
                		$tax_terms = get_terms("category_gallery");
						foreach($tax_terms as $tax_term){	
							$selected = in_array($tax_term->slug,$meta) ? 'selected' : '';
							echo "<option value='$tax_term->slug' $selected >$tax_term->name</option>"; 
						}
	                    echo '</select>';
					break;		
					
			//Slider
					case 'slider':
					$value = $meta != '' ? $meta : '0';
						echo '<td valign="top"><div id="'.$field['id'].'-slider"></div>
								<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" /></td>
								<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
				
			//Image
					case 'image':
						$image_def = get_template_directory_uri().'/style/images/icon-bullet.png';	
						if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }	
						else {$image = $image_def;}			
						echo	'<div><span class="custom_default_image" style="display:none">'.$image_def.'</span><input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
									<img style="max-width:100%;box-sizing:border-box;" src="'.$image.'" class="custom_preview_image" alt="" /><br />
										<input class="custom_upload_image_button button" type="button" value="Choose Image" />
										<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
										<br clear="all" /></div>';
					break;
				
			//Repeatable
					case 'repeatable':
						echo '<td valign="top"><a class="repeatable-add button" href="#">+</a>
								<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
						$i = 0;
						if ($meta) {
							foreach($meta as $row) {
								echo '<li><span class="sort hndle">|||</span>
											<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
											<a class="repeatable-remove button" href="#">-</a></li>';
								$i++;
							}
						} else {
							echo '<li><span class="sort hndle">|||</span>
										<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
										<a class="repeatable-remove button" href="#">-</a></li>';
						}
						echo '</ul></td>
							<td width="200px" valign="top"><span class="description">'.$field['desc'].'</span></td>';
					break;
				} //end switch
		echo '<span class="description">'.$field['desc'].'</span><br></td></tr>';
	} // end foreach
	//echo '<tr><td colspan=3 align="right"><input name="save" type="button" class="button-primary tp_publish_buttons" id="mypublish" accesskey="p" value=""></td></tr>';
	echo '</table>'; // end table
}

function remove_taxonomy_boxes() {
	remove_meta_box('categorydiv', 'post', 'side');
}
//add_action( 'admin_menu' , 'remove_taxonomy_boxes' );

// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields,$custom_post_portfolio_type_meta_fields,$custom_post_video_type_meta_fields,$custom_page_video_meta_fields,$custom_page_gallery_meta_fields,$custom_page_meta_fields,$custom_post_meta_fields,$custom_portfolio_meta_fields,$custom_post_type_meta_fields;
    if(isset($_POST['post_type'])){
	    // which fields to use
	    if ('page' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_page_meta_fields,$custom_page_video_meta_fields,$custom_page_gallery_meta_fields);
		}
		if ('post' == $_POST['post_type']) {
			$custom_meta_fields = array_merge($custom_post_meta_fields,$custom_post_type_meta_fields);
		}

		$portfolio_slugs = get_registered_post_types();
		if (is_array($portfolio_slugs) && in_array($_POST['post_type'], $portfolio_slugs) && strstr($_POST['post_type'],"portfolio_") !== false) {
			$custom_meta_fields = array_merge($custom_portfolio_meta_fields,$custom_post_portfolio_type_meta_fields);
		}

		if ('video' == $_POST['post_type']) {
			$custom_meta_fields = $custom_post_video_type_meta_fields;
		}

		// verify nonce
		if(isset($_POST['custom_meta_box_nonce'])){
			if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
				return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
			return $post_id;
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id))
				return $post_id;
			} elseif (!current_user_can('edit_post', $post_id)) {
				return $post_id;
		}

		// loop through fields and save the data
		foreach ($custom_meta_fields as $field) {
			if($field['type'] == 'tax_select') continue;

				$old = get_post_meta($post_id, $field['id'], true);
				
				if(isset($_POST[$field['id']]))
					$new = $_POST[$field['id']];
				else $new = "";
				
							
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		} // end foreach
		// save taxonomies
		//$post = get_post($post_id);
		//$category = $_POST['category'];
		//wp_set_object_terms( $post_id, $category, 'category' );
	}
}
add_action('save_post', 'save_custom_meta');
?>