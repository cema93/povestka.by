jQuery(document).ready(function( $ ) {

	const circle = document.querySelector('.progress__ring-circle');
	if (circle) {
		const radius = circle.r.baseVal.value;
		const circumference = 2 * Math.PI * radius;
		circle.style.strokeDasharray = `${circumference} ${circumference}`;
		var counter = Number.parseInt(document.querySelector('.conscription__counter-number').textContent);
		let percents = (Math.round(counter) / Math.round(counter+20)) * 100;
		function setProgress(percent) {
			const offset = circumference - percent / 100 * circumference;
			circle.style.strokeDashoffset = offset;
		}
		setProgress(percents);
	}
// Меню

	const burger = document.querySelector('.header__top-burger');
	const menu = document.querySelector('.header__menu');
	const close = document.querySelector('.header__menu-img-close');

	burger.addEventListener("click", function() {
		if (window.innerWidth < 992) {
			menu.style.display = "block";
		}
	});
	close.onclick = () => {
		if (window.innerWidth < 992) {
			menu.style.display = "none";
		}
	};

// Колокольчик

	const bell = document.querySelector('.header__notifications-img');
	const bell_counter = document.querySelector('.header__notifications-counter');
	const small_menu_counter = document.querySelector('.header__menu-list__counter');
	if (bell_counter) {
		small_menu_counter.textContent = bell_counter.textContent;
		if ((bell_counter.textContent).trim() != "") {
			bell.setAttribute('src', "https://povestka.by/wp-content/themes/stable/img/header/bell-active.svg");
			bell_counter.style.display = "block";
			small_menu_counter.style.display = "block";
		} else if ((bell_counter.textContent).trim() == "") {
			bell.setAttribute('src', "https://povestka.by/wp-content/themes/stable/img/header/bell.svg");
			bell_counter.style.display = "none";
			small_menu_counter.style.display = "none";
		}
	}

	// Слайдер
	$('.advantages__slider').slick({
		mobileFirst: true,
		arrows: false,
		dots: true,
		slidesToShow: 3,
		infinite: false,
		responsive: [{
			breakpoint: 767,
			settings: 'unslick'
		}]
	});

	$(window).resize(function () {
		if (window.innerWidth > 992) {
			burger.style.display = "none";
		} else {
			burger.style.display = "block";
		}
	});

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $formLoading = $('#login-modal .loading-block');
    var $formSuccess = $('#login-modal .success-block');
    var $formError = $('#login-modal .error-block');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;

    $("#login-modal form").submit(function (e) {
		e.preventDefault();
        switch(this.id) {
            case "login-form":
				var height = $('#login-form').height();
				
				$formLoading.height(height);
				$formSuccess.height(height);
				$formError.height(height);
				
				$formLogin.hide();
				$formLoading.show();
		
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					data: { 
						'action': 'ajaxlogin',
						'username': $('#login-modal form input[name="email"]').val(),
						'password': $('#login-modal form input[name="password"]').val(),
						'remember': $('#login-modal form input[name="remember"]').is(":checked"),
						'security': new_var.nonce
					},
					success: function(data){
						if(data['success']){
							$formLoading.hide();
							$formSuccess.show();
							setTimeout(function() {
								document.location.reload();
							}, 3000); 							
						}else{
							$formLoading.hide();
							$('#login-modal .error-block .text').html(data['data']);
							$formError.show();
							setTimeout(function() {
    							$formError.hide();
								$formLogin.show();
							}, 3000); 
						}
					}
				});
                break;
            case "lost-form":
				height = $('#lost-form').height();
				
				$formLoading.height(height);
				$formSuccess.height(height);
				
				$formLost.hide();
				$formLoading.show();
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					data: { 
						'action': 'ajaxlost',
						'username': $('#login-modal form#lost-form input[name="email"]').val(),
						'security': new_var.nonce
					},
					success: function(data){
						$formLoading.hide();
						$('#login-modal .success-block .text').html("Проверьте свой email");
						$formSuccess.show();
						setTimeout(function() {
							document.location.reload();
						}, 5000); 							
					}
				});
                break;
            case "register-form":
                break;
            default:
			break;
        }
        return false;
    });
    
    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });
    
    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }

});

