<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<section class="content-block">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="nav nav-tabs row" role="tablist" id="tabs">
						<li role="presentation" class="active col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="section-wrapper">
								<a href="#documents" role="tab" data-toggle="tab">
									<img src="<?php echo get_template_directory_uri(); ?>/img/sections/1.png" alt="" />
									<p>Образцы заявлений и жалоб</p>
								</a>
								<div class="section-border-1"></div>
								<div class="section-border-2"></div>
								<div class="section-border-3"></div>
								<div class="section-border-5"></div>
							</div>
						</li>
						<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="section-wrapper">
								<a href="#medical" role="tab" data-toggle="tab">
									<img src="<?php echo get_template_directory_uri(); ?>/img/sections/2.png" alt="" />
									<p>Медицинские противопоказания для службы в армии</p>
								</a>
								<div class="section-border-1"></div>
								<div class="section-border-2"></div>
								<div class="section-border-3"></div>
								<div class="section-border-5"></div>
							</div>
						</li>
						<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="section-wrapper">
								<a href="#law" role="tab" data-toggle="tab">
									<img src="<?php echo get_template_directory_uri(); ?>/img/sections/3.png" alt="" />
									<p>Нормативно-правовые акты</p>
								</a>
								<div class="section-border-1"></div>
								<div class="section-border-2"></div>
								<div class="section-border-3"></div>
								<div class="section-border-5"></div>
							</div>
						</li>
						<li role="presentation" class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
							<div class="section-wrapper">
								<a href="#gos" role="tab" data-toggle="tab">
									<img src="<?php echo get_template_directory_uri(); ?>/img/sections/4.png" alt="" />
									<p>Разъяснения от государственных органов и комментарии к законодательству</p>
								</a>
								<div class="section-border-1"></div>
								<div class="section-border-2"></div>
								<div class="section-border-3"></div>
								<div class="section-border-5"></div>
							</div>
						</li>
					</ul>
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
					<?php the_content(); ?>
					<h1>Документы, регламентирующие порядок прохождения службы</h1>
					<?php /* if(display_ad() AND wp_is_mobile()) { ?>
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
					<?php } */ ?>
				</div>	
			</div>
		</div>
	</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
