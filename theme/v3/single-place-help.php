<?php
	function wpshout_save_post_if_submitted() {
		global $wpdb, $post;
		$current_user = wp_get_current_user();


		if ( !isset($_POST['_wp_http_referer']) OR htmlspecialchars($_POST['_wp_http_referer'], ENT_QUOTES | ENT_HTML5, 'UTF-8') !="/place/". $post->ID ."/" ) {
			return null;
		}


		if( !wp_verify_nonce($_POST['_wpnonce'], 'new_org_review_nonce') ) {
			return array( 'error' => 'Мы зафиксировали попытку взлома!');
		}

		if($current_user->ID != get_field('agent', $post->ID) ){
			return array( 'error' => 'Вы не представитель организации!');
		}

		if($current_user->ID == 0){
			return array( 'error' => 'Авторизуйтесь, чтобы ответить!');
		}
		if(!user_can( $current_user->ID, 'ap_new_comment' ) ) {
			return array( 'error' => 'У Вас нет прав для оставления отзыва! Вы либо заблокированы, либо не подтвердили номер.');
		}

		if( (int)$_POST['vote'] <=0 ){
			return array( 'error' => 'Отзыва не существует!');
		}

		$answer = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating_answer WHERE vote_id ='". (int)$_POST['vote'] ."'");
		if(count($answer) == 1) {
			return array( 'error' => 'Ответ уже есть!');
		}

		if( strlen($_POST['comment']) < 10 ) {
			return array( 'error' => 'Комментарий слишком короткий!');
		}

		$result = $wpdb->insert( 'povestka_wp_company_rating_answer', array(
			'user_id' => $current_user->ID,
			'vote_id'  => (int)$_POST['vote'],
			'comment' => $_POST['comment']
		), array('%d', '%d', '%s'));
		if( $result == false){
			return array( 'error' => 'Ошибка созранения данных!');
		}elseif($result > 0){
			$_POST = array();
			return array( 'success' => 'Ответ сохранен.');
		}else{
			return array( 'error' => 'Что-то пошло не так!');
		}
		
	}
	$event = wpshout_save_post_if_submitted();
	
	$current_user = wp_get_current_user();
