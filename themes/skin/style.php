<?php
	header("Content-Type: text/css; charset=utf-8");
	//Basics & WordPress Standards
		$absolute_path = __FILE__;
		$path_to_file = explode( 'wp-content', $absolute_path );
		$path_to_wp = $path_to_file[0];
		require_once( $path_to_wp.'/wp-load.php' );
		require_once( $path_to_wp.'/wp-includes/functions.php');
		
		$template_uri = get_template_directory_uri();
	
	//Theme Options
		$tb_themeoptions = array_merge(get_option("tb_glisseo_theme_general_options"),get_option("tb_glisseo_theme_header_options"),get_option("tb_glisseo_theme_body_options"));
		//Style
			// hex (incl. #)
			$tb_themeoptions["tb_glisseo_highlight_color"] = "#".$tb_themeoptions["tb_glisseo_highlight_color"];
			$tb_themeoptions["tb_glisseo_highlight_hover_color"] = "#".$tb_themeoptions["tb_glisseo_highlight_hover_color"];
			// from colorpicker (preview) via URL
			if(isset($_GET["maincolor"])) $tb_themeoptions["tb_glisseo_highlight_color"] = "#".$_GET["maincolor"];
			// rgb (only numbers, e.g. 255,255,255)
			$tb_themeoptions["tb_glisseo_highlight_color_rgb"] = HexToRGB($tb_themeoptions["tb_glisseo_highlight_color"]);
			
			$tb_themeoptions["tb_glisseo_background_color"] = "#".$tb_themeoptions["tb_glisseo_background_color"];
			$tb_themeoptions["tb_glisseo_main_fontfamily"] = htmlspecialchars_decode($tb_themeoptions["tb_glisseo_main_fontfamily"],ENT_QUOTES);
		//Header
			$tb_themeoptions["tb_glisseo_header_background_color"] = "#".$tb_themeoptions["tb_glisseo_header_background_color"];
			$tb_themeoptions["tb_glisseo_header_logo_background_color"] = "#".$tb_themeoptions["tb_glisseo_header_logo_background_color"];
			$tb_themeoptions["tb_glisseo_header_logo_background_border_color"] = "#".$tb_themeoptions["tb_glisseo_header_logo_background_border_color"];
?>

/*-----------------------------------------------------------------------------------*/
/*	RESET
/*-----------------------------------------------------------------------------------*/

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend {
	margin:0;
	padding:0;
	border:0;
	outline:0;
	font-size:100%;
	vertical-align:baseline;
	background:transparent
}

html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend {
	margin:0;
	padding:0;
	border:0;
	outline:0;
	font-size:100%;
	vertical-align:baseline;
	background:transparent
}
body {
	line-height:1
}
ol, ul {
	list-style:none
}
blockquote, q {
	quotes:none
}
blockquote:before, blockquote:after, q:before, q:after {
	content:'';
	content:none
}
:focus {
	outline:0
}
ins {
	text-decoration:none
}
del {
	text-decoration:line-through
}
table {
	border-collapse:collapse;
	border-spacing:0
}
.clear {
	clear:both;
	display:block;
	overflow:hidden;
	visibility:hidden;
	width:0;
	height:0
}
.clearfix:after {
	clear:both;
	content:' ';
	display:block;
	font-size:0;
	line-height:0;
	visibility:hidden;
	width:0;
	height:0
}
.clearfix {
	display:inline-block
}
* html .clearfix {
	height:1%
}
.clearfix {
	display:block
}
th, td {
	margin:0;
	padding:0
}
table {
	border-collapse:collapse;
	border-spacing:0
}
.clear {
	clear: both;
}
br {
	line-height: 10px;
}
input[type="submit"]::-moz-focus-inner, input[type="button"]::-moz-focus-inner {
	border : 0px;
}
input[type="submit"]:focus, input[type="button"]:focus {
	outline : none;
}

input, textarea {
	-webkit-appearance: none;
	border-radius: 0;
}

::selection {
	background: #fefac7; /* Safari */
	color: #555555;
}
::-moz-selection {
	background: #fefac7; /* Firefox */
	color: #555555;
}

/*-----------------------------------------------------------------------------------*/
/*	GENERAL
/*-----------------------------------------------------------------------------------*/


body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: 100%;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-size: 13px;
	line-height: 22px;
	background: #eceee9 url(<?php echo $tb_themeoptions["tb_glisseo_body_background_image"]; ?>) repeat fixed;
	color: #5f5f5f;
	letter-spacing: 0.5px;
	margin: 0;
}

input, textarea {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-size: 13px;
	width: 100%;
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}

p {
	padding-bottom: 20px;
	letter-spacing: 0.3px;
}

h1, h2, h3, h4, h5, h6 {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: 700;
	color: #4f4f4f;
	margin-bottom: 15px;
	text-transform: uppercase;
}

h1 {
	font-size: 21px;
	line-height: 23px;
}

h1.title,
h2 {
	font-size: 18px;
	line-height: 21px;
}

h1.title a,
h2.title a {
	color: #4f4f4f;
}

h1.title a:hover,
h2.title a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

h3 {
	font-size: 16px;
	line-height: 19px;
}
h4 {
	font-size: 15px;
	line-height: 17px;
}
h5 {
	font-size: 14px;
	line-height: 16px;
	margin-bottom: 10px;
}

h5 span {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: 400;
	text-transform: none;
	font-size: 11px;
	color: #999999;
	padding-left: 5px;
}

h6 {
	font-size: 12px;
	line-height: 14px;
}

hr {
	border: none;
	border-top: 1px solid #b6b6b6;
	height: 1px;
	margin-top: 30px;
	margin-bottom: 50px;
}

a {
	text-decoration: none;
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_hover_color"]; ?>;
}

a.button,
.forms fieldset .btn-submit,
.wpcf7-submit,
#comment-form #btn-submit,
.filter li a  {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	background: #424242;
	border: none;
	border-bottom: 5px solid #717171;
	color: #fff;
	font-size: 12px;
	text-transform: uppercase;
	padding: 6px 20px 4px;
	margin: 0;
	display: inline-block;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
	cursor: pointer;
	margin-bottom: 20px;
	width: auto;
	height: auto;
}

