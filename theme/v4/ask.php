<?php /* Template Name: ask Template */ 
get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-8 col-md-9 col-lg-9">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
								<meta itemprop="position" content="1" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="/questions/"><span itemprop="name">Все вопросы</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php the_title();?></span></a>
								<meta itemprop="position" content="3" />
							</li>
						</ol>

					
					<?php if(!is_tax()) { ?>
						<h1><?php the_title(); ?></h1>
					<?php } ?>
					<!-- start --><?php the_content(); ?><!--end -->
				<?php endwhile; // end of the loop. ?>
				</section>
				<aside class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
					<div class="panel panel-default" id="author-recommendations">
						<div class="panel-heading">ПАМЯТКА АВТОРУ</div>
						<div class="panel-body">
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-question-circle" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Перед тем как задать вопрос ознакомьтесь с <a href="https://povestka.by/faq/">FAQ</a> и <a href="https://povestka.by/wiki/directory/">справочником</a>.
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa fa-search" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Не задавайте одинаковых вопросов. Воспользуйтесь <a href="https://povestka.by/?s=">поиском</a>.
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-check-circle" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Вопрос не должен нарушать <a href="https://povestka.by/help/rules/">правила сайта</a>.
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-font" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Старайтесь оформлять вопросы так, чтобы их было удобно читать.
								</div>
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</section>



<!-- Modal -->
<div class="modal fade" id="author-recommendations-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-show="show" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="myModalLabel">ПАМЯТКА АВТОРУ</h4>
      </div>
      <div class="modal-body">
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-question-circle" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									<strong>Перед тем как задать вопрос ознакомьтесь с <a href="https://povestka.by/faq/">FAQ</a> и <a href="https://povestka.by/wiki/directory/">справочником</a>.</strong>
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa fa-search" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Не задавайте одинаковых вопросов. Воспользуйтесь <a href="https://povestka.by/?s=">поиском</a>.
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-check-circle" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Вопрос не должен нарушать <a href="https://povestka.by/help/rules/">правила сайта</a>.
								</div>
							</div>
							<hr>
							<div class="media">
								<div class="media-left">
								  <i class="fa fa-font" aria-hidden="true"></i>
								</div>
								<div class="media-body">
									Старайтесь оформлять вопросы так, чтобы их было удобно читать.
								</div>
							</div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-success" data-dismiss="modal">Ознакомлен(а)!</button>
      </div>
    </div>
  </div>
</div>
<?php get_footer('old'); ?>
