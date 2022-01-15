<?php
//require_once('inc/maintenance.php');

require_once('inc/disable-user-registration-notification-emails.php');
require_once('inc/wp_bootstrap_navwalker.php');
require_once('inc/russian-number-comments.php');
require_once('inc/tk_comment.php');
require_once('inc/wp_pagination.php');
require_once('inc/function_please_confirm_number.php');
require_once('inc/function_birthday.php');
require_once('inc/function_admin-profile.php');
require_once('inc/buddypress.php');
require_once('inc/function_rating.php');

global $site_error;
$site_error = new WP_Error;

add_theme_support('post-thumbnails'); //Поддержка миниатюр
add_theme_support( 'title-tag' );

//Убираем Userbar
add_action('after_setup_theme', 'remove_admin_bar'); 
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}
	
	//Start Убирараем лишнее из wp_head
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3 ); // мы избавились от вывода дополнительных RSS каналов, тоесть rss отдельных страниц, рубрик, тегов при всем этом основная лента rss осталась!
	remove_action('wp_head', 'rsd_link', 10); // это нужно, если вы пользуетесь блог-клиентами, удаляйте и не думайте!
	remove_action('wp_head', 'wlwmanifest_link' ); // аналогично нужно для блог-клиента под названием Windows Live Writer, если не знаете что это такое, значит удаляем!
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //  эти функции должны показывать поисковым машинам какая страница вашего сайта является главной, следущей, стартовой и указывает о взаимосвязи документов.
	remove_action('wp_head', 'wp_generator'); //Версия wordpress
	remove_action('wp_head', 'rel_canonical' );
	remove_action('wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	remove_action( 'wp_head', 'wp_resource_hints', 2 );
	//End Убирараем лишнее из wp_head
//START Меняем Адрес Отправки Email По-Умолчанию
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($old) {
	return 'info@povestka.by';
}
function new_mail_from_name($old) {
	return 'Центр прав призывника';
}
//END Меняем Адрес Отправки Email По-Умолчанию

// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );

function my1_scripts_method() {
    wp_enqueue_script( 'jquery' );
	if(is_page('test')){
		wp_enqueue_script( 'es6-shim', '//cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js', array('jquery') );
		wp_enqueue_script( 'formvalidation', get_template_directory_uri() . '/vendor/formvalidation/dist/js/FormValidation.full.min.js' ); 
		wp_enqueue_script( 'formvalidation-bootstrap', get_template_directory_uri() . '/vendor/formvalidation/dist/js/plugins/Bootstrap3.min.js' ); 
	}else{
		wp_enqueue_script( 'bootstrap-validator', '//cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js', array('bootstrap') ); // https://cdnjs.com/libraries/bootstrap-validator
	}
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
	wp_enqueue_script( 'bootstrap-datepicker', get_template_directory_uri() . '/vendor/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js', array('bootstrap') );
	wp_enqueue_script( 'bootstrap-datepicker-locale', get_template_directory_uri() . '/vendor/bootstrap-datepicker-1.9.0/locales/bootstrap-datepicker.ru.min.js', array('bootstrap-datepicker') );

	wp_dequeue_style( 'wp-block-library' );
	wp_deregister_style( 'bp-nouveau' ); 
	wp_deregister_style( 'bp-members-block' ); 
	wp_deregister_style( 'bp-member-block' ); 
	wp_dequeue_script('bp-nouveau');
}    
add_action( 'wp_enqueue_scripts', 'my1_scripts_method' );

//Подключаем скрипты вконце страницы
function footer_enqueue_scripts(){
	remove_action('wp_head','wp_print_scripts');
	remove_action('wp_head','wp_print_head_scripts',9);
	remove_action('wp_head','wp_enqueue_scripts',1);
	add_action('wp_footer','wp_enqueue_scripts',5);
	add_action('wp_footer','wp_print_head_scripts',5);
	add_action('wp_footer','wp_print_scripts',5);
}
add_action('after_setup_theme','footer_enqueue_scripts');

function add_responsive_class($content){
	if( !empty($content) ) {

		$content = str_replace(
			[ '<iframe', '</iframe>' ],
			[ '<div class="embed-responsive embed-responsive-16by9"><iframe', '</iframe></div>' ],
			$content
		);
		$content = str_replace(
			[ '<table>', '</table>' ],
//			[ '<div class="table-responsive"><table class="table table-bordered table-condensed">', '</table></div>' ],
			[ '<table class="table table-bordered table-condensed">', '</table>' ],
			$content
		);

		libxml_use_internal_errors(true);
		$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
		$document = new DOMDocument();
		$document->loadHTML($content);

		foreach ($document->getElementsByTagName('img') as $img) {
			$class = $img-> getAttribute('class'); // Получаем классы картинки
			$classes = explode(" ", $class); // разбиваем строку классов и переводим в массив 
			foreach ($classes as $key => $value) {
				if( $value !="alignright" AND $value !="alignleft" AND $value !="aligncenter" ) unset($classes[$key]); // сверяем классы с нужными нам, ненужные удаляем
			}
			if(count($classes) ==0 ) { array_push($classes, "aligncenter");}
			array_push($classes, "img-responsive"); // добавляем класс для адаптивности картинок
			$class = implode(" ", $classes); // объединяем элементы массива классов в строку
			$img->setAttribute('class', $class); // возвращяем классы картинки
				$img->removeAttribute('width');
			$img->removeAttribute('height');
		}
		$html= preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $document->saveHTML());
		unset($document);
		unset($content);
		return mb_convert_encoding($html, 'UTF-8', "HTML-ENTITIES");
	}
}
add_filter ('the_content', 'add_responsive_class');