.wpcf7-submit{height: 36px;}

a.button:hover,
.forms fieldset .btn-submit:hover,
.wpcf7-submit:hover,
#comment-form #btn-submit:hover,
.filter li a:hover,
.filter li a.active  {
	border-color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

a.button.blue:hover  {
	border-color: #649bb7;
}

a.button.rose:hover  {
	border-color: #b76464;
}

a.button.gray:hover  {
	border-color: #969696;
}

a.button.lime:hover  {
	border-color: #93b764;
}

a.button.pink:hover  {
	border-color: #ce82b9;
}

a.button.orange:hover  {
	border-color: #e58835;
}

a.button.red:hover  {
	border-color: #c55842;
}

a.button.yellow:hover  {
	border-color: #dcce32;
}

a.button.aqua:hover  {
	border-color: #44bcc3;
}

a.button.brown:hover  {
	border-color: #976e4a;
}

a.button.purple:hover  {
	border-color: #a180c4;
}

#navigation .nav-previous .meta-nav-prev {
	float: left;
}
#navigation .nav-next .meta-nav-next {
	float: right;
}
#navigation {
	background: transparent url(style/images/line.png) repeat-x center top;
	padding-top: 40px;
	margin-bottom: 20px;
}
#navigation:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}
.center {
	text-align: center;
}

.map iframe,
.head-image {
	max-width: 100%;
}

img {
	max-width: 100%;
	display: block;
}

#fancybox-thumbs ul li img {
	max-width: none;
}

img.left, img.alignleft {
	float: left;
	margin: 10px 20px 10px 0;
}

img.right, img.alignright {
	float: right;
	margin: 10px 0 10px 20px;
}

img.center, img.aligncenter {
	text-align: center;
	display: block;
	margin: 0 auto;
	padding: 0 0 20px 0;
}

.alignleft {
	float: left;
}

.alignright {
	float: right;
}

.aligncenter {
	text-align: center;
}

img.margin {
	margin-bottom: 20px;
}

ul {
	padding-bottom: 20px;
	overflow: hidden;
}

ul li {
	background: transparent url(style/images/icon-bullet.png) no-repeat left 7px;
	padding: 0 0 0 20px;
}

ol {
	list-style: decimal;
	list-style-position: inside;
	padding-bottom: 20px;
}
ol li {
	padding: 0;
	margin: 0;
}


.dropcap {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	display:block;
	float:left;
	font-size:43px;
	padding:0;
	margin: 0;
	margin:10px 8px 0 0;
	text-transform: uppercase;
}

.lite1 {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
	border-bottom: 1px dotted <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

.lite2 {
	background: #fefac7;
}

pre {
	margin: 5px 0px 40px 0px;
	padding: 0 10px 0px 10px;
	display: block;
	clear: both;
	background: url(style/images/codebg.jpg) repeat;
	line-height: 20px;
	font-size: 13px;
	border: 1px solid #d6d6d6;
}

blockquote p {
	text-transform: uppercase;
	font-size: 18px;
	line-height: 30px;
	background: transparent url(style/images/blockquote.png) no-repeat left 5px;
	padding-left: 45px;
	font-weight: 300;
}

.download-box, .warning-box, .info-box, .note-box {
	clear:both;
	margin: 10px 0px;
	padding: 15px 15px 13px 15px;
	line-height: 17px;
}
.info-box {
	background:#c2ddf9;
	border:1px solid #80bbef;
	color:#4783b7;
}
.warning-box {
	background:#ffcccc;
	border:1px solid #ff9999;
	color:#c31b00;
}
.download-box {
	background:#d1f7b6;
	border:1px solid #8bca61;
	color:#5e9537;
}
.note-box {
	background:#fdebae;
	border:1px solid #e6c555;
	color:#9e660d;
}

.intro {
	font-size: 17px;
	line-height: 26px;
	margin-bottom: 30px;
	font-weight: 300;
}

.intro.uppercase {
	text-transform: uppercase;
	font-size: 20px;
	line-height: 30px;
	margin-bottom: 50px;
}

.header-wrapper {
	width: 100%;
	height: 75px;
	background: #212121 url(style/images/header.png) repeat-x center bottom;
	color: #fff;
	position: relative;
	z-index: 1000;
	-webkit-box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.5);
	box-shadow: 0px 1px 0px 0px rgba(0, 0, 0, 0.5);
}

.header {
	width: 960px;
	margin: 0px auto;
}

.logo {
	position: absolute;
	background-color: transparent;
	border: none;
	padding: 30px 60px 25px;
}

.wrapper {
	width: 960px;
	margin: 50px auto;
}

.head-image {
	width: 100%;
}

.head-image img {
	width: 100%;
	height: auto;
}

.page-title {
	width: 960px;
	margin: 0 auto;
	position: relative;
}

.head-image h1 {
	position: absolute;
	bottom: 20px;
	right: 0;
	background: rgba(0, 0, 0, 0.8);
	color: #cbcbcb;
	font-size: 23px;
	line-height: 35px;
	padding: 3px 10px 5px;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	text-transform: uppercase;
	font-weight: 300;
}

/*-----------------------------------------------------------------------------------*/
/*	COLUMNS
/*-----------------------------------------------------------------------------------*/

.one-half {
	width:48%;
}
.one-third {
	width:30.66%;
}
.two-third {
	width:65.33%;
}
.one-fourth {
	width:22%;
}
.three-fourth {
	width:74%;
}
.one-fifth {
	width:16.8%;
}
.two-fifth {
	width:37.6%;
}
.three-fifth {
	width:58.4%;
}
.four-fifth {
	width:67.2%;
}
.one-sixth {
	width:13.33%;
}
.five-sixth {
	width:82.67%;
}
.one-half, .one-third, .two-third, .three-fourth, .one-fourth, .one-fifth, .two-fifth, .three-fifth, .four-fifth, .one-sixth, .five-sixth {
	position:relative;
	margin-right:4%;
	float:left;
}
.last {
	margin-right:0 !important;
	clear:right;
}

