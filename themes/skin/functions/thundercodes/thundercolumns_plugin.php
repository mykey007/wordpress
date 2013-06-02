
(function(){
		tinymce.create('tinymce.plugins.thundercolumns', {
	    createControl: function(n, cm) {
	        switch (n) {
	            case 'thundercolumns_button':
	                var c = cm.createSplitButton('thundercolumns_button', {
	                    title : 'ThunderColumns',
	                    image : '<?php echo $_GET["dir"]; ?>/style/images/columns.png',
	                    
	                });
	
	                c.onRenderMenu.add(function(c, m) {
	                    m.add({title : 'ThunderColumns', 'class' : 'mceMenuItemTitle'}).setDisabled(1);
	
	                    m.add({title : '1/2', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-half]YOUR_TEXT_HERE[/one-half]');                    
	                    }});
	                    
	                    m.add({title : '1/2 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-half last]YOUR_TEXT_HERE[/one-half]');                    
	                    }});
	                    
	                     m.add({title : '1/3', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-third]YOUR_TEXT_HERE[/one-third]');                    
	                    }});
	                    
	                    m.add({title : '1/3 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-third last]YOUR_TEXT_HERE[/one-third]');                    
	                    }});
	                    
	                    m.add({title : '2/3', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[two-third]YOUR_TEXT_HERE[/two-third]');                    
	                    }});
	                    
	                    m.add({title : '2/3 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[two-third last]YOUR_TEXT_HERE[/two-third]');                    
	                    }});
	                    
	                    m.add({title : '1/4', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-fourth]YOUR_TEXT_HERE[/one-fourth]');                    
	                    }});
	                    
	                    m.add({title : '1/4 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-fourth last]YOUR_TEXT_HERE[/one-fourth]');                    
	                    }});
	                    
	                    m.add({title : '3/4', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[three-fourth]YOUR_TEXT_HERE[/three-fourth]');                    
	                    }});
	                    
	                    m.add({title : '3/4 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[three-fourth last]YOUR_TEXT_HERE[/three-fourth]');                    
	                    }});
	                    
	                    m.add({title : '1/5', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-fifth]YOUR_TEXT_HERE[/one-fifth]');                    
	                    }});
	                    
	                    m.add({title : '1/5 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-fifth last]YOUR_TEXT_HERE[/one-fifth]');                    
	                    }});
	                    
	                    m.add({title : '2/5', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[two-fifth]YOUR_TEXT_HERE[/two-fifth]');                    
	                    }});
	                    
	                    m.add({title : '2/5 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[two-fifth last]YOUR_TEXT_HERE[/two-fifth]');                    
	                    }});
	                    
	                    m.add({title : '3/5', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[three-fifth]YOUR_TEXT_HERE[/three-fifth]');                    
	                    }});
	                    
	                    m.add({title : '3/5 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[three-fifth last]YOUR_TEXT_HERE[/three-fifth]');                    
	                    }});
	                    
	                    m.add({title : '4/5', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[four-fifth]YOUR_TEXT_HERE[/four-fifth]');                    
	                    }});
	                    
	                    m.add({title : '4/5 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[four-fifth last]YOUR_TEXT_HERE[/four-fifth]');                    
	                    }});
	                    
	                    m.add({title : '1/6', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-sixth]YOUR_TEXT_HERE[/one-sixth]');                    
	                    }});
	                    
	                    m.add({title : '1/6 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[one-sixth last]YOUR_TEXT_HERE[/one-sixth]');                    
	                    }});
	                    
	                    m.add({title : '5/6', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[five-sixth]YOUR_TEXT_HERE[/five-sixth]');                    
	                    }});
	                    
	                    m.add({title : '5/6 Last in Row', onclick : function() {
	                    	tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[five-sixth last]YOUR_TEXT_HERE[/five-sixth]');                    
	                    }});

	                    
	                });
	
	              // Return the new splitbutton instance
	              return c;
	        }
	
	        return null;
	    }
	});	
	
	
	
	tinymce.PluginManager.add('thundercolumns', tinymce.plugins.thundercolumns);
})()