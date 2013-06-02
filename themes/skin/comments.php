<?php
/**
 * @package WordPress
 * @subpackage tb_glisseo_Theme
 */
?>

<?php if ( post_password_required() ) : ?>
	<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tb_glisseo' ); ?></p>
<?php return; endif; ?>

<?php if ( have_comments() ) : ?>
		<!-- Begin Comments -->
	    <div id="comments">
	      <h3><?php comments_number( __('0 Comments','tb_glisseo'), __('1 Comment','tb_glisseo'), __('% Comments','tb_glisseo') ); ?> </h3>
	      <ol id="singlecomments" class="commentlist"><?php wp_list_comments( array( 'callback' => 'tb_glisseo_comment' ) ); ?></ol>
	    </div>
	    <hr />
    <!-- End Comments -->
<?php endif;  ?>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :  ?>
	<div>
		<div class="left marginbottom10"><?php previous_comments_link( __( 'Older Comments ', 'tb_glisseo' ) ); ?></div>
		<div class="right marginbottom10"><?php next_comments_link( __( 'Newer Comments', 'tb_glisseo' ) ); ?> </div>
	</div>
<?php endif;  ?>

<?php if ( !have_comments() && comments_open() ){?>
	<!--<div class="divide40"></div>-->
<?php } ?>

<?php if ( comments_open() ) :

		$comments_args = array(
			'fields' => apply_filters( 'comment_form_default_fields', array(
				'author' => '<div><input type="text" name="author" title="'.__( 'Name', 'tb_glisseo' ).'*"/></div>',
				'email'  => '<div><input type="text" name="email" title="'.__( 'Email', 'tb_glisseo' ).'*" /></div>',
				'url'    => '<div><input type="text" name="url" title="'.__( 'Website', 'tb_glisseo' ).'" /></div>')
			),
			'id_form' => 'comment-form',
	        'title_reply'=>'<h3>'.__( 'Would you like to share your thoughts?', 'tb_glisseo' ).'</h3>',
	        'comment_field' => ' <div><textarea name="comment" id="textarea" rows="5" cols="30"></textarea></div>',
			'label_submit' => __( 'Submit Comment' , 'tb_glisseo'),
			'id_submit' => 'btn-submit'
		);
		comment_form($comments_args); 
    
    endif; ?>