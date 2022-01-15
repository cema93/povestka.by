<?php
/*
Plugin Name: Самописные плагины для povestka.by
Plugin URI: http://site-style.by/
Description: Вносимые изменения: убираем admin bar.
Version: 2.0
Author: Семён Гавриленко
Author URI: http://site-style.by
*/

/* Добавляем книгу памяти */
function cema93_memory_book_create_post_type() { // создаем новый тип записи
	register_post_type( 'memory', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'Книга памяти' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'История' ) // даем названия одной записи
				,'add_new' => 'Добавить историю' // для добавления новой записи
				,'add_new_item' => 'Добавить историю' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать историю' // для редактирования типа записи
				,'new_item' => 'Новая история' // текст новой записи
				,'view_item' => 'Посмотреть историю' // для просмотра записи этого типа.
				,'search_items' => 'Поиск истории' // для поиска по этим типам записи
				,'not_found' => 'Историй не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'Историй в корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'Книга памяти' // название меню
			),
			'public' => true,
			'has_archive' => 'memory',
			'menu_position' => 5, // указываем место в левой баковой панели
			'supports' => array('title', 'editor', 'thumbnail'), // тут мы активируем поддержку миниатюр
		)
	);
}
add_action( 'init', 'cema93_memory_book_create_post_type' ); // инициируем добавления типа

/* Добавляем аукцион */
function cema93_lot_create_post_type() { // создаем новый тип записи
	register_post_type( 'lot', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'Лот' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Лот' ) // даем названия одной записи
				,'add_new' => 'Добавить лот' // для добавления новой записи
				,'add_new_item' => 'Добавить лот' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать лот' // для редактирования типа записи
				,'new_item' => 'Новый лот' // текст новой записи
				,'view_item' => 'Посмотреть лот' // для просмотра записи этого типа.
				,'search_items' => 'Поиск лотов' // для поиска по этим типам записи
				,'not_found' => 'лот не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'лот в корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'лот' // название меню
			),
			'public' => true,
			'supports' => array('title', 'editor'), // тут мы активируем поддержку миниатюр
		)
	);
}
add_action( 'init', 'cema93_lot_create_post_type' ); // инициируем добавления типа

/* Добавляем wiki */
function wiki_create_post_type() { // создаем новый тип записи
	register_post_type( 'wiki', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'wiki' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'wiki' ) // даем названия одной записи
				,'add_new' => 'Добавить документ в wiki' // для добавления новой записи
				,'add_new_item' => 'Добавить документ в wiki' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать документ в wiki' // для редактирования типа записи
				,'new_item' => 'Новый документ в wiki' // текст новой записи
				,'view_item' => 'Посмотреть документ в wiki' // для просмотра записи этого типа.
				,'search_items' => 'Поиск документа в wiki' // для поиска по этим типам записи
				,'not_found' => 'Не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'В корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'wiki' // название меню
			),
			'public' => true,
			'has_archive' => 'wiki',
			'rewrite' => array(
				'slug' => 'wiki/%wiki-cat%',
				'hierarchical' => false
			),
			'menu_position' => 5, // указываем место в левой баковой панели
			'supports' => array('title', 'editor'), // тут мы активируем поддержку миниатюр
		)
	);
}
add_action( 'init', 'wiki_create_post_type' ); // инициируем добавления типа

function wiki_add_cema93_faq_cat_taxonomy() {
	register_taxonomy('wiki-cat', 'wiki', array(
		'hierarchical' => true,
		'labels' => array(
				'name' => __( 'Разделы' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Раздел' ), // даем названия одной записи
				'search_items' => __( 'Поиск раздела' ),
				'all_items' => __( 'Все разделы' ),
				'parent_item' => __( 'Родительский раздел' ),
				'parent_item_colon' => __( 'Родительский раздел:' ),
				'edit_item' => __( 'Редактировать раздел' ),
				'update_item' => __( 'Обновить раздел' ),
				'add_new_item' => __( 'Добавить раздел' ),
				'new_item_name' => __( 'Название раздела' ),
				'menu_name' => __( 'Разделы' ),
		),
		'public' => true,
		'query_var' => true,
		'show_tagcloud' => false,
		'show_in_rest' => false,
		'rewrite' => array(
			'slug' => 'wiki',
			'hierarchical' => false
		),
	));
}
add_action( 'init', 'wiki_add_cema93_faq_cat_taxonomy', 0 );

function wiki_post_permalink( $post_link, $id = 0, $leavename = false ) {
	if ( strpos($post_link, '%wiki-cat%') === false ) {
		return $post_link;
	}
	if ( strpos($post_link, 'wiki')){
		$post = get_post($id);
		if ( !is_object($post) || $post->post_type != 'wiki' ) {
		return $post_link;
		}

		$terms = wp_get_object_terms($post->ID, 'wiki-cat');
		if ( !$terms ) {
			return str_replace('wiki/%wiki-cat%/', '', $post_link);
		}

		if($terms['0']->parent > 0){
			$parent_term = get_term( $terms['0']->parent, 'wiki-cat' );
			$locations = $parent_term->slug . "/";
		}else{
			$locations = $terms['0']->slug . "/";
		}
		$locations = trim($locations, "/");

		return str_replace('%wiki-cat%', $locations, $post_link);
	}
}
add_filter('post_type_link', 'wiki_post_permalink', 1, 3);


/* Добавляем Карту */
function place_create_post_type() { // создаем новый тип записи
	register_post_type( 'place', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'Место' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Место' ) // даем названия одной записи
				,'add_new' => 'Добавить место' // для добавления новой записи
				,'add_new_item' => 'Добавить место' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать место' // для редактирования типа записи
				,'new_item' => 'Новое место' // текст новой записи
				,'view_item' => 'Посмотреть место' // для просмотра записи этого типа.
				,'search_items' => 'Поиск места' // для поиска по этим типам записи
				,'not_found' => 'Мест не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'Мест в корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'Карта' // название меню
			),
			'public' => true,
			'has_archive' => 'place',
			'menu_position' => 5, // указываем место в левой баковой панели
			'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author'), // тут мы активируем поддержку миниатюр
			'rewrite' => array(
				'slug' => 'place',
				'hierarchical' => false
			),
			'capability_type' => 'place',
			'map_meta_cap' => true,
		)
	);
}
add_action( 'init', 'place_create_post_type' ); // инициируем добавления типа

