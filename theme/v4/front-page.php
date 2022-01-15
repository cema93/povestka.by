<?php get_header(); ?>
	<header class="header">
        <div class="header__main">
            <div class="container">
                <div class="header__main-inner">
                    <div class="row">
                        <div class="col-12 col-md-10 offset-md-1">
                            <div class="header__main-title">
                                <h1>Центр прав призывника</h1>
                            </div>
                            <div class="header__main-text">
                                <p>
                                    это сервис вопросов и ответов, предназначенный для призывников,
                                    допризывников, военнообязанных, военнослужащих, альтернативщиков и их близких
                                </p>
                            </div>
                            <a href="https://povestka.by/questions/ask/" class="header__main-btn default-btn">
                                Задать вопрос
                            </a>
                        </div>
                        <div class="header__main-man"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__features">
            <div class="container-xl">
                <div class="header__features-items">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <div class="header__features-item">
								<img src="https://povestka.by/wp-content/themes/stable/img/front-page/features/user.svg">
                                <h3>550.000</h3>
                                <p>посетителей в год</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="header__features-item header__features-second">
								<img src="https://povestka.by/wp-content/themes/stable/img/front-page/features/answers.svg">
                                <h3>5.000</h3>
                                <p>ответов в год</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="header__features-item">
								<img src="https://povestka.by/wp-content/themes/stable/img/front-page/features/calendar.svg">
                                <h3>7 лет</h3>
                                <p>работает для вас</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
	<?php if(get_option("cema93_timer_text") != "Нет призыва" ) { ?>
		<?php 
			$lastday	= get_option("cema93_timer_years").'-'.get_option("cema93_timer_months").'-'.get_option("cema93_timer_days");
			$datetime1 = new DateTime("now");
			$datetime2 = new DateTime($lastday);
			$interval = date_diff($datetime1, $datetime2);
			$timer = $interval->format('%a');
		?>
		<section class="conscription">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12 col-xl-4 offset-xl-1">
						<div class="conscription__text">
							<div class="conscription__text-title">
								<h1 class="conscription__text-title-text"><?php echo get_option("cema93_timer_text"); ?></h1>
							</div>
							<p>дней осталось</p>
						</div>
					</div>
					<div class="col-lg-12 col-xl-4 offset-xl-1">
						<div class="conscription__counter">
						
							<div class="conscription__counter-number"><?php echo str_pad($timer, 3, '0', STR_PAD_LEFT); ?></div>
							<svg class="progress__ring" width="300" height="300">
								<defs>
									<filter id="inset-shadow">
										<feFlood flood-color="#005900" />
										<feComposite operator="out" in2="SourceGraphic" />
										<feGaussianBlur stdDeviation="7" />
										<feComposite operator="atop" in2="SourceGraphic" />
									</filter>
								</defs>
								<circle class="progress__ring-outline" stroke="#EAF7E6" stroke-width="24" cx="150" cy="150" r="126" fill="transparent" />
								<circle class="progress__ring-circle" stroke="#2CAB00" filter="url(#inset-shadow)" stroke-linecap="round" stroke-width="24" cx="150" cy="150" r="126" fill="transparent" />
							</svg>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>

    <section class="advantages">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 offset-xl-2">
                    <div class="advantages__title">
                        <h3>
                            Белорусские призывники зачастую не знают своих прав,
                            чем могут пользоваться военкоматы.
                            Мы помогаем молодым людям заполнить эти пробелы на волонтёрских началах
                        </h3>
                    </div>
                </div>
            </div>

            <div class="advantages__items">
                <div class="row advantages__slider">
                    <div class="col-md-4 offset-md-2 col-lg-3 offset-lg-0">
					<a href="/news/">
                        <div class="advantages__items-item">
                            <div class="advantages__items-img">
                                <img src="https://povestka.by/wp-content/themes/stable/img/front-page/advantages/news.svg" class="img-fluid" alt="message">
                            </div>
                            <p>Публикуем актуальные новости и аналитику</p>
                        </div>
					</a>
                    </div>
                    <div class="col-md-4 offset-md-0 col-lg-3 offset-lg-0">
					<a href="/questions/">
                        <div class="advantages__items-item">
                            <div class="advantages__items-img">
                                <img src="https://povestka.by/wp-content/themes/stable/img/front-page/advantages/questions.svg" class="img-fluid" alt="questions">
                            </div>
                            <p>Отвечаем на вопросы</p>
                        </div>
					</a>
                    </div>
                    <div class="col-md-4 offset-md-2 col-lg-3 offset-lg-0">
					<a href="/doc/">
                        <div class="advantages__items-item">
                            <div class="advantages__items-img">
                                <img src="https://povestka.by/wp-content/themes/stable/img/front-page/advantages/files.svg" class="img-fluid" alt="files">
                            </div>
                            <p>Размещаем полезные документы</p>
                        </div>
					</a>
                    </div>
                    <div class="col-md-4 offset-md-0 col-lg-3 offset-lg-0">
                        <div class="advantages__items-item">
                            <div class="advantages__items-img">
                                <img src="https://povestka.by/wp-content/themes/stable/img/front-page/advantages/messages.svg" class="img-fluid" alt="files">
                            </div>
                            <p>Консультируем в соц. сетях</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="help">
        <div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-11 offset-xl-1">
					<div class="help__title">
						<h2>Как получить помощь</h2>
					</div>
				</div>
			</div>

            <div class="help__content">
                <div class="row">
                    <div class="col-lg-6 col-xl-5 offset-xl-1">

                        <!-- Для пк -->

                        <div class="help__content-points">
                            <div class="help__content-point">
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/user.svg">
                                </div>
                                <div class="help__content-title">
                                    <h3>Зарегистрируйтесь на сайте (подтвердите e-mail и телефон)</h3>
                                </div>
                            </div>
                            <div class="help__content-point">
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/search.svg">
                                </div>
                                <div class="help__content-title">
                                    <h3>Воспользуйтесь поиском (на сайте более 8000 ответов на вопросы)</h3>
                                </div>
                            </div>
                            <div class="help__content-point">
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/question.svg">
                                </div>
                                <div class="help__content-title">
                                    <h3>Задайте вопрос на сайте (ответ в течение суток)</h3>
                                </div>
                            </div>
                        </div>

                        <!-- Для телефонов -->

                        <div class="help__content-points__small">
                            <div class="help__content-point">
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/user.svg">
                                </div>
                                <div class="help__content-title">
                                    <h3>Зарегистрируйтесь на сайте (подтвердите e-mail и телефон)</h3>
                                </div>
                            </div>
                            <div class="help__content-point">
                                <div class="help__content-title">
                                    <h3>Воспользуйтесь поиском (на сайте более 8000 ответов на вопросы)</h3>
                                </div>
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/search.svg">
                                </div>
                            </div>
                            <div class="help__content-point">
                                <div class="help__content-img">
                                   <img alt="" src="https://povestka.by/wp-content/themes/stable/img/front-page/help/question.svg">
                                </div>
                                <div class="help__content-title">
                                    <h3>Задайте вопрос на сайте (ответ в течение суток)</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="offset-lg-0 col-lg-5 offset-xl-1 col-xl-5 text-center text-md-start">
						<div class="help__content-man"></div>
						<a href="https://povestka.by/questions/ask/" class="help__content-btn default-btn">Задать вопрос</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
	
	

    <section class="blog">
        <div class="container">
            <div class="row">

<?php $sticky = count(get_option('sticky_posts')); $posts_per_page =4-$sticky; if($posts_per_page < 0) $posts_per_page = 0; $post_number=0; $query = new WP_Query( array( 'posts_per_page' => $posts_per_page) ); ?>
<?php if ( $query->have_posts() ) { ?>
	<?php while ( $query->have_posts() ) { $query->the_post();?>
		<?php if($post_number++ ==0){ ?>
                <div class="col-lg-8 offset-lg-2 col-xl-5 offset-xl-0">
                    <a href="<?php the_permalink(); ?>">
                        <div class="blog__donations">
                            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="donations">
                            <div class="blog__donations-title">
                                <h3>
                                    <? echo get_the_title(); ?>
                                </h3>
                            </div>
                            <p class="d-xl-block d-xxl-none">
                                <?php echo strip_tags(get_the_content('')); ?>
                            </p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-8 offset-lg-2 col-xl-7 offset-xl-0">
                    <div class="blog__articles">
		<?php }else{ ?>
                        <a href="<?php the_permalink(); ?>">
                            <div class="blog__article<?php if($post_number ==4) echo " blog__article-last"; ?>">
                                <div class="blog__article-img">
                                    <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="article">
                                </div>
                                <div class="blog__article-title">
                                    <? echo get_the_title(); ?>
                                </div>
                                <div class="blog__article-date">
                                    <?php the_time('j F Y'); ?>
                                </div>
                            </div>
                        </a>
		<?php } ?>

	<?php } ?>
                    </div>
                </div>
<?php } ?>
<?php wp_reset_postdata(); ?>

				
            </div>
            <div class="row">
                <div class="col">
                    <div class="blog__articles-inner">
                        <a href="https://povestka.by/news/">
                            <div class="blog__articles-inner__btn">
                                Все новости
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>