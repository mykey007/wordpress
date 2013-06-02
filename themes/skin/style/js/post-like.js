jQuery(document).ready(function() {

	jQuery(".likes").find("a").click(function(){
		heart = jQuery(this);
		
		// Retrieve post ID from data attribute
			post_id = heart.data("post_id");
	
		// Ajax call
			jQuery.ajax({
				type: "post",
				url: ajax_var.url,
				data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=1&post_id="+post_id,
				success: function(count){
					// If vote successful
					heart.find(".likenr").html(count);
				}
			});
		return false;
	});
})