add_filter( 'comment_text', 'comment_text_dom' );
function comment_text_dom( $content ) {
	if( !empty($content) ) {
		$have_links = false;

			libxml_use_internal_errors(true);
			$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
			$document = new DOMDocument();
			$document->loadHTML($content, LIBXML_HTML_NODEFDTD);;

			foreach ($document->getElementsByTagName('a') as $link) {
				if (strlen($link->getAttribute('href')) >= 30) {
					$have_links = true;
					$link->nodeValue = substr($link->getAttribute('href'), 0, 25) . '...';
				}
			}
			
			if($have_links) {
				$trim_off_front = strpos($document->saveHTML(),'<body>') + 6;
				$trim_off_end = (strrpos($document->saveHTML(),'</body>')) - strlen($document->saveHTML());
				$html= substr($document->saveHTML(), $trim_off_front, $trim_off_end);
				unset($trim_off_front);
				unset($have_links);
				unset($trim_off_end);
				unset($document);
				unset($content);
				return mb_convert_encoding($html, 'UTF-8', "HTML-ENTITIES");
			}else{
				return $content;
			}
	}
}

//разрешаем некоторые html теги в редакторе start
function wph_add_all_elements($init) {
		$html_tags = 'a[href|target=_blank],img[src|class|alt],h1,h2,h3,h4,h5,h6,pre,b,strong,em,del,hr,br,blockquote,ul[class],ol[class],li,span[style|class],i[class],sup,p[style],iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width],table,tr,td[rowspan|colspan|style]';
        $init['valid_elements'] = $html_tags;
        $init['extended_valid_elements'] = $html_tags;
    return $init;
}
add_filter('tiny_mce_before_init', 'wph_add_all_elements', 20);
//разрешаем некоторые html теги в редакторе end
function bac_allowed_html_tags_in_comments() {
//	define('CUSTOM_TAGS', true);
	global $allowedtags;
  
	$allowedtags = array(
		'a' => array(
			'href' => array(),
			'target' => array(),
		),
		'img' => array(
			'src' => array(),
			'class' => array(),
			'alt' => array(),
		),
		'h1' => array(),
		'h2' => array(),
		'h3' => array(),
		'h4' => array(),
		'h5' => array(),
		'h6' => array(),
		'pre' => array(),
		'b' => array(),
		'strong' => array(),
		'em' => array(),
		'del' => array(),
		'hr' => array(),
		'br' => array(),
		'blockquote' => array(),
		'sup' => array(),
		'ul' => array(),
		'ol' => array(),
		'li' => array(),
		'span' => array(
			'style'=> array(),
			'class'=> array(),
		),
		'i' => array(
			'class'=> array()
		),
		'p' => array(
			'style'=> array()
		),
		'iframe' => array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
		),
		'table' => array(),
		'tr' => array(),
		'td' => array(
			'style' => array(),
		),
	);
}
add_action('init', 'bac_allowed_html_tags_in_comments', 10);

add_action( 'wp_enqueue_scripts', 'my_enqueue_style', 99 );
function my_enqueue_style(){
	wp_dequeue_style( "wsl-widget" );
	if(is_post_type_archive( 'place' )) {
		wp_enqueue_script('yandex-api', 'https://api-maps.yandex.ru/2.1/?lang=ru_RU');
		wp_localize_script( 'yandex-api', 'MyAjax', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'security' )
		));
	}
}