function place_add_cat_taxonomy() {
	register_taxonomy('place-cat', 'place', array(
		'hierarchical' => true,
		'labels' => array(
				'name' => __( 'Категории мест' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Категория' ), // даем названия одной записи
				'search_items' => __( 'Поиск категории' ),
				'all_items' => __( 'Все категории' ),
				'parent_item' => __( 'Родительская категория' ),
				'parent_item_colon' => __( 'Родительский категория' ),
				'edit_item' => __( 'Редактировать категорию' ),
				'update_item' => __( 'Обновить категорию' ),
				'add_new_item' => __( 'Добавить категорию' ),
				'new_item_name' => __( 'Название категории' ),
				'menu_name' => __( 'Категории мест' ),
		),
		'public' => true,
		'show_tagcloud' => false,
		'show_in_rest' => false,
		'rewrite' => false,
	));
}
add_action( 'init', 'place_add_cat_taxonomy', 0 );

function place_post_permalink($post_link, $post = 0) {
    if($post->post_type === 'place') {
        return home_url('place/' . $post->ID . '/');
    }
    else{
        return $post_link;
    }
}
add_filter('post_type_link', 'place_post_permalink', 1, 3);
function place_post_permalink_rewrite(){
    add_rewrite_rule('place/([0-9]+)?$', 'index.php?post_type=place&p=$matches[1]', 'top');
}
add_action('init', 'place_post_permalink_rewrite');

function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyDnJh4rOq7-7dC55lnIsamobxUH7MnpEME';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/* Добавляем справку */
function cema93_help_create_post_type() { // создаем новый тип записи
	register_post_type( 'help', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'Идея' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Идея' ) // даем названия одной записи
				,'add_new' => 'Добавить идею' // для добавления новой записи
				,'add_new_item' => 'Добавить идею' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать идею' // для редактирования типа записи
				,'new_item' => 'Новая идея' // текст новой записи
				,'view_item' => 'Посмотреть идею' // для просмотра записи этого типа.
				,'search_items' => 'Поиск идеи' // для поиска по этим типам записи
				,'not_found' => 'Идей не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'Идей в корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'Справочный раздел' // название меню
			),
			'public' => true,
			'has_archive' => 'help',
			'menu_position' => 5, // указываем место в левой баковой панели
			'supports' => array('title', 'editor'),
		)
	);
}
add_action( 'init', 'cema93_help_create_post_type' ); // инициируем добавления типа

add_action('admin_menu', function(){
	$hook_suffix = add_menu_page( 'Настройка таймера', 'Таймер', 'manage_options', 'cema93_timer', 'cema93_timer_toplevel_page' );
	add_action( "load-$hook_suffix", 'cema93_timer_save_action' );
} );

function cema93_timer_save_action() {
	if (isset($_POST["update_settings"])) {  //Если нажали сохранить
		update_option("cema93_timer_years", $_POST['cema93_timer_years']);
		update_option("cema93_timer_months", $_POST['cema93_timer_months']);
		update_option("cema93_timer_days", $_POST['cema93_timer_days']);
		update_option("cema93_timer_text", $_POST['cema93_timer_text']);
	}
}

