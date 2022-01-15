</div>
<!--noindex-->
	<footer class="footer">
		<div class="container bottom_border">
			<div class="row">
				<div class="col-12 text-center">
					<p>Перепечатка фотографий и текста (целиком и частично) разрешена только при наличии активной ссылки на сайт povestka.by</p>
				</div>
			</div>
		</div>
		<div class="container">
			<?php wp_nav_menu(array(
				'theme_location' => 'footer_menu', // название меню
				'container' => '', // контейнер для меню, по умолчанию 'div', в нашем случае ставим 'nav', пустая строка - нет контейнера
				'container_class' => '', // класс для контейнера
				'container_id' => '', // id для контейнера
				'menu_class' => 'foote_bottom_ul_amrc list-unstyled list-inline text-center', // класс для меню
				'menu_id' => '', // id для меню
				'depth' => 1,
			));	?>
			<p class="text-center">© 2013-<?php echo date("Y"); ?> Центр прав призывника</p>
			<ul class="social_footer_ul list-unstyled list-inline">
				<li><a href="https://vk.com/ags_by" target="_blank" rel="noreferrer nofollow"><i class="fa fa-vk"></i></a></li>
				<li><a href="https://www.facebook.com/ags.by/" target="_blank" rel="noreferrer nofollow"><i class="fa fa-facebook"></i></a></li>
				<li><a href="https://ok.ru/group/53616670015673" target="_blank" rel="noreferrer nofollow"><i class="fa fa-odnoklassniki"></i></a></li>
			</ul>
			<?php if(is_front_page() OR is_page('donate')) { ?><img src="https://povestka.by/wp-content/themes/stable/img/footer/banks.png" class="img-responsive" alt="Логотипы банков и платежных систем" /><?php } ?>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
	<script>
	jQuery(document).ready(function( $ ) {
		var currentTime = new Date();
		var day = currentTime.getDate();
		var month = currentTime.getMonth() + 1;
		var year = currentTime.getFullYear() - 16;
		jQuery("input[name='birthday']").datepicker({
			format: "dd-mm-yyyy",
			endDate: day+'-'+month+'-'+year,
			language: "ru",
			autoclose: true
		});
		
		$("body").on("click",".show-button", function( e ){
			e.preventDefault();

			if($(this)[0].hasAttribute("data-stat")){
				ym(27034011, 'reachGoal', 'rating_stat', {type: $(this).attr("data-stat")});
			}

			show = $(this).attr("data-show");
//			$(this).collapse('hide');
			$(this).addClass("hidden");
			$('.'+show).collapse('show');
			return false;
		});
		
	});
	<?php  if(!is_page('donate')) { ?>
		jQuery(document).ready(function( $ ) {
			$.ajax({
				url: '/doika/short-client-1',
			}).done(function( data ) {
				
				var root = document.getElementsByTagName('html')[0];
				
				document.body.classList.add("donateHeader__margin");

				var elems = document.body.getElementsByTagName("*");

				for (var i = 0; i < elems.length; i++) {
					var elementComputedStyle = window.getComputedStyle(elems[i], null);
					var elementPosition = elementComputedStyle.getPropertyValue('position');
					var elementTopPosition = elementComputedStyle.getPropertyValue('top');

					if ((elementPosition == 'fixed') && (parseInt(elementTopPosition) <= 59) && (elementTopPosition)) {
						elems[i].classList.add("donateHeader__transform");
					}
				}

				var donateHeader = document.createElement('div');
				donateHeader.className = 'donateHeader';
				donateHeader.innerHTML = '<p class="donateHeader__title">' + data.campaignTitle + '</p>' +
					'<p class="donateHeader__goal">Собрано <span class="summ__highlight">'+ data.currentFunds +'</span> из <span class="goal__highlight">'+ data.expectedFunds +'</span> руб.</p>' +
					'<p class="donateHeader__button">Помочь!</p>';

				root.appendChild(donateHeader);

				document.querySelector(".donateHeader__button").addEventListener("click", function () {
					window.location.href = 'https://povestka.by/news/nash-sajt-rabotaet-blagodarya-vashej-podderzhke/#module-donate-wrapper';
				});
			});
		});
	
	<?php } ?>
	<?php if(is_front_page()) { ?>
		jQuery(document).ready(function( $ ) {
			$('.section-wrapper').mouseenter(function() {
				$(this).find('.section-border-1').stop().animate({top: '0px'}, 250);
				$(this).find('.section-border-2').stop().animate({bottom: '0px'}, 250);
				$(this).find('.section-border-3').stop().animate({left: '0px'}, 250);
				$(this).find('.section-border-4').stop().animate({right: '0px'}, 250);
				$(this).find('.section-border').animate({top: '0px', left: '0px'}, 250);
			});
			$('.section-wrapper').mouseleave(function() {
				$(this).find('.section-border-1').stop().animate({top: '-365px'}, 250);
				$(this).find('.section-border-2').stop().animate({bottom: '-365px'}, 250);
				$(this).find('.section-border-3').stop().animate({left: '-365px'}, 250);
				$(this).find('.section-border-4').stop().animate({right: '-365px'}, 250);
			});
		});

		if (window.location.hash.startsWith('#faq')) {
			window.location.replace("https://povestka.by/faq/");
		}
	<?php }elseif(is_page('rating') OR is_singular('place') ) { ?>
		jQuery(document).ready(function( $ ) {
			$('#RatingCarousel').carousel({
				interval: 5000
			});
			
			if ($(window).width() >= 767) {
				$('#RatingCarousel.carousel .item').each(function(){
					var next = $(this).next();
					if (!next.length) {
						next = $(this).siblings(':first');
					}
					next.children(':first-child').clone().appendTo($(this));
				  
					if (next.next().length>0) {
						next.next().children(':first-child').clone().appendTo($(this));
					}
					else {
						$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
					}
				});
			}
		});

		jQuery(document).ready(function( $ ) {
			$('form#new_org_review').bootstrapValidator({
				feedbackIcons: {
					valid: 'glyphicon glyphicon-ok',
					invalid: 'glyphicon glyphicon-remove',
					validating: 'glyphicon glyphicon-refresh'
				},
				fields: {
					org: {
						validators: {
							notEmpty: {
								message: 'Выберите органищацию'
							}
						}
					},
					rating: {
						validators: {
							notEmpty: {
								message: 'Поставьте оценку'
							}
						}
					},
					comment: {
						validators: {
							stringLength: {
								min: 10,
								message:'Комментарий не может быть менее 10 символов'
							},
							notEmpty: {
								message: 'Пожаоуйста, введите комментарий'
							}
						}
					}
				}
			});
		});
		jQuery(document).ready(function( $ ) {
			
			var hash = window.location.hash;
			if (hash) {
				$('ul.nav a[href="' + hash + '"]').tab('show');
				var new_position = $('ul#actions').offset();
				$('html, body').stop().animate({ scrollTop: new_position.top }, 500);				
			}

			jQuery('.nav-tabs a').click(function (e) {
				jQuery(this).tab('show');
				var scrollmem = jQuery('body').scrollTop() || jQuery('html').scrollTop();
				window.location.hash = this.hash;
				jQuery('html,body').scrollTop(scrollmem);
			});
		});

	<?php }elseif(is_post_type_archive('faq')) { ?>
		jQuery(document).ready(function( $ ) {
			$('.question').click(function() {
				$some = $(this);
				$some.parents('.question-wrapper').find('.answer').toggle();
			});
			
			var searchbox = document.getElementsByClassName("faq-search-box");
			[].forEach.call(searchbox,function(searchbox){
				searchbox.addEventListener("input", function (e) {
					if( searchbox.value.length > 0 ){
						var questions = document.querySelectorAll(".question-wrapper");
						var searchTerm = searchbox.value;
						[].forEach.call(questions,function(question){
							if( question.innerHTML.toLowerCase().lastIndexOf(searchTerm.toLowerCase()) != -1 ){
								question.style.display = 'block';
							}else{
								question.style.display = 'none';
							}
						});
					}else{
						var questions = document.querySelectorAll(".question-wrapper");
						[].forEach.call(questions,function(questions){
							questions.style.display = 'block';
						});
					}
				});
			});

		});
	<?php }elseif(is_page('doc')) { ?>
		jQuery(function(){
			setTimeout(function() {
				window.scrollTo(0, 0);
			}, 1);
		});
		jQuery(document).ready(function( $ ) {
			var hash = window.location.hash;
			hash && jQuery('ul.nav a[href="' + hash + '"]').tab('show');
			jQuery('.nav-tabs a').click(function (e) {
				jQuery(this).tab('show');
				var scrollmem = jQuery('body').scrollTop() || jQuery('html').scrollTop();
				window.location.hash = this.hash;
				jQuery('html,body').scrollTop(scrollmem);
			});

			$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
				var next_obj = $(e.target);
				var prev_obj = $(e.relatedTarget);

				if(!prev_obj.parent().parent().hasClass('active')){
					$(prev_obj).parent().find('.section-border-1').css('top', '-365px');
					$(prev_obj).parent().find('.section-border-2').css('bottom', '-365px');
					$(prev_obj).parent().find('.section-border-3').css('left', '-365px');
					$(prev_obj).parent().find('.section-border-5').css('right', '-365px');
				}
			});
			$('.section-wrapper').mouseenter(function() {
				if(!$(this).parent().hasClass('active')) {
					$(this).find('.section-border-1').stop().animate({top: '0px'}, 250);
					$(this).find('.section-border-2').stop().animate({bottom: '0px'}, 250);
					$(this).find('.section-border-3').stop().animate({left: '0px'}, 250);
					$(this).find('.section-border-5').stop().animate({right: '0px'}, 250);
				}
			});
			$('.section-wrapper').mouseleave(function() {
				if(!$(this).parent().hasClass('active')) {
					$(this).find('.section-border-1').stop().animate({top: '-365px'}, 250);
					$(this).find('.section-border-2').stop().animate({bottom: '-365px'}, 250);
					$(this).find('.section-border-3').stop().animate({left: '-365px'}, 250);
					$(this).find('.section-border-5').stop().animate({right: '-365px'}, 250);
				}
			});
		});
	<?php }elseif(is_page_template('ask.php') AND is_user_logged_in()) { ?>
		jQuery(document).ready(function( $ ) {
			$('#author-recommendations-modal').modal('show');
		});
	<?php } ?>
	</script>
	<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(27034011, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/27034011" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
	<script type="text/javascript">
		ym(27034011, 'reachGoal', 'user_logged_in', {user_logged_in: "<?php if ( is_user_logged_in() ) { echo "yes"; }else{ echo "no"; } ?>"});
	<?php if( is_404() ){ ?>
			ym(27034011, 'reachGoal', 'error404', {URL: document.location.href});
	<?php } ?>
	</script>
<!--/noindex-->
</body>
</html>