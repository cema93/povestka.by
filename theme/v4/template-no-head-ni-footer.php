<?php /* Template Name: Страница без шапки и подвала */ ?>
<?php get_header('empty'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="about">
						<?php the_content(); ?>
					</div>
				<?php endwhile; // end of the loop. ?>
				</section>
			</div>
		</div>
<?php get_footer('empty'); ?>
