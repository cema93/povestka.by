    <footer class="footer">
        <div class="container">
            <div class="row">
                <p>
                    Перепечатка фотографий и текста (целиком и частично) разрешена
                    только при наличии активной ссылки на сайт povestka.by
                </p>
            </div>
			<?php
				wp_nav_menu( array(
					'theme_location'  => 'footer_menu',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'footer__nav',
					'menu_id'         => '',
					'echo'            => true,
					'before'          => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
					'depth'           => 1,
				));
			?>
            <div class="row">
				<ul class="social_footer_ul list-unstyled list-inline">
					<li class="list-inline-item"><a href="https://vk.com/ags_by" target="_blank" rel="noreferrer nofollow"><i class="icon-vk"></i></a></li>
					<li class="list-inline-item"><a href="https://www.facebook.com/ags.by/" target="_blank" rel="noreferrer nofollow"><i class="icon-facebook-f"></i></a></li>
					<li class="list-inline-item"><a href="https://t.me/povestkaby" target="_blank" rel="noreferrer nofollow"><i class="icon-telegram-plane"></i></a></li>
					<li class="list-inline-item"><a href="viber://pa?chatURI=povestkaby" target="_blank" rel="noreferrer nofollow"><i class="icon-viber"></i></a></li>
				</ul>
				<p>
                    По вопросам сотрудничества и рекламы: info@povestka.by
                <br>
                    © 2013-2022 Центр прав призывника
                </p>
            </div>

            <div class="footer__credits">
				<?php if(is_front_page() OR is_page('donate')) { ?>
					<img src="https://povestka.by/wp-content/themes/stable/img/banks.png" class="img-fluid" alt="Логотипы банков и платежных систем" />
					<img src="https://povestka.by/wp-content/themes/stable/img/banks-webpay.png" class="img-fluid" alt="Логотипы банков и платежных систем" />
					<p class="text-center">ИП Гавриленко С.А., УНП: 193052606, время работы: круглосуточно, юридический адрес: Республика беларусь, г. Минск, ул. Калиновского 27-16</p>
				<?php } ?>
            </div>
        </div>
    </footer>
	<?php wp_footer(); ?>
<?php if ( !is_user_logged_in() ) { ?>
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    	<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<img class="mx-auto img_logo" src="https://povestka.by/wp-content/themes/stable/img/header/logo-small.png" alt="Логотип Центра прав призывника">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                
                <!-- Begin # DIV Form -->
                <div id="div-forms">
					<div class="loading-block text-center" style="display:none;">
						<svg style="max-height:80%" viewBox="0 0 300 300">
							<circle stroke="#EAF7E6" stroke-width="24" cx="150" cy="150" r="126" fill="transparent"></circle>
							<circle stroke="#2CAB00" filter="url(#inset-shadow)" stroke-linecap="round" stroke-width="24" cx="150" cy="150" r="126" fill="transparent" style="stroke-dasharray: 791.681, 791.681; stroke-dashoffset: 293.215;">
								<animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="2s" values="0 150 150;360 150 150" keyTimes="0;1"></animateTransform>
							</circle>
						</svg>
					</div>
					<div class="success-block text-center" style="display:none;">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#198754" d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"/></svg>
						<p class="text"></p>
					</div>
					<div class="error-block text-danger text-center" style="display:none;">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#dc3545" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"/></svg>
						<p class="text"></p>
					</div>

                    <!-- Begin # Login Form -->
                    <form id="login-form">
		                <div class="modal-body">
							<div class="">
							  <label for="email" class="form-label">e-mail</label>
							  <input type="email" name="email" class="form-control" placeholder="" required>
							</div>
							<div class="">
							  <label for="password" class="form-label">пароль</label>
							  <input type="password" name="password" class="form-control" placeholder="" required>
							</div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember"> Запомнить меня
                                </label>
                            </div>
        		    	</div>
				        <div class="modal-footer">
					
							<div class="">
								<button class="btn btn-submit mx-auto" type="submit" type="button">Войти</button>
							</div>
				    	    <div class="text-center">
                                <button id="login_lost_btn" type="button" class="btn btn-link">Забыли пароль?</button>
                                <!--<button id="login_register_btn" type="button" class="btn btn-link">Регистрация</button>-->
								<a href="https://povestka.by/registration/" class="btn btn-link">Регистрация</a>
                            </div>
				        </div>
                    </form>
                    <!-- End # Login Form -->
                    
                    <!-- Begin | Lost Password Form -->
                    <form id="lost-form" style="display:none;">
    	    		    <div class="modal-body">
							<h3>Восстановление пароля</h3>
							Для восстановления доступа укажите e-mail, привязанный к вашему профилю
							<div class="">
								<label for="email" class="form-label">e-mail</label>
								<input type="email" name="email" class="form-control" placeholder="" required>
							</div>
            			</div>
		    		    <div class="modal-footer">
							<div class="">
								<button class="btn btn-submit mx-auto" type="submit" type="button">Восстановить пароль</button>
							</div>
				    	    <div class="text-center">
                                <button id="lost_login_btn" type="button" class="btn btn-link">Вход</button>
                                <!--<button id="lost_register_btn" type="button" class="btn btn-link">Регистрация</button>-->
								<a href="https://povestka.by/registration/" class="btn btn-link">Регистрация</a>
                            </div>
		    		    </div>
                    </form>
                    <!-- End | Lost Password Form -->
                    
                    <!-- Begin | Register Form -->
                    <form id="register-form" style="display:none;">
            		    <div class="modal-body">
		    				<div id="div-register-msg">
                                <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
                                <span id="text-register-msg">Register an account.</span>
                            </div>
		    				<input id="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
                            <input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
                            <input id="register_password" class="form-control" type="password" placeholder="Password" required>
            			</div>
		    		    <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                            </div>
                            <div>
                                <button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
                                <button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
                            </div>
		    		    </div>
                    </form>
                    <!-- End | Register Form -->
                    
                </div>
                <!-- End # DIV Form -->
                
			</div>
		</div>
	</div>
    <!-- END # MODAL LOGIN -->
	<?php } ?>
	<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(27034011, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/27034011" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
	<script type="text/javascript">
		ym(27034011, 'reachGoal', 'user_logged_in', {user_logged_in: "<?php if ( is_user_logged_in() ) { echo "yes"; }else{ echo "no"; } ?>"});
	<?php if( is_404() ){ ?>
			ym(27034011, 'reachGoal', 'error404', {URL: document.location.href});
	<?php } ?>
	</script>
	<?php if( get_current_user_id() == 1 ){ ?>

	<style>
	.breakpoint{
		position: fixed;
		top:40px;
		right:10px;
		background-color:red;
		color:white;
		display:none;
		z-index: 99999;
		padding: 5px;
		font-size: 20px;
	}
	</style>
	<div class="breakpoint d-block d-sm-none">xs</div>
	<div class="breakpoint d-none d-sm-block d-md-none">sm</div>
	<div class="breakpoint d-none d-md-block d-lg-none">md</div>
	<div class="breakpoint d-none d-lg-block d-xl-none">lg</div>
	<div class="breakpoint d-none d-xl-block d-xxl-none">xl</div>
	<div class="breakpoint d-none d-xxl-block">xxl</div>
	
	<?php } ?>
</body>
</html>