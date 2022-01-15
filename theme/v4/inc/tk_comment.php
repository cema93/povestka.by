<?php
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 version 1.1.10
 */
if ( ! function_exists( '_tk_comment' ) ) :
function _tk_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' != $comment->comment_type AND 'trackback' != $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media">
			<div class="pull-left">
				<?php echo get_avatar( $comment->user_id, '50', 'wavatar', '', array('force_default'=> true, 'loading' => 'lazy') ); ?>
			</div>
			<div class="media-body">
				<div class="media-body-wrap panel panel-default">

					<div class="panel-heading">
						<h5 class="media-heading"><?php printf( __( '<strong>%s</strong> написал ', '_tk' ), get_comment_author() ); ?>
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php printf( _x( '%1$s в %2$s', '1: date, 2: time', '_tk' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '<span style="margin-left: 5px;" class="fa fa-pencil" aria-hidden="true"></span> Edit', '_tk' ), '<span class="edit-link">', '</span>' ); ?>
						</h5>
					</div>

					<?php if ( '0' == $comment->comment_approved ) : ?>
						<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', '_tk' ); ?></p>
					<?php endif; ?>

					<div class="comment-content panel-body">
						<?php comment_text(); ?>
					</div><!-- .comment-content -->

					<?php comment_reply_link(
						array_merge(
							$args, array(
								'add_below' => 'div-comment',
								'depth' 	=> $depth,
								'max_depth' => $args['max_depth'],
								'before' 	=> '<footer class="reply comment-reply panel-footer">',
								'after' 	=> '</footer><!-- .reply -->'
							)
						)
					); ?>

				</div>
			</div><!-- .media-body -->

		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for _tk_comment()
?>