<?php get_header(); ?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;

if($paged ==1 AND !empty($_GET["s"]) AND get_current_user_id() != 1) { 
	global $wpdb;
	$wpdb->insert('povestka_wp_search_query', array('text' => wp_kses(wp_unslash($_GET["s"]), 'default' ) ) );
}
$current_article=0;
?>
<section>
	<div class="container">
	
	
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
					<?php if(empty($_GET["s"])) { ?>
						<p style="margin-bottom: 50px; text-align: center; font-size: 150%;">Что будем искать?</p>
						<p style="text-align: center;">А пока ты думаешь посмотри немного рекламы :)</p>
							<?php if(wp_is_mobile()) { ?>
								<!-- Yandex.RTB R-A-986682-4 -->
								<div id="yandex_rtb_R-A-986682-4"></div>
								<script>window.yaContextCb.push(()=>{
								  Ya.Context.AdvManager.render({
									renderTo: 'yandex_rtb_R-A-986682-4',
									blockId: 'R-A-986682-4'
								  })
								})</script>
							<?php }else{ ?>
								<!-- Yandex.RTB R-A-986682-3 -->
								<div id="yandex_rtb_R-A-986682-3"></div>
								<script>window.yaContextCb.push(()=>{
								  Ya.Context.AdvManager.render({
									renderTo: 'yandex_rtb_R-A-986682-3',
									blockId: 'R-A-986682-3'
								  })
								})</script>
							<?php } ?>
					<?php }elseif(!$wp_query->found_posts){ ?>
						<p>
							По Вашему запросу ничего не найдено.<br><br>
							Рекомендации:
							<ul>
								<li>Убедитесь, что все слова написаны без ошибок.</li>
								<li>Попробуйте использовать другие ключевые слова.</li>
								<li>Попробуйте использовать более популярные ключевые слова.</li>
								<li>Попробуйте уменьшить количество слов в запросе.</li>
							</ul>						
						<p>
					<?php } ?>
				<?php if ( have_posts() AND !empty($_GET["s"]) ) { ?>
					<p style="margin-bottom: 30px;">Нашлось <?php echo declension($wp_query->found_posts, array('результат','результата','результатов')); ?></p>
					<?php while ( have_posts() ) { the_post(); $current_article++; ?>
						<a href="https://povestka.by/?p=<?php the_ID(); ?>">
							<div class="search__article">
								<div class="search__article-title">
									<?php echo get_the_title(); ?>
								</div>
								<div>
									<?php
									if(get_post_type() == 'question') {
										if(ap_is_featured_question( get_the_ID() )){
											echo wp_trim_words( wp_strip_all_tags( get_the_content(), true), 30);
										}elseif(ap_have_answer_selected( get_the_ID() )){
											$question = ap_get_post( get_the_ID() );
											$answer = ap_get_post($question->selected_id);
											echo wp_trim_words( wp_strip_all_tags( $answer->post_content, true), 30);
										}else{
											$question = ap_get_post( get_the_ID() );
											$childrens = get_posts( [
												'post_parent' => get_the_ID(),
												'post_type'   => 'answer', 
												'numberposts' => 1,
												'author__not_in' => [ $question->post_author ]
											] );
											if( $childrens ){
												foreach( $childrens as $children ){
													echo wp_trim_words( wp_strip_all_tags( $children->post_content, true), 30);
												}
											}
										}
									}else {
										echo wp_trim_words( wp_strip_all_tags( get_the_content(), true), 30);
									}


									if(get_current_user_id() == 1){
										echo "<hr>";
										echo get_post_type();

										$datetime1 = new DateTime( get_the_date() );
										$datetime2 = new DateTime();
										$interval = $datetime1->diff( $datetime2 );

										if(get_post_type() == 'question') {
											if(ap_is_featured_question( get_the_ID() )){
												echo " | избранный";
												
											}elseif (ap_have_answer_selected( get_the_ID() ) ) {
												echo " | <span style='color:green;'>ответ выбран</span>";
											}elseif($interval->format( '%a' ) < 30) { 
												echo " | <span style='color:red;'>нельзя обрабатывать</span>";
											}else{
												echo " | <span style='color:yellow;'>надо обрабюотать</span>";
											}
											if(get_post_status( get_the_ID() ) !="publish"){
												echo " | <span style='color:red;font-weight:700;'>Неправильный статус</span>";
											}
										}
									}
									?>
								</div>
							</div>
						</a>
						<?php if($current_article == 5 AND $wp_query->post_count > 5 ) { ?>
							<div class="search__article">
								<?php if(wp_is_mobile()) { ?>
									<!-- Yandex.RTB R-A-986682-4 -->
									<div id="yandex_rtb_R-A-986682-4"></div>
									<script>window.yaContextCb.push(()=>{
									  Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-986682-4',
										blockId: 'R-A-986682-4'
									  })
									})</script>
								<?php }else{ ?>
									<!-- Yandex.RTB R-A-986682-3 -->
									<div id="yandex_rtb_R-A-986682-3"></div>
									<script>window.yaContextCb.push(()=>{
									  Ya.Context.AdvManager.render({
										renderTo: 'yandex_rtb_R-A-986682-3',
										blockId: 'R-A-986682-3'
									  })
									})</script>
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>

					<?php
					$end_size = wp_is_mobile() ? 0 : 2;
					echo get_the_posts_pagination( array(
						'show_all'           => false, // показаны все страницы участвующие в пагинации
						'end_size'           => $end_size,     // количество страниц на концах
						'mid_size'           => 2,     // количество страниц вокруг текущей
						'prev_next'          => true,  // выводить ли боковые ссылки "предыдущая/следующая страница".
						'prev_text'          => '<img src="https://povestka.by/wp-content/themes/stable/img/pagination-arrow.svg">',
						'next_text'          => '<img src="https://povestka.by/wp-content/themes/stable/img/pagination-arrow.svg">',
						'class'              => 'text-center',
					) ); ?>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>



















