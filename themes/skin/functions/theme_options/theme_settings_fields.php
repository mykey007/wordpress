<?php
/* ------------------------------------------------------------------------ *
 * Field Callbacks
 * ------------------------------------------------------------------------ */ 


/* ------------------------------------------------------------------------ *
 * Checkbox
 * ------------------------------------------------------------------------ */  
	function tb_glisseo_checkbox_callback($args) {
		// Extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		// First, we read the options collection
		$options = get_option($section);
		
		// Next, we update the name attribute to access this element's ID in the context of the display options array
		// We also access the show_header element of the options collection in the call to the checked() helper function
		$html = '<input type="checkbox" id="' . $name . '" name="' . $section . '[' . $name . ']" value="1" ' . checked( 1, isset( $options[$name] ) ? $options[$name] : 0, false ) . '/>'; 
		
		// Here, we'll take the first argument of the array and add it to a label next to the checkbox
		$html .= '<label for="' . $name .'">&nbsp;'  . $desc . '</label>'; 
		
		echo $html;
		
	} // end tb_glisseo_checkbox_callback

/* ------------------------------------------------------------------------ *
 * Input URL
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_input_url_callback($args) {
		
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		$size = isset($args[3]) ? $args[3] : 300;
		
		// Then, we read the options collection
		$options = get_option( $section );
		
		// Next, we need to make sure the element is defined in the options. If not, we'll set an empty string.
		$url = '';
		if( isset( $options[$name] ) ) {
			$url = esc_url( $options[$name] );
		} // end if
		
		// Render the output
		echo '<input type="text" id="'. $name .'" name="' . $section . '[' . $name . ']" value="' . $url . '" style="width:' . $size . 'px"/>';
		echo '<br><span class="description">' . $desc . '</span>';
	} // end tb_glisseo_input_url_callback


/* ------------------------------------------------------------------------ *
 * Input
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_input_callback($args) {
		
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		$size = isset($args[3]) ? $args[3] : 300;
		
		$options = get_option( $section );
		
		// Render the output
		echo '<input type="text" id="' . $name . '" name="' . $section . '[' . $name . ']" value="' . $options[$name] . '" style="width:' . $size . 'px"/>';
		echo '<br><span class="description">' . $desc . '</span>';
	} // end tb_glisseo_input_element_callback


/* ------------------------------------------------------------------------ *
 * Textarea
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_textarea_callback($args) {
		
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		$options = get_option( $section );
		
		// Render the output
		echo '<textarea id="' . $name . '" name="' . $section . '[' . $name . ']" rows="5" cols="50">' . $options[$name] . '</textarea>';
		echo '<br><span class="description">' . $desc . '</span>';
		
	} // end tb_glisseo_textarea_callback


/* ------------------------------------------------------------------------ *
 * Radio
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_radio_callback($args) {
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		$boxes_array = $args[3];
		
		$options = get_option( $section );
		$boxcount=0;
		foreach($boxes_array as $value => $text){
			echo '<input type="radio" id="' . $name . $boxcount . '" name="' . $section . '[' . $name . ']" value="' . $value . '"' . checked( $value, $options[$name], false ) . '/>';
			echo '<label for="' . $name . '">&nbsp;&nbsp;' . $text . '</label><br>';
		}	
		echo '<br><span class="description">' . $desc . '</span>';
	} // end tb_glisseo_radio_callback

/* ------------------------------------------------------------------------ *
 * Select
 * ------------------------------------------------------------------------ */ 
	 function tb_glisseo_select_element_callback($args) {
	
		$options = get_option( 'tb_glisseo_theme_body_options' );
		
		$html = '<select id="time_options" name="tb_glisseo_theme_body_options[time_options]">';
			$html .= '<option value="default">Select a time option...</option>';
			$html .= '<option value="never"' . selected( $options['time_options'], 'never', false) . '>Never</option>';
			$html .= '<option value="sometimes"' . selected( $options['time_options'], 'sometimes', false) . '>Sometimes</option>';
			$html .= '<option value="always"' . selected( $options['time_options'], 'always', false) . '>Always</option>';
		$html .= '</select>';
		
		echo $html;
		echo '<br><span class="description">' . $desc . '</span>';

	} // end tb_glisseo_radio_element_callback

