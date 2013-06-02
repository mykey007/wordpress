<?php 

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');

function likescript() {
	if (!is_admin()) {wp_enqueue_script('like_post', TB_JS."/post-like.js", array('jquery'),false,true);}
	wp_localize_script('like_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
	));
}
add_action('wp_enqueue_scripts', 'likescript');



$tb_themeoptions = get_option("tb_glisseo_theme_blog_options");
$timebeforerevote = $tb_themeoptions["tb_glisseo_heart_time"]; // minutes 

function post_like()
{
	// Check for nonce security
	$nonce = $_POST['nonce'];
	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
        die ( 'Busted!');

	if(isset($_POST['post_like']))
	{
		// Retrieve user IP address
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];

		// Get voters'IPs for the current post
		$meta_IP = get_post_meta($post_id, "voted_IP");
		$voted_IP = $meta_IP[0];

		if(!is_array($voted_IP))
			$voted_IP = array();

		// Get votes count for the current post
		$meta_count = 0;
		$meta_count = get_post_meta($post_id, "votes_count", true);
	
		
		// Use has already voted ?
		if(!hasAlreadyVoted($post_id))
		{
			$voted_IP[$ip] = time();

			// Save IP and increase votes count
			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);

			// Display count (ie jQuery return value)
			echo $meta_count;
		}
		else
			echo "<div class='already'>".__("You voted already","tb_glisseo")."</div>";
	}
	exit;
}

function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;

	// Retrieve post votes IPs
	$meta_IP = get_post_meta($post_id, "voted_IP");
	$voted_IP = $meta_IP[0];

	if(!is_array($voted_IP))
		$voted_IP = array();

	// Retrieve current user IP
	$ip = $_SERVER['REMOTE_ADDR'];

	// If user has already voted
	if(in_array($ip, array_keys($voted_IP)))
	{
		$time = $voted_IP[$ip];
		$now = time();

		// Compare between current time and vote time
		if(round(($now - $time) / 60) > $timebeforerevote)
			return false;

		return true;
	}

	return false;
}

function getPostLikeLink($post_id)
{
	$themename = "tb_glisseo";

	$vote_count = get_post_meta($post_id, "votes_count", true);
	if(($vote_count==""))
	 $vote_count = 0;

	$output = '<div class="likes"> <a href="#" class="like-count" data-post_id="'.$post_id.'"><span></span><div class="likenr">'.$vote_count.'</div></a> </div>';

	return $output;
}
?>