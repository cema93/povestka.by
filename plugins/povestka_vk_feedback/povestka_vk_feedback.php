<?php
/*
Plugin Name: Модуль-помочник сбора обратной связи пользователей vkдля povestka.by
Plugin URI: http://site-style.by/
Description: Модуль-помочник сбора обратной связи пользователей vkдля povestka.by
Version: 1.0
Author: Семён Гавриленко
Author URI: http://site-style.by
*/
	require __DIR__ . '/vendor/autoload.php';
	//Получение токена https://vk.com/dev/authcode_flow_user
	$access_token =  VK_TOKEN;
	$vk = new VK\Client\VKApiClient('5.101');


	// Запускаем хук для выгрузки постов
	function vk_get_posts_cron_job_hook() {
		global $wpdb, $access_token, $vk;

		$response = $vk->wall()->get($access_token, array( 
			'owner_id' => '-12586726', 
			'filter'   => 'others',
			'count'    => 100
		));
		
		foreach ($response['items'] as $array) {
			$result = $wpdb->get_results("SELECT * FROM povestka_wp_vk_posts WHERE id =".$array['id']); 
			if (count($result) == 0) {
				$wpdb->insert( 'povestka_wp_vk_posts', array( 'id' => $array['id'], 'status' => '1_new', 'created' => date('Y-m-d H:i:s', $array['date']) ), array( '%d', '%s', '%s' ));
			}

		}
	}
/*
	add_action( 'vk_get_posts_cron_job', 'vk_get_posts_cron_job_hook' );
	function vk_get_posts_cron_job() {
		if ( ! wp_next_scheduled( 'vk_get_posts_cron_job_hook' ) ) {
			wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'vk_get_posts_cron_job_hook' );
		}
	}
	add_action( 'wp', 'vk_get_posts_cron_job' );
*/

// Запускаем хук для выгрузки каментов
function vk_get_comments_cron_job_hook() {
	global $access_token, $vk, $wpdb;
		
	$result = $wpdb->get_results("SELECT * FROM povestka_wp_vk_posts WHERE status ='1_new'");
	if(count($result) >0 ){
		foreach ( $result as $row ) {
			try { 
				$response = $vk->wall()->getComments($access_token, array( 
					'owner_id' => '-12586726', 
					'post_id' => $row->id,
					'need_likes' => 0,
					'count' => 1,
					'sort' => 'desc',
				));
			} catch (\Exception $e) {
				if($e->getErrorCode() == 15){
					$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'deleted' ), array( 'id' => $row->id ) );
				}else{
					echo "<pre>"; var_dump($e); echo "</pre>";
				}
				sleep(1);
				continue;
			}
				
			if($response['count'] > 0){
				$datetime1 = date_create(date('Y-m-d', $response['items']['0']['date']));
				$datetime2 = date_create(date("Y-m-d"));
				$interval = date_diff($datetime1, $datetime2);
				if($interval->days >3){
					$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'2_wait' ), array( 'id' => $row->id ) );
				}
			}
				
			sleep(1);
		}
	}
}
/*
add_action( 'vk_get_comments_cron_job_hook', 'vk_get_comments_cron_job_hook' );
function vk_get_comments_cron_job() {
	if ( ! wp_next_scheduled( 'vk_get_comments_cron_job_hook' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'twicedaily', 'vk_get_comments_cron_job_hook' );
	}
}
add_action( 'wp', 'vk_get_comments_cron_job' );
*/

function vk_feed_get_count($status){
	global $wpdb;
	$count = $wpdb->get_var("SELECT COUNT(*) FROM povestka_wp_vk_posts WHERE status ='".$status."'");
	return $count;
}

add_action('admin_menu', function(){
	$hook_suffix = add_menu_page( 'Панель', 'Обратная связь VK', 'manage_options', 'vk-feed', 'vk_feed_page', '', 4 );
	add_action( "load-$hook_suffix", 'vk_feed_page_save_action' );
} );

function vk_feed_page_save_action() {
	global $vk_feed_action_message, $wpdb;
	$requestType = $_SERVER['REQUEST_METHOD'];
	$vk_feed_action_message = '';
	if($requestType == 'POST'){
		if( isset($_POST['id']) AND ctype_digit($_POST['id'])) {
			$id = (int)$_POST['id'];
			
			if (isset($_POST['2_wait'])) {
				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'2_wait' ), array( 'id' => $id ) );
				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
			}elseif (isset($_POST['3_friend'])) {
				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'3_friend' ), array( 'id' => $id ) );
				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
			} else if (isset($_POST['4_send'])) {
				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'4_send' ), array( 'id' => $id ) );
				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
			} else if (isset($_POST['deleted'])) {
				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'deleted' ), array( 'id' => $id ) );
				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
			}
		}else{
			wp_die('Есть пост, но нет id');
		}
	}
}

