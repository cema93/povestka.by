<?php get_header(); ?>
	<div class="container">
		<div class="row" id="faq">
			<div class="faq-header">
				<div class="col-xs-4 col-sm-3 col-md-2 col-lg-3">
					<h1 class="faq-title">
						FAQ<span>Часто задаваемые <br>вопросы</span>
					</h1>
				</div>
				<div class="col-xs-8 col-sm-offset-3 col-md-offset-6 col-lg-offset-5  col-sm-6 col-md-4 col-lg-4" style="overflow: hidden;">
					<a href="https://povestka.by/questions/" class="question-btn">Не нашли свой вопрос</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
				<input class='faq-search-box' placeholder="Поиск в FAQ">
			</div>
			<?php if(display_ad() AND !wp_is_mobile()) { ?>
				<div class="clearfix"></div>
				<!-- Yandex.RTB R-A-270077-2 -->
				<div id="yandex_rtb_R-A-270077-2-1"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-2",
								renderTo: "yandex_rtb_R-A-270077-2-1",
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
			<div class="clearfix"></div>
			<?php if(display_ad() AND wp_is_mobile()) { ?>
				<!-- Yandex.RTB R-A-270077-10 -->
				<div id="yandex_rtb_R-A-270077-10-1"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-10",
								renderTo: "yandex_rtb_R-A-270077-10-1",
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
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="question-title"><i class="hidden-xs hidden-sm fa fa-exclamation-circle" aria-hidden="true"></i> Призыв</div>
				<?php $the_query = new WP_Query( array('post_type' => 'faq', 'order' => 'ASC', 'posts_per_page' => -1, 'cema93-faq-cat' => 'prizyv', 'meta_key' => 'order_number', 'orderby' => 'meta_value')); ?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="question-wrapper">
						<div class="question-block question">
							<div class="q-number"><?php echo ltrim( (string)get_field("order_number", get_the_ID()), '0'); ?></div>
							<div class="text"><?php the_title();?></div>
						</div>
						<div class="answer">
							<div class="text"><?php the_content();?></div>
							<img src="https://povestka.by/wp-content/themes/stable/img/answer.png" alt="" />
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php if(display_ad() AND wp_is_mobile()) { ?>
				<!-- Yandex.RTB R-A-270077-10 -->
				<div id="yandex_rtb_R-A-270077-10-2"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-10",
								renderTo: "yandex_rtb_R-A-270077-10-2",
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
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="question-title"><i class="hidden-xs hidden-sm fa fa-exclamation-circle" aria-hidden="true"></i> Медицина, отсрочки</div>
				<?php $the_query = new WP_Query( array('post_type' => 'faq', 'order' => 'ASC', 'posts_per_page' => -1, 'cema93-faq-cat' => 'meditsina-otsrochki', 'meta_key' => 'order_number', 'orderby' => 'meta_value')); ?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="question-wrapper">
						<div class="question-block question">
							<div class="q-number"><?php echo ltrim( (string)get_field("order_number", get_the_ID()), '0'); ?></div>
							<div class="text"><?php the_title();?></div>
						</div>
						<div class="answer">
							<div class="text"><?php the_content();?></div>
							<img src="https://povestka.by/wp-content/themes/stable/img/answer.png" alt="" />
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php if(display_ad() AND wp_is_mobile()) { ?>
				<!-- Yandex.RTB R-A-270077-10 -->
				<div id="yandex_rtb_R-A-270077-10-3"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-10",
								renderTo: "yandex_rtb_R-A-270077-10-3",
								pageNumber: 3,
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
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="question-title"><i class="hidden-xs hidden-sm fa fa-exclamation-circle" aria-hidden="true"></i> НГМ, запас, сборы, АГС</div>
				<?php $the_query = new WP_Query( array('post_type' => 'faq', 'order' => 'ASC', 'posts_per_page' => -1, 'cema93-faq-cat' => 'ngm-zapas-sbory-ags', 'meta_key' => 'order_number', 'orderby' => 'meta_value')); ?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="question-wrapper">
						<div class="question-block question">
							<div class="q-number"><?php echo ltrim( (string)get_field("order_number", get_the_ID()), '0'); ?></div>
							<div class="text"><?php the_title();?></div>
						</div>
						<div class="answer">
							<div class="text"><?php the_content();?></div>
							<img src="https://povestka.by/wp-content/themes/stable/img/answer.png" alt="" />
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php if(display_ad() AND wp_is_mobile()) { ?>
				<!-- Yandex.RTB R-A-270077-10 -->
				<div id="yandex_rtb_R-A-270077-10-4"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-10",
								renderTo: "yandex_rtb_R-A-270077-10-4",
								pageNumber: 4,
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
				<!-- Yandex.RTB R-A-270077-2 -->
				<div id="yandex_rtb_R-A-270077-2-2"></div>
				<script type="text/javascript">
					(function(w, d, n, s, t) {
						w[n] = w[n] || [];
						w[n].push(function() {
							Ya.Context.AdvManager.render({
								blockId: "R-A-270077-2",
								renderTo: "yandex_rtb_R-A-270077-2-2",
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
	</div>
<?php get_footer(); ?>