.column-wrapper {
	overflow: hidden;
	width: 100%;
}

/*-----------------------------------------------------------------------------------*/
/*	MENU
/*-----------------------------------------------------------------------------------*/

.menu {
	list-style: none;
	float: right;
	font-weight: normal;
	position: relative;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	text-transform: uppercase;
	z-index: 1003;
	margin-top: 33px;
}
.menu ul {
	margin: 0;
	list-style-type: none;
	position: relative;
	overflow: inherit;
}
.menu ul li {
	position: relative;
	float: left;
	background: none;
	padding: 0;
	margin-left: 40px;
}
.menu ul li a {
	display: block;
	text-decoration: none;
	line-height: 1;
	font-size: 12px;
	color: #d0d1d2;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

.menu ul li.active a, .menu ul li a:hover, .menu ul li a.selected {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}
.menu ul li.active ul li a {
	color: #3b3b3b;
}
.menu ul li.active ul li a:hover {
	color: #3b3b3b;
}
.menu ul li ul {
	position: absolute;
	left: 0;
	display: none;
	visibility: hidden;
	width: 160px;
	padding: 15px 0 0 0;
}
.menu ul li ul li {
	display: list-item;
	float: none;
	background: #c7c7c7;
	border-top: 1px solid #929292;
	margin: 0;
}
.menu ul li ul li:first-child {
	border: none;
}
.menu ul li ul li ul {
	top: 0;
}
.menu ul li ul li a {
	margin: 0;
	border: none;
	padding: 13px 15px;
	line-height: 1;
	font-size: 11px;
	color: #3b3b3b;
}
.menu ul li ul li a:hover {
	color: #3b3b3b;
	background-color: #d5d5d5;
}
* html .menu {
	height: 1%;
}

.selectnav {
	display: none;
	width: 280px;
	margin: 0 auto 25px;
}

/*-----------------------------------------------------------------------------------*/
/*	FOOTER
/*-----------------------------------------------------------------------------------*/

.footer-wrapper {
	width: 100%;
	background-color: #2c2c2c;
	color: #c5c5c5;
	position: relative;
	z-index: 1;
	padding: 35px 0 40px;
}

.footer {
	width: 960px;
	margin: 0px auto;
}

.footer h3 {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
	font-size: 13px;
}

.footer .searchform input {
	background: #242424;
	padding: 7px 10px;
	color: #c5c5c5;
	margin-bottom: 20px;
	border: 1px solid #3c3c3c;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

.footer .searchform input:focus {
	border: 1px solid #494949;
}

.footer .post-list {
	padding: 0;
}

.footer .post-list h4 {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-size: 13px;
	line-height: 22px;
	margin: 0;
	font-weight: normal;
	text-transform: none;
}

.footer .post-list h4 a {
	color: #c5c5c5;
}

.footer .post-list .meta {
	color: #899096;
	font-size: 11px;
}

.footer .post-list li {
	border-top: 1px solid #494949;
	padding: 0;
	padding-top: 20px;
	margin-top: 19px;
}

.footer .post-list li:first-child {
	margin: 0;
	padding: 0;
	border: none;
}

.footer a {
	color: #c5c5c5;
}

.footer a:hover,
.footer .post-list a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

ul {
	padding-left: 0;
}

.footer ul li {
	padding: 0;
	background: none;
}

.site-generator-wrapper {
	width: 100%;
	color: #c5c5c5;
	background-color: #242424;
	padding: 20px 0 15px;
}

.site-generator {
	width: 960px;
	margin: 0px auto;
	font-size: 11px;
}

.copyright {
	float: left;
	max-width: 500px;
}

.copyright p {
	padding: 0;
	font-size: 11px;
}

.social {
	padding: 0;
	margin-bottom: 4px;
	float:right;
	-webkit-transform: translateZ(0);
}

.social li {
	float: left;
	padding: 0;
	margin-left: 8px;
	background: none;
}

.social a {
	background-color: transparent;
	height:25px;
	width:25px;
	display:block;
}

.social.team {
	float: none;
	margin-bottom: 20px;
}

.social.team li {
	margin: 0px 8px 0px 0px;
}

.social .rss {
	background-image: url(style/images/icon-rss.png);
}

.social .facebook {
	background-image: url(style/images/icon-facebook.png);
}

.social .twitter {
	background-image: url(style/images/icon-twitter.png);
}

.social .dribbble {
	background-image: url(style/images/icon-dribbble.png);
}

.social .pinterest {
	background-image: url(style/images/icon-pinterest.png);
}

.social .linkedin {
	background-image: url(style/images/icon-linkedin.png);
}

.social .vimeo {
	background-image: url(style/images/icon-vimeo.png);
}

.social .youtube {
	background-image: url(style/images/icon-youtube.png);
}

.social .lastfm {
	background-image: url(style/images/icon-lastfm.png);
}

.social .tumblr {
	background-image: url(style/images/icon-tumblr.png);
}

.social .forrst {
	background-image: url(style/images/icon-forrst.png);
}

.social .skype {
	background-image: url(style/images/icon-skype.png);
}

.social .flickr {
	background-image: url(style/images/icon-flickr.png);
}

.social .digg {
	background-image: url(style/images/icon-digg.png);
}

.social .google{
	background-image: url(style/images/icon-google.png);
}

/*-----------------------------------------------------------------------------------*/
/*	TWITTER
/*-----------------------------------------------------------------------------------*/

#twitter-wrapper {
	float: none;
	clear: both;
	position: relative;
}

#twitter-wrapper a {
	color: #c5c5c5;
}

#twitter-wrapper a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

.twitter em {
	font-style: normal;
	color: #899096;
	font-size: 11px;
}

.twitter em a {
	color: #899096 !important;
}

.twitter em a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?> !important;
}

.twitter ul {
	padding: 0;
}

.twitter ul li {
	border-bottom: 1px solid #494949;
	padding: 0;
	padding-bottom: 20px;
	margin-bottom: 19px;
}


