	<link rel="stylesheet" href="https://povestka.by/wp-content/themes/stable/vendor/intl-tel-input-14.0.0/build/css/intlTelInput.css?1537727621611">
	<link rel="stylesheet" href="https://povestka.by/wp-content/themes/stable/vendor/intl-tel-input-14.0.0/examples/css/isValidNumber.css?1537727621611">
	
<div class="alert alert-warning" role="alert">
<?php /*	Согласно <b>Постановлению Совета Министров Республики Беларусь от <a href = "https://news.tut.by/society/616915.html">23 ноября 2018 г.</a> №850</b> "Об утверждении Положения о порядке предварительной идентификации пользователей интернет-ресурса, сетевого издания", с 1 декабря 2018 г. для того, чтобы пользователи нашего сайта могли писать вопросы, ответы, комментарии, им нужно указать номер телефона, на который придет СМС с кодом. После единовременного введения этого кода сайтом можно будет полноценно пользоваться, как и прежде. Данная процедура совершенно бесплатна.
	<br>Администрация сайта не в восторге от данных нововведений, но мы вынуждены их выполнять, чтобы сайт мог работать дальше.<br> */ ?>
	<b>Привяжите номер телефона</b>! Ваш номер телефона не будет виден другим пользователям. Привязка номера используется только для защиты от спама. При проблемах с привязкой номера свяжитесь с технической поддержкой по номеру +375291998650<br><br>
<a name="form"></a>
<?php
	global $wpdb;
	$current_user = wp_get_current_user();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['phone']) AND validate_phone_number(htmlspecialchars($_POST['phone']))) {
			$existing_users = get_users(array('meta_key' => 'connect_phone', 'meta_value' => str_replace(array(" ", "(", ")", "-"), "", htmlspecialchars($_POST['phone'])), 'number' => 1, "fields"=> array('ID') ));
			if($existing_users){
				echo 'Этот номер телефона уже привязан к другому аккаунту. <a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#form">Привязать другой номер.</a>';
			}else{
				$code = rand(10000, 99999);
				if(sendRocketSMS(htmlspecialchars($_POST['phone']), $code)){
					$wpdb->insert( 'povestka_wp_phone_confirm', array( 'user_id' => $current_user->ID, 'phone' => htmlspecialchars($_POST['phone']), 'code' => $code, 'attempts' => 0 ));
					?>
					На ваш номер <b><?php echo htmlspecialchars($_POST['phone']); ?></b> отправлено смс с 5-ти значным кодом. Введите код из смс.
					
					<form class="form-inline" action="#form" method="post">
						<div class="form-group">
							<input type="number" class="form-control" name="code" id="code" placeholder="Введите код" min="10000" max="99999" autocomplete="off">
						</div>
						<button type="submit" class="btn btn-default">Проверить код</button> <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>#form">Изменить номер</a>
					</form>
					У вас 10 попыток ввода, после чего код станет не действительным. Будьте внимательны!
					<?php
				}else{
					echo "Ошибка отправки SMS. В ближайшее время ситуация будет исправлена, попробуйте запросить sms повторно";
				}
			}

		}elseif(isset($_POST['code'])) {
			$row = $wpdb->get_row( "SELECT * FROM povestka_wp_phone_confirm WHERE user_id = $current_user->ID ORDER BY id DESC LIMIT 1" );
			if($row->attempts < 10-1) {
				if((int)$_POST['code'] == (int)$row->code){
					update_user_meta( $current_user->ID, 'connect_phone', str_replace(array(" ", "(", ")", "-"), "", $row->phone) );
					$u = new WP_User( $current_user->ID );
					$u->remove_role( 'registered' ); // Remove role
					$u->add_role( 'subscriber' ); // Add role
					echo 'Вы успешно прошли идентификацию. <a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#form">Обновите страницу</a> и вам будут доступны все функции сайта.';
				}else{
					$wpdb->update( 'povestka_wp_phone_confirm', array( 'attempts' => $row->attempts+1 ), array( 'ID' => $row->id ) );
					?>
					Проверка не пройдена, код введен не верно!
					
					<form class="form-inline" action="#form" method="post">
						<div class="form-group">
							<input type="number" class="form-control" name="code" id="code" placeholder="Введите код" min="10000" max="99999" autocomplete="off">
						</div>
						<button type="submit" class="btn btn-default">Проверить код</button> <a href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>#form">Изменить номер</a>
					</form>
					У вас <?php echo 10-$row->attempts-1; ?> попыток ввода, после чего код станет не действительным. Будьте внимательны!
					<?php
				}
			}else{
				echo 'Код заблокирован! попробуйте <a href="http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#form">запросить новый код</a>';
			}
		}
	}else{
		$sent_codes_count = $wpdb->get_var( "SELECT COUNT(*) FROM povestka_wp_phone_confirm WHERE user_id = $current_user->ID AND date BETWEEN '".current_time('Y-m-d')." 00:00:00' AND '".current_time('Y-m-d')." 23:59:59'" );
		if( $sent_codes_count < 2 ){
?>
	<big>Введите свой номер телефона для прохождения идентификации:</big><br>
	<small>На указанный номер будет отправлено SMS с кодом подтверждения</small><br>
	<form class="form-inline" action="#form" method="post">
		<div class="form-group">
			<input id="phone" name="phone" class="form-control" type="tel" autocomplete="off">
		</div>
		<button id="submit" type="submit" class="btn btn-default" disabled><span id="valid-msg" class="hide">✓</span> Запросить код</button>
		<small id="phone" class="help-block">Для 1 аккаунта вы можете заказать проверочный код только 2 раза. Будьте внимательны при вводе номера.</small>
	</form>
	<small><span id="error-msg" class="hide"></span></small>
</div>
<?php
		}else{
			echo "Вы исчерапали количество попыток отправки кода. Попробуйте запросить код завтра.";
		}
	}
?>


    <script src="https://povestka.by/wp-content/themes/stable/vendor/intl-tel-input-14.0.0/build/js/intlTelInput.js?1537727621611"></script>
	<script>
	var input = document.querySelector("#phone"),
	errorMsg = document.querySelector("#error-msg"),
	validMsg = document.querySelector("#valid-msg"),
	button = document.querySelector("#submit");

	// here, the index maps to the error code returned from getValidationError - see readme
	var errorMap = [ "Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

	// initialise plugin
	var iti = window.intlTelInput(input, {
		initialCountry: 'BY',
		nationalMode: false,
		preferredCountries: ["BY"],
		utilsScript: "https://povestka.by/wp-content/themes/stable/vendor/intl-tel-input-14.0.0/build/js/utils.js?1537717752654"
	});

	var reset = function() {
		button.setAttribute('disabled', 'disabled');
		input.classList.remove("error");
		errorMsg.innerHTML = "";
		errorMsg.classList.add("hide");
		validMsg.classList.add("hide");
	};
	var validate = function() {
		reset();
		if (input.value.trim()) {
			if (iti.isValidNumber()) {
				validMsg.classList.remove("hide");
				button.removeAttribute('disabled', 'disabled');
			} else {
				input.classList.add("error");
				var errorCode = iti.getValidationError();
				console.log(errorCode);
				if(errorCode != -99){
					errorMsg.innerHTML = errorMap[errorCode];
					errorMsg.classList.remove("hide");
				}
			}
		}
	};

	// on blur: validate
	input.addEventListener('blur', validate);

	input.addEventListener('change', validate);
	input.addEventListener('keyup', validate);
	</script>
	
	