<?php
$user = wp_get_current_user();
 if( is_single( 8266 ) AND ( get_current_user_id() == 1 OR in_array( 'representative', (array) $user->roles )) ){
	include(TEMPLATEPATH.'/single-help-8266.php');
 }else{ ?>
<?php get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
						<div class="about">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
							<?php if( is_single( 8266 ) AND !is_user_logged_in() ){ ?>
								<div class="alert alert-success" role="alert">Для участия в аукционе рекламы необходимо авторизоваться.</div>
								<div style="border: 2px solid rgba(0,0,0,0.1); border-radius: 3px; margin-bottom: 20px;">
									<div class="ap-content ap-login" style="margin-top:0px;">
										<div class="ap-cell">
											<div class="ap-cell-inner">
												<div style="margin: 0 auto; text-align: center;">
													<?php wp_login_form(); ?>
												</div>
												<div class="ap-login-buttons">
													<a href="<?php echo esc_url( wp_registration_url() ); ?>" class="ap-btn">Зарегистрироваться</a>
													<span class="ap-login-sep">или</span>
													<a href="<?php echo wp_lostpassword_url(); ?>" class="ap-btn">Восстановить пароль</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php }elseif( is_single( 8266 ) AND is_user_logged_in() ){  ?>
								<div class="alert alert-success" role="alert">Для участия в аукционе рекламы свяжитесь с нами с помощью email info@povestka.by.</div>
							<?php } ?>
						</div>
				</section>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php
						echo '<div class="panel panel-default"><div class="panel-heading">Справочный раздел</div><ul class="list-group">';
						$menuParameters = array(
							'theme_location' => 'help_menu',
							'container'       => false,
							'echo'            => false,
							'items_wrap'      => '%3$s',
							'depth'           => 1,
						);
						$help_menu = strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
						$help_menu = preg_replace('/<a /', '<a class="list-group-item" ', $help_menu);
						echo $help_menu;
						echo '</ul></div>';
					?>
				</div>
			</div>
		</div>
<?php get_footer('old'); ?>
<?php } ?>
