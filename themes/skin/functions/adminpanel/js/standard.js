jQuery(document).ready(function() {
	// Save all changes
		jQuery(".saveallchanges").click(function(){
			jQuery(".save_message").show();
			jQuery("#tp_editor_form").submit();
			return false;
		});
});