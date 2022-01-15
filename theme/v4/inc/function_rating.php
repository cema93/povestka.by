<?php

function get_org_rewiews_count($org_id){
	global $wpdb;
	$count = $wpdb->get_var("SELECT COUNT(*) FROM povestka_wp_company_rating WHERE org_id ='".$org_id."' AND status='approved'");
	return $count;
}

function get_org_rewiews_count_by_status($status){
	global $wpdb;
	$count = $wpdb->get_var("SELECT COUNT(*) FROM povestka_wp_company_rating WHERE status='". $status ."'");
	return $count;
}

function recount_org_reviews(){
	global $wpdb;
	
//	$result = $wpdb->get_col("SELECT rating FROM povestka_wp_company_rating WHERE org_id ='".$org_id."' AND status='approved'");
//	if($result == null) { 
//		$average=0; 
//	} else {
//		$average = array_sum($result) / count($result);
//		$average = round($average, 2);
//	}
//	if(update_field( 'rating', $average, (int)$org_id )) {return true;}else{return false;}
	$year_ago = date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y")-1));
	$query = new WP_Query( array( 
		'post_type' => 'place', 
		'posts_per_page' => -1, 
		'place-cat' => 'sluzhby-pomoshhi-prizyvnikam',
	) );
	while ( $query->have_posts() ) { $query->the_post();
		$id = get_the_ID();
		//rating and reviews_count and rating_date
		$result = $wpdb->get_col("SELECT rating FROM povestka_wp_company_rating WHERE org_id ='". $id ."' AND status='approved'");
		if($result == null) { 
			$rating = 0; 
			$reviews_count = 0;
		} else {
			$rating = array_sum($result) / count($result);
			$rating = round($rating, 1);
			$reviews_count = count($result);
		}
		update_field( 'rating', $rating, $id );
		update_field( 'reviews_count', $reviews_count, $id );
		if( $reviews_count > 0 ) {
			$rating_date = $wpdb->get_var( "SELECT date FROM povestka_wp_company_rating WHERE org_id = '". $id ."' AND status='approved' ORDER BY date DESC limit 1" );
			update_field( 'rating_date', $rating_date, $id );
		}else{
			update_field( 'rating_date', '0000-00-00 00:00:00', $id );
		}
		//rating_year 
		$result = $wpdb->get_col("SELECT rating FROM povestka_wp_company_rating WHERE org_id ='". $id ."' AND status='approved' AND date > '". $year_ago ."'");
		if($result == null) { 
			$rating_year = 0; 
		} else {
			$rating_year = array_sum($result) / count($result);
			$rating_year = round($rating_year, 1);
		}
		update_field( 'rating_year', $rating_year, $id );
	}
}

add_action('admin_menu', function(){
	$hook_suffix = add_menu_page( 'Панель', 'Рейтинг организаций ('.get_org_rewiews_count_by_status('new').')', 'manage_options', 'org-rating', 'org_rating_page', '', 4 );
	add_action( "load-$hook_suffix", 'org_rating_page_save_action' );
} );

function org_rating_page_save_action() {
	global $action_message, $wpdb;
	$requestType = $_SERVER['REQUEST_METHOD'];
	$vk_feed_action_message = '';
	if($requestType == 'POST'){
		if( isset($_POST['id']) AND ctype_digit($_POST['id'])) {
			$id = (int)$_POST['id'];
			$org_id = $wpdb->get_var("SELECT org_id FROM povestka_wp_company_rating where id=".$id);

			if (isset($_POST['deleted'])) {
				$result = $wpdb->update( 'povestka_wp_company_rating', array( 'status' =>'deleted' ), array( 'id' => $id ) );
				if($result){
					recount_org_reviews();
					$action_message = '<div id="message" class="updated">Отзыв '. $id .' удалён</div>';
				}
			}elseif (isset($_POST['work'])) {
				$result = $wpdb->update( 'povestka_wp_company_rating', array( 'status' =>'work' ), array( 'id' => $id ) );
				if($result){
					recount_org_reviews();
					$action_message = '<div id="message" class="updated">Отзыв '. $id .' обновлен</div>';
				}
			}elseif (isset($_POST['approved'])) {
				$result = $wpdb->update( 'povestka_wp_company_rating', array( 'status' =>'approved' ), array( 'id' => $id ) );
				if($result){
					recount_org_reviews();
					$action_message = '<div id="message" class="updated">Отзыв '. $id .' обновлен</div>';
				}
			}
		}else{
			wp_die('Есть пост, но нет id');
		}
	}
}

