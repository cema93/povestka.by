<?php /* Template Name: Справочный раздел */ get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<div class="alert alert-danger alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Уважаемые посетители!</strong> Данный раздел находится в разработке. </div>
					<?php if( current_user_can('manage_options') ){ ?>
						<style>
							select.btn{
								padding-top: 4px;
								padding-right: 0px;
								padding-bottom: 4px;
								padding-left: 4px;
							}
						</style>
						<div class="well well-sm">
							<h1>Я хочу... </h1>
							<form>
								<div class="input-group">
									<div class="input-group-btn">
										<select class="btn btn-default dropdown-toggle" style="height:34px;">
										  <option>поделиться идеей</option>
										  <option>сообщить о проблеме</option>
										  <option>задать вопрос</option>
										</select>
									</div>
									<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
									<div class="input-group-btn">
										<button class="btn" type="submit"><i class="fa fa-play" aria-hidden="true"></i></button>
									</div>
								</div>
							</form>
						</div>
					<?php } ?>
					<h3>Последние отзывы</h3>
<!--					
					фортировка по голосам, по дате, по комментариям
					фильтр по типу, по статусу
-->					
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="row">
									<div class="col-xs-3 text-center" style="line-height: 0.9;">
										<span style="font-size: 40px;"><?php the_field('votes_count'); ?></span><br>голосов
									</div>
									<div class="col-xs-9">
										<span class="right"><?php the_field('status'); ?></span>
										<?php $type = get_field('type'); ?>
										<?php if($type == 'Идея') { ?>
											<i class="fa fa-lightbulb-o" aria-hidden="true"></i>
										<?php }elseif($type == 'Проблема'){ ?>
											<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
										<?php }elseif($type == 'Вопрос'){ ?>
											<i class="fa fa-question-circle" aria-hidden="true"></i>
										<?php } ?>
										
<?php if( current_user_can('manage_options') ){ ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a>
<?php }else{ ?>
	<h3><?php the_title();?></h3>
<?php } ?>
										<div><?php the_field('content'); ?></div>
										<?php $answer = get_field('answer'); ?>
										<?php if($answer !="") {?>
										<div class="well well-sm">Официальный ответ:<br><?php echo $answer; ?></div>
										<?php } ?>
									</div>
								</div>
							</div>
<?php if( current_user_can('manage_options') ){ ?>
	<div class="panel-footer text-center">
		<div class="row">
			<div class="col-xs-3 like-button">
				<input type="checkbox" id="<?php the_ID(); ?>"><label for="<?php the_ID(); ?>" class="btn"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Поддерживаю!</label>
			</div>
			<div class="col-xs-5 text-center">
				<?php if(function_exists('russian_comments')) { russian_comments(); } ?>
			</div>
			<div class="col-xs-4">
				<span class="right"><?php the_author(); ?>, <?php the_date(); ?> <?php the_time(); ?></span>
			</div>
		</div>
	</div>
<?php } ?>
						</div>
					<?php endwhile; ?>
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
	</section>
<?php get_footer('old'); ?>