function place_inline_script() {
	if ( wp_script_is( 'yandex-api', 'done' ) AND is_post_type_archive( 'place' ) ) {
?>
	<script type="text/javascript">
	ymaps.ready(init);

function init () {
	var myMap = new ymaps.Map('map', {
			center: [53.78897009, 27.97742750],
			zoom: 6,
			type: 'yandex#map',
			controls: ["zoomControl"]
	}, {
			searchControlProvider: 'yandex#search',
			suppressMapOpenBlock: true,
			restrictMapArea: [[56.5, 18], [50.5, 38]]
	}),
	objectManager = new ymaps.ObjectManager();
	myMap.geoObjects.add(objectManager);

	ymaps.borders.load('001', {
		lang: 'ru',
		quality: 3
	}).then(function (result) {

		// Создадим многоугольник, который будет скрывать весь мир, кроме заданной страны.
		var background = new ymaps.Polygon([
			[
				[85, 179.99],
				[-85, 179.99],
				[-85, -179.99],
				[85, -179.99]
			]
		], {}, {
			fillColor: '#fbfafa',
			strokeWidth: 0,
			// Для того чтобы полигон отобразился на весь мир, нам нужно поменять
			// алгоритм пересчета координат геометрии в пиксельные координаты.
			coordRendering: 'straightPath'
		});

		// Найдём страну по её iso коду.
		var region = result.features.filter(function (feature) { return feature.properties.iso3166 == 'BY'; })[0];

		// Добавим координаты этой страны в полигон, который накрывает весь мир.
		// В полигоне образуется полость, через которую будет видно заданную страну.
		var masks = region.geometry.coordinates;
		masks.forEach(function(mask){
			background.geometry.insert(1, mask);
		});

		// Добавим многоугольник на карту.
		myMap.geoObjects.add(background);
	});

	jQuery.ajax({
		url: MyAjax.ajaxurl,
		type: 'POST',
		data: {
			action: 'place_list',
			security : MyAjax.security
		}
	}).done(function(data) {
		objectManager.add(data);
		document.getElementById("map-loading").style.display = "none";
		document.getElementById("map").style.display = "block";
	});

	var elements = document.querySelectorAll('.place-cat-list > input');
	var ids = [];
	for (var i = 0; i < elements.length; i++) {
		ids[i] = elements[i].id;
	}
	jQuery('.place-cat-list input').change(function(){ 
		document.getElementById("map-loading").style.display = "block";
		document.getElementById("map").style.display = "none";
		var id = jQuery(this).attr('id');
		if(jQuery(this).is(':checked') ){
			ids.push(id);
		}else{
			ids.splice(jQuery.inArray(id, ids),1);
		}
		objectManager.setFilter(function(object) {
			return ids.includes(object.options.preset);
		});
		document.getElementById("map-loading").style.display = "none";
		document.getElementById("map").style.display = "block";
	});
}
	</script>
<?php
	}
}
add_action( 'wp_footer', 'place_inline_script' );

