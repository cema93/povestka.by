<?php get_header('old'); ?>
<div class="container">
	<?php if ( have_posts() ) : ?>
		<?php $i=0; ?>
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
		<?php $sticky = get_option( 'sticky_posts' ); ?>
		<?php if( $paged == 1 AND $sticky ) { ?>
			<?php
				global $more;
				$the_query = new WP_Query( array('posts_per_page' => 1, 'category_name' => 'news', 'post__in' => $sticky, 'ignore_sticky_posts' => 1));
			?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post();
						$more = 0;
				?>
				<div class="news-list-item news-list-item-sticky">
					<div class="row">
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 image<?php if($i++ %2 ==0){ echo " right"; } ?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-responsive img-rounded" alt="<?php the_title_attribute(); ?>"></a>
							<?php }else { ?>
							<?php } ?>
							<div class="time"><?php the_time('j F Y') ?></div>
						</div>
						<div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 text">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							<div class="hidden-xs"><?php echo strip_tags(get_the_content('')); ?></div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php } ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?if ( $i !=0 AND $i %5 ==0 ) { ?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php if(display_ad() AND wp_is_mobile()) { ?>
								<!-- Yandex.RTB R-A-986682-6 -->
								<div id="yandex_rtb_R-A-986682-6-<?php echo $i; ?>"></div>
								<script type="text/javascript">
									(function(w, d, n, s, t) {
										w[n] = w[n] || [];
										w[n].push(function() {
											Ya.Context.AdvManager.render({
												blockId: "R-A-986682-6",
												renderTo: "yandex_rtb_R-A-986682-6-<?php echo $i; ?>",
												pageNumber: <?php echo $i; ?>,
												async: true
											});
										});
										t = d.getElementsByTagName("script")[0];
										s = d.createElement("script");
										s.type = "text/javascript";
										s.src = "//an.yandex.ru/system/context.js";
										s.async = true;
										t.parentNode.insertBefore(s, t);
									})(this, this.document, "yandexContextAsyncCallbacks");
								</script>
							<?php } ?>
							<?php if(display_ad() AND !wp_is_mobile()) { ?>
								<div class="clearfix"></div>
								<!-- Yandex.RTB R-A-986682-5 -->
								<div id="yandex_rtb_R-A-986682-5-<?php echo $i; ?>"></div>
								<script type="text/javascript">
									(function(w, d, n, s, t) {
										w[n] = w[n] || [];
										w[n].push(function() {
											Ya.Context.AdvManager.render({
												blockId: "R-A-986682-5",
												renderTo: "yandex_rtb_R-A-986682-5-<?php echo $i; ?>",
												pageNumber: <?php echo $i; ?>,
												async: true
											});
										});
										t = d.getElementsByTagName("script")[0];
										s = d.createElement("script");
										s.type = "text/javascript";
										s.src = "//an.yandex.ru/system/context.js";
										s.async = true;
										t.parentNode.insertBefore(s, t);
									})(this, this.document, "yandexContextAsyncCallbacks");
								</script>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
				<div class="news-list-item">
					<div class="row">
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4 image<?php if($i++ %2 ==0){ echo " right"; } ?>">
							<?php if ( has_post_thumbnail() ) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-responsive img-rounded" alt="<?php the_title_attribute(); ?>"></a>
							<?php }else { ?>
							<?php } ?>
							<div class="time"><?php the_time('j F Y') ?></div>
						</div>
						<div class="col-xs-12 col-sm-7 col-md-8 col-lg-8 text">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							<div class="hidden-xs"><?php echo strip_tags(get_the_content('')); ?></div>
						</div>
					</div>
				</div>
		<?php endwhile; ?>
		<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	<?php else: ?>
		<p>Sorry, no posts matched your criteria.</p>
	<?php endif; ?>
</div>
<?php get_footer('old'); ?>