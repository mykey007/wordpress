<?php 
//Basics & WordPress Standards
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];
		require_once( $path_to_wp.'/wp-load.php' );
		require_once( $path_to_wp.'/wp-includes/functions.php');

?>
// closure to avoid namespace collision
(function(){
		tinymce.create('tinymce.plugins.thundercodes', {
	    createControl: function(n, cm) {
	        switch (n) {
	            case 'thundercodes_button':
	                var c = cm.createSplitButton('thundercodes_button', {
	                    title : 'ThunderCodes',
	                    image : '<?php echo $_GET["dir"]; ?>/style/images/thunder_icon.png',
	                    
	                });
	
	                c.onRenderMenu.add(function(c, m) {
	                    m.add({title : 'ThunderCodes', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
	
	                    m.add({title : 'Button', onclick : function() {
	                    	callshortcode("button");
	                    }});
	
	                    m.add({title : 'Intro Text', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[intro]YOUR_TEXT_HERE[/intro]');                    
	                    }});
	                    
	                    m.add({title : 'Divider', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[divider]');                    
	                    }});
	                    
	                    m.add({title : 'Dropcap', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[dropcap]C[/dropcap]');                    
	                    }});
	                    
	                    m.add({title : 'Box', onclick : function() {
	                    	callshortcode("box");
	                    }});
	                    
	                    m.add({title : 'Highlight', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[highlight]YOUR_HIGHLIGHTED_TEXT[/highlight]');   
	                    }});
	                    
	                    m.add({title : 'Codebox', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[codebox]YOUR_CODE[/codebox]');   
	                    }});
	                    
	                    m.add({title : 'Sup Text', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[sup]YOUR_SUP_TEXT[/sup]');   
	                    }});
	                    
	                    m.add({title : 'Sub Text', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[sub]YOUR_SUB_TEXT[/sub]');   
	                    }});
	                    
	                    m.add({title : 'Cite Text', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cite]YOUR_CITE_TEXT[/cite]');   
	                    }});
	                   
	                    m.add({title : 'Abbr Text', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[abbr title="abbr explanation"]YOUR_ABBR_TEXT[/abbr]');   
	                    }});
	                    
	                    m.add({title : 'HeadSubline', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[headsubline subline="YOUR_SUBLINE_TEXT"]>YOUR_HEADLINE_TEXT[/headsubline]');                    
	                    }});
	                    
	                    m.add({title : 'Latest Posts', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[latest_posts number="2"]');   
	                    }});
	                    
	                    m.add({title : 'Latest Projects', onclick : function() {
	                    	callshortcode("projects");
	                    }});
	                    
	                    m.add({title : 'Tabs', onclick : function() {
	                    	callshortcode("tabs");
	                    }});
	                    
	                    m.add({title : 'Toggle', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[toggle title="YOUR_TOGGLE_TITLE"]YOUR_TOGGLE_CONTENT[/toggle]');   
	                    }});
	                    
	                    m.add({title : 'Socialbar', onclick : function() {
	                    	callshortcode("socialbar");
	                    }});

	                });
	
	              // Return the new splitbutton instance
	              return c;
	        }
	
	        return null;
	    }
	});	
	
	
	
	tinymce.PluginManager.add('thundercodes', tinymce.plugins.thundercodes);

	
	function callshortcode(thundershortcode){
		switch (thundershortcode) {
		    case "button": 
		    				var form = jQuery('<div id="thundercodes-form" class="thundercodes-form"><table id="thundercodes-table" class="form-table">\
										<?php thundercodes_input('link','Link','#','The link a button sends you when clicking');?>
										<?php thundercodes_input('target','Target','_self','Where should the link be opened?');?>
										<?php thundercodes_select('hover','Hover Color',array('highlight','blue','rose','gray','lime','pink','orange','red','yellow','aqua','brown','purple'),'Select the hover Color');?>
										<?php thundercodes_input('content','Text','Button','Text on the button');?>
										</table>\
										<p class="submit">\
											<input type="button" id="thundercodes-submit" class="button-primary" value="Insert Button" name="submit" onclick="submitForm()" />\
										</p>\
									</div>');
							thunder_options = Array("link","target","hover"); 
							thunder_shortcode = "[button {{link}} {{target}} {{hover}}]YOUR_BUTTON_TEXT[/button]";
							H = 294;
		    	break;	
		    
		    case "box": 
		    				var form = jQuery('<div id="thundercodes-form" class="thundercodes-form"><table id="thundercodes-table" class="form-table">\
										<?php thundercodes_select('style','Style',array('info','download','warning','note'),'Define the display style of the Box');?>
										</table>\
										<p class="submit">\
											<input type="button" id="thundercodes-submit" class="button-primary" value="Insert Box" name="submit" onclick="submitForm()" />\
										</p>\
									</div>');
							thunder_options = Array("style"); 
							thunder_shortcode = "[box {{style}}]YOUR_BOX_TEXT[/box]";
							H = 110;
		    	break;	
		    	
		    case "projects": 
		    				var form = jQuery('<div id="thundercodes-form" class="thundercodes-form"><table id="thundercodes-table" class="form-table">\
										<?php thundercodes_portfolio_select('portfolioslug','Portfolio','Choose the Portfolio to Display');?>
										<?php thundercodes_input('number','Number','2','How many Portfolio items do you want to display?');?>
										</table>\
										<p class="submit">\
											<input type="button" id="thundercodes-submit" class="button-primary" value="Insert Latest Projects" name="submit" onclick="submitForm()" />\
										</p>\
									</div>');
							thunder_options = Array("number","portfolioslug"); 
							thunder_shortcode = "[latest_projects {{number}} {{portfolioslug}}]";
							H = 170;
		    	break;	
		    case "tabs": 
		    				var form = jQuery('<div id="thundercodes-form" class="thundercodes-form"><table id="thundercodes-table" class="form-table">\
										<?php thundercodes_input('number','Number of Tabs','3','How many Tabs?');?>
										<?php thundercodes_select('align','Tabs Align',array('left','center'),'Display the tabs bound to the left or centered');?>
										</table>\
										<p class="submit">\
											<input type="button" id="thundercodes-submit" class="button-primary" value="Insert Tabs" name="submit" onclick="submitTabsForm()" />\
										</p>\
									</div>');
							thunder_options = Array("number"); 
							thunder_shortcode = "{{tabs}}";
							H = 110;
		    	break;	
		    case "socialbar": 
		    				var form = jQuery('<div id="thundercodes-form" class="thundercodes-form"><table id="thundercodes-table" class="form-table">\
										<?php thundercodes_socials('Socials');?>
										</table>\
										<p class="submit">\
											<input type="button" id="thundercodes-submit" class="button-primary" value="Insert Socialbar" name="submit" onclick="submitSocialsForm()" />\
										</p>\
									</div>');
							thunder_options = Array("number"); 
							thunder_shortcode = "[socialbar{{socials}}]";
							H = 350;
		    	break;	
		}
			
		jQuery(".thundercodes-form").remove();							
		var table = form.find('#thundercodes-table');
		form.appendTo('body').hide();
    
        // triggers the thickbox
		//var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
		var width = jQuery(window).width(), W = ( 720 < width ) ? 720 : width;
		W = W - 80;
		//H = H - 84;
		tb_show( 'ThunderCodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=thundercodes-form' );
		jQuery("#TB_window").css("height",H+65);
		jQuery("#TB_window").css("overflow-y","auto");
		jQuery("#TB_window").css("overflow-x","hidden");

		// handles the click event of the submit button
		//form.find('#thundercodes-submit').click(function(){
	}

	jQuery(".tb_glisseo_add_social").live("click",function(){
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

})()
	var thunder_options;
	var thunder_shortcode;
	
	function submitForm(){
			for(index in thunder_options){
				var value = jQuery("#thundercodes-table").find('#thundercodes-' + thunder_options[index]).val();
				// attaches the attribute to the shortcode only if it's different from the default value
				//if ( value !== options[index] )
				if(value!="")
					thunder_shortcode = thunder_shortcode.replace( "{{"+thunder_options[index]+"}}" , thunder_options[index] + '="'+ value +'"');
				else 
					thunder_shortcode = thunder_shortcode.replace( "{{"+thunder_options[index]+"}}" , "");
			};
			/*value = jQuery("#thundercodes-table").find('#thundercodes-content').val();
			if(value!="")	
				thunder_shortcode = thunder_shortcode.replace( "{{content}}" , value);
			else 
				thunder_shortcode = thunder_shortcode.replace( "{{content}}" , '');
			*/			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, thunder_shortcode);
			
			// closes Thickbox
			tb_remove();
	}
	
	function submitTabsForm(){
			var number = jQuery("#thundercodes-table").find('#thundercodes-number').val();
			var align = jQuery("#thundercodes-table").find('#thundercodes-align').val();	
			var tabs = "";	
			for (i=1; i <= number; i++ ){
				tabs += '[tab title="Tab Title '+i+'"]Tab Content '+i+'[/tab]';
			}
			thunder_shortcode = '[tabs align="' +align+'"]' +thunder_shortcode+ '[/tabs]';
			thunder_shortcode = thunder_shortcode.replace( "{{tabs}}" , tabs);
			
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, thunder_shortcode);
			
			// closes Thickbox
			tb_remove();
	}
	
	function submitSocialsForm(){
			socials = "";
			jQuery(".thesocials").each(function(){
				$this = jQuery(this);
				network = $this.find("select").val();
				link = $this.find("input").val();
				if(link!="")
					socials += ' ' + network + '=' + '"' + link + '"';
			});
			
			thunder_shortcode = thunder_shortcode.replace( "{{socials}}" , socials);
			
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, thunder_shortcode);
			
			// closes Thickbox
			tb_remove();
	}
	
<?php 
	function thundercodes_input($id,$label,$default,$description){
		echo '<tr>\
				<th><label for="thundercodes-'.$id.'">'.$label.'</label></th>\
				<td><input type="text" id="thundercodes-'.$id.'" name="'.$id.'" value="'.$default.'" /><br />\
				<small>'.$description.'</small></td>\
			</tr>\
		';
	}
	
	function thundercodes_select($id,$label,$options,$description){
		echo '<tr>\
				<th><label for="thundercodes-'.$id.'">'.$label.'</label></th>\
				<td><select name="'.$id.'" id="thundercodes-'.$id.'">\ ';
		for($i=0;$i<sizeOf($options);$i++){
			echo '<option value="'.$options[$i].'">'.$options[$i].'</option>';
		}
			
		echo '		</select><br />\
				<small>'.$description.'</small></td>\
			</tr>\
		';
	}
	
	function thundercodes_portfolio_select($id,$label,$description){
		echo '<tr>\
				<th><label for="thundercodes-'.$id.'">'.$label.'</label></th>\
				<td><select name="'.$id.'" id="thundercodes-'.$id.'">\ ';

		$portfolio_slugs = get_registered_post_types(); 
	
		if(is_array($portfolio_slugs))
			foreach ( $portfolio_slugs as $slug ){
				if(strstr($slug,"portfolio_") !== false){
					$obj = get_post_type_object($slug);
					$name = $obj->labels->singular_name;
			    	echo '<option value="'.$slug.'">'.str_replace("'","",str_replace("Portfolio '","",$name)).'</option>'; 
			    }
			}
		
		echo '		</select><br />\
				<small>'.$description.'</small></td> \
			</tr>\ ';
	}	
	
	function thundercodes_socials($label){
		echo '<tr>\
				<th><label for="thundercodes-socials">'.$label.'</label></th>\
				<td>\
				<div>\
			        <div style="display:none;">\
			        	<br><div class="thesocials"><select class="widefat">\
				        	<option value="dribbble">Dribbble</option>\
				        	<option value="facebook">Facebook</option>\
				        	<option value="flickr">Flickr</option>\
				        	<option value="forrst">Forrst</option>\
				        	<option value="google">Google</option>\
				        	<option value="lastfm">LastFM</option>\
				        	<option value="linkedin">LinkedIn</option>\
				        	<option value="pinterest">Pinterest</option>\
				        	<option value="rss">RSS</option>\
				        	<option value="skype">Skype</option>\
				        	<option value="tumblr">Tumblr</option>\
				        	<option value="twitter">Twitter</option>\
				        	<option value="vimeo">Vimeo</option>\
				        	<option value="youtube">Youtube</option>\
				        </select>\
				        <label>URL Link:</label>\
				        <input type="text" class="widefat"/>\</div>\
				        <br><a href="#" class="tb_glisseo_delete_social">Delete Social</a><br>\
				   </div>\
				   <div class="thesocials"><select class="widefat">\
			        	<option value="dribbble">Dribbble</option>\
			        	<option value="facebook">Facebook</option>\
			        	<option value="flickr">Flickr</option>\
			        	<option value="forrst">Forrst</option>\
			        	<option value="google">Google</option>\
			        	<option value="lastfm">LastFM</option>\
			        	<option value="linkedin">LinkedIn</option>\
			        	<option value="pinterest">Pinterest</option>\
			        	<option value="rss">RSS</option>\
			        	<option value="skype">Skype</option>\
			        	<option value="tumblr">Tumblr</option>\
			        	<option value="twitter">Twitter</option>\
			        	<option value="vimeo">Vimeo</option>\
			        	<option value="youtube">Youtube</option>\
			        </select>\
			        <label>URL Link:</label>\
			        <input type="text" class="widefat"/></div><br>\
			        <span></span>\
			        <br><hr><a href="#" class="tb_glisseo_add_social">Add Social</a>\
				</div>\
				</td>\
			</tr>\
		';
	}
	
?>