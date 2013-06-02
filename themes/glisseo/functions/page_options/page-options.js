jQuery(function(jQuery) {
	
	
	jQuery('#media-items').bind('DOMNodeInserted',function(){
		jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
		});
	});
	
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
		$this = jQuery(this).closest('td');
		var defaultImage = $this.find('.custom_default_image').text();
		alert(defaultImage);
		$this.find('.custom_upload_image').val('');
		$this.find('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	jQuery('.repeatable-add').click(function() {
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
		jQuery('input', field).val('').attr('name', function(index, name) {
			return name.replace(/(\d+)/, function(fullMatch, n) {
				return Number(n) + 1;
			});
		})
		field.insertAfter(fieldLocation, jQuery(this).closest('td'))
		return false;
	});
	
	jQuery('.repeatable-remove').click(function(){
		jQuery(this).parent().remove();
		return false;
	});
		
	/*jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort'
	});
	*/
});


jQuery("document").ready(function(){
	//change page template options show/hide
	jQuery("#page_template").change(function(){
			jQuery(".tp_options").each(function(){
				if(!jQuery(this).hasClass(jQuery("#page_template").val().replace(".php", ""))){
					jQuery(this).fadeOut();
				}
				else {
					jQuery(this).fadeIn();	
	
					if(jQuery("#tb_glisseo_activate_sidebar").attr("checked")){
						jQuery(".sidebar").show();
					}
					else{
						jQuery(".sidebar").hide();
					}
					
				}
			});
	
		//show/hide portfolio tab
		if(jQuery("#page_template").val().replace(".php", "")!="portfolio")
			jQuery("#portfolio-options").fadeOut();
		else {
			jQuery("#portfolio-options").fadeIn();
		}
		
		if(jQuery("#page_template").val().replace(".php", "")!="contact"){
			jQuery(".gmap").hide();
			jQuery(".headimage").show();
		}
		else {
			jQuery(".gmap").show();
			jQuery(".headimage").hide();
		};
		
		//show/hide video tab
		if(jQuery("#page_template").length){
			if(jQuery("#page_template").val().replace(".php", "")!="videocase"){
				jQuery("#page-video-options").hide();
			}
			else {
				jQuery("#page-video-options").show();
			}
		}
		
		//show/hide gallery tab
		if(jQuery("#page_template").length){
			if(jQuery("#page_template").val().replace(".php", "")!="gallery_overview"){
				jQuery("#page-gallery-options").hide();
			}
			else {
				jQuery("#page-gallery-options").show();
			}
		}
		
		
 	});
	
	
	jQuery("#tb_glisseo_portfolio_excerpt_active").click(function() {
		if(jQuery(this).attr("checked")){
			jQuery(".excerpt").fadeIn();
		}
		else{
			jQuery(".excerpt").fadeOut();
		}
	});
	
	
	//show/hide sidebar options
	jQuery("#tb_glisseo_activate_sidebar").click(function() {
		$this=jQuery(this).attr("checked");
		if($this){
			jQuery(".sidebar").fadeIn();
			jQuery(".portfolio-sidebar-inactive").fadeOut();
			jQuery(".portfolio-sidebar-active").fadeIn();
		}
		else{
			jQuery(".sidebar").fadeOut();
			jQuery(".portfolio-sidebar-inactive").show();
			if(jQuery("input[name=tb_glisseo_portfolio_items_row]:checked").val()=="one"){
				jQuery(".portfolio-sidebar-active").show();
			}
			else{

				jQuery(".portfolio-sidebar-active").hide();
			}
		}
	});


	//on load show/hide sidebar options
	if(jQuery("#tb_glisseo_activate_sidebar").attr("checked")) {
		jQuery(".sidebar").fadeIn();
		jQuery(".portfolio-sidebar-inactive").fadeOut();
		jQuery(".portfolio-sidebar-active").fadeIn();
	}
	else{
		jQuery(".sidebar").fadeOut();
		jQuery(".portfolio-sidebar-inactive").fadeIn();
		//jQuery(".portfolio-sidebar-active").fadeOut();
		if(jQuery("input[name=tb_glisseo_portfolio_items_row]:checked").val()=="one"){
	jQuery(".portfolio-sidebar-active").show();
	}
	else{     			
		jQuery(".portfolio-sidebar-active").hide();
	}
	}
	
	//show/hide title options
	jQuery("#tb_glisseo_activate_page_title").click(function(){	
		if(jQuery("#tb_glisseo_activate_page_title").attr("checked")) {
			jQuery(".headline").fadeOut();
		}
		else{
			jQuery(".headline").fadeIn();
		}
	});
	//on load show/hide title options
	if(jQuery("#tb_glisseo_activate_page_title").attr("checked")) {
		jQuery(".headline").hide();
	}
	else{
		jQuery(".headline").show();
	}
	
	//show/hide contact stuff
	if(jQuery("#page_template").length && jQuery("#page_template").val().replace(".php", "")!="contact"){
	jQuery(".gmap").hide();
	jQuery(".headimage").show();
}
else {
	jQuery(".gmap").show();
	jQuery(".headimage").hide();
};

//on load page template options show/hide
	jQuery(".tp_options").each(function(){
		if(jQuery("#page_template").length){
			if(!jQuery(this).hasClass(jQuery("#page_template").val().replace(".php", ""))){
				jQuery(this).hide();
			}
			else {
				jQuery(this).show();	
			}
		}
	});
	
	//on load show/hide video tab
	if(jQuery("#page_template").length){
		if(jQuery("#page_template").val().replace(".php", "")!="videocase"){
			jQuery("#page-video-options").hide();
		}
		else {
			jQuery("#page-video-options").show();
		}
	}
	
	//on load show/hide gallery tab
	if(jQuery("#page_template").length){
		if(jQuery("#page_template").val().replace(".php", "")!="gallery_overview"){
			jQuery("#page-gallery-options").hide();
		}
		else {
			jQuery("#page-gallery-options").show();
		}
	}

	//alert(jQuery("#page_template").val());
	
	//Portfolio Excerpt Actions
	if(jQuery("#page_template").length){
	 	if(jQuery("#page_template").val().replace(".php", "")=="portfolio"){
	 		if(jQuery("#tb_glisseo_portfolio_excerpt_active").attr("checked")){
	 			jQuery(".excerpt").show();
	 		}
	 		else{
	 			jQuery(".excerpt").hide();
	 		}
	 	} 
 	}
	
	
	//post type options onclick
	jQuery("input[name=\"tb_glisseo_post_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

	//post video options onclick
jQuery("input[name=\"tb_glisseo_video_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//post video options onclick
jQuery("input[name=\"tb_glisseo_image_type\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//onload post type options
	postType = jQuery("input[name=tb_glisseo_post_type]:checked").val();
	jQuery(".post_type").each(function(){
		$this=jQuery(this);
		if($this.hasClass(postType)) $this.show();
		else $this.hide();
	});

	if(postType=="video"){
		postType = jQuery("input[name=tb_glisseo_video_type]:checked").val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
}

if(postType=="image"){
		postType = jQuery("input[name=tb_glisseo_image_type]:checked").val();
		jQuery(".post_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
}

//post external link onclick
jQuery("input[name=\"tb_glisseo_portfolio_link\"]").click(function(){
		postType = jQuery(this).val();
		jQuery(".post_link").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
		});
	});

//onload external link
	postType = jQuery("input[name=tb_glisseo_portfolio_link]:checked").val();
	jQuery(".post_link").each(function(){
		$this=jQuery(this);
		if($this.hasClass(postType)) $this.show();
		else $this.hide();
	});

if(jQuery("input[name=tb_glisseo_video_width]").val()==""){
	jQuery("input[name=tb_glisseo_video_width]").val("500");
}

if(jQuery("input[name=tb_glisseo_video_height]").val()==""){
	jQuery("input[name=tb_glisseo_video_height]").val("281");
}

jQuery("#tb_glisseo_activate_slider").click(function() {
	$this=jQuery(this).attr("checked");
	if($this){
			jQuery(".slider_content").fadeIn();
		}
		else{
			jQuery(".slider_content").fadeOut();
	}
});

if(jQuery("#tb_glisseo_activate_slider").attr("checked")){
	jQuery(".slider_content").show();
}
else{
	jQuery(".slider_content").hide();
}


postType = jQuery("input[name=tb_glisseo_video_type]:checked").val();
	jQuery(".video_type").each(function(){
			$this=jQuery(this);
			if($this.hasClass(postType)) $this.show();
			else $this.hide();
	});



});
