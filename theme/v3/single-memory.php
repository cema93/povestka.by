<?php get_header(); ?>
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
								<a itemtype="http://schema.org/Thing" itemprop="item" href="/memory/"><span itemprop="name">Книга памяти</span></a>
								<meta itemprop="position" content="2" />
							</li>
							<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="active hidden">
								<a itemtype="http://schema.org/Thing" itemprop="item" href="https://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>"><span itemprop="name"><?php the_title();?></span></a>
								<meta itemprop="position" content="4" />
							</li>
						</ol>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?php if ( has_post_thumbnail() ) { ?>
						<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), array (250,250) ); ?>" class="img-responsive center-block">
					<?php }else { ?>
						<img src="https://povestka.by/wp-content/themes/stable/img/memory/no-photo.jpg" alt="<?php the_title();?>" class="img-responsive center-block">
					<?php } ?>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<h1 style="margin-top:0px;"><?php the_title();?></h1>
					<?php if( get_field('DeathDate') OR get_field('MilitaryUnit') ) { ?>
						<big>Информация:</big>
						<?php if( get_field('DeathDate') ) { ?><br>Дата гибели: <b><?php echo date('d-m-Y', strtotime(get_field('DeathDate'))); ?></b><?php } ?>
						<?php if( get_field('MilitaryUnit') ) { ?><br>Воинская часть: <b>№<?php the_field('MilitaryUnit'); ?></b><?php } ?>
					<?php } ?>
				</div>
				<div class="clearfix"></div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:20px;">
				<?php the_content(); ?>
				</div>
			<?php endwhile; ?>
			</section>
			<aside class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
				<?php $the_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 3, 'category_name' => 'news', 'post__not_in' => array(get_the_ID()))); ?>
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 news-block">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
							<img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" class="img-responsive img-rounded" alt="<?php the_title(); ?>">
						<?php } ?>
							<p class="text"><?php the_title();?></p>
						</a>
					</div>
				<?php endwhile; ?>
			</aside>
		</div>
	</div>
<?php get_footer(); ?>