/* ------------------------------------------------------------------------ *
 * Color
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_color_callback($args) {
		
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		$options = get_option( $section );
		
		// Render the output
		echo '<input type="text" id="' . $name . '" class="color" name="' . $section . '[' . $name . ']" value="' . $options[$name] . '" style="width:70px"/>';
		echo '<br><span class="description">' . $desc . '</span>';
		
	} // end tb_glisseo_input_element_callback

/* ------------------------------------------------------------------------ *
 * Portfolio Builder
 * ------------------------------------------------------------------------ */ 
	 function tb_glisseo_portfolio_build_callback($args) {
		 // First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		$options = get_option( $section );
		
		//print_r($options);
		
		echo "
		<script>
			jQuery(document).ready(function(){
				jQuery('.repeatable-add').click(function() {
					field = jQuery(this).closest('div').find('.custom_repeatable li:last').clone(true);
					fieldLocation = jQuery(this).closest('div').find('.custom_repeatable li:last');
					jQuery('input,select', field).val('').attr('name', function(index, name) {
						return name.replace(/(\d+)/, function(fullMatch, n) {
							return Number(n) + 1;
						});
					})
					field.insertBefore(jQuery(this).closest('div').find('.inserthere'))
					jQuery('.slug', field).val('portfolio_'+Math.round(new Date().getTime() / 1000));
					return false;
				});
				jQuery('.repeatable-remove').click(function(){
					jQuery(this).parent().remove();
					return false;
				});
			});
		</script>";
		echo '<div><a class="repeatable-add button" href="#">Add Portfolio</a> 
            <ul id="'.$args[0].'-repeatable" class="custom_repeatable">';  
	    $i = 0;
	    $j = 1; 
	    
	    //print_r($options);
	    echo '<strong><div style="width:110px;float:left;">&nbsp;Portfolio Name</div><div style="width:150px;float:left;">&nbsp;&nbsp;Slug</div><div style="width:170px;float:left;">&nbsp;&nbsp;Page</div><div style="width:100px;float:left;">&nbsp;&nbsp;Style</div></strong><div style="clear:both;"></div>';
	    if (is_array($options) && !empty($options)) {  
	        foreach($options as $row) {
	        	if(($j%4)==0){
		            $html = '<select id="' . $name . 'Type" name="' . $section . '[' . $name . "_type-" . $i . ']"  style="width:100px">';
						$html .= '<option value="classic"' . selected( $row, 'classic', false) . '>Classic</option>';
						$html .= '<option value="lightbox"' . selected( $row, 'lightbox', false) . '>Lightbox</option>';
					$html .= '</select>';
		            echo $html . '&nbsp;<a class="repeatable-remove" href="#"><small>Remove Portfolio</small></a></li>';
	                $i++;
	                $j = 0;
	            }
	            else if(($j%3)==0){
		            echo '<select id="' . $name . 'Page" name="' . $section . '[' . $name . "_page-" . $i . ']"  style="width:170px">';
		            $pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'portfolio.php'
					));
					$content="";
					foreach($pages as $page){
						$selected = $page->ID == $row ? "selected" : "";
						$content .= "<option value='".$page->ID."' ".$selected.">";
				        $content .=  $page->post_title;
				    	$content .=  "</option>";
					}
					echo $content."</select>";
	            }
	            else if(($j%2)==0){
		            echo '<input type="text" id="' . $name . 'Slug" class="slug" name="' . $section . '[' . $name . "_slug-" . $i . ']" value="'.$row.'" style="width:150px" />';
	            }
	            else{
		            echo '<li><input type="text" id="' . $name . 'Name" name="' . $section . '[' . $name . "_name-" . $i . ']" value="'.$row.'" style="width:110px"/>';
	            }
	        	$j++;
	        }  
	    } else {  
	        echo '<li><input type="text" id="' . $name . '" name="' . $section . '[' . $name . "_name-" . $i . ']" value="" style="width:110px"/> 
	                    <input type="text" id="' . $name . 'Slug" class="slug" name="' . $section . '[' . $name . "_slug-" . $i . ']" value="portfolio_'.substr(rand()*8,0,10).'" style="width:150px"/>';
	         echo '<select id="' . $name . 'Page" name="' . $section . '[' . $name . "_page-" . $i . ']">';
		            $pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'portfolio.php'
					));
					if(is_array($pages)){
						foreach($pages as $page){
							$content .= "<option value='".$page->ID."'>";
					        $content .=  $page->post_title;
					    	$content .=  "</option>";
						}
					}
					else $content .= "<option value=''>Please create Page with Page Template 'Portfolio'</option>";
			echo $content . '</select><select id="' . $name . 'Type" name="' . $section . '[' . $name . "_type-" . $i . ']"><option value="classic">Classic Portfolio</option><option value="lightbox">Lightbox Portfolio</option></select> <a class="repeatable-remove button" href="#">-</a></li>';
	    }  
	    echo '<span class="inserthere"></span></ul> 
	        </div>'; 		
	} // end tb_glisseo_radio_element_callback

