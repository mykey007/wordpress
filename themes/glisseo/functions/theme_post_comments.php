<?php
/* ------------------------------------- */
/* BLOG POST COMMENTS */
/* ------------------------------------- */

function tb_glisseo_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
    <!-- Reply Start -->
	<!--li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"-->

		
		
		<li class= "clearfix"  id="comment-<?php comment_ID(); ?>">
          <div class="user"><?php echo get_avatar( $comment, 70 ); ?></div>
          <div class="message"> <?php echo comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            <div class="info">
              <h2><?php comment_author_link(); ?></h2>
              <div class="meta"><?php echo date_i18n(get_option('date_format'), strtotime(get_comment_date())); ?></div>
            </div>
            <?php comment_text(); ?>
          </div>
        </li>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'tb_glisseo' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'tb_glisseo'), ' ' ); ?></p></li>
	<?php
			break;
	endswitch;
}
?>