function cema93_timer_toplevel_page() {
?> 
<div class="wrap">
	<h2>Таймер</h2>
	<?php if (isset($_POST["update_settings"])) { echo '<div id="message" class="updated">Новое время окончания таймета установлено</div>';} ?>
	<h3>Установите дату окончания призыва</h3>
	<form method="POST" action="">
		<table class="wp-list-table widefat fixed">
			<tr>
				<td>
					<select name="cema93_timer_text">
						<?php 
								if( get_option("cema93_timer_text") == 'Идет призыв')
									echo '<option selected value="Идет призыв">Идет призыв</option>';
								else
									echo '<option value="Идет призыв">Идет призыв</option>';
								if( get_option("cema93_timer_text") == 'До призыва')
									echo '<option selected value="До призыва">До призыва</option>';
								else
									echo '<option value="До призыва">До призыва</option>';
								if( get_option("cema93_timer_text") == 'Нет призыва')
									echo '<option selected value="Нет призыва">Нет призыва</option>';
								else
									echo '<option value="Нет призыва">Нет призыва</option>';
						?>
					</select>
				</td>
				<td>Год</td>
				<td>Месяц</td>
				<td>День</td>
			</tr>
			<tr>
				<td>Дата окончания</td>
				<td>
					<select name="cema93_timer_years">
						<?php 
							for($i=date('Y'); $i< (date('Y') + 3) ; $i++)
								if( get_option("cema93_timer_years") == $i)
									echo '<option selected value="'. $i .'">'. $i .'</option>';
								else
									echo '<option value="'. $i .'">'. $i .'</option>';
						?>
					</select>
				</td>
				<td>
					<select name="cema93_timer_months">
						<?php 
							for($i=1; $i< 13 ; $i++)
								if( get_option("cema93_timer_months") == $i)
									echo '<option selected value="'. $i .'">'. $i .'</option>';
								else
									echo '<option value="'. $i .'">'. $i .'</option>';
						?>
					</select>
				</td>
				<td>
					<select name="cema93_timer_days">
						<?php 
							for($i=1; $i< 32 ; $i++)
								if( get_option("cema93_timer_days") == $i)
									echo '<option selected value="'. $i .'">'. $i .'</option>';
								else
									echo '<option value="'. $i .'">'. $i .'</option>';
						?>
					</select>
				</td>
			</tr>
		</table>
		<p align="right">
			<input id="submit" type="submit" value="Сохранить время окончания" class="button-primary"/>
			<input type="hidden" name="update_settings" value="Y" />
		</p> 
	</form>
</div>
<?php  
}
?>
<?php
/* ВИДЖЕТ ТАБОВ */

function tab_content_func() {
	return '<div class="tab-content">';
}
add_shortcode( 'tab-content', 'tab_content_func' );

function end_tab_content_func() {
	return '</div>';
}
add_shortcode( 'end-tab-content', 'end_tab_content_func' );

function tab_func( $atts, $content="" ) {
	$atts = shortcode_atts( array(
		'role' => 'tabpanel',
		'class' => 'tab-pane active',
		'id' => ''
	), $atts );
		$result = '';
	$result .= '<div class="' .$atts['class']. '" id="' .$atts['id']. '">';
	$result .= $content;
	$result .= "</div>";
	return "$result";
}
add_shortcode( 'tab', 'tab_func' );




//Увеличивваем время авторизации
add_filter( 'auth_cookie_expiration', function ( $expiration, $user_id, $remember ) {
	// Вермя жизни cookies
	// Если установлена галочка
	if ( $remember == true ) {
		return 360 * DAY_IN_SECONDS;
	}
	// Если не установлена
	return 180 * DAY_IN_SECONDS;
}, 100, 3 );

add_action('init', 'custom_editor_styles');
function custom_editor_styles() {
	add_editor_style('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
}

/* Добавляем тест на отсрочку */
function cema93_postponement_create_post_type() { // создаем новый тип записи
	register_post_type( 'postponement', // указываем названия типа
		array(
			'labels' => array(
				'name' => __( 'Тест на отсрочки' ), // даем названия разделу, для панели управления
				'singular_name' => __( 'Вопрос теста' ) // даем названия одной записи
				,'add_new' => 'Добавить вопрос' // для добавления новой записи
				,'add_new_item' => 'Добавить вопрос' // заголовка у вновь создаваемой записи в админ-панели.
				,'edit_item' => 'Редактировать вопрос' // для редактирования типа записи
				,'new_item' => 'Новый вопрос' // текст новой записи
				,'view_item' => 'Посмотреть вопрос' // для просмотра записи этого типа.
				,'search_items' => 'Поиск вопросов' // для поиска по этим типам записи
				,'not_found' => 'вопросов не найлено' // если в результате поиска ничего не было найдень
				,'not_found_in_trash' => 'вопросов в корзине не найдено' // если не было найдено в корзине
				,'parent_item_colon' => '' // для родительских типов. для древовидных типов
				,'menu_name' => 'Тест на отсрочки' // название меню
			),
			'public' => true,
			'has_archive' => false,
			'menu_position' => 5, // указываем место в левой баковой панели
			'supports' => array('title', 'editor'), // тут мы активируем поддержку миниатюр
		)
	);
}
add_action( 'init', 'cema93_postponement_create_post_type' ); // инициируем добавления типа


add_filter( 'wpseo_next_rel_link', 'faq_change_wpseo_next' );
add_filter( 'wpseo_prev_rel_link', 'faq_change_wpseo_prev' );

function faq_change_wpseo_next( $link ) {
	if( is_post_type_archive( 'place' ) ){
        return false;
     }else{
		 return $link;;
	 }
}
function faq_change_wpseo_prev( $link ) {
	if( is_post_type_archive( 'place' ) ){
        return false;
     }else{
		 return $link;;
	 }
}


?>