/* ------------------------------------------------------------------------ *
 * Sidebar Builder
 * ------------------------------------------------------------------------ */ 
	 function tb_glisseo_sidebar_build_callback($args) {
		 // First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		
		$options = get_option( $section );
		
		echo "
		<script>
			jQuery(document).ready(function(){
				jQuery('.repeatable-add').click(function() {
					field = jQuery(this).closest('div').find('.custom_repeatable li:last').clone(true);
					fieldLocation = jQuery(this).closest('div').find('.custom_repeatable li:last');
					jQuery('input,select', field).val('').attr('name', function(index, name) {
						return name.replace(/(\d+)/, function(fullMatch, n) {
							return Number(n) + 1;
						});
					})
					field.insertBefore(jQuery(this).closest('div').find('.inserthere'))
					jQuery('.slug', field).val('sidebar_'+Math.round(new Date().getTime() / 1000));
					return false;
				});
				jQuery('.repeatable-remove').click(function(){
					jQuery(this).parent().remove();
					return false;
				});
			});
		</script>";
		echo '<div><a class="repeatable-add button" href="#">Add Sidebar</a> 
            <ul id="'.$args[0].'-repeatable" class="custom_repeatable">';  
	    $i = 0;
	    $j = 1; 
	    
	    echo '<strong><div style="width:110px;float:left;">&nbsp;Sidebar Name</div></strong><div style="clear:both;"></div>';
	    if (is_array($options) && !empty($options)) {  
	        foreach($options as $row) {
	        	if($j%2==0){
	        		echo '<input type="hidden" id="' . $name . 'Slug" class="slug" name="' . $section . '[' . $name . "_slug-" . $i . ']" value="'.$row.'" style="width:150px;float:left;" />&nbsp;<a class="repeatable-remove" href="#"><small>Remove Sidebar</small></a></li>';
			    	$i++;
	                $j = 0;
		        }
		        else{
			        echo '<li><input type="text" id="' . $name . 'Name" name="' . $section . '[' . $name . "_name-" . $i . ']" value="'.$row.'" style="width:110px;float:left;"/>';
			    }
			    $j++;
	        }
	    } else {  
	        echo '<li><input type="text" id="' . $name . '" name="' . $section . '[' . $name . "_name-" . $i . ']" value="" style="width:110px"/> 
	                    <input type="hidden" id="' . $name . 'Slug" class="slug" name="' . $section . '[' . $name . "_slug-" . $i . ']" value="'.uniqid("portfolio_").'" style="width:150px"/></li>';
	    }  
	    echo '<span class="inserthere"></span></ul> 
	        </div><div style="clear:both"></div>'; 		
	} // end tb_glisseo_sidebar_callback

/* ------------------------------------------------------------------------ *
 * Image
 * ------------------------------------------------------------------------ */ 
	function tb_glisseo_image_callback($args) {
		
		// First, extract $args
		$name = $args[0];
		$section = $args[1];
		$desc = $args[2];
		
		$options = get_option( $section );
		
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
								formfield.val(imgurl);
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
		
		$image = get_template_directory_uri().'/style/images/icon-bullet.png';
		echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
		if ($options[$name]) { $image = $options[$name];}
		echo	'<input name="' . $section . '[' . $name . ']" type="hidden" class="custom_upload_image" value="'.$options[$name].'" />
					<img src="'.$image.'" class="custom_preview_image" alt="" style="max-width:300px" /><br />
						<input class="custom_upload_image_button button" type="button" value="Choose Image" />
						<small> <a href="#" class="custom_clear_image_button">Remove Image</a></small>
						<br clear="all" /><span class="description">'.$desc.'';
	} // end tb_glisseo_input_element_callback


?>