<?php get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="about">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				<?php endwhile; // end of the loop. ?>
				</section>
			</div>
			<div class="text-center"><a href="https://povestka.by/donate/anonymously/">Помочь Центру прав призывника анонимно</a></div>


			<h2 class="text-center">Частые вопросы</h2>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel-group">

						<div class="panel panel-default panel-help">
							<a href="#faq-1" data-toggle="collapse">
								<div class="panel-heading">
									Безопасно ли оплачивать картой на этом сайте?
								</div>
							</a>
							<div id="faq-1" class="collapse">
								<div class="panel-body">
									<p>Платёжная система <a href="https://webpay.by/" target="_blank" rel="noopener">WEBPAY</a>™ обеспечивает прием платежей по банковским карточкам VISA и MasterCard всех банков мира.</p>
									<p>Все платежи совершаются только в белорусских рублях, а сама операция оплаты банковской карточкой онлайн полностью конфиденциальна и безопасна.</p>
									<p>Безопасный сервер WEBPAY устанавливает шифрованное соединение по защищенному протоколу TLS и конфиденциально принимает от клиента данные его пластиковой банковской карты (номер карты, имя держателя, дату окончания действия, и контрольный номер банковской карточке CVC/CVC2).</p>
									<p>Администрация сайта не получает доступ к данным пластиковой карты (номер карты, имя держателя, дату окончания действия, и контрольный номер банковской карточке CVC/CVC2)</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-2" data-toggle="collapse">
								<div class="panel-heading">
									Как совершить пожертвование?
								</div>
							</a>
							<div id="faq-2" class="collapse">
								<div class="panel-body">
									<p>Для того, чтобы совершить пожертвование, заполните информацию в пустых ячейках выше, после чего нажмите кнопку ПОЖЕРТВОВАТЬ, которая переведет Вас на сервер платежной системы WEBPAY™.</p>
									<p>При переводе с пластиковой карточки рекомендуем Вам сохранять копию извещения о платеже.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-3" data-toggle="collapse">
								<div class="panel-heading">
									Что такое ежемесячное пожертвование?
								</div>
							</a>
							<div id="faq-3" class="collapse">
								<div class="panel-body">
									<p>Ежемесячное (или регулярное) пожертвование — это пожертвование, которое оформляется однажды и затем каждый месяц автоматически списывается с вашей карты. Таким образом вы будете помогать регулярно, не заходя каждый раз на сайт для ввода данных карты.</p>
									<p>Мы используем для ежемесячных пожертвований надежный платежный сервис WEBPAY. Он обеспечивает безопасность платежей, защиту от мошеннических операций и шифрование данных.</p>
									<p>Такое пожертвование легко отключить, если у вас изменятся обстоятельства.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-4" data-toggle="collapse">
								<div class="panel-heading">
									Как отключить ежемесячное пожертвование?
								</div>
							</a>
							<div id="faq-4" class="collapse">
								<div class="panel-body">
									<p>1. Авторизуйтесь в <a href="https://povestka.by/donor-account/">личном кабинете</a>. Email — это адрес электронной почты, на который приходят квитанции о списании пожертвования. Внимание! Необходимо использовать именно этот адрес. Иначе, в кабинете не отразятся ваши пожертвования.</p>
									<p>4. Нажмите «Отменить ежемесячные пожертвования» и подтвердите отмену.</p>
									<p>Кроме того, перед каждым списанием платежный сервис присылает электронное письмо с предупреждением о скором списании и ссылкой для отказа от пожертвования.</p>
									<p>Если возникнут сложности, напишите нам на info@povestka.by</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-5" data-toggle="collapse">
								<div class="panel-heading">
									Взимается ли комисия при оформлении пожертвования?
								</div>
							</a>
							<div id="faq-5" class="collapse">
								<div class="panel-body">
									<p>При списании пожертвования часть средств уходит на оплату сервису, который обеспечивает перевод денег. Комиссия при пожертвованиях оплачивается из средств Центра прав призывника. С вашей карты спишется ровно та сумма, которую вы укажете на сайте.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-6" data-toggle="collapse">
								<div class="panel-heading">
									Что такое «личный кабинет жертвователя»?
								</div>
							</a>
							<div id="faq-6" class="collapse">
								<div class="panel-body">
									<p>Личный кабинет жертвователя — это раздел нашего сайта. Здесь вы можете контролировать ваши пожертвования, легко подключать и изменять ежемесячные пожертвования, управлять напоминаниями.</p>
									<p>Если вы уже делали пожертвования на нашем сайте, для регистрации и входа в личный кабинет используйте email, который указывали при оформлении пожертвования.</p>
									<p><a href="https://povestka.by/donor-account/">Войти в личный кабинет</a></p>
									<p>Будем рады ответить на другие ваши вопросы по почте info@povestka.by</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-7" data-toggle="collapse">
								<div class="panel-heading">
									Как совершить ворзврат ошибочно уплаченных денежных средств?
								</div>
							</a>
							<div id="faq-7" class="collapse">
								<div class="panel-body">
									<p>Возврат ошибочно уплаченных денежных средств производится на ту же банковскую карту, с которой было осуществлено пожертвование. Возврат может быть осуществлен при обращении в Организацию посредством сообщения электронной почты на e-mail info@povestka.by, сообщение должно быть направлено в течение пяти рабочих дней с момента совершения пожертвования.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default panel-help">
							<a href="#faq-8" data-toggle="collapse">
								<div class="panel-heading">
									Контакты службы поддержки
								</div>
							</a>
							<div id="faq-8" class="collapse">
								<div class="panel-body">
									Пишите нам на почту info@povestka.by или звоните на номер +375291998650.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<h2 class="text-center">Предыдущие сборы средств</h2>
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">Оплата домена и хостинга на 2020 год</div>
						<div class="panel-body">
							<p>В эту сумму входит: оплата сервера, домена, рассылаемых смс, банковского обслуживания и налогов на 2020 год.</p>
						</div>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>Дата начала/ окончания</td>
									<td>26.07.2019/ 22.05.2020</td>
								</tr>
								<tr>
									<td>Необходимая/ собранная сумма</td>
									<td>1450р/ 1450р</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">Оплата домена и хостинга на 2019 год</div>
						<div class="panel-body">
							<p>В эту сумму входит: оплата сервера, домена, рассылаемых смс, банковского обслуживания и налогов на 2019 год.</p>
						</div>
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>Дата начала/ окончания</td>
									<td>13.03.2019/ 25.07.2019</td>
								</tr>
								<tr>
									<td>Необходимая/ собранная сумма</td>
									<td>1450р/ 1450р</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
	<?php if( get_current_user_id() == 1 ){ ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<canvas id="MyChart" width="400" height="200"></canvas>
<script>
new Chart(document.getElementById("MyChart"), {
  type: 'bar',
  data: {
    labels: [2018, 2019, 2020, 2021],
    datasets: [{
      label: "Пожертвования",
      type: "bar",
      stack: "Base",
      backgroundColor: "#279800",
      data: [0, 0, 0, 1569.04]
    }, {
      label: "Оплата хостинга",
      type: "bar",
      stack: "Base",
      backgroundColor: 'rgba(105, 105, 105, 1)',
      data: [0, 0, 0, -968.25],
    }, {
      label: "Оплата налогов",
      type: "bar",
      stack: "Base",
      backgroundColor: 'rgba(105, 105, 105, 0.9)',
      data: [0, 0, 0, -295.88],
    }, {
      label: "Оплата банковского обслуживания",
      type: "bar",
      stack: "Base",
      backgroundColor: 'rgba(105, 105, 105, 0.8)',
      data: [0, 0, 0, -190],
    }, {
      label: "Оплата домена",
      type: "bar",
      stack: "Base",
      backgroundColor: 'rgba(105, 105, 105, 0.7)',
      data: [0, 0, 0, -66],
    }, {
      label: "Оплата sms и рассылок",
      type: "bar",
      stack: "Base",
      backgroundColor: 'rgba(105, 105, 105, 0.6)',
      data: [0, 0, 0, -49.3]
    }]
  },
  options: {
	responsive: true,
    scales: {
      x: {
        stacked: true,
      },
      y: {
        stacked: true
      }
    },
	  tooltips: {
		  position: 'average',
    mode: 'label',
    callbacks: {
      label: function(tooltipItem, data) {
        var dataset = data.datasets[tooltipItem.datasetIndex];

        if (tooltipItem.index == 0 && tooltipItem.datasetIndex !== 0)
          return null;

        return dataset.label + ': ' + dataset.data[tooltipItem.index] + 'BYN';
      }
    }
  },
  }
});

</script>

<?php } ?>



		</div>
<?php get_footer('old'); ?>
