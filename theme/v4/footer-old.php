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
				'theme_location' => 'footer_menu-old', // название меню
				'container' => '', // контейнер для меню, по умолчанию 'div', в нашем случае ставим 'nav', пустая строка - нет контейнера
				'container_class' => '', // класс для контейнера
				'container_id' => '', // id для контейнера
				'menu_class' => 'foote_bottom_ul_amrc list-unstyled list-inline text-center', // класс для меню
				'menu_id' => '', // id для меню
				'depth' => 1,
			));	?>
			<p class="text-center">© 2013-2022 Центр прав призывника</p>
			<ul class="social_footer_ul list-unstyled list-inline">
				<li><a href="https://vk.com/ags_by" target="_blank" rel="noreferrer nofollow"><i class="fab fa-vk"></i></a></li>
				<li><a href="https://www.facebook.com/ags.by/" target="_blank" rel="noreferrer nofollow"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="https://ok.ru/group/53616670015673" target="_blank" rel="noreferrer nofollow"><i class="fab fa-odnoklassniki"></i></a></li>
			</ul>
			<?php if(is_front_page() OR is_page('donate')) { ?>
				<img src="https://povestka.by/wp-content/themes/stable/img-old/footer/banks.png" class="img-responsive" alt="Логотипы банков и платежных систем" />
				<p class="text-center">ИП Гавриленко С.А., УНП: 193052606, время работы: круглосуточно, юридический адрес: Республика беларусь, г. Минск, ул. Калиновского 27-16</p>
			<?php } ?>
		</div>
	</footer>
	
	<?php wp_footer(); ?>
	<script>
	jQuery(document).ready(function( $ ) {
		
		$("body").on("click",".show-button", function( e ){
			e.preventDefault();

			if($(this)[0].hasAttribute("data-stat")){
				ym(27034011, 'reachGoal', 'rating_stat', {type: $(this).attr("data-stat")});
			}

			show = $(this).attr("data-show");
			$(this).addClass("hidden");
			$('.'+show).collapse('show');
			return false;
		});
		
	});
	<?php if(is_page('rating')) { ?>
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
	<?php }elseif(is_singular('place') ) { ?>
		jQuery(document).ready(function( $ ) {
			var hash = window.location.hash;
			if (hash) {
				$('ul.nav a[href="' + hash + '"]').tab('show');
				var new_position = $('ul#actions').offset();
//				console.log(new_position);
				$('html, body').stop().animate({ scrollTop: new_position.top }, 500);				
			}
			jQuery('.nav-tabs a').click(function (e) {
				jQuery(this).tab('show');
				var scrollmem = jQuery('body').scrollTop() || jQuery('html').scrollTop();
				window.location.hash = this.hash;
				jQuery('html,body').scrollTop(scrollmem);
			});
		});

	<?php }elseif(is_page('faq')) { ?>
		jQuery(document).ready(function( $ ) {
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
	<?php }elseif(is_singular('question') AND is_user_logged_in()) { ?>
		<?php $answers_count = ( '' !== get_query_var( 'answer_id' ) ? ap_get_answers_count() : ap_total_answers_found() ); ?>
		<?php if( !(int) $answers_count AND get_the_author_meta( 'ID' ) == get_current_user_id() ) { ?>
			<?php // https://stackoverflow.com/a/40658647 ?>
			jQuery(document).ready(function( $ ) {
				var seen=0;
				$(window).on('resize scroll', function() {
					if(!seen){
						var top_of_element = $(".do-not-wait").offset().top;
						var bottom_of_element = $(".do-not-wait").offset().top + $(".do-not-wait").outerHeight();
						var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
						var top_of_screen = $(window).scrollTop();
						
						if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element) && seen == 0){
							ym(27034011, 'reachGoal', 'rating_stat', {type: 'look'});
							seen=1;
						}
					}
				});
				$("body").on("click",".do-not-wait-link", function( e ){
					ym(27034011, 'reachGoal', 'rating_stat', {type: 'click'});
					return true;
				});
			});
		<?php } ?>
	<?php }elseif( is_single( 8266 ) ){ ?>
		jQuery(document).ready(function( $ ) {
			
			var i =0;
			var elements = document.getElementsByClassName("cost_input");
			for (var j = 0; j < elements.length; j++) {
				elements[j].addEventListener('keypress', test_fn, false);
			}
			function test_fn(e){
				if( e.charCode < 47 || e.charCode > 57 ) e.preventDefault(); // allow only numbers
			}
			
			//получаем id всех лотов
			var lots_ids = [];
			var elems = document.querySelectorAll(".lots > [lotID]")
			Array.from(elems).forEach( function (el) {
			   lots_ids.push(el.getAttribute("lotID"));
			});

			if(lots_ids.length){
				updat_price();
			}
			
			
			//автообновление цены
			function updat_price() {
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					data: {
						'action': 'LotsUpdate',
						'ids': lots_ids,
					},
					success: function(json){
						console.log(json);
						$.each(json.data, function(h, item) {
							$(".cost_input-"+json.data[h].id).attr({"min" : (Number.parseInt(json.data[h].current_cost)+1)}); //set min price input
							if(json.data[h].current_author){
								document.getElementsByClassName("current_cost-"+json.data[h].id)[0].textContent = json.data[h].current_cost + "BYN (Ваша ставка)"; //add current price
							}else{
								document.getElementsByClassName("current_cost-"+json.data[h].id)[0].textContent = json.data[h].current_cost + "BYN"; //add current price
							}
							
							if(json.data[h].author_history.length){
								document.getElementsByClassName("last-binds-pannel-"+json.data[h].id)[0].style.display = "block";
								var author_history_html ='';
								json.data[h].author_history.forEach(function(entry) {
									author_history_html += '<li class="list-group-item">' + entry.author + ' сделал(а) ставку ' + entry.bind + 'BYN в ' + entry.date + '</li>';
								});
								document.getElementsByClassName("last-binds-"+json.data[h].id)[0].innerHTML = author_history_html; //add current price
							}else{
								document.getElementsByClassName("last-binds-pannel-"+json.data[h].id)[0].style.display = "none";
							}
							if(json.data[h].time_left){
								document.getElementsByClassName("end_time-"+json.data[h].id)[0].textContent = "Окончание торгов через " + json.data[h].time_left;
							}else{
								document.getElementsByClassName("end_time-"+json.data[h].id)[0].textContent = "торги завершены" ;
							}
							
						});
					}
				});
				setTimeout(updat_price, 2000);
			}

			$("form.LotSubmit").submit(function(e){
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					data: {
						'action': 'PriceUpdate',
						'id': $(this).attr("lotID"),
						'rate': $('.cost_input-'+$(this).attr("lotID")).val()
					},
					success: function(json){
//						console.log(json);
						if(json.success){
							Swal.fire({
							  title: 'Ставка принята!',
							  text: '',
							  icon: 'success',
							  confirmButtonText: 'Закрыть'
							})
						}else{
							Swal.fire({
							  title: 'Ошибка принятия ставки!',
							  text: json.data,
							  icon: 'error',
							  confirmButtonText: 'Закрыть'
							})
						}

					}
				});
				return false;
			});
			
			var fActive = '';
			$("#filter button").on("click", function (e, event) {
				if(fActive != $(this).data('filter')){
					if ($(this).data('filter')) {
						$(".lots .jumbotron").hide();
						$('.lots .jumbotron[data-filter~=' + $(this).data('filter') + ']').show();
					}else{
						$(".lots .jumbotron").show();
					}
					e.preventDefault();
					$('#filter .active').removeClass('active');
					$(this).addClass('active');
					fActive = $(this).data('filter');
				}
			});
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