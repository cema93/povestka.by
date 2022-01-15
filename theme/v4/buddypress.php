<?php get_header('old'); ?>
		<div class="container">
			<div class="row">
				<section class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; // end of the loop. ?>
				</section>
			</div>
		</div>
	</section>
<?php get_footer('old'); ?>
