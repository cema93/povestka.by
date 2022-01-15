<?php get_header(); ?>
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
			<h2 class="text-center">Предыдущие сборы средств</h2>
			<div class="row">
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
			</div>
		</div>
<?php get_footer(); ?>
