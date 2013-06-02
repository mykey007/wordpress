<?php
/* ------------------------------------- */
/* THEME LOCALIZATION */
/* ------------------------------------- */

$themepath = get_template_directory();

load_theme_textdomain( 'tb_glisseo', $themepath.'/lang' );
$locale = get_locale();
$locale_file = $themepath."/lang/$locale.php";
if ( is_readable($locale_file) ) 
require_once($locale_file);
?>