/*-----------------------------------------------------------------------------------*/
/*	LATEST POSTS
/*-----------------------------------------------------------------------------------*/

.posts-grid {
	overflow: hidden;
	width: 110%;
	margin-right: -30px;
}

.posts-grid:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.post {
	margin-bottom: 50px;
	padding-bottom: 50px;
	border-bottom: 1px solid #b6b6b6;
	
}

.posts-grid .post {
	float: left;
	width: 465px;
	padding: 0;
	margin: 0 30px 50px 0;
	border: none;
}

.grid-wrapper .posts-grid.latest .post {
	margin: 0 30px 20px 0;
}

.post .info {
	overflow: hidden;
	float: left;
	width: 74px;
	text-align: center;
}

.post .post-content {
	float: left;
	width: 881px;
	min-height: 170px;
	padding-top: 20px;
	padding-left: 25px;
	border-left: 1px solid #b6b6b6;
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}

.posts-grid .post .post-content {
	width: 390px;
	padding-left: 20px;
	padding-top: 0;
}

.post .featured {
	margin-bottom: 20px;
}

.posts-grid .post .post-content .featured {
	border-bottom: 1px solid #b6b6b6;
	padding-bottom: 20px;
	margin-left: -20px;
	padding-left: 20px;
	margin-bottom: 20px;
}

.post .post-content .meta {
	font-size: 11px;
}

.post .info .date {
	border-bottom: 1px solid #b6b6b6;
	line-height: 1;
	padding: 20px 0;
	margin-bottom: 20px;
}

.post .info .date .day {
	font-size: 30px;
	line-height: 30px;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: 700;
}

.post .info .date .month {
	font-size: 17px;
	text-transform: uppercase;
	font-weight: 300;
}

.single .post .info .likes {
	border-bottom: 1px solid #b6b6b6;
	padding-bottom: 15px;
}

.post .info .likes a.like-count {
	font-size: 17px;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	color: #df9d9d;
	letter-spacing: 0.5px;
}

.post .info .likes a.like-count:hover {
	color: #d38d8d;
}

.post .info .likes a.like-count span {
	background: transparent url(style/images/icon-heart.png) no-repeat top center;
	width: 26px;
	height: 19px;
	display: block;
	margin: 0 auto 5px;
}

.post .info .likes a.like-count:hover span {
	background-position: bottom center;
}

.post .info .likes .already {
	font-size: 12px;
}


.post .info .share {
	margin-top: 16px;
	text-align: center;
	margin-left: 3px;
}
.post .info .share li {
	padding: 0;
	background: none;
	display: inline-block;
	margin-bottom: 7px;
}
.post .info .share li img {
	display: inline;
}

.post h1.title,
.post h2.title {
	margin-bottom: 5px;
}

.post .meta {
	margin-bottom: 20px;
}

.posts-grid .post h2.title {
	font-size: 14px;
	margin-bottom: 10px;
}

.posts-grid .post .meta {
	margin-bottom: 0;
	margin-top: -10px;
}

.container:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.post:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

/*-----------------------------------------------------------------------------------*/
/*	BLOG WITH SIDEBAR
/*-----------------------------------------------------------------------------------*/

.content {
	float: left;
	width: 640px;
}

.content .post .post-content {
	width: 566px;
}

.content .related ul {
	width: 652px;
	margin-right: -12px;
}

.content .related ul:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.content .related ul li {
	float: left;
	margin-right: 12px;
	padding: 0;
	background: none;
	width: 151px;
	height: 110px;
}

.content .related ul li img {
	width: 151px;
	height: 110px;
	display: block;
}


/*-----------------------------------------------------------------------------------*/
/*	SIDEBAR
/*-----------------------------------------------------------------------------------*/

.sidebar {
	float: right;
	width: 290px;
	border-left: 1px solid #b6b6b6;
	margin-left: 30px;
	-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
	-moz-box-sizing: border-box;    /* Firefox, other Gecko */
	box-sizing: border-box;         /* Opera/IE 8+ */
}

.sidebox {
	margin-top: 20px;
	padding-top: 30px;
	margin-left: 30px;
	border-top: 1px solid #b6b6b6;
} 

.sidebox:first-child {
	border: none;
	padding-top: 0;
	margin-top: 0;
} 

.sidebox h3 {
	font-size: 14px;
	text-transform: uppercase;
	margin-bottom: 15px;
}

.sidebox ul.posts-list {
	color: #5f5f5f;
}
.sidebox ul.posts-list:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}
.sidebox ul.posts-list li {
	clear: both;
	background: none;
	padding: 15px 0 0 0;
	line-height: 17px;
}
.sidebox ul.posts-list li:first-child {
	padding: 0;
}
.sidebox ul.posts-list li .featured {
	float: left;
	margin-right: 15px;
}
.sidebox ul.posts-list li .meta {
	overflow: hidden;
}
.sidebox ul.posts-list li em {
	display: inline-block;
	font-style: normal;
	font-size: 11px;
}
.sidebox ul.posts-list li h6 {
	margin-bottom: 5px;
	font-weight: normal;
	font-family: 'Open Sans', sans-serif;
	font-size: 13px;
	text-transform: none;
	line-height: 22px;
	margin-top:0;
	
}
.sidebox ul.posts-list li h6 a {
	color: #4f4f4f;
	
	
}
.sidebox ul.posts-list li h6 a:hover {
	color: #3cab88;
}

.sidebox ul.posts-list li em {
	color: #999999;
}

.sidebox .list {
	overflow: hidden;
	margin-bottom: -20px;
}

.sidebox a {
	color: #5f5f5f;
}

.sidebox a:hover {
	color: #3cab88;
}