//Поисковые подсказки
var suggest_count = 0;
var input_initial_value = '';
var suggest_selected = 0;

jQuery(document).ready(function( $ ) {
	// читаем ввод с клавиатуры
	$(".who").keyup(function(I){
		// определяем какие действия нужно делать при нажатии на клавиатуру
		switch(I.keyCode) {
			// игнорируем нажатия на эти клавишы
			case 13:  // enter
			case 27:  // escape
			case 38:  // стрелка вверх
			case 40:  // стрелка вниз
			break;

			default:
				// производим поиск только при вводе более 2х символов
				if($(this).val().length>2){

					input_initial_value = $(this).val();
					// производим AJAX запрос к /ajax/ajax.php, передаем ему GET query, в который мы помещаем наш запрос

					$.ajax({
						type: 'POST',
						dataType: 'html',
						url: ajaxurl,
						data: { 
							'action': 'ajaxsearchhints',
							'text': this.value,
							'security': new_var.nonce
						},
						success: function(data){
							var list = eval("("+data+")");
							suggest_count = list.length;
							if(suggest_count > 0){
								// перед показом слоя подсказки, его обнуляем
								$("#search_advice_wrapper").html('<div class="line"></div>');
								for(var i in list){
									if(list[i] != ''){
										// добавляем слою позиции
										$('#search_advice_wrapper').append('<div class="advice_variant">'+list[i]+'</div>');
									}
								}
								$("#search_advice_wrapper").show();
							}
						}
					});
				}else{
					$('#search_advice_wrapper').hide();
				}
			break;
		}
	});

	//считываем нажатие клавишь, уже после вывода подсказки
	$(".who").keydown(function(I){
		switch(I.keyCode) {
			// по нажатию клавишь прячем подсказку
			case 13: // enter
				if($('#search_advice_wrapper').find('.active').length !== 0) {
					$('#search_advice_wrapper').hide();
					$('#header-search-form button[type="submit"]').click();
				}else{
					$('#header-search-form button[type="submit"]').click();
				}
			break;
			case 27: // escape
				$('#search_advice_wrapper').hide();
			break;
			// делаем переход по подсказке стрелочками клавиатуры
			case 38: // стрелка вверх
			case 40: // стрелка вниз
				if(suggest_count){
					//делаем выделение пунктов в слое, переход по стрелочкам
					key_activate( I.keyCode-39 );
				}
			break;
		}
	});

	$('#search_advice_wrapper').on('click', '.advice_variant', function(event) {
		
		// ставим текст в input поиска
		$('.who').val($(event.target).text());
		$('.who').focus();
		// прячем слой подсказки
		$('#search_advice_wrapper').fadeOut(350).html('');
	});

	// если кликаем в любом месте сайта, нужно спрятать подсказку
	$('html').click(function(){
		$('#search_advice_wrapper').hide();
	});
	// если кликаем на поле input и есть пункты подсказки, то показываем скрытый слой
	$('.who').click(function(event){
		if(suggest_count)
			$('#search_advice_wrapper').show();
		event.stopPropagation();
	});
	
	
function key_activate(n){
	$('#search_advice_wrapper div.advice_variant').eq(suggest_selected-1).removeClass('active');

	if(n == 1 && suggest_selected < suggest_count){
		suggest_selected++;
	}else if(n == -1 && suggest_selected > 0){
		suggest_selected--;
	}

	if( suggest_selected > 0){
		$('#search_advice_wrapper div.advice_variant').eq(suggest_selected-1).addClass('active');
		$(".who").val( $('#search_advice_wrapper div.advice_variant').eq(suggest_selected-1).text() );
	} else {
		$(".who").val( input_initial_value );
	}
}
	
});

//reload empty search page
jQuery(document).ready(function( $ ) {
	if (window.location.href == 'https://povestka.by/?s=') {
		var time = new Date().getTime();
		$(document.body).bind("mousemove keypress", function(e) {
			time = new Date().getTime();
		});

		function refresh() {
			if(new Date().getTime() - time >= 300000)
				window.location.reload(true);
			else
				setTimeout(refresh, 60000);
		}

		setTimeout(refresh, 60000);
	}
})