<?php get_header('empty'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<div class="about">
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
				<?php endwhile; // end of the loop. ?>
				</section>
				<aside class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>
	</section>
<?php get_footer('empty'); ?>