.sidebox .searchform input {
	border: none;
	border: 1px solid #d9d9d9;
	background: #f3f5f1;
	height: 39px;
	line-height: 1;
	color: #555555;
	padding: 7px 10px;
	margin-bottom: 20px;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

.sidebox .searchform input:focus {
	border: 1px solid #bebebe;
}

.sidebox ul.tag-list {
	text-transform: lowercase;
	margin-bottom: -25px;
}

.sidebox ul.tag-list li {
	padding: 0;
	margin: 0;
	display: inline-block;
	margin-right: 1px;
	margin-bottom: 7px;
	background: none;
}

.sidebox ul.tag-list li a {
	padding: 0;
	margin: 0;	
	padding: 4px 15px 3px;
	font-size: 12px;
	font-family: 'Open Sans', sans-serif;
	background: #424242;
	border: none;
	border-bottom: 5px solid #717171;
	color: #fff;
	display: inline-block;
}

.sidebox ul.tag-list li a:hover  {
	border-color: #3cab88;
}

/*-----------------------------------------------------------------------------------*/
/*	RELATED
/*-----------------------------------------------------------------------------------*/

.related {
	border-top: 1px solid #b6b6b6;
	display: block;
	padding-top: 50px;
	margin-top: 30px;
	overflow: hidden;
}

.related ul {
	width: 110%;
	margin-right: -16px;
	padding-bottom: 0;
}

.related ul:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.related ul li {
	float: left;
	margin-right: 16px;
	padding: 0;
	width: 228px;
}

.related ul li img {
	width: 228px;
	display: block;
}

.post .related .featured {
	margin: 0;
}

/*-----------------------------------------------------------------------------------*/
/*	PAGE NAVIGATION
/*-----------------------------------------------------------------------------------*/

.page-navi ul {
	list-style: none;
}
.page-navi ul li {
	display: inline;
	background: none;
	padding: 0;
}
.page-navi ul li a {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	background: #424242;
	border-bottom: 5px solid #717171;
	color: #fff;
	font-size: 12px;
	text-transform: uppercase;
	padding: 7px 14px 3px 15px;
	margin: 0;
	text-align: center;
	display: inline-block;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
	cursor: pointer;
}
.page-navi ul li a:hover, .page-navi ul li a.current {
	border-color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

/*-----------------------------------------------------------------------------------*/
/*	COMMENTS
/*-----------------------------------------------------------------------------------*/

#comments {
	margin:50px 0 0 0;
	background: transparent url(style/images/line.png) center bottom repeat-x;

}
#comments ol.commentlist {
	list-style:none;
	margin: -5px 0 0 0;
}
#comments ol.commentlist li {
	padding:20px 0 0 0;
	background: none;
}
#comments .user {
	float:left;
	width: 70px;
	height: 70px;
	margin-right:20px;
}
#comments .message {
	overflow: hidden;
	padding:15px 20px 0 20px;
	border: 1px solid #d9d9d9;
	background: #f3f5f1;
	position: relative;
}
#comments ul.children {
	margin:0;
	overflow: inherit;
	padding:0 0 0 55px;
}
#comments ol.commentlist ul.children li {
	padding-right:0;
	border:none;
}
#comments .info h2 {
	font-size: 14px;
	margin: 0;
}
#comments .info {
	margin-bottom: 12px;
}
#comments .info h2 a {
	color: #4f4f4f;
}
#comments .info h2 a:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}
#comments .info .meta {
	font-size: 11px;
	color: #999999;
}
#comments a.comment-reply-link {
	position: absolute;
	right: 20px;
	top: 20px;
	line-height: 1;
	font-size: 11px;
	text-transform: uppercase;
}
#comment-form-wrapper {
	margin-top: 50px;
}

/*-----------------------------------------------------------------------------------*/
/*	FORMS
/*-----------------------------------------------------------------------------------*/

.forms, .wpcf7-form {
	position: relative;
	padding: 0;
	width: 100%;
}

.form-container .response {
	color: #58a267;
	display: none;
	margin: 0 0 15px 0;
}
.forms ol, .wpcf7-form ol {
	margin:0;
	padding:0;
}
.forms ol li , .wpcf7-form ol li {
	line-height:auto;
	list-style: none;
}
.forms li.form-row, .wpcf7-form li.form-row { 
	margin-bottom: 10px;
}
.forms li.hidden-row , .wpcf7-form li.hidden-row {
	display: none;
}

.forms fieldset .text-input,
.forms fieldset .text-area,
.wpcf7-text, .wpcf7-textarea,
#comment-form input,
#comment-form textarea {
	border: 1px solid #d9d9d9;
	background: #f3f5f1;
	height: 39px;
	line-height: 1;
	padding: 7px 10px;
	color: #555555;
	resize: none;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

.forms fieldset .text-input:focus,
.forms fieldset .text-area:focus,
.wpcf7-text:focus, .wpcf7-textarea:focus,
#comment-form input:focus,
#comment-form textarea:focus {
	border: 1px solid #bebebe;
}

.forms fieldset .text-area,
.wpcf7-textarea,
#comment-form textarea {
	min-height: 200px;
	padding: 10px;
	resize: vertical;
}

.forms li.error input, 
.forms li.error textarea {
	border: 1px solid #d18282;
}

.forms span.error {
	display: none;
}

.forms .button-row span.error {
	padding: 0;
	display: none;
}

.forms label {
	display: block;
	float: left;
	width: 95px;
	padding-top: 7px;
	font-size: 13px;
	clear: both;
}

#comment-form div {
	position:relative;
	margin-bottom: 20px;
}

#comment-form div label {
	position:absolute; top:0; left:0
}

.form-container:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.forms fieldset .btn-submit,
#comment-form #btn-submit {
	height: 37px;
	border-bottom: 5px solid #717171;
}


/*-----------------------------------------------------------------------------------*/
/*	Contact Form 7 Specials
/*-----------------------------------------------------------------------------------*/

div.wpcf7 .watermark{ 
	color: #555; 
}

div.wpcf7-response-output {
	margin: -6em 8.5em 1em;
	padding: 0.2em 1em;
}

div.wpcf7-validation-errors {
	background:#ffcccc;
	border:1px solid #ff9999;
	color:#c31b00;
}

span.wpcf7-not-valid-tip {
	background:#ffcccc;
	border:1px solid #ff9999;
	color:#c31b00;
}

