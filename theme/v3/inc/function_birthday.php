<?php
add_action( 'show_user_profile', 'extra_user_profile_field_birthday' );
add_action( 'edit_user_profile', 'extra_user_profile_field_birthday' );

function extra_user_profile_field_birthday( $user ) {
	if ( current_user_can( 'manage_options' ) ) {
	?>
	<table class="form-table">
	<tr>
		<th><label for="birthday"><?php _e("Дата рождения"); ?></label></th>
		<td>
			<input type="text" name="birthday" id="birthday" value="<?php echo esc_attr( get_the_author_meta( 'birthday', $user->ID ) ); ?>" class="regular-text" disabled /><br />
			<span class="description"><?php _e("Запрещено изменять"); ?></span>
		</td>
	</tr>
	</table>
<?php
	}
}

?>