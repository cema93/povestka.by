<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package PressBook
 */

get_header();
?>

	<div class="pb-content-sidebar u-wrapper">
		<main id="primary" class="site-main">

			<article class="pb-article">
				<header class="entry-header">
					<h1 class="entry-title"><?php single_cat_title(); ?></h1>
				</header>
				<div class="pb-content">
					<div class="entry-content">
						<?php echo category_description(); ?>
					</div>
				</div>
			</article>
		
		<?php
		if ( have_posts() ) {

			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content' );
			}

			the_posts_pagination();
		}
		?>

		</main><!-- #primary -->

		<?php
		get_sidebar( 'left' );
		get_sidebar();
		?>
	</div><!-- .pb-content-sidebar -->

<?php
get_footer();
