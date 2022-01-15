<?php
if ( post_password_required() ) {
	return;
}
?>

<?php if(is_singular('place') AND has_term('sluzhby-pomoshhi-prizyvnikam', 'place-cat') ) { ?>
<div id="comments-list" class="comments-area">
<?php }else{ ?>
<div id="comments" class="comments-area">
<?php } ?>
	<h2 class="comments-title">Обсуждение</h2>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
/*	?>
		
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyfifteen' ); ?></p>
		
	<?php */ endif; ?>
	<?php
		if ( is_user_logged_in() ) {
			$current_user = wp_get_current_user();
			if(user_can( $current_user->ID, 'ap_new_comment' ) ) {
				if(is_singular('place') AND has_term('sluzhby-pomoshhi-prizyvnikam', 'place-cat') ) {
					echo '<div class="alert alert-info" role="alert">Чтобы оставить отзыв перейдите по <a href="https://povestka.by/rating/#new">ссылке</a>.</div>';
				}
				comment_form( $args = array(
					'comment_field' =>  '<p><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
					'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Вы вошли как <a href="%1$s">%2$s</a>. <a href="%3$s">Выйти?</a>' ), bp_core_get_user_domain( $current_user->ID ), $user_identity, wp_logout_url( get_permalink( $post->ID ) ) ) . '</p>'
				));
			}elseif(in_array( 'registered', (array) $current_user->roles )){
				?>
					<?php include ( get_template_directory().'/inc/please_confirm_number.php' ); ?>
				<?php
			}
		}else {
?>
			<div style="border: 2px solid rgba(0,0,0,0.1); border-radius: 3px; margin-bottom: 20px;">
				<div class="ap-content ap-login" style="margin-top:0px;">
					<div class="ap-cell">
						<div class="ap-cell-inner">
							<div style="max-width: 250px; margin: 0 auto; text-align: center;">
								<?php wp_login_form(); ?>
							</div>
							<div class="ap-login-buttons">
								<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="ap-btn">Зарегистрироваться</a>
								<span class="ap-login-sep">или</span>
								<a href="<?php echo wp_lostpassword_url(); ?>" class="ap-btn">Восстановить пароль</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		}
	?>

	<?php if ( have_comments() ) : ?>

		<ol class="comment-list media-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'callback' => '_tk_comment',
					'short_ping'  => true,
					'avatar_size' => 50,
				) );
			?>
		</ol><!-- .comment-list -->

	<?php endif; // have_comments() ?>

</div><!-- .comments-area -->