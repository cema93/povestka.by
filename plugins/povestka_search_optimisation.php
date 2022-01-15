<?php
/*
Plugin Name: Оптимизация поиска povestka.by
Plugin URI: http://site-style.by/
Description: 
Version: 1.0
Author: Семён Гавриленко
Author URI: http://site-style.by
*/


add_action('admin_menu', function(){
	$hook_suffix = add_menu_page( 'Статистика запросов', 'Поиск', 'manage_options', 'povestka-search', 'povestka_search_page', '', 4 );
	add_action( "load-$hook_suffix", 'povestka_search_page_save_action' );
} );

function wpdocs_selectively_enqueue_admin_script( $hook ) {
    if ( 'povestka-search' != $hook ) {
        return;
    }
   wp_enqueue_script('jquery-ui-datepicker');
	wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	wp_enqueue_style('jquery-ui');
}
add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );



	

function povestka_search_page_save_action() {
	global $action_message, $wpdb;
	$requestType = $_SERVER['REQUEST_METHOD'];
	$action_message = '';
	if($requestType == 'POST'){
		if (isset($_POST['search_tool_search_optimisation'])) {
			$offset=0;
			$count = 100;
			$value='';
			while ($result = $wpdb->get_results("SELECT * FROM povestka_wp_search_query WHERE id> $offset-1 AND id<$offset+$count")) {
				foreach( $result as $row ){
					if($value == $row->text){
						$wpdb->delete( 'povestka_wp_search_query', [ 'id' => $row->id ] );
					}
					$value = $row->text;
				}
				$offset = $offset+$count;
			}
			$action_message='<div id="message" class="updated">Таблица оптимизирована</div>';
		}
		if (isset($_POST['search_tool_move_comment'])) {
			if( isset($_POST['comment_ID']) AND ctype_digit($_POST['comment_ID']) AND isset($_POST['comment_post_ID']) AND ctype_digit($_POST['comment_post_ID']) ) {
				$comment_ID = (int)$_POST['comment_ID'];
				$comment_post_ID = (int)$_POST['comment_post_ID'];
				
				$wpdb->update( 'povestka_wp_comments', ['comment_post_ID' => $comment_post_ID ], [ 'comment_ID' => $comment_ID ], '%d', '%d' );
				$action_message='<div id="message" class="updated">Комментарий '. $comment_ID .' перемещен к посту '. $comment_post_ID .' </div>';
			}else{
				wp_die('Ошибка в данных!');
			}
		}
		
		
		
//		if( isset($_POST['id']) AND ctype_digit($_POST['id'])) {
//			$id = (int)$_POST['id'];
			
//			if (isset($_POST['2_wait'])) {
//				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'2_wait' ), array( 'id' => $id ) );
//				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
//			}elseif (isset($_POST['3_friend'])) {
//				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'3_friend' ), array( 'id' => $id ) );
//				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
//			} else if (isset($_POST['4_send'])) {
//				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'4_send' ), array( 'id' => $id ) );
//				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
//			} else if (isset($_POST['deleted'])) {
//				$wpdb->update( 'povestka_wp_vk_posts', array( 'status' =>'deleted' ), array( 'id' => $id ) );
//				$vk_feed_action_message='<div id="message" class="updated">'. $id .' изменён</div>';
//			}
//		}else{
//			wp_die('Есть пост, но нет id');
//		}
	}
}
function firstDay($month = '', $year = '') {
    if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   return date('Y-m-d', $result);
}
function lastday($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);
}
function validateDate($date, $format = 'Y-m-d'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
function povestka_search_page(){
	global $wpdb, $action_message;
	$tab = '';
	if(isset($_GET['tab'])){
		$tab = $_GET['tab'];
	} else {
		$tab = 'search_history';
	}
	
	$start_date = '';
	if(isset($_GET['start_date']) AND validateDate($_GET['start_date'])){
		$start_date = $_GET['start_date'];
	} else {
		$start_date = firstDay();
	}
	$end_date = '';
	if(isset($_GET['end_date']) AND validateDate($_GET['end_date'])){
		$end_date = $_GET['end_date'];
	} else {
		$end_date = lastday();
	}
	
	?>

	<div class="wrap">
		<h1><?php echo get_admin_page_title() ?></h1>
		<?php if($tab == 'search_history') { ?>
		<form method="GET" action="">
			<input type="hidden" name="page" value="povestka-search" />
			<input type="date" name="start_date" value="<?php echo $start_date; ?>" min="2021-05-02" max="<?php echo lastday(); ?>" />
			<input type="date" name="end_date" value="<?php echo $end_date; ?>" min="2021-05-02" max="<?php echo lastday(); ?>" />
			<?php submit_button('Выбрать', 'secondary', '', false ); ?>
		</form>
		<?php }elseif($tab == 'questions') { ?>
		<?php }elseif($tab == 'tools') { ?>
		<?php } ?>
		
		<?php echo $action_message; ?>
		<nav class="nav-tab-wrapper">
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=search_history" ); ?>" class="nav-tab<?php if($tab=="search_history") echo " nav-tab-active"; ?>">История поисковых запросов</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=questions" ); ?>" class="nav-tab<?php if($tab=="questions") echo " nav-tab-active"; ?>">Проверка вопросов</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=tools" ); ?>" class="nav-tab<?php if($tab=="tools") echo " nav-tab-active"; ?>">Инструменты</a>
		</nav>
		
		<?php if($tab == 'search_history') { ?>

			<?php $result = $wpdb->get_results("SELECT povestka_wp_search_query.text AS text, COUNT(povestka_wp_search_query.text) AS count FROM povestka_wp_search_query WHERE povestka_wp_search_query.date >= '$start_date 00:00:00' AND povestka_wp_search_query.date <= '$end_date 23:59:59' GROUP BY povestka_wp_search_query.text ORDER BY `count` DESC"); ?>
			<?php $result_count = $wpdb->get_var( "SELECT COUNT(*) FROM povestka_wp_search_query WHERE povestka_wp_search_query.date >= '$start_date 00:00:00' AND povestka_wp_search_query.date <= '$end_date 23:59:59'" ); ?>
			<?php if(count($result) >0 ){ ?>
			<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Запрос (<?php echo count($result); ?>)</th>
							<th>Кол-во (<?php echo $result_count; ?>)</th>
							<th>action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td style="width: 50%"><a href="https://povestka.by/?s=<?php echo htmlspecialchars($row->text); ?>"><?php echo htmlspecialchars($row->text); ?></a></td>
								<td style="width: 10%"><?php echo $row->count; ?></td>
								<td style="width: 40%">
									<form method="POST">
										<input type="hidden" name="text" value="<?php echo $row->text; ?>">
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			<?php }else{ ?>
				<p>запросов нет</p>
			<?php }  ?>
		<?php }elseif($tab == 'questions') { ?>
			<?php $today=date('Y-m-d H:i:s'); ?>
			<?php $result = $wpdb->get_results("SELECT post_id AS ID FROM `povestka_wp_ap_qameta` WHERE (`selected_id` IS NULL OR `selected_id` = 0 ) AND `last_updated` < '$today' AND `answers` > 0 AND `post_id` in (SELECT ID from `povestka_wp_posts` WHERE `post_status` = 'publish' AND `post_type` = 'question' ) ORDER BY `povestka_wp_ap_qameta`.`post_id`  DESC"); ?>
			<?php if(count($result) >0 ){ ?>
			<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">ID (<?php echo count($result); ?>)</th>
							<th>Заголовок</th>
							<th>Информация</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php if( $i >= 1000) { ?>
								<tr<?php if( $i%2 == 0 ){ echo ' class="alternate"'; }?>>
									<td colspan="3">Все строки не влезли!, ещё <?php echo count($result)-$i;?></td>
								</tr>
								<?php break; ?>
							<?php }else{ ?>
								<tr<?php if( $i%2 == 0 ){ echo ' class="alternate"'; }?>>
									<td style="width: 10%"><?php echo $row->ID; ?></a></td>
									<td style="width: 50%"><a href="https://povestka.by/?p=<?php echo $row->ID; ?>"><?php echo get_the_title($row->ID); ?></a></td>
									<td style="width: 40%"></td>
								</tr>
							<?php } ?>
							<?php $i++; ?>
						<?php } ?>
					</tbody>
				</table>
			<?php }else{ ?>
				<p>Всё обработано</p>
			<?php }  ?>

		<?php }elseif($tab == 'tools') { ?>
		<div class="tab-content">
			<form method="POST" action="">
				<?php submit_button('Оптимизация базы данных поиска', 'secondary', 'search_tool_search_optimisation', false, array( 'style' => "margin: 10px 5px;" ) ); ?>
			</form>
			<hr>
			<h2>Переместить комментарий</h2>
			<form method="POST" action="">
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="comment_ID">ID комментария</label></th>
						<td><input name="comment_ID" type="number" class="regular-text"></td>
					</tr>
					<tr>
						<th scope="row"><label for="comment_post_ID">Новый ID поста</label></th>
						<td><input name="comment_post_ID" type="number" class="regular-text"></td>
					</tr>
				</table>
				<p class="submit"><?php submit_button('Обновить комментарий', 'secondary', 'search_tool_move_comment', false, array( 'style' => "margin: 10px 5px;" ) ); ?></p>
				
			</form>

		</div>
		<?php } ?>

	</div>
	<?php
}
?>