<?php
    // Global $bp variable holds all of our info
//    global $bp;

    // The user ID of the currently logged in user
//    $current_user_id = (int) trim($bp->loggedin_user->id);

    // The author that we are currently viewing
//    $author_id  = (int) trim($bp->displayed_user->id);

//    if ($current_user_id !== $author_id)
//    if ( get_current_user_id() != bp_displayed_user_id() OR current_user_can('manage_options') )
    if ( get_current_user_id() != bp_displayed_user_id() ) {
    // redirect to home page url
        wp_redirect(home_url());
        exit();
    }
?>
<?php get_header(); ?>
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
<?php get_footer(); ?>
