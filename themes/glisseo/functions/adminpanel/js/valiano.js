			jQuery(document).ready(function() {
				
				// WP Editor
				$wpeditor=jQuery("#wp-editor");
				$currenttextarea = "";
				jQuery(".wp-editor").mouseenter(function(){
					$this=jQuery(this);
					width=$this.outerWidth();
					height=$this.height()-40;
					$currenttextarea = $this;
					jQuery(".wp-editor-area").val($currenttextarea.val());
					jQuery("#wp-editor").width(width);
					jQuery("#wp-editor-area").height(height);
					jQuery("#wp-editor").css("left",$this.offset().left-164+"px");
					jQuery("#wp-editor").css("top",$this.offset().top-27+"px");
				});
				jQuery("#wp-editor").mouseleave(function(){
					jQuery(this).css("left","-100%");
					$currenttextarea.val(jQuery(".wp-editor-area").val());
				});

				// Initialize TP Fields
				jQuery('#adminright').tpfields();
				
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
				$img.attr("src",imgurl);
				$img.closest("div").show();
				jQuery("#img_"+$formfield.attr("id")).show();
				tb_remove();
				window.send_to_editor = editorSendToEditor;
				checkHeight();
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
			
			
			// Add and Remove Slides
			jQuery(".addslide").click(function(){
				addSlide(jQuery(this));
				return false;
			});
			
			addSlide = function($this){
				$newItem=$this.closest('div').find('div:first').clone(true,true).appendTo($this.closest('div'));
				  $newItem=$this.closest('div').find('.tp-accordion:last');
				  $newItem.find("input,select").val("");	
				  $newItem.find("textarea").text("");
				  $newItem.data("title",uniqid());
				  $newItem.find(".preview_pic").hide();
				  $newItem.find('.title').text("New");
				  $newItem.find('#tb_glisseo_portfolio_slug\\[\\]').val("portfolio_"+Math.round(new Date().getTime() / 1000));
				  
				  uniqid_teaser=Math.round(new Date().getTime() / 1000);
				  $newItem.find(".tp-radio").each(function(){
				  	$this = jQuery(this);
				  	$this.closest("span").find("input").attr("id",$this.closest("span").find("input").attr("id")+uniqid_teaser);
				  	$this.data("input",$this.data("input")+uniqid_teaser);
				  });
				  checkHeight();
			}
			
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
					jQuery(this).closest('.tp-accordion').find('#tb_glisseo_portfolio_slug\\[\\]').val("portfolio_"+Math.round(new Date().getTime() / 1000));
				}
			});
			
			
			   jQuery("#sc_select").live("change",function() {
			   		var selectedval = jQuery(this).val();
			   		if(selectedval != 0){
						send_to_editor(selectedval);
					}
					return false;
				});
			
			editorSendToEditor = window.send_to_editor;
			
			// Save for Webkit Browsers via CMD+S
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
		});
		
		jQuery(window).load(function(){
			jQuery('.preloader_wrapper').hide();
			jQuery('#adminleft li:first').click();
			jQuery('#adminleft').show();
			jQuery('#adminright').css("left",0);
			checkHeight();//jQuery('#adminleft li:first'));	
			jQuery("#wpeditor2-html").click();
		});