div.wpcf7-mail-sent-ok{
	background:#d1f7b6;
	border:1px solid #8bca61;
	color:#5e9537;
}

.wpcf7 input[type="checkbox"]{
	-webkit-appearance: checkbox;
	width:10px;
}

.wpcf7 input[type="radio"]{
	-webkit-appearance: radio;
	box-sizing: border-box;
	width:10px;
}

/*-----------------------------------------------------------------------------------*/
/*	TABS
/*-----------------------------------------------------------------------------------*/

.etabs { 
	margin: 0; 
	padding: 0; 
	text-align: center;
	overflow: inherit;
}

.etabs.left { 
	text-align: left;
}

.tab { 
	margin:0; 
	padding: 0;
	background: none;
	display: inline-block; 
	zoom:1; 
	*display:inline; 
	border-left: 1px solid #b6b6b6;
	text-transform: uppercase;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	font-size: 13px;
}

.tab a { 
	display: block; 
	color: #4e4e4e;
	padding:13px 34px 13px 38px; 
}

.tab:first-child { 
	border: none;
}

.tab a.active,
.tab a:hover { 
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}

.tab-container .panel-container { 
	border-top: 1px solid #c5c5c5; 
	padding: 30px 0 0 0; 
}

.panel-container { 
	
}

.etabs.left .tab { 
	font-size: 13px;
}

.etabs.left .tab a { 
	padding:10px 29px 10px 35px; 
}
.etabs.left .tab:first-child { 
	border-left: 1px solid #b6b6b6;
}

.tab-pane{
	letter-spacing: 0.3px;
}

/*-----------------------------------------------------------------------------------*/
/*	PORTFOLIO
/*-----------------------------------------------------------------------------------*/

.grid-wrapper,
#videocase,
#portfolio {
	overflow: hidden;
}

.items {
	width: 110%;
	margin-bottom: -16px;
	margin-right: -16px;
}

.items li {
	float: left;
	margin: 0 16px 16px 0;
	position: relative;
	background: none;
	padding: 0;
	width: 228px;
	height: 170px;
}

.items li img {
	display: block;
	width: 228px;
	height: 170px;
}

.items li a {
	color: #FFF;
}

.featured a .more,
.items li a .more,
.item a .more {
	display: none;
	height: 100%;
	position: absolute;
	text-align: center;
	text-decoration: none;
	width: 100%;
	z-index: 100;
	background: rgba(0, 0, 0, 0.66) url(style/images/icon-more.png) no-repeat center center;
}

.featured a, 
.featured img, 
.item a, 
.item img {
	display: block;
	position: relative;
}

.items:after {
	content: '';
	display: block;
	height: 0;
	clear: both;
	visibility: hidden;
}

.items .hidden {
	display: none;
}

.fancybox-title h2 {
	color: #FFF;
	margin-top: 15px;
	margin-bottom: 10px;
}

.filter {
	text-align: center;
}

.filter li {
	padding: 0;
	margin: 0;
	background: none;
	display: inline-block;
}

.item-info .portfolio-meta {
	padding: 0;
}

.item-info .portfolio-meta li {
	background: none;
	padding: 0;
	margin: 7px 0 0 0;
}

.item-info .portfolio-meta li:first-child {
	margin: 0;
}

.item-info .portfolio-meta li span {
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	text-transform: uppercase;
}

.item-info .portfolio-nav {
	border-top: 1px solid #b6b6b6;
	margin-top: 18px;
	padding-top: 23px;
}

.item-info .portfolio-nav h6 {
	margin-bottom: 10px;
	text-transform: uppercase;
}

.item-info .portfolio-nav a {
	width: 29px;
	height: 29px;
	display: block;
}

.item-info .portfolio-nav .prev,
.item-info .portfolio-nav .next,
.item-info .portfolio-nav .up {
	background: #303030 url(style/images/portfolio-nav.png) no-repeat top left;
	width: 29px;
	height: 29px;
	float: left;
	margin-right: 6px;
}

.item-info .portfolio-nav .prev {
	background-position: top left;
}

.item-info .portfolio-nav .next {
	background-position: top right;
}

.item-info .portfolio-nav .up {
	background-position: top center;
}

.item-info .portfolio-nav .prev:hover {
	background-position: bottom left;
	background-color: #000;
}

.item-info .portfolio-nav .next:hover {
	background-position: bottom right;
	background-color: #000;
}

.item-info .portfolio-nav .up:hover {
	background-position: bottom center;
	background-color: #000;
}

/*-----------------------------------------------------------------------------------*/
/*	VIDEOCASE
/*-----------------------------------------------------------------------------------*/

.video h2 {
	margin-top: 20px;
	margin-bottom: 15px;
}

#videocontainer {
	border-bottom: 1px solid #b6b6b6;
	margin-bottom: 30px;
}

/*-----------------------------------------------------------------------------------*/
/*	ISOTOPE
/*-----------------------------------------------------------------------------------*/

.isotope-item {
  z-index: 2;
}

.isotope-hidden.isotope-item {
  pointer-events: none;
  z-index: 1;
}

.isotope,
.isotope .isotope-item {
  -webkit-transition-duration: 0.8s;
     -moz-transition-duration: 0.8s;
      -ms-transition-duration: 0.8s;
       -o-transition-duration: 0.8s;
          transition-duration: 0.8s;
}

.isotope {
  -webkit-transition-property: height, width;
     -moz-transition-property: height, width;
      -ms-transition-property: height, width;
       -o-transition-property: height, width;
          transition-property: height, width;
}

.isotope .isotope-item {
  -webkit-transition-property: -webkit-transform, opacity;
     -moz-transition-property:    -moz-transform, opacity;
      -ms-transition-property:     -ms-transform, opacity;
       -o-transition-property:         top, left, opacity;
          transition-property:         transform, opacity;
}

.isotope.no-transition,
.isotope.no-transition .isotope-item,
.isotope .isotope-item.no-transition {
  -webkit-transition-duration: 0s;
     -moz-transition-duration: 0s;
      -ms-transition-duration: 0s;
       -o-transition-duration: 0s;
          transition-duration: 0s;
}

