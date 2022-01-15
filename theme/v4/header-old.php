<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://povestka.by/wp-content/themes/stable/css-old/main.css">
	<?php wp_head(); ?>
	
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="apple-mobile-web-app-title" content="Центр прав призывника">
	<meta name="application-name" content="Центр прав призывника">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
<script>window.yaContextCb=window.yaContextCb||[]</script>
<script src="https://yandex.ru/ads/system/context.js" async></script>
</head>
<body <?php body_class(); ?>>
<div class="main-content-wraper">
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-5 col-md-4 col-lg-3" style="min-height: 55px;">
					<a href="/" class="header-logo"> </a>
				</div>
				<div class="hidden-xs col-sm-7 col-md-3 col-lg-2 pull-right" style="min-height: 55px;">
					<?php if ( is_user_logged_in() ) { ?>
						<?php $current_user = wp_get_current_user(); ?>
						<ul class="nav navbar-nav navbar-right user-navbar">
							<?php if ( $notifications = bp_notifications_get_notifications_for_user( $current_user->ID ) ) { ?>
								<li class="dropdown notifications">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i data-count="<?php echo count( $notifications ) ?>" class="far fa-bell notification-icon" ></i></a>
									<ul class="dropdown-menu">
										<?php if ( $notifications ) { ?>
											<?php $counter = 0; ?>
											<?php for ( $i = 0; $i < count($notifications); $i++ ) { ?>
												<?php $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>
														
												<li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>

												<?php $counter++; ?>
											<?php } ?>
										<?php } else { ?>
											<li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e( 'You have no new alerts.', 'buddypress' ); ?></a></li>
										<?php } ?>
									</ul>
								</li>
							<?php } ?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo get_avatar_url( $current_user->ID, array( 'default' => 'wavatar', 'force_default' => true ) ); ?>" class="avatar" alt="<?php echo $current_user->display_name;?>"><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li>
										<div class="navbar-login">
											<div class="row">
												<div class="col-sm-4">
													<p class="text-center">
														<img src="<?php echo get_avatar_url( $current_user->ID, array( 'default' => 'wavatar', 'force_default' => true ) ); ?>" class="img-responsive" alt="<?php echo $current_user->display_name;?>">
													</p>
												</div>
												<div class="col-sm-8">
													<p class="text-left"><strong><?php echo $current_user->display_name; ?></strong></p>
													<p class="text-left small"><?php echo $current_user->user_email; ?></p>
													<p class="text-left">
														<a href="<?php echo bp_core_get_user_domain($current_user->ID); ?>my/" class="btn btn-primary btn-block btn-sm">Личный кабинет</a>
													</p>
												</div>
											</div>
										</div>
									</li>
									<li role="separator" class="divider"></li>
									<?php
										wp_nav_menu( array(
											'theme_location'  => 'user_header_menu',
											'container'       => '',
											'container_class' => '',
											'container_id'    => '',
											'menu_class'      => '',
											'menu_id'         => '',
											'echo'            => true,
											'before'          => '',
											'link_before'     => '',
											'link_after'      => '',
											'items_wrap'      => '%3$s',
										));
									?>
								</ul>
							</li>
						</ul>
					<?php }else{ ?>
						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Вход <span class="caret"></span></a>
								<ul id="login-dp" class="dropdown-menu">
									<li>
										<div class="row">
											<div class="col-md-12">
												<!--<form action="" method="post">
													<button class="btn btn-block btn-social btn-vk"       name="auth_soc_vk"     type="submit"><i class="fa fa-vk"></i>Войти через ВКонтакте</button>
													<button class="btn btn-block btn-social btn-facebook" name="auth_soc_fb"     type="submit"><i class="fa fa-facebook"></i>Войти через Facebook</button>
													<button class="btn btn-block btn-social btn-google"   name="auth_soc_google" type="submit"><i class="fa fa-google"></i>Войти через Google</button>
												</form>-->
												<?php wp_login_form(); ?>
											</div>
											<div class="ap-login-buttons">
												<a href="<?php echo esc_url( wp_registration_url() ); ?>"><strong><?php esc_attr_e( 'Register', 'anspress-question-answer' ); ?></strong></a>
											</div>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					<?php } ?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 pull-left" style="min-height: 55px;">
					<nav class="navbar navbar-top">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed btn-block" data-toggle="collapse" data-target="#header-menu-collapse" aria-expanded="false">
								Меню сайта
							</button>
						</div>
						<div class="navbar-collapse collapse in" id="header-menu-collapse">
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'header_menu-old',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'nav navbar-nav',
								'menu_id'         => '',
								'echo'            => true,
								'before'          => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 1,
								'walker'          => new wp_bootstrap_navwalker()
							));
						?>
						</div>
					</nav>
				</div>
				<?php if ( is_user_logged_in() ) { ?>
					<noindex>
						<div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="min-height: 55px;">
							<nav class="navbar navbar-top">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed btn-block" data-toggle="collapse" data-target="#header-user-menu-collapse" aria-expanded="false">
										<?php echo $current_user->display_name; ?>
										<?php if ( $notifications = bp_notifications_get_notifications_for_user( $current_user->ID ) ) { ?>
											<span class="notifications-count"><?php echo count( $notifications ); ?></span>
										<?php } ?>
									</button>
								</div>
								<div class="collapse navbar-collapse" id="header-user-menu-collapse">
									<?php
										wp_nav_menu( array(
											'theme_location'  => 'user_header_menu',
											'container'       => '',
											'container_class' => '',
											'container_id'    => '',
											'menu_class'      => 'nav navbar-nav',
											'menu_id'         => '',
											'echo'            => true,
											'before'          => '',
											'link_before'     => '',
											'link_after'      => '',
											'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
											'depth'           => 1,
											'walker'          => new wp_bootstrap_navwalker()
										));
									?>
								</div>
							</nav>
						</div>
					</noindex>
				<?php } ?>
			</div>
		</div>
		<?php if(is_front_page()){ ?>
			<div class="timer-block">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
							<?php if(get_option("cema93_timer_text") != "Нет призыва" ) { ?>
								<?php
									$lastday	= get_option("cema93_timer_years").'-'.get_option("cema93_timer_months").'-'.get_option("cema93_timer_days");
									$datetime1 = new DateTime("now");
									$datetime2 = new DateTime($lastday);
									$interval = date_diff($datetime1, $datetime2);
									$timer = $interval->format('%a');
								?>
								<div class="timer">
									<div class="timer-title"><?php echo get_option("cema93_timer_text"); ?>
										<span>осталось дней:</span>
									</div>
									<div id="countbox">
										<div class="number"><?php echo $s1 = $timer / 100 % 100; ?></div>
										<div class="number"><?php echo $s2 = $timer % 100 / 10 %10; ?></div>
										<div class="number"><?php echo $s3 = $timer % 100 % 10; ?></div>
									</div>
								</div>
							<?php } ?>
						</div>
						<div class="col-xs-12 col-sm-7 col-md-5 col-lg-5 col-md-offset-3 col-lg-offset-3">
							<div class="text-wrapper">
								<h1 class="header-text">
									О сборах и призыве в<br class="hidden-xs"> армию Беларуси в<br class="hidden-xs"> 100 вопросах и<br class="hidden-xs"> ответах
								</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php }else { ?>
			<div class="header-shadow"></div>
		<?php } ?>
	</header>