function vk_feed_page(){
	global $wpdb, $vk_feed_action_message;
	$tab = '';
	if(isset($_GET['tab'])){
		$tab = $_GET['tab'];
	} else {
		$tab = '2_wait';
	}

	?>
	<div class="wrap">
		<h2>Обратная связь VK</h2>
		<?php echo $vk_feed_action_message; ?>
		<h2 class="nav-tab-wrapper">
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=1_new" ); ?>" class="nav-tab<?php if($tab=="1_new") echo " nav-tab-active"; ?>">Новые (<?php echo vk_feed_get_count('1_new'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=2_wait" ); ?>" class="nav-tab<?php if($tab=="2_wait") echo " nav-tab-active"; ?>">Обработать (<?php echo vk_feed_get_count('2_wait'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=3_friend" ); ?>" class="nav-tab<?php if($tab=="3_friend") echo " nav-tab-active"; ?>">Запрос в друзья (<?php echo vk_feed_get_count('3_friend'); ?>)</a>
			<a class="nav-tab">Отправлено сообщение (<?php echo vk_feed_get_count('4_send'); ?>)</a>
			<a class="nav-tab">Удалены (<?php echo vk_feed_get_count('deleted'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=get_posts" ); ?>" class="nav-tab<?php if($tab=="get_posts") echo " nav-tab-active"; ?>">Запрос VK</a>
		</h2>
		
		<?php if($tab == '1_new') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_vk_posts WHERE status ='1_new'"); ?>
			<?php if(count($result) >0 ){ ?>
			<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">id</th>
							<th>link</th>
							<th>message</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title"><?php echo $row->id; ?></td>
								<td><a href="https://vk.com/wall-12586726_<?php echo $row->id; ?>" target="_blank">Пост</a></td>
								<td>Добрый день!<br>Меня зовут Семён, я активист Центра прав призывника. <?php echo date('d.m.Y', strtotime($row->created)); ?> вы задали вопрос в нашей группе.<br><br>Наша команда старается сделать всё, чтобы Вам было удобнее и быстрее получать ответы на свои вопросы.<br>Для этого мы сделали опрос, который повлияет на наши внутренние процессы.<br>Прошу Вас пройти опрос(можно анонимно) по ссылке https://povestka.by/vk-feedback<br>Просьба отвечать предельно честно :)<br><br>PS если хотите поддержать наш проект то перейдите по ссылке https://povestka.by/donate/</td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('В обработку', 'secondary', '2_wait', false ); ?> <?php submit_button('В друзья', 'secondary', '3_friend', false ); ?> <?php submit_button('Отправил собщение', 'primary', '4_send', false ); ?> <?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>постов нет</p>
			<?php }?>
		<?php }elseif($tab == '2_wait') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_vk_posts WHERE status ='2_wait'"); ?>
			<?php if(count($result) >0 ){ ?>
			<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">id</th>
							<th>link</th>
							<th>message</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title"><?php echo $row->id; ?></td>
								<td><a href="https://vk.com/wall-12586726_<?php echo $row->id; ?>" target="_blank">Пост</a></td>
								<td>Добрый день!<br>Меня зовут Семён, я активист Центра прав призывника. <?php echo date('d.m.Y', strtotime($row->created)); ?> вы задали вопрос в нашей группе.<br><br>Наша команда старается сделать всё, чтобы Вам было удобнее и быстрее получать ответы на свои вопросы.<br>Для этого мы сделали опрос, который повлияет на наши внутренние процессы.<br>Прошу Вас пройти опрос(можно анонимно) по ссылке https://povestka.by/vk-feedback<br>Просьба отвечать предельно честно :)<br><br>PS если хотите поддержать наш проект то перейдите по ссылке https://povestka.by/donate/</td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('В друзья', 'secondary', '3_friend', false ); ?> <?php submit_button('Отправил собщение', 'primary', '4_send', false ); ?> <?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>

			<?php }else{?>
				<p>постов нет</p>
			<?php }?>
		<?php }elseif($tab == '3_friend') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_vk_posts WHERE status ='3_friend'"); ?>
			<?php if(count($result) >0 ){ ?>
			<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">id</th>
							<th>link</th>
							<th>message</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title"><?php echo $row->id; ?></td>
								<td><a href="https://vk.com/wall-12586726_<?php echo $row->id; ?>" target="_blank">Пост</a></td>
								<td>Добрый день!<br>Меня зовут Семён, я активист Центра прав призывника. <?php echo date('d.m.Y', strtotime($row->created)); ?> вы задали вопрос в нашей группе.<br><br>Наша команда старается сделать всё, чтобы Вам было удобнее и быстрее получать ответы на свои вопросы.<br>Для этого мы сделали опрос, который повлияет на наши внутренние процессы.<br>Прошу Вас пройти опрос(можно анонимно) по ссылке https://povestka.by/vk-feedback<br>Просьба отвечать предельно честно :)<br><br>PS если хотите поддержать наш проект то перейдите по ссылке https://povestka.by/donate/</td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('В друзья', 'secondary', '3_friend', false ); ?> <?php submit_button('Отправил собщение', 'primary', '4_send', false ); ?> <?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>

			<?php }else{?>
				<p>постов нет</p>
			<?php }?>
		<?php }elseif($tab == 'get_posts') { ?>
			Получаем посты из VK:<br>
			<?php vk_get_posts_cron_job_hook(); ?>
			Получаем даты комментарием<br>
			<?php vk_get_comments_cron_job_hook(); ?>
			Запрос завершен!
		<?php } ?>
	</div>
	<?php
}
?>