function place_list_action_callback() {
	check_ajax_referer( 'security', 'security' );
	$json = array();
	$json['type'] = 'FeatureCollection';
		
	$my_posts = new WP_Query;
	$myposts = $my_posts->query( array(
		'post_type' => 'place',
		'posts_per_page' => -1,
		'post_status' => 'publish'
	) );
	$places = array();
	foreach( $myposts as $pst ){
		$location = get_field('coordinates', $pst->ID);
		$location1 = get_field('coordinates1', $pst->ID);
		if(!is_array($location)){
			continue;
//			$location = array('lat' => 0, 'lng'=>0);
		}
		$cat_id = wp_get_post_terms( $pst->ID, 'place-cat', array('orderby' => 'parent ', 'fields' => 'ids') );

		$array = array();
		$array['type']			= "Feature";
		$array['id']			= $pst->ID;
		$array['geometry']		= array("type"=> "Point", 'coordinates'=> array(doubleval($location['lat']), doubleval($location['lng'])));
		if( has_term( 'military-registration', 'place-cat', $pst->ID ) ){
			$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small><br><a class="btn btn-info btn-xs btn-block" href="'.get_permalink($pst->ID).'" role="button" target="_blank">Подробнее</a>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
		}elseif( has_term( 'sluzhby-pomoshhi-prizyvnikam', 'place-cat', $pst->ID ) ){
			$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small><br><a class="btn btn-info btn-xs btn-block" href="'.get_permalink($pst->ID).'" role="button" target="_blank">Отзывы и обсуждение</a>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
		}else{
			$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
		}
		$array['options']		= array('preset'=> 'islands#'. get_field('ymap_placemark_color', 'place-cat_'.$cat_id[0]) .'DotIcon');
		
		array_push($places, $array);
		
		if(is_array($location1)){
			$array = array();
			$array['type']			= "Feature";
			$array['id']			= $pst->ID."1";
			$array['geometry']		= array("type"=> "Point", 'coordinates'=> array(doubleval($location1['lat']), doubleval($location1['lng'])));
			if( has_term( 'military-registration', 'place-cat', $pst->ID ) ){
				$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small><br><a class="btn btn-info btn-xs btn-block" href="'.get_permalink($pst->ID).'" role="button" target="_blank">Подробнее</a>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
			}elseif( has_term( 'sluzhby-pomoshhi-prizyvnikam', 'place-cat', $pst->ID ) ){
				$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small><br><a class="btn btn-info btn-xs btn-block" href="'.get_permalink($pst->ID).'" role="button" target="_blank">Отзывы и обсуждение</a>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
			}else{
				$array['properties']	= array('balloonContent'=> '<b>'.get_the_title($pst->ID).'</b><br><small>'.get_field('Address', $pst->ID).'</small>'/*, 'clusterCaption'=> 'clusterCaption', 'myDescription'=>'myDescription'*/);
			}
			$array['options']		= array('preset'=> 'islands#'. get_field('ymap_placemark_color', 'place-cat_'.$cat_id[0]) .'DotIcon');
			
			array_push($places, $array);
			
		}
	}
	$json['features'] = $places;
	echo wp_json_encode($json);
	unset($my_posts);
	unset($myposts);
	unset($places);
	unset($json);
	die(); // this is required to return a proper result
}
if( wp_doing_ajax() ){
	add_action( 'wp_ajax_place_list', 'place_list_action_callback' );
	add_action( 'wp_ajax_nopriv_place_list', 'place_list_action_callback' );
}
	
register_nav_menus(array(
	'header_menu' => 'Меню в шапке сайта',
	'user_header_menu' => 'Пользовательское меню в шапке сайта',
	'footer_menu' => 'Меню в подвале сайта',
	'help_menu' => 'Меню в справочном разделе',
));


function maxsite_the_russian_time($tdate = '') {
	if ( substr_count($tdate , '---') > 0 ) return str_replace('---', '', $tdate);

	$treplace = array (
	"Январь" => "января",
	"Февраль" => "февраля",
	"Март" => "марта",
	"Апрель" => "апреля",
	"Май" => "мая",
	"Июнь" => "июня",
	"Июль" => "июля",
	"Август" => "августа",
	"Сентябрь" => "сентября",
	"Октябрь" => "октября",
	"Ноябрь" => "ноября",
	"Декабрь" => "декабря",
	
	"January" => "января",
	"February" => "февраля",
	"March" => "марта",
	"April" => "апреля",
	"May" => "мая",
	"June" => "июня",
	"July" => "июля",
	"August" => "августа",
	"September" => "сентября",
	"October" => "октября",
	"November" => "ноября",
	"December" => "декабря",	
	
	"Sunday" => "воскресенье",
	"Monday" => "понедельник",
	"Tuesday" => "вторник",
	"Wednesday" => "среда",
	"Thursday" => "четверг",
	"Friday" => "пятница",
	"Saturday" => "суббота",
	
	"Sun" => "воскресенье",
	"Mon" => "понедельник",
	"Tue" => "вторник",
	"Wed" => "среда",
	"Thu" => "четверг",
	"Fri" => "пятница",
	"Sat" => "суббота",
	
	"th" => "",
	"st" => "",
	"nd" => "",
	"rd" => ""

	);
   	return strtr($tdate, $treplace);
}

add_filter('the_time', 'maxsite_the_russian_time');
add_filter('get_the_time', 'maxsite_the_russian_time');
add_filter('the_date', 'maxsite_the_russian_time');
add_filter('get_the_date', 'maxsite_the_russian_time');
add_filter('the_modified_time', 'maxsite_the_russian_time');
add_filter('get_the_modified_date', 'maxsite_the_russian_time');
add_filter('get_post_time', 'maxsite_the_russian_time');
add_filter('get_comment_date', 'maxsite_the_russian_time');

	// отключаем создание миниатюр файлов для указанных размеров
	add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
	function delete_intermediate_image_sizes( $sizes ){
		// размеры которые нужно удалить
		return array_diff( $sizes, array(
			'medium',
			'large',
			'medium_large'
		) );
	}
