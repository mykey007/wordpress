<?php
/**
 * The template part for displaying page content
 *
 * @package Customizr
 * @since Customizr 1.0
 */
?>

<header>
     <?php 
     	printf('<h1 class="entry-title format-icon">%1$s %2$s</h1>',
			get_the_title(),
			(is_user_logged_in()) ? '<span class="edit-link btn btn-inverse btn-mini"><a class="post-edit-link" href="'.get_edit_post_link().'" title="'.__( 'Edit page', 'customizr' ).'">'.__( 'Edit page', 'customizr' ).'</a></span>' : ''
		); 
	?>
</header>
<hr class="featurette-divider">
<div class="entry-content">
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'customizr' ) ); ?>
</div>
   <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'customizr' ), 'after' => '</div>' ) ); ?>
<footer class="entry-meta">
</footer><!-- .entry-meta -->
