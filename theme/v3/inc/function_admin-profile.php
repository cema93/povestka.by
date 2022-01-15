<?php
add_action( 'show_user_profile', 'extra_user_profile_field_links' );
add_action( 'edit_user_profile', 'extra_user_profile_field_links' );

function extra_user_profile_field_links( $user ) {
	if ( current_user_can( 'manage_options' ) ) {
	?>
	<table class="form-table">
	<tr>
		<th><label for="birthday"><?php _e("Ссылки"); ?></label></th>
		<td>
		<?php
		$q = new WP_Query( array(
			'post_type' => array('question'),
			'posts_per_page' => -1,
			'author' => $user->ID,
			'fields' => 'ids',
//			'no_found_rows' => true
		) );
		$a = new WP_Query( array(
			'post_type' => array('answer'),
			'posts_per_page' => -1,
			'author' => $user->ID,
			'fields' => 'ids',
//			'no_found_rows' => true
		) );
		?>
			<a href="https://povestka.by/wp-admin/edit.php?post_type=question&author=<? echo $user->ID; ?>">Вопросы пользоввателя (<?php echo $q->post_count; ?>)</a> | <a href="https://povestka.by/wp-admin/edit.php?post_type=answer&author=<? echo $user->ID; ?>">Ответы пользоввателя (<?php echo $a->post_count; ?>)</a>
		</td>
	</tr>
	</table>
<?php
	}
}

?>