function my_revisions_to_keep( $revisions, $post ) {
	if ( 'question' == $post->post_type OR 'answer' == $post->post_type )
		return 0;
	else
		return 5;
}
add_filter( 'wp_revisions_to_keep', 'my_revisions_to_keep', 10, 2 );

//bootstrap video responsive embed
function bootstrap_embed( $html, $url, $attr ) {
	if ( ! is_admin() ) {
		return "<div class=\"embed-responsive embed-responsive-16by9\">" . $html . "</div>";
	} else {
		return $html;
	}
}
add_filter( 'embed_oembed_html', 'bootstrap_embed', 10, 3 );

/**
 * Hook to filter comments form.
 *
 * @param array $form Comment form
 */
add_filter( 'ap_comment_form_fields', function( $form ) {
  $form['fields']['content']['min_length'] = 2;
  
  return $form;
});

function help_inline_script() {
	if ( wp_script_is( 'jquery', 'done' ) AND is_post_type_archive( 'help' ) ) {
?>
	<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery('.like-button input').change(function(){ 
		var id = jQuery(this).attr('id');
		console.log(id);
		
		if(jQuery(this).is(':checked') ){
			console.log('c');
		}else{
			console.log('nc');
		}
	});
	
//		jQuery.ajax({
//			type: "post",
//			url: ajax_var.url,
//			data: "action=post-like&nonce="+ajax_var.nonce+"&type="+type+"&post_like=&post_id="+post_id,
//			success: function(data){
//				var parse_data = JSON.parse(data);
//				post_likes(parse_data[1], parse_data[0]);
//			}
//		});
});
	</script>
<?php
	}
}
add_action( 'wp_footer', 'help_inline_script' );

//remove_filter( 'authenticate', 'wp_authenticate_username_password', 20, 3 );
//add_filter( 'authenticate', 'tcb_authenticate_username_password', 20, 3 );
//function tcb_authenticate_username_password( $user, $email, $password ) {
//	if ( ! empty( $email ) && is_email( $email ) ) :
//		if ( $user = get_user_by_email( $email ) )
//			$email = $user->user_login;
//	endif;

//	return wp_authenticate_username_password( null, $email, $password );
//}
/*
if (isset($_POST['auth_soc_vk'])) {
	if( !is_user_logged_in()){
		try {
			$config   = dirname(__FILE__) . '/inc/hybridauth/config.php';
			require_once( "inc/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );
			$adapter = $hybridauth->authenticate( 'Vkontakte' );
			$user_profile = $adapter->getUserProfile();
			$adapter->logout();

			$login = get_users(array('meta_key' => 'auth_vk', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
			if(empty($login)){
				$site_error->add('vk_not_found', 'Этот аккаунт не зарегистрирован. ');
			}else{
				wp_set_current_user ( $login['0']->ID );
				wp_set_auth_cookie  ( $login['0']->ID );
				wp_safe_redirect( "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
			}
		}
		catch( Exception $e ){
			$site_error->add('vk_error', "<b>Произошла ошибка:</b> " . $e->getMessage() );
		}
	}	
}elseif (isset($_POST['auth_soc_fb'])) {
	if( !is_user_logged_in()){
		try {
			$config   = dirname(__FILE__) . '/inc/hybridauth/config.php';
			require_once( "inc/hybridauth/Hybrid/Auth.php" );
			$hybridauth = new Hybrid_Auth( $config );
			$adapter = $hybridauth->authenticate( 'Facebook' );
			$user_profile = $adapter->getUserProfile();
			$adapter->logout();

			$login = get_users(array('meta_key' => 'auth_fb', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
			if(empty($login)){
				$site_error->add('fb_not_found', 'Этот аккаунт не зарегистрирован .');
			}else{
				wp_set_current_user ( $login['0']->ID );
				wp_set_auth_cookie  ( $login['0']->ID );
				wp_safe_redirect( "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
			}
		}
		catch( Exception $e ){
			$site_error->add('fb_error', "<b>Произошла ошибка:</b> " . $e->getMessage() );
		}
	}
}elseif (isset($_POST['auth_soc_google'])) {
	if( !is_user_logged_in()){
		try {
			$config   = dirname(__FILE__) . '/inc/hybridauth/config.php';
			require_once( "inc/hybridauth/Hybrid/Auth.php" );
			
			$hybridauth = new Hybrid_Auth( $config );
			$adapter = $hybridauth->authenticate( 'Google' );
			$user_profile = $adapter->getUserProfile();
			$adapter->logout();

			$login = get_users(array('meta_key' => 'auth_google', 'meta_value' => $user_profile->identifier, 'number' => 1, "fields"=> array('ID') ));
			if(empty($login)){
				$site_error->add('google_not_found', 'Этот аккаунт не зарегистрирован. ');
			}else{
				wp_set_current_user ( $login['0']->ID );
				wp_set_auth_cookie  ( $login['0']->ID );
				wp_safe_redirect( "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
			}
		}
		catch( Exception $e ){
			$site_error->add('google_error', "<b>Произошла ошибка:</b> " . $e->getMessage() );
		}
	}	
}
*/

