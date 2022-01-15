<?php get_header('old'); ?>
	<div class="container">
		<div class="row">
			<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div class="about">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<h2>Немного статистики</h2>
<style>						
.circle-tile {
	margin-bottom: 15px;
	text-align: center;
}
.circle-tile-heading {
	border: 3px solid rgba(255, 255, 255, 0.3);
	border-radius: 100%;
	color: #FFFFFF;
	height: 80px;
	margin: 0 auto -40px;
	position: relative;
	transition: all 0.3s ease-in-out 0s;
	width: 80px;
}
.circle-tile-heading .fa {
	line-height: 80px;
}
.circle-tile-content {
	padding-top: 50px;
}
.circle-tile-number {
	font-size: 26px;
	font-weight: 700;
	line-height: 1;
	padding: 5px 0 15px;
}
.circle-tile-description {
	text-transform: uppercase;
}
.circle-tile-heading.dark-blue:hover {
	background-color: #2E4154;
}
.circle-tile-heading.green:hover {
	background-color: #138F77;
}
.circle-tile-heading.orange:hover {
	background-color: #DA8C10;
}
.circle-tile-heading.blue:hover {
	background-color: #2473A6;
}
.circle-tile-heading.red:hover {
	background-color: #CF4435;
}
.circle-tile-heading.purple:hover {
	background-color: #7F3D9B;
}
.tile-img {
	text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.9);
}

.dark-blue {
	background-color: #34495E;
}
.green {
	background-color: #16A085;
}
.blue {
	background-color: #2980B9;
}
.orange {
	background-color: #F39C12;
}
.red {
	background-color: #E74C3C;
}
.purple {
	background-color: #8E44AD;
}
.dark-gray {
	background-color: #7F8C8D;
}
.gray {
	background-color: #95A5A6;
}
.light-gray {
	background-color: #BDC3C7;
}
.yellow {
	background-color: #F1C40F;
}
.text-dark-blue {
	color: #34495E;
}
.text-green {
	color: #16A085;
}
.text-blue {
	color: #2980B9;
}
.text-orange {
	color: #F39C12;
}
.text-red {
	color: #E74C3C;
}
.text-purple {
	color: #8E44AD;
}
.text-faded {
	color: rgba(255, 255, 255, 0.7);
}
</style>
					<div class="container">
						<div class="row">
							<div class="col-lg-3 col-sm-6">
								<div class="circle-tile ">
									<div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div>
									<div class="circle-tile-content dark-blue">
										<div class="circle-tile-description text-faded">Зарегистрировано<br> пользователей</div>
										<div class="circle-tile-number text-faded "><?php $usercount = count_users(); echo intdiv( $usercount['total_users'], 10) *10; ?>+</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="circle-tile ">
									<div class="circle-tile-heading dark-blue"><i class="fa fa-newspaper-o fa-fw fa-3x"></i></div>
									<div class="circle-tile-content dark-blue">
										<div class="circle-tile-description text-faded">Размещёно<br> новостей</div>
										<div class="circle-tile-number text-faded "><?php $count_posts = wp_count_posts('post'); echo intdiv( $count_posts->publish, 10 ) *10; ?>+</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="circle-tile ">
									<div class="circle-tile-heading dark-blue"><i class="fa fa-question fa-fw fa-3x"></i></div>
									<div class="circle-tile-content dark-blue">
										<div class="circle-tile-description text-faded">Задано<br> вопросов</div>
										<div class="circle-tile-number text-faded "><?php $count_posts = wp_count_posts('question'); echo intdiv( $count_posts->publish, 10 ) *10; ?>+</div>
									</div>
								</div>
							</div>
							<div class="col-lg-3 col-sm-6">
								<div class="circle-tile ">
									<div class="circle-tile-heading dark-blue"><i class="fa fa-comments-o fa-fw fa-3x"></i></div>
									<div class="circle-tile-content dark-blue">
										<div class="circle-tile-description text-faded">Написано<br> комментприев</div>
										<div class="circle-tile-number text-faded "><?php $comments_count = wp_count_comments(); echo intdiv( $comments_count->total_comments, 10 ) *10; ?>+</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; // end of the loop. ?>
			</section>
		</div>
	</div>
<?php get_footer('old'); ?>
