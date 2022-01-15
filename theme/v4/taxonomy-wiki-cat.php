<?php get_header('old'); ?>
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 news-full-text">
						<ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemprop="item" itemid="https://povestka.by/" href="https://povestka.by/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
								<meta itemprop="position" content="1" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
								<a itemscope itemtype="https://schema.org/Thing" itemprop="item" itemid="https://povestka.by/wiki/" href="https://povestka.by/wiki/"><span itemprop="name">wiki</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="hidden">
								<a itemscope itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php single_term_title(); ?></span></a>
								<meta itemprop="position" content="3" />
							</li>
						</ol>
						<h1><?php single_term_title(); ?></h1>
						<?php if( strpos($_SERVER['REQUEST_URI'], '/raspisanie/') !== false ){ ?>
							<div class="alert">
								Вы просматриваете актуальную редакцию Расписания болезней, которая значительно отличается от действовавшей до 8 февраля 2020 года <a href="https://povestka.by/wp-content/uploads/doc/Raspisanie-2019.pdf">редакции</a>. Об изменениях читайте <a href="https://povestka.by/news/opublikovany-novye-trebovaniya-k-zdorovyu-grazhdan-svyazannye-s-voinskoj-obyazannostyu-godnymi-budut-vse/">в новостях</a>.
							</div>
						<?php } ?>
						<?php echo term_description() ?>
					<?php if(display_ad() AND wp_is_mobile()) { ?>
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
					<?php } ?>
						<?php if ( have_posts() ) { ?>
							<?php $prev_char = null; ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
									$term_list = wp_get_post_terms(get_the_ID(), 'wiki-cat', array("fields" => "all"));
									$char = $term_list[0]->name;
									if( $prev_char != $char ){
										$prev_char = $char;
										if($term_list[0]->parent != 0) {
											echo "<h3>". $char ."</h3>";
											echo "<small>".term_description( $term_list[0]->term_id, 'wiki-cat')."</small>";
										}else{
											echo "<br>";
										}
									}
									
									if(empty(get_the_content())){
										echo get_the_title(). "<br>";
									}else{
										echo '<a href="' .get_the_permalink(). '" title="' .esc_attr( strip_tags( get_the_title() ) ). '">'. get_the_title(). '</a><br>';
									}
								?>
								
							<?php endwhile; ?>
						<?php } ?>
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
					
					
					<?php /*  if(get_current_user_id() != 1001008) { ?>
						<?php  if(!wp_is_mobile()) { ?>
							<a href="https://safebilet.by/?utm_source=povestka&utm_medium=wiki"><img class="center-block img-responsive" src="https://povestka.by/wp-content/themes/stable/img/adv/safebilet/wiki-pc.jpg"></a>
						<?php }else{ ?>
							<a href="https://safebilet.by/?utm_source=povestka&utm_medium=wiki"><img class="center-block img-responsive" src="https://povestka.by/wp-content/themes/stable/img/adv/safebilet/wiki-mob.jpg"></a>
						<?php } ?>
					<?php } */ ?>
					</div>
				</div>
			</div>
<?php get_footer('old'); ?>