?>
<?php get_header(); ?>
	<div class="container">
		<div class="row">
			<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php if(has_post_thumbnail( get_the_ID() )) { ?>
					<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" class="img-responsive">
				<?php }else{ ?>
					<img src="https://via.placeholder.com/1200x550.png?text=<?php the_title_attribute() ?>" class="img-responsive">
				<?php } ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php the_content(); ?>
						<table class="table table-bordered">
							<tr>
								<td>Рейтинг</td><td class="note">
									<div class="rating">
										<iframe src="https://povestka.by/api/rating-badge/<?php the_ID()?>/" width="468" height="60" frameborder="0"></iframe>
									</div>
								</td>
							</tr>
							<tr><td>Адрес</td><td class="note"><div class="<?php the_ID(); ?>-adr collapse"><?php the_field('Address', get_the_ID()); ?></div><a href="#" class="show-button" data-show="<?php the_ID()?>-adr" data-stat="adr_<?php the_title_attribute() ?>">Показать</a></td></tr>
							<?php if( !empty(get_field('agent', get_the_ID()))) { ?><tr><td>Сайт</td><td class="note"><a href="#" class="show-button" data-show="<?php the_ID()?>-web" data-stat="web_<?php the_title_attribute() ?>">Показать</a><div class="<?php the_ID(); ?>-web collapse"><a href="https://<?php the_title_attribute() ?>/?utm_source=povestka&utm_medium=reviews"><?php the_title_attribute() ?></a></div></td></tr> <?php } ?>
							<tr><td>Контакты</td><td class="note"><div class="<?php the_ID(); ?>-cnt collapse"><?php the_field('contacts', get_the_ID()); ?></div><a href="#" class="show-button" data-show="<?php the_ID()?>-cnt" data-stat="cnt_<?php the_title_attribute() ?>">Показать</a></td></tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<ul class="nav nav-tabs" role="tablist" id="actions">
							<li role="presentation" class="active"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Обсуждение</a></li>
							<li role="presentation"><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Отзывы</a></li>
							<?php if ( current_user_can( 'edit_post', get_the_ID() ) ) { ?><li role="presentation"><a class="" href="https://povestka.by/wp-admin/post.php?post=<?php echo get_the_ID(); ?>&action=elementor">Изменить страницу</a></li><?php } ?>
						</ul>

						<div class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active" id="comments">
								<?php comments_template(); ?>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="reviews">
								<?php 
									if(isset($event['error'])) {
										echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Внимание!</strong> '. $event["error"] .'</div>';
									}elseif(isset($event['success'])) {
										echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'. $event["success"] .'</div>';
									}
								?>
								<a class="btn btn-success" href="https://povestka.by/rating/#new" role="button">Оставить отзыв</a>
								<?php $reviews = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating WHERE org_id ='".get_the_ID()."' and status='approved' ORDER BY id DESC"); ?>
								<?php if(count($reviews) >0 ){ ?>
									<?php foreach ( $reviews as $review ) { ?>
										<?php $answer = $wpdb->get_results("SELECT * FROM povestka_wp_company_rating_answer WHERE vote_id ='". $review->id ."'"); ?>

										<?php $user_info = get_userdata($review->user_id); ?>
										<article id="div-comment-6818" class="comment-body media">
											<div class="pull-left">
												<img alt="" src="<?php echo get_avatar_url($review->user_id, array( 'default' => 'wavatar', 'force_default' => true )); ?>" class="avatar avatar-50 photo" height="50" width="50">
											</div>
											<div class="media-body">
												<div class="media-body-wrap panel panel-default">
													<div class="panel-heading">
														<h5 class="media-heading"><b><?php echo $user_info->display_name; ?></b> <span class="hidden-xs">оставил(а) отзыв </span>в <time datetime="<?php echo mysql2date( 'c', $review->date ); ?>"><?php echo mysql2date( 'd.m.Y', $review->date ); ?> в <?php echo mysql2date( 'H:i', $review->date ); ?></time><?php if( count($answer) == 0 AND (empty(get_field('agent', get_the_ID())) OR $current_user->ID == get_field('agent', get_the_ID()))) { ?><span class="pull-right"><a href="#" class="show-button" data-show="<?php echo $review->id; ?>-form">Ответить</a></span><?php } ?></h5>
													</div>
													<div class="comment-content panel-body">
														<?php echo apply_filters( 'the_content',  html_entity_decode($review->comment, ENT_HTML5 | ENT_QUOTES) ); ?>
														<br>
														<div class="rating">
															<?php 
																$i = 0;
																for ($j = 1; $j <= $review->rating; $j++ ) {
																	echo '<i class="fa fa-star fa-2x" aria-hidden="true"></i>';
																	$i++;
																}
																for($i; $i <5; $i++){
																	echo '<i class="fa fa-star-o fa-2x" aria-hidden="true"></i>';
																}
															?>
														</div>
													</div>
												</div>
												<div class="media">
													<div class="media-left">
													</div>
													<div class="media-body">
														<div class="answer <?php if (count($answer) == 0) {echo $review->id."-form"; } else{echo "in";} ?>">
														<?php if(count($answer) == 0) { ?>
															<?php if(empty(get_field('agent', get_the_ID()))) { ?>
																<div class="alert alert-warning alert-dismissible" role="alert">
																	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																	<strong>Вы представитель <?php the_title_attribute() ?>?</strong> Пожалуйста свяжитесь с нами по имэйлу <strong>info@povestka.by</strong>
																</div>
															<?php } ?>

															<?php if( !empty(get_field('agent', get_the_ID())) AND$current_user->ID == get_field('agent', get_the_ID())) { ?>
																<form action="#reviews" method="post">
																	<?php wp_nonce_field( 'new_org_review_nonce' ); ?>
																	<input type="text" value="<?php echo $review->id; ?>" name="vote" class="hidden">
																	<textarea class="form-control" name="comment" rows="3"></textarea>
																	<button type="submit" class="btn btn-default">Оставить</button>
																</form>
															<?php } ?>
														<?php }else{ ?>
															<h4 class="media-heading">Ответ организации:</h4>
															<?php echo apply_filters( 'the_content', $answer['0']->comment ); ?>
														<?php } ?>
													</div>
												</div>
											</div><!-- .media-body -->
										</article>
										<hr>
									<?php } ?>
								<?php }else{ ?>
									<a href="/rating/#new_org_review">Оставьте первый отзыв</a>
								<?php } ?>
							</div>
						</div>
					
					</div>
				</div>
			<?php endwhile; ?>
			</section>
		</div>
	</div>
<?php get_footer(); ?>