/*-----------------------------------------------------------------------------------*/
/*	SLIDER
/*-----------------------------------------------------------------------------------*/

.tp-leftarrow.large {
	z-index:100;
	cursor:pointer;
	position:relative;
	background: #000 url(style/images/slider-arrows.png) no-repeat left top;
	width:31px;
	height:31px;
	top: 50% !important;
	margin-left: 20px;
	margin-top: -16px;
}

.tp-leftarrow.large:hover {
	background-position: left bottom;
}

.tp-rightarrow.large {
	z-index:100;
	cursor:pointer;
	position:relative;
	background: #000 url(style/images/slider-arrows.png) no-repeat top right;
	width:31px;
	height:31px;
	top: 50% !important;
	margin-left: -20px;
	margin-top: -16px;
}

.tp-rightarrow.large:hover {
	background-position: bottom right;
}

.tp-bannertimer {
	width:100%;
	height:5px;
	background:url(style/images/timer.png);
	position:absolute;
	z-index:200;
}

.tp-bullets {
	z-index:100;
	position:absolute;
}

.tp-bullets.simplebullets.round .bullet {
	cursor:pointer;
	position:relative;
	background: #b9bbb7;
	width:20px;
	height:7px;
	margin:1px;
	float:left;
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}
 
.tp-bullets.simplebullets.round .bullet.selected {
	background: #848583;
}

.tp-bullets.simplebullets.round .bullet:hover {
	background: #9e9f9c;
}

.tp-simpleresponsive img {
	-moz-user-select: none;
	-khtml-user-select: none;
	-webkit-user-select: none;
	-o-user-select: none;
}

.tp-simpleresponsive ul {
	list-style:none;
	padding:0;
	margin:0;
}

.tp-simpleresponsive > ul li {
	list-style:none;
	position:absolute;
	visibility:hidden;
}

.caption.slidelink a div {
	width:10000px;
	height:10000px;
}

.tp-loader {
	background:url(style/images/loading.gif) no-repeat;
	background-color:#eceee9;
	margin:-15px -15px;
	top:50%;
	left:50%;
	z-index:10000;
	position:absolute;
	width:30px;
	height:30px;
}

.fullwidthbanner-container {
	width:100% !important;
	position:relative;
	padding:0;
	max-height:700px !important;
	overflow:hidden;
}

.fullwidthbanner ul {
	overflow: inherit;
}

.fullwidthbanner ul li {
	padding: 0;
	background: none;
}

.fullwidthbanner img {
	max-width: none;
	display: block;
}

.bannercontainer {
	background-color:transparent;
	width:960px;
	position:relative;
	margin: 50px auto;
}

.banner {
	width:960px;
	height:450px;
	position:relative;
	overflow:hidden;
}

.bannercontainer ul {
	overflow: inherit;
}

.bannercontainer ul li {
	padding: 0;
	background: none;
}

.banner img {
	max-width: none;
	display: block;
}


/*-----------------------------------------------------------------------------------*/
/*	GALLERY
/*-----------------------------------------------------------------------------------*/

.zetaSlider {
	width:100%;
}
.thumbnail-wrapper {
	width: 980px;
	padding-left: 20px;
	margin: 50px auto 0;
}

/* COL4 */
.thumbnail-wrapper.col2 .zetaThumbs {
	position: relative;
	padding: 0 0 40px 0;
}
.thumbnail-wrapper.col2 .zetaThumbs li {
	width: 470px;
	height: auto;
	float: left;
	padding: 0;
	margin: 0 20px 30px 0;	
	position: relative;
}
.thumbnail-wrapper.col2 .zetaThumbs li img {
	width: 470px;
	height: 220px;
}
.thumbnail-wrapper.col2 .zetaThumbs li h4 {
	margin: 20px 0 10px 0;
}

/* COL2 */
.thumbnail-wrapper.col4 .zetaThumbs {
	position: relative;
	padding: 0 0 40px 0;
}
.thumbnail-wrapper.col4 .zetaThumbs li {
	width: 230px;
	height: auto;
	float: left;
	padding: 0;
	margin: 0 15px 30px 0;	
	position: relative;
}
.thumbnail-wrapper.col4 .zetaThumbs li img {
	width: 230px;
	/*height: 105px;*/
}
.thumbnail-wrapper.col4 .zetaThumbs li h4 {
	margin: 20px 0 10px 0;
}

/* SLIDER STYLING */
.zetaHolder {
	background:#222;
	padding:46px 20px 40px 20px;
	position:relative;
	height:590px;
	margin-bottom: 30px;
	overflow:hidden;
	display:none;
	-moz-box-sizing:border-box;
	-webkit-box-sizing:border-box;
	box-sizing:border-box;
}

.zetaEmpty {
	position:absolute;
	height:500px;
	padding: 4px;
}

.isDraggingTrue {
  cursor: url(https://mail.google.com/mail/images/2/closedhand.cur), auto;
}
.isDraggingFalse {
  cursor: url(https://mail.google.com/mail/images/2/openhand.cur), auto;
}

.zetaEmpty div:first-child {
    margin-left:0;
}

.zetaEmpty div {
	height:500px;
	float:left;
	margin-right:20px;
	display:none;
    -moz-user-select: none;
    -webkit-user-select: none;
    -webkit-user-drag: none;
    white-space:nowrap;
}
.zetaEmpty p {
	white-space:normal;
}
.zetaEmpty img {
	height:100%;
	background:transparent;
	padding:0;
	margin:0;
	box-shadow:none;
}

.zetaEmpty div {
	position: relative;
	-webkit-box-shadow: 0px 0px 4px -1px rgba(0, 0, 0, 0.5);
	-moz-box-shadow: 0px 0px 4px -1px rgba(0, 0, 0, 0.5);
	box-shadow: 0px 0px 4px -1px rgba(0, 0, 0, 0.5);
}

.zetaEmpty div span.caption {
	position: absolute;
	bottom: 15px;
	left: 15px;
	max-width: 70%;
	padding: 5px 10px;
	background-color: #000;
	color: #FFF;
	opacity: 0; 
	filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
	-MS-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
	-webkit-transition:all 200ms ease-in;
	-o-transition:all 200ms ease-in;
	-moz-transition:all 200ms ease-in;
}

.zetaEmpty div span p {
	word-wrap: break-word;
	padding: 0;
}

.zetaEmpty div:hover span {
	opacity: .7; 
	filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=70);
	-MS-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)";
}

