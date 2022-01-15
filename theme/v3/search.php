<?php get_header(); ?>
<?php
$s = get_search_query();
if( !empty( $s ) ) {
	$questions_id = array();
	$news_id = array();
	$docs_id = array();
	$books_id = array();

	//Ищем вопросы, ответы, новости
	$my_posts = new WP_Query;
	$myposts = $my_posts->query( array(
		'post_type' => array( 'question', 'answer', 'post' ),
		'posts_per_page' => -1,
		's' => $s
	) );
	foreach( $myposts as $pst ){
		if( get_post_type( $pst->ID ) == 'post' ) {
			array_push( $news_id, $pst->ID );
		}elseif( get_post_type( $pst->ID ) == 'answer' ) {
			array_push( $questions_id, $pst->post_parent );
		}else{
			array_push( $questions_id, $pst->ID );
		}
	}
	//Ищем комментарии
	$comments = get_comments( array( 'search' => $s ) );
	foreach( $comments as $comment ) {
		if( get_post_type( $comment->comment_post_ID ) == 'question' ) {
			array_push( $questions_id, $comment->comment_post_ID );
		}elseif( get_post_type( $comment->comment_post_ID ) == 'answer' ) {
			array_push( $questions_id, wp_get_post_parent_id( $comment->comment_post_ID ) );
		}elseif( get_post_type( $comment->comment_post_ID ) == 'post' ) {
			array_push( $news_id, $comment->comment_post_ID );
		}
	}
	//уникализируем массивы
	if( count( $questions_id ) > 0 ) { $questions_id = array_unique( $questions_id ); }
	if( count( $news_id ) > 0 ) { $news_id = array_unique( $news_id ); }
	if( count( $docs_id ) > 0 ) { $docs_id = array_unique( $docs_id ); }
	if( count( $books_id ) > 0 ) { $books_id = array_unique( $books_id ); }	
}
?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div id="anspress" class="anspress">
						<div class="ap-list-head clearfix">
							<form id="ap-search-form" class="ap-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<button class="ap-btn ap-search-btn" type="submit"><?php esc_attr_e( 'Search', 'anspress-question-answer' ); ?></button>
								<div class="ap-search-inner no-overflow">
									<input name="s" type="text" class="ap-search-input ap-form-input" placeholder="<?php esc_attr_e( 'Search questions...', 'anspress-question-answer' ); ?>" value="<?php echo get_query_var('s'); ?>" />
								</div>
							</form>
						</div>
					</div>
					<?php if( !empty( $s ) ) { ?>
						<?php if( count( $questions_id ) > 0 ) { ?>
							<h3>Вопросы и ответы</h3>
							<div id="anspress" class="anspress">
								<?php
									set_query_var('ap_hide_list_head', 1);
									anspress()->questions = new Question_Query( array( 'post__in' => $questions_id, 'showposts' => -1 ) );
									ap_get_template_part( 'question-list' );
									 wp_reset_postdata();
								?>
							</div>
						<?php } ?>
						<?php if( count( $news_id ) > 0 ) { ?>
							<h3>Новости</h3>
							<div class="row">
								<?php $query = new WP_Query( array( 'post__in' => $news_id, 'posts_per_page' => -1 ) ); ?>
								<?php $i=1; ?>
								<?php while ( $query->have_posts() ) { $query->the_post(); ?>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 news-block">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php if ( has_post_thumbnail() ) { ?>
												<img src="<?php $dom = simplexml_load_string(get_the_post_thumbnail( get_the_ID(), 'thumbnail' )); $src = $dom->attributes()->src; echo $src; ?>" class="img-responsive img-rounded" alt="<?php the_title(); ?>">
											<?php }else { ?>
											<?php } ?>
											<p class="text"><?php the_title();?></p>
										</a>
									</div>
									<?php $i++; if(($i-1)%3==0) {?><div class="clearfix"></div> <?php }?>
								<?php } ?>
								<?php wp_reset_postdata(); ?>
							</div>
							<div class="clearfix"></div>
						<?php } ?>
						<?php if( count( $docs_id ) > 0 ) { ?>
							<h3>Документы</h3>
						<?php } ?>
						<?php if( count( $books_id ) > 0 ) { ?>
							<h3>Книга памяти</h3>
						<?php } ?>
						<?php
							if( count( $news_id ) == 0 AND count( $docs_id ) == 0 AND count( $books_id ) == 0 AND count( $questions_id ) == 0 ){
								ap_get_template_part( 'content-none' );
							}
						?>
					<?php } ?>
				</section>
			</div>
		</div>
	</section>
<?php get_footer(); ?>