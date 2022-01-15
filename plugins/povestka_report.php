<?php
/*
Plugin Name: Формирование отчетов для povestka.by
Plugin URI: http://site-style.by/
Description: Вносимые изменения: Выводим отчёты для администратора.
Version: 1.0
Author: Семён Гавриленко
Author URI: http://site-style.by
*/

add_action('admin_menu', function(){
	add_menu_page( 'Ежедневный отчёт', 'Отчёт', 'manage_options', 'povestka-report', 'povestka_report_page', 'dashicons-chart-pie', 4 ); 
} );

function get_count_day_post( $date, $post_type ) {
	$timestamp = strtotime($date);
	$day = getdate($timestamp);
	$args = array(
		'post_type' => $post_type,
		'posts_per_page' => -1,
		'date_query' => array(
			array(
				'year'  => $day['year'],
				'month' => $day['mon'],
				'day'   => $day['mday'],
			),
		),
	);
	$query = new WP_Query( $args );
	return $query->post_count;
}
function get_count_day_comment( $date ) {
	$timestamp = strtotime($date);
	$day = getdate($timestamp);
	$args = array(
		'count'=> true,
		'date_query' => array(
			array(
				'year'  => $day['year'],
				'month' => $day['mon'],
				'day'   => $day['mday'],
			),
		),
	);
	$count = get_comments( $args );
	return $count;
}

function povestka_report_page(){

	?>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/fh-3.1.4/datatables.min.css"/>
	 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/fh-3.1.4/datatables.min.js"></script>
	<script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.10.19/sorting/date-de.js"></script>
	<script>
		jQuery(document).ready( function ( $ ) {
			$('#myTable').DataTable( {
				dom: 'Bfrtip',
				"pageLength": 50,
				fixedHeader: {
					header: true,
					footer: true
				},
				language: {
					buttons: {
						pageLength: {
							_: "Показано %d дней",
							'-1': "Все"
						}
					}
				},
				lengthMenu: [ [ 10, 25, 50, 100, -1 ], [ 10, 25, 50, 100, 'Все' ] ],
				buttons: [ 'pageLength', 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ],
			} );
		} );
	</script>
	<div class="wrap">
		<h1><?php echo get_admin_page_title() ?></h1>
		<table id="myTable" class="cell-border hover dataTable">
			<thead><tr><td>Дата</td><td>кол-во вопросов</td><td>кол-во ответов</td><td>кол-во коментариев</td></tr></thead>
			<tbody>
				<?php
				// Дата начала интервала
				$start = new DateTime("01.04.2017");
				// Дата окончания интервала
				$end = new DateTime("now");
				// Интервал в один день
				$step = new DateInterval('P1D');
				// Итератор по дням
				$period = new DatePeriod($start, $step, $end);
				// Вывод дней
				foreach($period as $datetime) {
					echo "<tr><td data-sort='". $datetime->format("Y-m-d") ."'>". $datetime->format("d.m.Y") ."</td><td class='dt-center'>". get_count_day_post( $datetime->format("d-m-Y"), "question" ) ."</td><td class='dt-center'>". get_count_day_post( $datetime->format("d-m-Y"), "answer" ) ."</td><td class='dt-center'>". get_count_day_comment( $datetime->format("d-m-Y") ) ."</td></tr>";
				}
				?>
			</tbody>
		</table>
	</div>
	<?php
}
?>