.zetaEmpty div span a {
	display: block;
}

.zetaWarning {
	background:rgba(0, 0, 0, 0.5);
    border-radius:3px;
    color:#FFF;
    width: 200px;
    padding: 10px 20px;
    height: 100px;
    position:absolute;
    text-align:center;
    left:50%;
    margin-left: -110px;
    top:190px;
    display:none;
    z-index: 800;
}

.zetaWarning .navigate {
	margin-bottom: 15px;
	padding-top: 5px;
	<?php echo $tb_themeoptions["tb_glisseo_main_fontfamily"]; ?>
	font-weight: bold;
	text-transform: uppercase;
}

.zetaWarning .drag {
	background: transparent url(style/images/icon-drag.png) center 5px no-repeat;
	width:30%;
	margin-right: 5%;
	padding-top: 30px;
	float: left;
}

.zetaWarning .arrow {
	background: transparent url(style/images/icon-arrows.png) center 9px no-repeat;
	width:30%;
	margin-right: 5%;
	padding-top: 30px;
	float: left;
}

.zetaWarning .keys {
	background: transparent url(style/images/icon-keyboard.png) center 0 no-repeat;
	width:30%;
	padding-top: 30px;
	float: left;
}

/* CONTROLS STYLING */
.zetaControls {
	position:absolute;
	top:0px;
	left: 50%;
    margin-left: -45px;
	z-index:9999;
}
.zetaControls a {
	color:#FFF;
	display:block;
	text-indent:-9999px;
	background: transparent url(style/images/gallery-controls.png) no-repeat left top;
	width: 31px;
	height: 31px;
	-webkit-transition: none;
	-o-transition: none;
	-moz-transition: none;
	float: left;
	background-color: #000;
}

.zetaControls a.zetaBtnPrev {
	background-position: top center;
}

.zetaControls a.zetaBtnNext {
	background-position: top right;
}

.zetaControls a.zetaBtnClose {
	background-position: top left;
}

.zetaControls a.zetaBtnPrev:hover {
	background-position: bottom center;
}

.zetaControls a.zetaBtnNext:hover {
	background-position: bottom right;
}

.zetaControls a.zetaBtnClose:hover {
	background-position: bottom left;
}

.zetaSlider .page-navi {
	margin-top: -20px;
	margin-bottom: 20px;
	position: relative;
	z-index: 1;
}

.zetaSlider.zetaTop .page-navi {
	margin-top: -20px;
	margin-bottom: 0;	
}

/* CONTENT ABOVE */
.zetaTop {
	position:relative;
}
.zetaTop ul {
	float:left;
}
.zetaTop .zetaHolder {
	position:absolute;
	width:100%;
	top:0;
	left:0;
	margin-bottom: 0;
}

/* IE7 FIXES */
.ie7 .zetaThumbs {
	padding-bottom:20px;
}
.ie7 .zetaTextBox {
	padding:0 20px;
}
.ie7 .zetaTextBox *:first-child {
	margin-top:20px;
}
.ie7 .zetaHolder {
	padding-bottom:0;
}

.single-portfolio-content {
	text-align: center;
}

.single-portfolio-content img {
	display: inline-block;
	max-width: 100%;
}

.single-portfolio-content div {
	margin-bottom: 50px;
	width:960px;
}

.single-portfolio-content div p {
	margin: 5px 0 0 0;
}

.tax-category_gallery .post, .tax-category_gallery .page-navi {display:none !important;}


/*-----------------------------------------------------------------------------------*/
/*	TOGGLE
/*-----------------------------------------------------------------------------------*/

.toggle {
	width: 100%;
	padding-bottom: 15px;
	clear:both;
}
.toggle h4.title {
	cursor: pointer;
	border: 1px solid #d9d9d9;
	background: #f3f5f1;
	margin: 0 0 10px 0;
	padding: 10px;
	font-size: 13px;
}
.toggle h4.title:hover {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}
.toggle h4.title.active {
	color: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"]; ?>;
}
.togglebox {
	height: auto;
	overflow: hidden;
	margin: 0;
	border: 1px solid #d9d9d9;
	background: #f3f5f1;
}
.togglebox div {
	padding: 15px 15px 0 15px;
}

/*-----------------------------------------------------------------------------------*/
/*	AUDIO
/*-----------------------------------------------------------------------------------*/

.html5audio { background-color:#333;}
audio {width:100% !important;}

.mejs-controls .mejs-time-rail .mejs-time-loaded , .mejs-controls .mejs-time-rail .mejs-time-loaded, .mejs-controls .mejs-time-rail .mejs-time-loaded { background: <?php echo $tb_themeoptions["tb_glisseo_highlight_color"];?> !important;}

.html5audio .mejs-container {width:100% !important;}


#twitter a{
	background: url(style/images/share-twitter.png) left top no-repeat;
	padding-left:42px;
	height:20px;
	padding-top:0;
	padding-bottom:5px;
}

#facebook a{
	background: url(style/images/share-facebook.png) left top no-repeat;
	padding-left:42px;
	height:20px;
	padding-top:0;
	padding-bottom:5px;
}

#google a{
	background: url(style/images/share-google.png) left top no-repeat;
	padding-left:42px;
	height:20px;
	padding-top:0;
	padding-bottom:5px;
}

#pinterest a{
	background: url(style/images/share-pinterest.png) left top no-repeat;
	padding-left:42px;
	height:20px;
	padding-top:0;
	padding-bottom:5px;
}

<?php echo $tb_themeoptions["tb_glisseo_css"]; ?>