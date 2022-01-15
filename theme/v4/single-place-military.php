<?php get_header('old'); ?>
	<div class="container">
		<div class="row">
			<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="/"><i class="fa fa-home" aria-hidden="true"></i><span itemprop="name" class="sr-only">Главная</span></a>
								<meta itemprop="position" content="1" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="/place/"><span itemprop="name">Карта</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active hidden">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="<?php echo home_url( $wp->request . '/' ); ?>"><span itemprop="name"><?php the_title();?></span></a>
								<meta itemprop="position" content="4" />
							</li>
						</ol>
				<h1 class="text-center"><?php the_title();?></h1>
				<div class="jumbotron">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<?php if ( has_post_thumbnail() ) { ?>
								<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), array (250,250) ); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive center-block">
							<?php }else { ?>
								<img src="https://povestka.by/wp-content/themes/stable/img-old/house-icon.png" alt="<?php the_title_attribute(); ?>" class="img-responsive center-block">
							<?php } ?>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							Адрес: <?php if( get_field('Address') ) { ?><strong><?php the_field('Address'); ?></strong><?php } ?><br>
							ФИО Военкома: <?php if( get_field('commissar') ) { ?><strong><?php the_field(commissar); ?></strong><?php }else { echo "Напишите данные о военкоме в комментарии";} ?><br>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php comments_template(); ?>
			<?php endwhile; ?>
			</section>
		</div>
	</div>
<?php get_footer('old'); ?>