<?php
add_action( 'show_user_profile', 'extra_user_profile_field_connect_phone' );
add_action( 'edit_user_profile', 'extra_user_profile_field_connect_phone' );

function extra_user_profile_field_connect_phone( $user ) {
	if ( current_user_can( 'manage_options' ) ) {
	?>
	<h3><?php _e("Начало раздела который виден только админам"); ?></h3>

	<table class="form-table">
	<tr>
		<th><label for="connect_phone"><?php _e("привязанный номер телефона"); ?></label></th>
		<td>
			<input type="text" name="connect_phone" id="connect_phone" value="<?php echo esc_attr( get_the_author_meta( 'connect_phone', $user->ID ) ); ?>" class="regular-text" disabled /><br />
			<span class="description"><?php _e("Запрещено изменять"); ?></span>
		</td>
	</tr>
	</table>
<?php
	}
}

function validate_phone_number($phone) {
	// Allow +, - and . in phone number
	$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
	// Remove "-" from number
	$phone_to_check =str_replace(array(" ", "(", ")", "-"), "", $filtered_phone_number);
	// Check the lenght of number
	// This can be customized if you want phone number from a specific country
	if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
		return false;
	} else {
		return true;
	}
}

	function sendRocketSMS($phone, $message) {
		$curl = curl_init();
	
		curl_setopt($curl, CURLOPT_URL, 'http://api.rocketsms.by/json/send');	
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, "username=193052606&password=b8zG8qaC&phone=" . $phone . "&sender=povestka.by&text=" . $message."&priority=true");
		
		$result = @json_decode(curl_exec($curl), true);
		
		if ($result && isset($result['id'])) {
			return true;
		} elseif ($result && isset($result['error'])) {
			error_log("SMS. Error occurred while sending message. ErrorID=" . $result['error'], 0);
			return false;
		} else {
			error_log("SMS. Service error", 0);
			return false;
		}
	}
?>