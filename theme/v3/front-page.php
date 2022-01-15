<?php get_header(); ?>
			<div class="container">
				<ul class="nav nav-tabs row" role="tablist" id="tabs">
					<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="section-wrapper">
							<a href="/doc/">
								<img src="https://povestka.by/wp-content/themes/stable/img/sections/1.png" class="img-responsive" alt="Образцы заявлений, обращений и прочих документов" />
								<p>Образцы заявлений и жалоб</p>
							</a>
							<div class="section-border-1"></div>
							<div class="section-border-2"></div>
							<div class="section-border-3"></div>
							<div class="section-border-4"></div>
						</div>
					</li>
					<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="section-wrapper">
							<a href="/doc/#medical">
								<img src="https://povestka.by/wp-content/themes/stable/img/sections/2.png" class="img-responsive" alt="Медицинские противопоказания для службы в армии" />
								<p>Медицинские противопоказания для службы в армии</p>
							</a>
							<div class="section-border-1"></div>
							<div class="section-border-2"></div>
							<div class="section-border-3"></div>
							<div class="section-border-4"></div>
						</div>
					</li>
					<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="section-wrapper">
							<a href="/doc/#law">
								<img src="https://povestka.by/wp-content/themes/stable/img/sections/3.png" class="img-responsive" alt="Нормативно-правовые акты" />
								<p>Нормативно-правовые акты</p>
							</a>
							<div class="section-border-1"></div>
							<div class="section-border-2"></div>
							<div class="section-border-3"></div>
							<div class="section-border-4"></div>
						</div>
					</li>
					<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
						<div class="section-wrapper">
							<a href="/doc/#gos">
								<img src="https://povestka.by/wp-content/themes/stable/img/sections/4.png" class="img-responsive" alt="Разъяснения от государственных органов" />
								<p>Разъяснения от государственных органов и комментарии к законодательству</p>
							</a>
							<div class="section-border-1"></div>
							<div class="section-border-2"></div>
							<div class="section-border-3"></div>
							<div class="section-border-4"></div>
						</div>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="row faq-header" id="faq">
					<?php $the_query = new WP_Query( array( 'post_type' => 'faq', 'cema93-faq-cat' => array( 'prizyv', 'meditsina-otsrochki', 'ngm-zapas-sbory-ags' ), 'posts_per_page' => -1, 'meta_query'  => array( array( 'key'        => 'show_on_front-page', 'compare'    => '=', 'value'      => true )), 'meta_key' => 'order_number', 'orderby' => 'meta_value', 'order' => 'ASC' )); ?>
					<?php if($the_query->have_posts()) { ?>
						<div class="col-xs-4 col-sm-3 col-md-2 col-lg-3">
							<div class="faq-title">
								FAQ<span>Актуальные <br>вопросы</span>
							</div>
						</div>
						<div class="col-xs-8 col-sm-offset-4 col-md-offset-6 col-lg-offset-6  col-sm-5 col-md-4 col-lg-3">
							<a href="https://povestka.by/faq/" class="question-btn">Все вопросы</a>
						</div>
						<div class="clearfix"></div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="panel-group">
								<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<div class="panel panel-default panel-help">
										<a href="#faq-<?php the_ID(); ?>" data-toggle="collapse">
											<div class="panel-heading">
												<?php echo ltrim( (string)get_field("order_number", get_the_ID()), '0'); ?>. <?php the_title();?>
											</div>
										</a>
										<div id="faq-<?php the_ID(); ?>" class="collapse">
											<div class="panel-body">
												<?php the_content();?>
											</div>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="news-separator"><a href="/news/">Новости</a></div>
					</div>
					<div class="clearfix"></div>
					
						<?php $sticky = get_option( 'sticky_posts' ); $sticky_post = 0; ?>
						<?php if($sticky) { ?>
							<?php
								global $more;
								$the_query = new WP_Query( array('posts_per_page' => 1, 'category_name' => 'news', 'post__in' => $sticky, 'ignore_sticky_posts' => 1));
								$i=1;
							?>
							<?php while( $the_query->have_posts() ) : $the_query->the_post();
									$more = 0;
									$sticky_post = get_the_ID();
							?>
							<?php if ( has_post_thumbnail() ) { ?>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-rounded img-responsive" style="margin: 0 auto 10px auto;" loading="lazy" alt="<?php the_title(); ?>"></a>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
											<div class="news-text">
												<p class="news-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></p>
												<p class="text hidden-xs"><?php echo strip_tags(get_the_content('')); ?></p>
												<p class="news-date hidden-xs"><?php the_time('j F Y'); ?></p>
											</div>
										</div>
									<?php }else { ?>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="news-text">
												<p class="news-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></p>
												<p class="text hidden-xs"><?php echo strip_tags(get_the_content('')); ?></p>
												<p class="news-date hidden-xs"><?php the_time('j F Y'); ?></p>
											</div>
										</div>
									<?php } ?>
								<?php endwhile; ?>
							<div class="clearfix"></div>
							<?php
								global $more;
								$the_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3, 'category_name' => 'news', 'post__not_in' => array($sticky_post) ));
								$i=1;
							?>
							<?php while( $the_query->have_posts() ) : $the_query->the_post();
									$more = 0;
							?>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 news-block">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php if ( has_post_thumbnail() ) { ?>
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-responsive img-rounded" loading="lazy" alt="<?php the_title(); ?>">
											<?php }else { ?>
											<?php } ?>
											<span class="text"><?php the_title();?></span>
										</a>
									</div>
							<?php endwhile; ?>
							<?php wp_reset_query(); ?>
						<?php }else{?>
							<?php
								global $more;
								$the_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'news'));
								$i=1;
							?>
							<?php while( $the_query->have_posts() ) : $the_query->the_post();
									$more = 0;
							?>
								<?php if(1==$i++) { ?>
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-rounded img-responsive" style="margin: 0 auto 10px auto;" loading="lazy" alt="<?php the_title(); ?>"></a>
										</div>
										<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
											<div class="news-text">
												<p class="news-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></p>
												<p class="text hidden-xs"><?php echo strip_tags(get_the_content('')); ?></p>
												<p class="news-date hidden-xs"><?php the_time('j F Y'); ?></p>
											</div>
										</div>
									<?php }else { ?>
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="news-text">
												<p class="news-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></p>
												<p class="text hidden-xs"><?php echo strip_tags(get_the_content('')); ?></p>
												<p class="news-date hidden-xs"><?php the_time('j F Y'); ?></p>
											</div>
										</div>
									<?php } ?>
									<div class="clearfix"></div>
								<?php } else { ?>
									<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 news-block">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php if ( has_post_thumbnail() ) { ?>
												<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-responsive img-rounded" loading="lazy" alt="<?php the_title(); ?>">
											<?php } ?>
											<span class="text"><?php the_title();?></span>
										</a>
									</div>
								<?php } ?>
							<?php endwhile; ?>
						<?php } ?>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="questions-separator"><a href="/questions/">Вопросы пользователей</a></div>
					</div>
					<div class="col-xs-12" id="anspress">
					<?php
						$my_posts = new WP_Query;
						$myposts = $my_posts->query( array(
							'post_type' => array( 'question' ),
							'posts_per_page' => 10,
							'fields' => 'ids',
						) );
						set_query_var('ap_hide_list_head', 1);
						anspress()->questions = new Question_Query( array( 'post__in' => $myposts ) );
						ap_get_template_part( 'question-list' );
						wp_reset_postdata();
					?>
					</div>
				</div>
					
			</div>
<?php get_footer(); ?>