function org_rating_page(){
	global $wpdb, $action_message;
	$tab = '';
	if(isset($_GET['tab'])){
		$tab = $_GET['tab'];
	} else {
		$tab = 'new';
	}
	?>
	<div class="wrap">
		<h2>Отзывы</h2>
		<?php echo $action_message; ?>
		<h2 class="nav-tab-wrapper">
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=new" ); ?>" class="nav-tab<?php if($tab=="new") echo " nav-tab-active"; ?>">Новые (<?php echo get_org_rewiews_count_by_status('new'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=work" ); ?>" class="nav-tab<?php if($tab=="work") echo " nav-tab-active"; ?>">В работе (<?php echo get_org_rewiews_count_by_status('work'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=approved" ); ?>" class="nav-tab<?php if($tab=="approved") echo " nav-tab-active"; ?>">Утверждённые (<?php echo get_org_rewiews_count_by_status('approved'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=deleted" ); ?>" class="nav-tab<?php if($tab=="deleted") echo " nav-tab-active"; ?>">Удалённые (<?php echo get_org_rewiews_count_by_status('deleted'); ?>)</a>
			<a href="<?php echo admin_url( 'admin.php?page='.get_current_screen()->parent_base. "&tab=answer" ); ?>" class="nav-tab<?php if($tab=="answer") echo " nav-tab-active"; ?>">Ответы</a>
		</h2>
		
		
		
		<?php if($tab == 'new') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating WHERE status='new'"); ?>
			<?php if(count($result) >0 ){ ?>
				<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Автор</th>
							<th>Организация</th>
							<th>Оценка</th>
							<th>Договор</th>
							<th>Комментарий</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php $user_info = get_userdata($row->user_id); ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title"><a href="https://povestka.by/wp-admin/user-edit.php?user_id=<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></a></td>
								<td><?php echo get_the_title($row->org_id); ?></td>
								<td><?php echo $row->rating; ?></td>
								<td><?php echo $row->doc; ?></td>
								<td><?php echo apply_filters( 'the_content', $row->comment ); ?></td>
								<td><?php echo $row->date; ?></td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('Взял в работу', 'secondary', 'work', false ); ?> <?php submit_button('Одобрить', 'primary', 'approved', false ); ?> <?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>Отзывов ещё нет</p>
			<?php }?>
		<?php }elseif($tab == 'work') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating WHERE status='work'"); ?>
			<?php if(count($result) >0 ){ ?>
				<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Автор</th>
							<th>Организация</th>
							<th>Оценка</th>
							<th>Договор</th>
							<th>Комментарий</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php $user_info = get_userdata($row->user_id); ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title"><a href="https://povestka.by/wp-admin/user-edit.php?user_id=<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></a></td>
								<td><?php echo get_the_title($row->org_id); ?></td>
								<td><?php echo $row->rating; ?></td>
								<td><?php echo $row->doc; ?></td>
								<td><?php echo apply_filters( 'the_content', $row->comment ); ?></td>
								<td><?php echo $row->date; ?></td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('Одобрить', 'primary', 'approved', false ); ?> <?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>Отзывов ещё нет</p>
			<?php }?>
		<?php }elseif($tab == 'approved') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating WHERE status='approved'"); ?>
			<?php if(count($result) >0 ){ ?>
				<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Автор</th>
							<th>Организация</th>
							<th>Оценка</th>
							<th>Договор</th>
							<th>Комментарий</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php $user_info = get_userdata($row->user_id); ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title" data-id="<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></td>
								<td><?php echo get_the_title($row->org_id); ?></td>
								<td><?php echo $row->rating; ?></td>
								<td><?php echo $row->doc; ?></td>
								<td><?php echo apply_filters( 'the_content', $row->comment ); ?></td>
								<td><?php echo $row->date; ?></td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('Удалить', 'delete', 'deleted', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>Отзывов ещё нет</p>
			<?php }?>
		<?php }elseif($tab == 'deleted') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating WHERE status='deleted'"); ?>
			<?php if(count($result) >0 ){ ?>
				<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Автор</th>
							<th>Организация</th>
							<th>Оценка</th>
							<th>Договор</th>
							<th>Комментарий</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php $user_info = get_userdata($row->user_id); ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title" data-id="<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></td>
								<td><?php echo get_the_title($row->org_id); ?></td>
								<td><?php echo $row->rating; ?></td>
								<td><?php echo $row->doc; ?></td>
								<td><?php echo apply_filters( 'the_content', $row->comment ); ?></td>
								<td><?php echo $row->date; ?></td>
								<td><form method="POST"><input type="hidden" name="id" value="<?php echo $row->id; ?>"><?php submit_button('Взял в работу', 'secondary', 'work', false ); ?> <?php submit_button('Одобрить', 'primary', 'approved', false ); ?></form></td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>Отзывов ещё нет</p>
			<?php }?>
		<?php }elseif($tab == 'answer') { ?>
			<?php $result = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating_answer "); ?>
			<?php if(count($result) >0 ){ ?>
				<?php $i=0; ?>
				<table class="widefat">
					<thead>
						<tr>
							<th class="row-title">Автор</th>
							<th>Ответ</th>
							<th>Дата</th>
							<th>Действия</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $result as $row ) { ?>
							<?php $user_info = get_userdata($row->user_id); ?>
							<tr<?php if( $i++%2 == 0 ){ echo ' class="alternate"'; }?>>
								<td class="row-title" data-id="<?php echo $user_info->ID; ?>"><?php echo $user_info->display_name; ?></td>
								<td><?php echo apply_filters( 'the_content', $row->comment ); ?></td>
								<td><?php echo $row->date; ?></td>
								<td> </td>
							</tr>
						<?php }?>
					</tbody>
				</table>
			<?php }else{?>
				<p>Отзывов ещё нет</p>
			<?php }?>
			<pre>
Как получить доступ к ответам организации?
1) Разместить на всех страницах сайта баннер с рейтингом со страницы Вашей организации.
2) Зарегистрироваться на сайте povestka.by
3) подтвердить имэйл и привязать номер телефона
4) Связаться с Семёном Гавриленко и сообщить логин или имэйл
		
Правила написания ответов:
1) Ответ должен быть  не менее 10 символов
2) Запрещено публиковать личные данные клиента кроме тех, что он указал в отзыве, исключение - номер договора и дата его заключения
3) Запрещено публиковать ссылки, номера телефонов, названия аккаунтов в соц сетях
4) По техническим причинам нет возможности изменить опубликованный ответ либо удалить его.
			</pre>
		<?php } ?>
		
		
		
		
		
		
		
		

	</div>
	<?php
}
?>