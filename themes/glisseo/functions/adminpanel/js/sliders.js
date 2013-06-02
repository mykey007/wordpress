			jQuery(document).ready(function() {
				//jQuery("#tp_editor_form").attr("target","");

			// Save all changes
				jQuery(".saveallchanges").click(function(){
					jQuery(".save_message").show();
					if(jQuery("#tp_valiano_slider_uniq\\[\\]").length > 0) {
						addTeaser = jQuery("#"+jQuery('#adminleft li:last').attr("ref"));
						addTeaserSlug = addTeaser.find(".text-input:first").val();
						addTeaserItems = addTeaser.find(".tp-slide").length;
						addTeaserItemOne = addTeaser.find(".tp-accordion").find(".radioinput:first").val();
						if(addTeaserSlug!=""){
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
				
			// Add and Remove Slider
				jQuery('#menu li:last').live("click",function(){
						jQuery("#adminright .tab_content").hide();
						$adminDiv=jQuery("#adminright").find("#"+jQuery(this).attr("ref"));
						//jQuery(this).html("New Slug<div class='remove_teaser'></div>");
						uniqid_teaser = uniqid();
						$adminDiv.clone(true,true).insertAfter($adminDiv);
						$adminDiv.find("input:first").val("New Slug");
						
						jQuery("#adminright .tab_content:last #tp_slider_uniq\\[\\]").val(uniqid_teaser);
						jQuery("#adminright .tab_content:last").attr("id",uniqid_teaser);

						jQuery(this).after("<li ref='"+uniqid_teaser+"'>Add Slider</li>");
						jQuery("#adminright .tab_content:last input,textarea").each(function(){
							$this=jQuery(this);
							thisID=$this.attr("id");
							if(thisID){	
								$this.attr("id",thisID.replace($adminDiv.attr("id"),uniqid_teaser));
								$this.attr("name",thisID.replace($adminDiv.attr("id"),uniqid_teaser));
							}
						});
						

						$adminDiv.find(".text-input:first").val("New Slider");
						
						$adminDiv.find(".tp-radio:first .radio:first").click();
						$adminDiv.find(".tp-radio:first .radio:first").click();
						jQuery(".saveallchanges").click();
						//$adminDiv.show();

						$adminDiv.find(".teaser_content").hide();
						//setTimeout(checkHeight(jQuery(this)),400);
						jQuery("#tp_editor_form").append("<input name=newfield value=yes>");
						jQuery(".saveallchanges").click();
						checkHeight();
				});
		
				jQuery(".remove_teaser").live("click",function(){
					if(confirm("You really want to delete this slider?\n\n(It will be in the database though untill you press the 'Apply Changes' button)\n\n")){	
						$this=jQuery(this);
						jQuery("#"+$this.closest("li").attr("ref")).remove();
						$this.closest("li").remove();
						jQuery("#tp_editor_form").append("<input name=newfield value=yes>");
						jQuery(".saveallchanges").click();
						return false;
					}
				});

				// Change Video Type
				
				jQuery(".slider_video_choose .tp-radio .radio").each( function() {
					jQuery(this).live("click",function(){							
							$this=jQuery(this);
							if($this.data("value")!="none"){
								$this.closest(".slider_video_choose").find(".slider_video").show();
							}
							else{
								$this.closest(".slider_video_choose").find(".slider_video").hide();
							}
						});
				});
			
				// Change Caption Type
				jQuery(".slider_caption_choose .tp-radio .radio").live("click",function(){
					$this=jQuery(this);
					if($this.data("value")!="none"){
						$this.closest(".slider_caption_choose").find(".slider_caption").show();
						//checkHeight("ddd");
					}
					else{
						$this.closest(".slider_caption_choose").find(".slider_caption").hide();
						//checkHeight("ddd");
					}
				});

		});

		