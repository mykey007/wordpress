<?php 

	$absolute_path = __FILE__;
	$path_to_file = explode( 'wp-content', $absolute_path );
	$path_to_wp = $path_to_file[0];
	require_once( $path_to_wp.'/wp-load.php' );
	require_once( $path_to_wp.'/wp-includes/functions.php');
	
	$template_uri = get_template_directory_uri();
	
	
?>
<html  style="background-color:transparent;margin:0;padding:0;overflow:hidden;">
<head>
<!-- LOAD THE MEDIAPLAYER	-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>	

	<script src="<?php echo TB_JS;?>/mediaplayer/mediaelement-and-player.min.js"></script>
	<link rel="stylesheet" href="<?php echo TB_JS;?>/mediaplayer/mediaelementplayer.min.css" />
	
	
<?php
	$pageoptions = getOptions($_GET["post_id"]);
?>
        
</head>



<!--
#######################################
	- THE BODY PART -
######################################
-->
<body style="background-color:transparent;margin:0;padding:0">		
		<video width="100%" height="100%" id="player2" poster="<?php echo aq_resize(wp_get_attachment_url( get_post_thumbnail_id($_GET["post_id"])),$_GET["width"],$_GET["height"],true);?>" controls="controls" preload="none">
			<!-- MP4 source -->
			<source type="video/mp4" src="<?php echo $pageoptions["tb_glisseo_mp4_link"];?>" />
			<!-- Fallback flash player for no-HTML5 browsers with JavaScript turned off -->
			<object width="100%" height="100%" type="application/x-shockwave-flash" data="<?php echo TB_JS;?>/mediaplayer/flashmediaelement.swf"> 		
				<param name="movie" value="<?php echo TB_JS;?>/mediaplayer/flashmediaelement.swf" /> 
				<param name="flashvars" value="controls=true&amp;file=<?php echo $pageoptions["tb_glisseo_mp4_link"];?>" /> 		
			</object> 	
		</video>
		<script> 
			jQuery("video").mediaelementplayer({
				pluginPath: "<?php echo TB_JS;?>/mediaplayer/",
				// name of flash file
				flashName: "flashmediaelement.swf",
				// name of silverlight file
				silverlightName: "silverlightmediaelement.xap",
				success: function(player, node) {
					jQuery("#" + node.id + "-mode").html("mode: " + player.pluginType);
				}
			});
		</script>		


	</body>
</html>