			jQuery(document).ready(function() {
				//jQuery.noConflict();					 									
				
				jQuery(".saveallchanges").click(function(){
					jQuery(".save_message").show();
					if(jQuery("#tp_showbiz_uniq\\[\\]").length > 0) {
						addTeaser = jQuery("#"+jQuery('#adminleft li:last').attr("ref"));
						addTeaserSlug = addTeaser.find(".text-input:first").val();
						addTeaserItems = addTeaser.find(".tp-accordion").length;
						addTeaserItemOne = addTeaser.find(".tp-accordion").find(".text-input:first").val();
						if(addTeaserSlug!="" || addTeaserItems > 1 || addTeaserItemOne !=""){
							jQuery("#tp_editor_form").submit();
						}
						else{
							addTeaser.find("input,textarea").attr("disabled",true);
							jQuery("#tp_editor_form").submit();
							addTeaser.find("input,textarea").attr("disabled",false);
						}
					}
					else{
						jQuery("#tp_editor_form").submit();
					}	
					return false;
				});
				
				// Initialize TP Fields
				//jQuery('#adminright').tpfields();
				
				// Initialize Admin Panel
				jQuery('#adminright div:first').show();
				jQuery('#adminleft li:first').addClass("active");	
				
				// Click Event Menu Panel
				jQuery('#adminleft li').live("click",function(){
				    jQuery('#adminright .tab_content').hide().removeClass("adminactive");
					jQuery("#adminright").find("#"+jQuery(this).attr("ref")).show().addClass("adminactive");
					jQuery('#adminleft li').removeClass("active");
					jQuery(this).addClass("active");
					checkHeight(jQuery(this));
				});
				
				$currentdiv="jQuery('#adminleft li:first')";
			 	
				// Sync Panel Left and Right Side Heights
			 	// Sync Panel Left and Right Side Heights
		 	checkHeight=function(){
				if (jQuery("#adminright").find(".adminactive").height()+20 < 780)
					jQuery("#adminleft").height(780);
				else
					jQuery("#adminleft").height(jQuery("#adminright").find(".adminactive").height()+20);
			}		
				
			
			// Upload
			$formfield = "";
			
			jQuery('.upload_image_button').click(function() {
			 window.send_to_editor = uploadSendToEditor;
			 $formfield = jQuery(this).closest("span").find("input");
			 formfield = $formfield.attr('name');
			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			 return false;
			});
			
			editorSendToEditor = window.send_to_editor;
			
			uploadSendToEditor = function(html) {
				imgurl = jQuery('img',html).attr('src');
				$formfield.val(imgurl);
				$img=$formfield.closest("span").find("img:first");
				$img.attr("src","<?php echo get_template_directory_uri(); ?>/functions/thumb.php?src="+imgurl);
				jQuery("#img_"+$formfield.attr("id")).show();
				tb_remove();
				window.send_to_editor = editorSendToEditor;
				checkHeight($currentdiv);
			}
			
			// Image Fields
			jQuery(".preview_pic .itemremove").click(function(){
				jQuery(this).closest("span").find("input").val("");
				jQuery(this).closest("span").find(".preview_pic").hide();
			});
			
			jQuery(".upload_image_field").blur(function(){
				$this=jQuery(this);
				if($this.val()==""){
					jQuery(this).closest("span").find(".preview_pic").hide();
				}
				else {
					
					$this.closest("span").find("img:first").attr("src",$this.val());
					$this.closest("span").find(".preview_pic").show();
				}
			});
			
			jQuery(".addslide").click(function(){
				addSlide(jQuery(this));
				return false;
			});
			
//			jQuery("#sidebar .addslide").click(function(){
//				$this.closest('div').find('.tp-accordion:last').find('#tp_sidebar_slug_nr\\[\\]').val(Math.round(new Date().getTime() / 1000));
//			});
//			
			
			addSlide = function($this){
				  $newItem=$this.closest('div').find('div:first').clone(true,true).appendTo($this.closest('div'));
				  $newItem=$this.closest('div').find('.tp-accordion:last');
				  $newItem.find("input,select").val("");	
				  $newItem.find("textarea").text("");
				  $newItem.data("title",uniqid());
				  $newItem.find(".preview_pic").hide();
				  $newItem.find('.title').text("New");
				  $newItem.find('#tp_sidebar_slug_nr\\[\\]').val(Math.round(new Date().getTime() / 1000));
				  
			}
			
			// New Teaser
			jQuery('#menu li:last').live("click",function(){
					jQuery("#adminright .tab_content").hide();
					$adminDiv=jQuery("#adminright").find("#"+jQuery(this).attr("ref"));
					jQuery(this).html("New Slug<div class='remove_teaser'></div>");
					uniqid_teaser = uniqid();
					$adminDiv.clone(true,true).insertAfter($adminDiv);
					$adminDiv.find("input:first").val("New Slug");
					jQuery("#adminright .tab_content:last #tp_showbiz_uniq\\[\\]").val(uniqid_teaser);
					jQuery("#adminright .tab_content:last").attr("id",uniqid_teaser);

					jQuery(this).after("<li ref='"+uniqid_teaser+"'>Add Teaser</li>");
					jQuery("#adminright .tab_content:last input,textarea").each(function(){
						$this=jQuery(this);
						thisID=$this.attr("id");
						if(thisID){	
							$this.attr("id",thisID.replace($adminDiv.attr("id"),uniqid_teaser));
							$this.attr("name",thisID.replace($adminDiv.attr("id"),uniqid_teaser));
						}
					});
					$adminDiv.show();

					$adminDiv.find(".teaser_content").hide();
					setTimeout(checkHeight(jQuery(this)),400);
			});

			uniqid = function uniqid()
			  {
			    var newDate = new Date;
			    return newDate.getTime();
			    }
			
			jQuery("#adminpanel .remove").live("click",function() {
				if(jQuery(this).closest(".tp_sortable").find('.tp-accordion').length > 1)
					jQuery(this).closest('.tp-accordion').remove();
				else {
					jQuery(this).closest('.tp-accordion').find("input,select").val("");	
					jQuery(this).closest('.tp-accordion').find("textarea").text("");
					jQuery(this).closest('.tp-accordion').find('.title').text("New");
				}
			});
			
			
			   jQuery("#sc_select").live("change",function() {
			   		var selectedval = jQuery(this).val();
			   		if(selectedval != 0){
						send_to_editor(selectedval);
					}
					return false;
				});
				
			jQuery(".remove_teaser").live("click",function(){
				if(confirm("You really want to delete this teaser?\n\n(It will be in the database though untill you press the 'Apply Changes' button)\n\n")){	
					$this=jQuery(this);
					jQuery("#"+$this.closest("li").attr("ref")).remove();
					$this.closest("li").remove();
					//jQuery('#adminleft li:first').click();
					return false;
				}
			});

			// blog_options
			jQuery(".teaser_custom_blog").live("click",function(){
				$button_pressed = jQuery(this).data("value");
				jQuery(this).closest(".tab_content").find(".teaser_content").each(function(){
					if(jQuery(this).hasClass($button_pressed+"_teaser_content"))
						jQuery(this).show();
					else jQuery(this).hide();
				});
				checkHeight();
			});

			// blog_options
			jQuery(".teaser_layout").live("click",function(){
				$button_pressed = jQuery(this).data("value");
				jQuery(this).closest(".tab_content").find(".teaser_layout_detail").each(function(){
					if(jQuery(this).hasClass($button_pressed+"_teaser_layout_detail"))
						jQuery(this).show();
					else jQuery(this).hide();
				});
				checkHeight();
			});
			
			setTimeout(function() {
				console.log(jQuery(".radio_selected").length);
				jQuery(".radio_selected").each(
					function(i) {
						console.log(i);
						jQuery(this).click();
				})
			},400);
		
			var last_key = 0;
			var code_meta_key = 91;
			var code_s = 83;
			
			jQuery(document).keydown(function(event){ 
			
			  if (last_key == 91 && event.keyCode == 83) {
			    jQuery(".saveallchanges").click();
			    return false;
			  }
			
			  last_key = (event.keyCode == 91) ? 91 : 0;
			});
			
			changeSaveMessage = function(){
				jQuery('.save_message').animate({opacity: 1.0}, 1000).html('Saved...').removeClass('yellow').addClass('green').animate({opacity: 1.0}, 500).fadeOut('slow', function() {
				      jQuery('.save_message').addClass('yellow').html('Saving...');
				});
			}
			
			$wpeditor=jQuery("#wp-editor");
			$currenttextarea = "";
			jQuery(".wp-editor").live("mouseenter",function(){
				$this=jQuery(this);
				$currenttextarea = $this;
				jQuery("#wp-editor").css("left",$this.offset().left-164+"px");
				jQuery("#wp-editor").css("top",$this.offset().top-57+"px");
			});
			jQuery("#wp-editor").live("mouseleave",function(){
				jQuery(this).css("left","-9999999px");
				$currenttextarea.val(tinyMCE.activeEditor.getContent());
			});

		});
		
		jQuery(window).load(function(){
			jQuery('.preloader_wrapper').hide();
			jQuery('#adminleft li:first').click();
			jQuery('#adminleft').show();
			jQuery('#adminright').css("left",0);
			checkHeight(jQuery('#adminleft li:first'));	
		});