add_action( 'after_setup_theme', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
	add_editor_style( 'editor-styles.css' );
}

// https://wp-kama.ru/question/funktsiya-skloneniya-slov-posle-chisel-php
function num_decline( $number, $titles, $param2 = '', $param3 = '' ){

	if( $param2 )
		$titles = [ $titles, $param2, $param3 ];

	if( is_string($titles) )
		$titles = preg_split( '/, */', $titles );

	if( empty($titles[2]) )
		$titles[2] = $titles[1]; // когда указано 2 элемента

	$cases = [ 2, 0, 1, 1, 1, 2 ];

	$intnum = abs( intval( strip_tags( $number ) ) );

	return "$number ". $titles[ ($intnum % 100 > 4 && $intnum % 100 < 20) ? 2 : $cases[min($intnum % 10, 5)] ];
}

add_filter( 'body_class','sendpulse_body_class' );
function sendpulse_body_class( $classes ) {
	if( is_singular( array('post', 'wiki') ) ) {
		$classes[] = 'sp_notify_prompt';
	}
	if(is_page('rating') OR (is_singular( array('place') ) AND has_term('sluzhby-pomoshhi-prizyvnikam', 'place-cat'))){
		$classes[] = 'rating';
	}
	return $classes;
}


function display_ad(){
//	if(is_user_logged_in()){
//		return false;
//	}
//	return true;
	return false;
}

function cema93_is_uniq_display_name_translit($str) {
$str = mb_strtoupper($str);
/*
	1) На входе всегда заглавные буквы
	2) Всё переводим в заглавные английские буквы для сравнения

*/
	$tr = array(
		"1"=>"L",
		"3"=>"З",
		"6"=>"Б",
		"0"=>"O",
		"А"=>"A",
		"В"=>"B",
		"Е"=>"E",
		"И"=>"U",
		"К"=>"K",
		"М"=>"M",
		"Н"=>"H",
		"О"=>"O",
		"Р"=>"P",
		"С"=>"C",
		"У"=>"Y",
		"Х"=>"X",
	);
	return strtr($str,$tr);
}
function cema93_is_uniq_display_name($display_name){
	$display_name = mb_strtoupper($display_name);
	
	$blogusers = get_users(array('fields'=> array('display_name')));
	foreach ( $blogusers as $user ) {
		if (strcasecmp(cema93_is_uniq_display_name_translit($display_name), cema93_is_uniq_display_name_translit($user->display_name)) ==0) return 0;
	}
	return 1;

}


add_action( 'wp_ajax_nopriv_register_check_display_name', 'ajax_cema93_is_uniq_display_name' ); // For anonymous users
function ajax_cema93_is_uniq_display_name(){	
	$valid =false;
	if(cema93_is_uniq_display_name(filter_input(INPUT_POST, 'display_name', FILTER_SANITIZE_STRING))) $valid = true;		
    echo( json_encode( array( 'valid'=> $valid ) ) );
    wp_die();
}

add_action( 'wp_ajax_nopriv_register_check_email', 'ajax_cema93_is_uniq_email' ); // For anonymous users
function ajax_cema93_is_uniq_email(){	
	$valid =false;
	if(!email_exists( filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING))) $valid = true;		
    echo( json_encode( array( 'valid'=> $valid ) ) );
    wp_die();
}


function homepage_posts($query)
{
    if ($query->is_tax('wiki-cat') && $query->is_main_query() && !$query->is_tax('wiki-cat', array('directory')))
    {
        $query->set( 'orderby', 'date' );
    }
}
add_action('pre_get_posts', 'homepage_posts');

// Clear items that are older than 22 days (i.e. keep only the most recent 22 days in the log)
add_filter( 'simple_history/db_purge_days_interval', function( $days ) {
	$days = 365;
	return $days;
} );

?>