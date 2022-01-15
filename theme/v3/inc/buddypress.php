<?php
function profile_tab_yourtabname() {
	global $bp;
	
	bp_core_remove_nav_item( 'profile' );
	bp_core_remove_subnav_item( 'settings', 'profile' );
	bp_core_remove_subnav_item( 'settings', 'data' );
	$bp->bp_options_nav['settings']['general']['name'] = 'Email и пароль';
	

	bp_core_new_nav_item( array(
		'name' => 'Мой профиль', 
		'slug' => 'my',
		'show_for_displayed_user' => false,
		'screen_function' => 'profile_my_function', 
		'position' => 1,
		'default_subnav_slug' => 'my'
	) );
	bp_core_new_nav_item( array(
		'name' => 'Мои вопросы', 
		'slug' => 'questions',
		'show_for_displayed_user' => false,
		'screen_function' => 'profile_questions_function', 
		'position' => 1,
		'default_subnav_slug' => 'questions'
	) );
	bp_core_new_nav_item( array(
		'name' => 'Мои ответы', 
		'slug' => 'answers',
		'show_for_displayed_user' => false,
		'screen_function' => 'profile_answers_function', 
		'position' => 1,
		'default_subnav_slug' => 'answers'
	) );

	//settings
	bp_core_new_subnav_item( array(
		'name' => 'Профиль', 
		'slug' => 'my',
		'parent_slug' => 'settings',
		'parent_url' => bp_loggedin_user_domain() . 'settings/', 
		'show_for_displayed_user' => false,
		'screen_function' => 'profile_settings_my_function',
		'position' => 1
	) );
//	$bp->bp_options_nav['settings']['general']['position'] = '2';
//	bp_core_new_subnav_item( array(
//		'name' => 'Ключница', 
//		'slug' => 'keys',
//		'parent_slug' => 'settings',
//		'parent_url' => bp_loggedin_user_domain() . 'settings/', 
//		'show_for_displayed_user' => false,
//		'screen_function' => 'profile_settings_keys_function', 
//		'position' => 3
//	) );
	
}
add_action( 'bp_setup_nav', 'profile_tab_yourtabname' );
 
 
function profile_my_function() {

	function calculate_age($birthday) {
		$birthday_timestamp = strtotime($birthday);
		$age = date('Y') - date('Y', $birthday_timestamp);
		if (date('md', $birthday_timestamp) > date('md')) {
			$age--;
		}
		return $age;
	}
	
    add_action( 'bp_template_content', 'profile_my_content' );
    bp_core_load_template( 'members/single/profile' );
}
function profile_my_content() {
	global $current_user;
	get_currentuserinfo();
?>
	<div class="row">
		<div class="col-sm-10">
			<table class="table table-clean">
				<tbody>
					<tr>
						<td>Зарегистрирован</td>
						<td><?php echo date("d-m-Y", strtotime($current_user->user_registered)); ?></td>
					</tr>
					<tr>
						<td>Возраст</td>
						<td><?php if(!empty(get_user_meta( $current_user->ID, 'birthday', true ))) { echo calculate_age( get_user_meta( $current_user->ID, 'birthday', true ) ); } else {echo '<a href="'. bp_core_get_user_domain($current_user->ID) .'settings/my/">указать</a>'; } ?></td>
					</tr>
					<tr>
						<td>Военкомат</td>
						<td><?php if(!empty(get_user_meta( $current_user->ID, 'military', true ))) { echo "<a href='". get_permalink( get_user_meta( $current_user->ID, 'military', true ) ) ."'>".get_the_title( get_user_meta( $current_user->ID, 'military', true ) )."</a>"; } else {echo '<a href="'. bp_core_get_user_domain($current_user->ID) .'settings/my/">указать</a>'; } ?></td>
					</tr>
				</tbody>
			</table>
			<h4 class="profile-subtitle">Контактная информация</h4>
			<table class="table table-clean">
				<tbody>
					<tr>
						<td class="parm">Email</td>
						<td><?php echo $current_user->user_email; ?></td>
					</tr>
					<tr>
						<td class="parm">Телефон</td>
						<td><?php if(!empty(get_user_meta( $current_user->ID, 'connect_phone', true ))) { echo get_user_meta( $current_user->ID, 'connect_phone', true ); } else {echo 'Не привязан'; } ?></td>
					</tr>
				</tbody>
			</table>
			<h4 class="profile-subtitle">Соглашения</h4>
			<ul>
				<li>Вы приняли <a href="http://povestka.by/help/privacy-policy/">Политику конфиденциальности</a></li>
				<li>Вы приняли <a href="https://povestka.by/help/rules/">Правила сайта</a></li>
				<li>Вы дали согласие на отправку технической информации на e-mail(кроме информации рекламного характера)</li>
			</ul>
		</div>
	</div>
<?php
}
function profile_questions_function() {
    add_action( 'bp_template_content', 'profile_questions_content' );
    bp_core_load_template( 'members/single/profile' );
}
function profile_questions_content() { 
	global $current_user;
	get_currentuserinfo();
?>
	<div id="anspress" class="anspress questions">
		<div id="ap-bp-questions">
			<?php $questions = new WP_Query( array( 'author'=> $current_user->ID, 'post_type' => 'question', 'posts_per_page' => -1 ) ); ?>
			<?php if ( $questions->have_posts() ) : ?>
				<div class="ap-questions">
					<?php
					while ( $questions->have_posts() ) :
						$questions->the_post();
						ap_get_template_part( 'question-list-item' );
					endwhile;
					?>
				</div>
			<?php
				else :
					ap_get_template_part( 'content-none' );
				endif;
			?>
		</div>
	</div>
<?php
}
function profile_answers_function() {
    add_action( 'bp_template_content', 'profile_answers_content' );
    bp_core_load_template( 'members/single/profile' );
}
function profile_answers_content() { 
	global $current_user;
	get_currentuserinfo();
?>
	<div id="anspress" class="anspress answers">
		<div id="ap-bp-questions">
			<?php $answer = new WP_Query( array( 'author'=> $current_user->ID, 'post_type' => 'answer', 'posts_per_page' => -1 ) ); ?>
			<?php if ( $answer->have_posts() ) : ?>
				<div class="ap-answer">
					<?php
					while ( $answer->have_posts() ) :
						$answer->the_post();
						ap_get_template_part( 'buddypress/answer-item' );
					endwhile;
					?>
				</div>
			<?php
				else :
					ap_get_template_part( 'content-none' );
				endif;
			?>
		</div>
	</div>
<?php
}
function profile_settings_keys_function() {
	global $current_user;
	get_currentuserinfo();

			if (isset($_POST['add_soc_vk'])) {
				try {
					$config   = get_template_directory() . '/inc/hybridauth/config.php';
					require_once( get_template_directory()."/inc/hybridauth/Hybrid/Auth.php" );
					$hybridauth = new Hybrid_Auth( $config );
					$adapter = $hybridauth->authenticate( 'Vkontakte' );
					$user_profile = $adapter->getUserProfile();
					
					
					$login = get_users(array('meta_key' => 'auth_vk', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
					if(empty($login)){
						update_user_meta( $current_user->ID, 'auth_vk', $user_profile->identifier );
						bp_core_add_message( "Учетная запись привязана к акаунту", 'success' );
					}else{
						bp_core_add_message( "<b>Произошла ошибка</b>: эта учетная запись привязана к дургому аккаунту", 'error' );
					}
					$adapter->logout();
				}
				catch( Exception $e ){
					bp_core_add_message( "<b>Произошла ошибка:</b> " . $e->getMessage(), 'error' );
				}

			}elseif (isset($_POST['remove_soc_vk'])) {
				update_user_meta( $current_user->ID, 'auth_vk', '' );
				bp_core_add_message( "Учетная запись отвязана от акаунта", 'success' );
			}elseif (isset($_POST['add_soc_fb'])) {
				try {
					$config   = get_template_directory() . '/inc/hybridauth/config.php';
					require_once( get_template_directory()."/inc/hybridauth/Hybrid/Auth.php" );
					$hybridauth = new Hybrid_Auth( $config );
					$adapter = $hybridauth->authenticate( 'Facebook' );
					$user_profile = $adapter->getUserProfile();
					
					$login = get_users(array('meta_key' => 'auth_fb', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
					if(empty($login)){
						update_user_meta( $current_user->ID, 'auth_fb', $user_profile->identifier );
						bp_core_add_message( "Учетная запись привязана к акаунту", 'success' );
					}else{
						bp_core_add_message( "<b>Произошла ошибка</b>: эта учетная запись привязана к дургому аккаунту", 'error' );
					}
					$adapter->logout();
				}
				catch( Exception $e ){
					bp_core_add_message( "<b>Произошла ошибка:</b> " . $e->getMessage(), 'error' );
				}

			}elseif (isset($_POST['remove_soc_fb'])) {
				update_user_meta( $current_user->ID, 'auth_fb', '' );
				bp_core_add_message( "Учетная запись отвязана от акаунта", 'success' );
			}elseif (isset($_POST['add_soc_google'])) {
				try {
					$config   = get_template_directory() . '/inc/hybridauth/config.php';
					require_once( get_template_directory()."/inc/hybridauth/Hybrid/Auth.php" );
					$hybridauth = new Hybrid_Auth( $config );
					$adapter = $hybridauth->authenticate( 'Google' );
					$user_profile = $adapter->getUserProfile();

					$login = get_users(array('meta_key' => 'auth_google', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
					if(empty($login)){
						update_user_meta( $current_user->ID, 'auth_google', $user_profile->identifier );
						bp_core_add_message( "Учетная запись привязана к акаунту", 'success' );
					}else{
						bp_core_add_message( "<b>Произошла ошибка</b>: эта учетная запись привязана к дургому аккаунту", 'error' );
					}
					$adapter->logout();
				}
				catch( Exception $e ){
					bp_core_add_message( "<b>Произошла ошибка:</b> " . $e->getMessage(), 'error' );
				}

			}elseif (isset($_POST['remove_soc_google'])) {
				update_user_meta( $current_user->ID, 'auth_google', '' );
				bp_core_add_message( "Учетная запись отвязана от акаунта", 'success' );
			}
    add_action( 'bp_template_content', 'profile_settings_keys_content' );
    bp_core_load_template( 'members/single/profile' );
}
function profile_settings_keys_content() { 
	global $current_user;
	get_currentuserinfo();
?>
							<div class="row">
								<div class="col-sm-12">
									<h2 class="margin-none">Ключница</h2>
									<p>Привязка учетных записей социальных сетей к аккаунту позволит вам входить в один клик.</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-12">
									<form action="" method="post">
										<?php if(!empty(get_user_meta( $current_user->ID, 'auth_vk', true )) OR !empty(get_user_meta( $current_user->ID, 'auth_fb', true )) OR !empty(get_user_meta( $current_user->ID, 'auth_google', true )) ) {  // тут добавить все соц сети ?>
											<h4>Подключенные сервисы для авторизации</h4>
											<ul class="list-style list-inline">
												<?php if( !empty(get_user_meta( $current_user->ID, 'auth_vk', true )) ) { ?>
												<li>
													<div class="btn-group">
														<span class="btn btn-social btn-vk"><i class="fa fa-vk"></i>ВКонтакте</span>
														<button class="btn btn-default" name="remove_soc_vk" type="submit"><i class="fa fa-times" title="Отключить"></i></button>
													</div>
												</li>
												<?php } ?>
												<?php if( !empty(get_user_meta( $current_user->ID, 'auth_fb', true )) ) { ?>
												<li>
													<div class="btn-group">
														<span class="btn btn-social btn-facebook"><i class="fa fa-facebook"></i>Facebook</span>
														<button class="btn btn-default" name="remove_soc_fb" type="submit"><i class="fa fa-times" title="Отключить"></i></button>
													</div>
												</li>
												<?php } ?>
												<?php if( !empty(get_user_meta( $current_user->ID, 'auth_google', true )) ) { ?>
												<li>
													<div class="btn-group">
														<span class="btn btn-social btn-google"><i class="fa fa-google"></i>Google</span>
														<button class="btn btn-default" name="remove_soc_google" type="submit"><i class="fa fa-times" title="Отключить"></i></button>
													</div>
												</li>
												<?php } ?>
											</ul>
										<?php } ?>
										<?php if( empty(get_user_meta( $current_user->ID, 'auth_vk', true )) OR empty(get_user_meta( $current_user->ID, 'auth_fb', true )) OR empty(get_user_meta( $current_user->ID, 'auth_google', true )) ) { // тут добавить все соц сети ?>
										<br>
										<h4>Доступные к подключению сервисы для авторизации</h4>
										<ul class="list-style list-inline">
											<?php if( empty(get_user_meta( $current_user->ID, 'auth_vk', true )) ) { ?>
												<li>
													<div class="btn-group">
														<button class="btn btn-social btn-vk" name="add_soc_vk" type="submit"><i class="fa fa-vk"></i>ВКонтакте</button>
													</div>
												</li>
											<?php } ?>
											<?php if( empty(get_user_meta( $current_user->ID, 'auth_fb', true )) ) { ?>
											<li>
												<div class="btn-group">
													<button class="btn btn-social btn-facebook" name="add_soc_fb" type="submit"><i class="fa fa-facebook"></i>Facebook</button>
												</div>
											</li>
											<?php } ?>
											<?php if( empty(get_user_meta( $current_user->ID, 'auth_google', true )) ) { ?>
											<li>
												<div class="btn-group">
													<button class="btn btn-social btn-google" name="add_soc_google" type="submit"><i class="fa fa-google"></i>Google</button>
												</div>
											</li>
											<?php } ?>
										</ul>
										<?php } ?>
									</form>
								</div>
							</div>
<?php
}
function profile_settings_my_function() {
	if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		global $current_user;
		get_currentuserinfo();
		$errors = array();

		function validateDate($date, $format = 'Y-m-d H:i:s'){
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}

		$display_name = htmlspecialchars(trim($_POST['display_name']));
		$birthday     = htmlspecialchars(trim($_POST['birthday']));
		$military     = intval($_POST['military']);
		
		if( empty($display_name)){
			$errors['display_name'] = "Отображаемое имя не может быть пустым";
		}else{
			wp_update_user( array( 'ID' => $current_user->ID, 'display_name' => $display_name ) );
		}
		
		if(validateDate($birthday, 'd-m-Y')) {
			if ( time() < strtotime('+16 years', strtotime($birthday))) {
				$errors['birthday'] = "Похоже, что вам нет 16 лет! Минимальный допустимый возраст пользователя сайта - 16 лет.";
			}else{
				update_user_meta( $current_user->ID, 'birthday', $birthday );
			}
		}else{
			$errors['birthday'] = "Проверьте дату рождения.";
		}
		
		if($military == 0){
			update_user_meta( $current_user->ID, 'military', '' );
		}else{
			$military_post = get_post($military);	
			if($military_post != NULL){
				if($military_post->post_type == "place"){
					if(has_term( 'military-registration', 'place-cat', $military )){
//					if(is_object_in_term( $military_post->ID, 'place-cat' )){
						update_user_meta( $current_user->ID, 'military', $military );
					}else{
						$errors['military'] = "Указанный объект не является вонской частью.";
					}
				}else{
					$errors['military'] = "Объект с введенным id не является Местом.";
				}
			}else{
				$errors['military'] = "Части с таким ID не существует.";
			}
		}
		
		if(0 === count($errors)) {
			bp_core_add_message( "Профиль обновлен! Чтобы увидеть изменения - <a href='https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>обновите страницу</a>", 'success' );
		}else{
			bp_core_add_message("Профиль не обновлен! " . $errors['birthday'] . " " . $errors['display_name']. " " . $errors['military'], 'error');
		}
	}
	add_action( 'bp_template_content', 'profile_settings_my_content' );
	bp_core_load_template( 'members/single/profile' );
}
function profile_settings_my_content() {
	global $current_user;
	get_currentuserinfo();
?>
							<div class="row">
								<div class="col-sm-12">
									<h2 class="margin-none">Редактирование профайла</h2>
									<p>Отредактируйте его полностью.</p>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-10">
									<form action="" method="post">
										<table class="table table-clean">
											<tbody>
												<tr>
													<td>Отображаемое имя</td>
													<td>
														<input type="text" class="form-control" name="display_name" id="display_name" placeholder="Отображаемое имя" autocomplete="off" value="<?php echo $current_user->display_name; ?>" required>
														<span class="help-block">Не может быть пустым</span>
													</td>
												</tr>
												<tr>
													<td>Возраст</td>
													<td>
														<input id="birthday" name="birthday" placeholder="Укажите дату вашего рождения" class="form-control" required="" type="text" autocomplete="off" value="<?php echo get_user_meta( $current_user->ID, 'birthday', true ); ?>" required>
														<span class="help-block">Регистрация доступна для лиц достигших 16 лет.</span>
													</td>
												</tr>
												<tr>
													<td>Военкомат</td>
													<td>
														<select class="form-control" name="military">
															<option value="0">Выберите военный комиссариат к которому вы приписаны.</option>
															<?php
																$args = array(
																	'post_type' => 'place',
																	'place-cat' => 'military-registration',
																	'posts_per_page' => -1
																);
																$query = new WP_Query;
																$my_posts = $query->query($args);

																foreach( $my_posts as $my_post ){
																	echo '<option value="'. $my_post->ID .'" '. selected( $my_post->ID, get_user_meta( $current_user->ID, "military", true ) ) .'>'. $my_post->post_title .'</option>';
																}
															?>
														</select>
														<span class="help-block"></span>
													</td>
												</tr>
												<tr>
													<td> </td>
													<td>
														<input type="submit" name="submit" id="submit" value="Сохранить изменения" class="auto">
													</td>
												</tr>
											</tbody>
										</table>
									</form>
								</div>
							</div>
<?php
}
?>