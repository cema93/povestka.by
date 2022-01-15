<?php get_header('old'); ?>
	<div class="container">
		<div class="row">
			<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<?php
					$term = wp_get_post_terms(get_the_ID(), 'wiki-cat', array("fields" => "all"));
					if( $term['0']->parent > 0 ) {
					$term = get_term( $term['0']->parent, 'wiki-cat' );
						$cat = $term->name;
						$cat_slug = $term->slug;
					}else{
						$cat = $term[0]->name;
						$cat_slug = $term[0]->slug;
					}

					$all_posts = new WP_Query(array(
						'post_type' => 'wiki',
						'wiki-cat' => $cat_slug,
						'orderby' => 'name',
						'order' => 'DESC',
						'posts_per_page' => -1
					));
					foreach($all_posts->posts as $key => $value) {
						if($value->ID == $post->ID){
							$nextID = $all_posts->posts[$key + 1]->ID;
							$prevID = $all_posts->posts[$key - 1]->ID;
							break;
						}
					}
					if ( false === get_permalink( $nextID ) ) { $nextID = 0; }
					if ( false === get_permalink( $prevID ) ) { $prevID = 0; }

				?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

					<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
						<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemprop="item" itemid="https://povestka.by/" href="https://povestka.by/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
							<meta itemprop="position" content="1" />
						</li>
						<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemscope itemtype="https://schema.org/Thing" itemprop="item" itemid="https://povestka.by/wiki/" href="https://povestka.by/wiki/"><span itemprop="name">wiki</span></a>
							<meta itemprop="position" content="2" />
						</li>
						<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
							<a itemscope itemtype="https://schema.org/Thing" itemprop="item" itemid="https://povestka.by/wiki/<?php echo $cat_slug; ?>/" href="https://povestka.by/wiki/<?php echo $cat_slug; ?>/"><span itemprop="name"><?php echo $cat; ?></span></a>
							<meta itemprop="position" content="3" />
						</li>
						<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="hidden">
							<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php the_title();?></span></a>
							<meta itemprop="position" content="4" />
						</li>
					</ol>
					<h1><?php the_title();?></h1>
					<?php if( strpos($_SERVER['REQUEST_URI'], '/raspisanie/') !== false ){ ?>
						<div class="alert">
							Вы просматриваете актуальную редакцию Расписания болезней, которая значительно отличается от действовавшей до 8 февраля 2020 года <a href="https://povestka.by/wp-content/uploads/doc/Raspisanie-2019.pdf">редакции</a>. Об изменениях читайте <a href="https://povestka.by/news/opublikovany-novye-trebovaniya-k-zdorovyu-grazhdan-svyazannye-s-voinskoj-obyazannostyu-godnymi-budut-vse/">в новостях</a>.
						</div>
					<?php } ?>
				</div>
				<nav>
					<ul class="pager">
						<?php if( $prevID > 0 ): ?>
							<li class="previous"><a href="<?php echo get_permalink($prevID); ?>"><span aria-hidden="true">&larr;</span> Предыдущая</a></li>
						<?php endif; ?>
						<?php if( $nextID > 0 ): ?>
							<li class="next"><a href="<?php echo get_permalink($nextID); ?>">Следующая <span aria-hidden="true">&rarr;</span></a></li>
						<?php endif; ?>
					</ul>
				</nav>
					<?php /*  if(display_ad() AND wp_is_mobile()) { ?>
						<!-- Yandex.RTB R-A-986682-6 -->
						<div id="yandex_rtb_R-A-986682-6-1"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-986682-6",
										renderTo: "yandex_rtb_R-A-986682-6-1",
										pageNumber: 1,
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
						<div id="yandex_rtb_R-A-986682-5-1"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-986682-5",
										renderTo: "yandex_rtb_R-A-986682-5-1",
										pageNumber: 1,
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
					<?php } */ ?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 news-full-text">
					<?php the_content(); ?>
				</div>
				<nav>
					<ul class="pager">
						<?php if( $prevID > 0 ): ?>
							<li class="previous"><a href="<?php echo get_permalink($prevID); ?>"><span aria-hidden="true">&larr;</span> Предыдущая</a></li>
						<?php endif; ?>
						<?php if( $nextID > 0 ): ?>
							<li class="next"><a href="<?php echo get_permalink($nextID); ?>">Следующая <span aria-hidden="true">&rarr;</span></a></li>
						<?php endif; ?>
					</ul>
				</nav>
					<?php /* if(get_current_user_id() != 1001008) { ?>
						<?php  if(!wp_is_mobile()) { ?>
							<a href="https://safebilet.by/?utm_source=povestka&utm_medium=wiki"><img class="center-block img-responsive" src="https://povestka.by/wp-content/themes/stable/img/adv/safebilet/wiki-pc.jpg"></a>
						<?php }else{ ?>
							<a href="https://safebilet.by/?utm_source=povestka&utm_medium=wiki"><img class="center-block img-responsive" src="https://povestka.by/wp-content/themes/stable/img/adv/safebilet/wiki-mob.jpg"></a>
						<?php } ?>
					<?php } */ ?>
<div id="id-C-A-986682-1"></div>
<script>window.yaContextCb.push(()=>{
  Ya.Context.AdvManager.renderWidget({
    renderTo: 'id-C-A-986682-1',
    blockId: window.innerWidth > 768 ? 'C-A-986682-1' : 'C-A-986682-8'
  })
})</script>

			<?php endwhile; // end of the loop. ?>
			</section>
		</div>
					<?php if(display_ad() AND wp_is_mobile()) { ?>
						<!-- Yandex.RTB R-A-986682-6 -->
						<div id="yandex_rtb_R-A-986682-6-2"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-986682-6",
										renderTo: "yandex_rtb_R-A-986682-6-2",
										pageNumber: 2,
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
						<div id="yandex_rtb_R-A-986682-5-2"></div>
						<script type="text/javascript">
							(function(w, d, n, s, t) {
								w[n] = w[n] || [];
								w[n].push(function() {
									Ya.Context.AdvManager.render({
										blockId: "R-A-986682-5",
										renderTo: "yandex_rtb_R-A-986682-5-2",
										pageNumber: 2,
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
<?php get_footer('old'); ?>
