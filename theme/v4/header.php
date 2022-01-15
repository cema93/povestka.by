<?php $current_user = wp_get_current_user(); $notifications_count = bp_notifications_get_unread_notification_count($current_user->ID); ?>
<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Main css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style/style.css?1620484077002">
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
    <header class="header">
        <nav class="header__nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'header_menu',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'header__nav-list d-flex justify-content-between',
								'menu_id'         => '',
								'echo'            => true,
								'before'          => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
								'depth'           => 1,
							));
						?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Меню сбоку -->
        <div class="header__menu">
			<div class="header__menu-img-close">
				<i class="icon-cancel"></i>
			</div>
			<div class="header__menu-img-user">
				<?php if ( is_user_logged_in() ) { ?>
					<a href="<?php echo bp_core_get_user_domain($current_user->ID); ?>my/">
						<i class="icon-user"></i>
					</a>
				<?php }else{ ?>
					<a href="#login" role="button" data-bs-toggle="modal" data-bs-target="#login-modal">
						<i class="icon-login"></i>
					</a>
				<?php } ?>
				</div>
            <ul class="header__menu-list">
                <?php if ( is_user_logged_in() ) { ?><li><a href="<?php if($notifications_count) { echo bp_core_get_user_domain($current_user->ID)."notifications/"; } else{ echo bp_core_get_user_domain($current_user->ID)."notifications/read/"; } ?>">
                    <div class="header__menu-list__counter"><?php if($notifications_count) echo $notifications_count; ?></div>
                    Уведомления
                </a></li><?php } ?>
						<?php
							wp_nav_menu( array(
								'theme_location'  => 'header_menu',
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
								'depth'           => 1,
							));
						?>
            </ul>
        </div>
        <!-- Лого + поиск -->

        <div class="header__top">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-3">
                        <a href="/" class="header__top-logo">
                        </a>
                    </div>
                    <div class="col-3 header__top-burger">
                        <!-- Меню в виде бургера -->
                        <i class="icon-bars"></i>
                    </div>
                    <div class="col-sm-10 offset-sm-1 col-md-10 offset-md-1 col-lg-5 col-xl-6 offset-xl-0 header__top-input">
						<form id="header-search-form" role="search" method="get" action="/">
							<input type="search" value="<?php echo $_GET["s"]; ?>" class="who" placeholder="Поиск по сайту" name="s" required autocomplete="off">
							<button type="submit" class="btn btn-link header__top-search"><i class="icon-search"></i></button>
							<div id="search_advice_wrapper"></div>
						</form>
						
                    </div>
					<?php if ( is_user_logged_in() ) { ?>
                    <div class="col-md-1 offset-md-1 d-flex justify-content-end">
                        <div class="header__notifications">
                            <a href="<?php if($notifications_count) { echo bp_core_get_user_domain($current_user->ID)."notifications/"; } else{ echo bp_core_get_user_domain($current_user->ID)."notifications/read/"; } ?>">
                                <img class="header__notifications-img"  alt="">
                                <div class="header__notifications-counter"><?php if($notifications_count) echo $notifications_count; ?></div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex justify-content-end">
                        <div class="header__profile">
                            <a href="<?php echo bp_core_get_user_domain($current_user->ID); ?>my/">
								<img class="header__profile-img" alt="" src="https://povestka.by/wp-content/themes/stable/img/header/profile.svg">
                            </a>
                        </div>
                    </div>
					<?php }else { ?>
                    <div class="col-md-3 d-none d-sm-none d-md-none d-lg-flex d-xl-flex d-xxl-flex justify-content-end">
						<a href="#" class="header_login_button" role="button" data-bs-toggle="modal" data-bs-target="#login-modal">Вход</a>
                    </div>
					<?php } ?>
                </div>
            </div>
        </div>
	 </header>