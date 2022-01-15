<?php
/* 
Template Name: Register 
*/
	$display_modal = false;

	if (is_user_logged_in()) {
		header( 'Location:https://povestka.by/' );
	} else{

		$errors = array();

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			$display_name          = filter_input(INPUT_POST, 'display_name', FILTER_SANITIZE_STRING);
			$email                 = $_POST['email'];
			$password              = $_POST['password'];
			$password_confirmation = $_POST['password_confirmation'];
			$term                  = $_POST['term'];
			$rules                 = $_POST['rules'];
			$captcha 			   = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
			
			if ( isset( $_POST['nonce'] ) &&
				wp_verify_nonce( $_POST['nonce'], 'register' ) ) {
			} else {
				$errors['nonce'];
			}
			
			if(!$captcha){
				$errors['captcha'] = "Не работает защита от ботов";
			}else{
				$secretKey = "6Lebe84ZAAAAALMOlNIyW9qsA_7o06z--F1OuERJ";
				$ip = $_SERVER['REMOTE_ADDR'];
				$url = 'https://www.google.com/recaptcha/api/siteverify';
				$data = array('secret' => $secretKey, 'response' => $captcha);
				$options = array(
					'http' => array(
						'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
						'method'  => 'POST',
						'content' => http_build_query($data)
					)
				);
				$context  = stream_context_create($options);
				$response = file_get_contents($url, false, $context);
				$responseKeys = json_decode($response,true);
				if(!$responseKeys["success"]) {
					$errors['captcha'] = "Мы считаем, что вы бот";
				}
				
			}

			if( empty($display_name)){
				$errors['display_name'] = "Пожалуйста, представьтесь";
			}elseif(!cema93_is_uniq_display_name($display_name)){
				$errors['display_name'] = "Этот никнейм уже занят";
			}

			if( !is_email( $email ) ) {
				$errors['email'] = "Пожалуйста, введите корректный email";
			}elseif( email_exists( $email ) ) {
				$errors['email'] = "Этот email уже используется. <a href='".wp_lostpassword_url()."'>Забыли пароль?</a>";
			}
	
			// Check password is valid
			if( 0 === preg_match("/.{6,30}/", $password)) {
				$errors['password'] = "Необходимо заполнить поле, не меньше 6 и не больше 30 символов";
			}

			// Check password confirmation_matches
			if( 0 !== strcmp( $password, $password_confirmation )) {
				$errors['password_confirmation'] = "Пароли не совпадают";
			}

			// Check terms of service is agreed to
			if( $term != "Да" OR $rules != "Да") {
				$errors['agreement'] = "Вам необходимо принять все соглашения";
			}
			
			if(0 === count($errors)) {
				$usermeta = array();
				
				$usermeta['field_1'] = $display_name;
				$usermeta['field_1_visibility'] = 'public';
				$usermeta['profile_field_ids'] = '1';
				$usermeta = apply_filters( 'bp_signup_usermeta', $usermeta );
				
				
				$new_user_id = bp_core_signup_user( $email, $password, $email, $usermeta );
				if ( is_wp_error( $new_user_id ) ) {
					echo $new_user_id->get_error_message();
				}else{
					$display_modal = true;
					wp_update_user( array( 'ID' => $new_user_id, 'display_name' => $display_name, 'first_name' => $display_name ) );
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://povestka.by/wp-content/themes/stable/css-old/main.css">
	<link rel="stylesheet" href="https://povestka.by/wp-content/themes/stable/vendor/formvalidation/dist/css/formValidation.min.css">

	<title>Регистрация</title>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script src='https://www.google.com/recaptcha/api.js?render=6Lebe84ZAAAAAFTl-UDTBEbVZAyt2aL-GbA9ySxL'></script>
	<style>
#regContainer {
	 margin-top: 3%;
}
 .panel-login {
	 border-color: #ccc;
	 background-color: #f9f8f8;
	 -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
	 -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
	 box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
}

 .panel-login > .panel-heading {
	 -webkit-transition: all 0.1s linear;
	 -moz-transition: all 0.1s linear;
	 transition: all 0.1s linear;
	 font-size: 48px;
	 color: #066a75;
	 font-family: 'FranchiseRegular', 'Arial Narrow', Arial, sans-serif;
	 font-weight: bold;
	 text-align: center;
	 background: -webkit-repeating-linear-gradient(-45deg, #2BA450, #2BA450 20px, #018E2C 20px, #018E2C 40px, #2BA450 40px);
	 -webkit-text-fill-color: transparent;
	 -webkit-background-clip: text;
}

 .panel-login > .panel-heading hr {
	 margin-top: 10px;
	 margin-bottom: 0px;
	 clear: both;
	 border: 0;
	 height: 1px;
	 background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
	 background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
	 background-image: -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
	 background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
}
 .panel-login input[type="text"], .panel-login input[type="email"], .panel-login input[type="password"] {
	 height: 45px;
	 border: 1px solid #ddd;
	 font-size: 16px;
	 -webkit-transition: all 0.1s linear;
	 -moz-transition: all 0.1s linear;
	 transition: all 0.1s linear;
}
 .panel-login input:hover, .panel-login input:focus {
	 outline: none;
	 -webkit-box-shadow: none;
	 -moz-box-shadow: none;
	 box-shadow: none;
	 border-color: #ccc;
}
 .btn-login {
	 background-color: #3d9db3;
	 outline: none;
	 color: #fff;
	 font-size: 14px;
	 height: auto;
	 font-weight: normal;
	 padding: 14px 0;
	 text-transform: uppercase;
	 border-color: #2d92a9;
}
 .btn-login:hover, .btn-login:focus {
	 color: #fff;
	 background-color: #198da8;
	 border-color: #53a3cd;
}
 .btn-register {
	 background-color: #17ae47;
	 outline: none;
	 color: #fff;
	 font-size: 14px;
	 height: auto;
	 font-weight: normal;
	 padding: 14px 0;
	 text-transform: uppercase;
	 border-color: #1cb94a;
}
 .btn-register:hover, .btn-register:focus {
	 color: #fff;
	 background-color: #1ca347;
	 border-color: #1ca347;
}
 .panel-heading {

}
 

	</style>
</head>
<body>

<div id="regContainer" class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-login">
				<div class="panel-heading">
							Регистрация
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
								<?php wp_nonce_field( 'register', 'nonce' );?>
								<input id="token" type="hidden" name="token">
								<div class="form-group<?php if(isset($errors['display_name'])) echo " has-error"; ?>">
									<label for="display_name">Никнейм</label>
										<input id="display_name" name="display_name" placeholder="Введите Ваше имя или псевдоним" class="form-control input-md" required="" value="<?php if(isset($display_name)) echo $display_name; ?>" type="text" autocomplete="off">
										<?php if(isset($errors['display_name'])) { ?><span class="help-block"><?php echo $errors['display_name']; ?></span><?php } ?>
								</div>
								<div class="form-group<?php if(isset($errors['email'])) echo " has-error"; ?>">
									<label for="email">Email</label>
									<input id="email" name="email" placeholder="Введите Ваш email" class="form-control input-md" required="" type="email" autocomplete="off" value="<?php if(isset($email)) echo $email; ?>">
									<span class="help-block"><?php if(isset($errors['email'])) echo $errors['email']; ?></span>
								</div>
								<div class="form-group<?php if(isset($errors['password'])) echo " has-error"; ?>">
									<label for="password">Пароль</label>
									<input id="password" name="password" placeholder="Введите пароль" class="form-control input-md" required="" type="password" autocomplete="off" value="<?php if(isset($password)) echo $password; ?>">
									<span class="help-block"><?php if(isset($errors['password'])) echo $errors['password']; ?></span>
								</div>
								<div class="form-group<?php if(isset($errors['password_confirmation']) OR isset($errors['password'])) echo " has-error"; ?>">
									<label for="password_confirmation">Подтверждение пароля</label>
									<input id="password_confirmation" name="password_confirmation" placeholder="Повторите пароль" class="form-control input-md" required="" type="password" autocomplete="off" value="<?php if(isset($password_confirmation)) echo $password_confirmation; ?>">
									<span class="help-block"><?php if(isset($errors['password_confirmation'])) echo $errors['password_confirmation']; ?></span>
								</div>

								<div class="form-group <?php if(isset($errors['agreement'])) echo " has-error"; ?>">
									<label>Соглашения</label>
									<div>
										<input id="term" name="term" value="Да" required="" type="checkbox" <?php checked( $term, 'Да' ); ?>> Я подтверждаю, что ознакомлен с <a href="http://povestka.by/help/privacy-policy/">Политикой конфиденциальности</a> и соглашаюсь с ней<br>
									</div>									
								</div>
								<div class="form-group <?php if(isset($errors['agreement'])) echo " has-error"; ?>">
									<div>									
										<input id="rules" name="rules" value="Да" required="" type="checkbox" <?php checked( $rules, 'Да' ); ?>> Я подтверждаю, что ознакомлен с <a href="https://povestka.by/help/rules/">Правилами сайта</a> и соглашаюсь с ними
										<span class="help-block"><?php if(isset($errors['agreement'])) echo $errors['agreement']; ?></span>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<input type="submit" class="form-control btn btn-register" value="Зарегистрироваться">
										</div>
									</div>
								</div>
								<p class="text-center"><a href="<?php echo wp_login_url(); ?>" style="color:#333">Уже зарегистрированы?</a></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="modal fade" tabindex="-1" role="dialog" id="thankyouModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Регистрация завершена!</h4>
      </div>
      <div class="modal-body">
        <p>Вы успешно создали учетную запись. Для ее активации вам необходимо перейти по ссылке из письма, которое мы только что отправили на ваш адрес электронной почты. После этого вы сможете авторизовываться и полноценно пользоваться сайтом.</p>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	<?php wp_footer(); ?>
	<?php if($display_modal) echo "<script> jQuery(window).load(function(){ jQuery('#thankyouModal').modal('show'); }); </script>"; ?>

	<script>
	document.addEventListener('DOMContentLoaded', function(e) {
		const form = document.getElementById('form');
		FormValidation.formValidation(
			form,
			{
				fields: {
					display_name: {
						validators: {
							notEmpty: {
								message: 'Пожалуйста, представьтесь'
							},
							regexp: {
								regexp: /^[a-zA-Z0-9а-яА-ЯёЁІіЎў_-]{3,30}$/,
								message: 'Только буквы, цифры, знак подчеркивания, дефис и пробел, не меньше 3 и не больше 30 символов'
							},
							remote: {
								message: 'Этот никнейм уже занят',
								url: ajaxurl,
								type: 'POST',
								data: {
									action: 'register_check_display_name',
								}
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'Введите корректный e-mail'
							},
							emailAddress: {
								message: 'Введите корректный e-mail'
							},
							remote: {
								data: {
									action: 'register_check_email',
								},
								message: 'Этот email уже занят. <a href=" <php echo wp_lostpassword_url()">Забыли пароль?</a>',
								method: 'POST',
								url: ajaxurl,
							}
						}
					},
					password: {
						validators: {
							stringLength: {
								min: 6,
								max: 20,
								message:'Необходимо заполнить поле, не меньше 6 и не больше 30 символов'
							},
							notEmpty: {
								message:'Необходимо заполнить поле, не меньше 6 и не больше 30 символов'
							}
						}
					},
					password_confirmation: {
						validators: {
							identical: {
								compare: function() {
									return form.querySelector('[name="password"]').value;
								},
								message: 'Введённые пароли не совпадают'
							}
						}
					},
					term: {
						validators: {
							notEmpty: {
								message:'Необходимо принять соглашение'
							}
						}
					},
					rules: {
						validators: {
							notEmpty: {
								message:'Необходимо принять соглашение'
							}
						}
					},
            },
            plugins: {
				
				
				// Validate fields when clicking the Submit button
				submitButton: new FormValidation.plugins.SubmitButton(),

				// Submit the form when all fields are valid
				defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                bootstrap3: new FormValidation.plugins.Bootstrap3(),
                trigger: new FormValidation.plugins.Trigger({
                    delay: {
                        display_name: 3,
                        email: 3,
                    },
                }),

            },
        }
    );
});
		grecaptcha.ready(function() {
            grecaptcha.execute('6Lebe84ZAAAAAFTl-UDTBEbVZAyt2aL-GbA9ySxL', {action: 'homepage'}).then(function(token) {
                document.getElementById('token').value = token
            });
        });
		
	</script>
</div>
</body>
</html>