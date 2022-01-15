<?php
/**
 * BuddyPress - Users Header
 *
 * @since 3.0.0
 * @version 7.0.0
 */
	global $current_user;
	get_currentuserinfo();
?>

<div id="item-header-avatar">
	<?php echo get_avatar( $current_user->ID, 100, 'wavatar', '', array('force_default'=> true, 'loading' => 'lazy') ); ?>
</div><!-- #item-header-avatar -->

<div id="item-header-content">

	<h2 class="user-nicename"><?php echo $current_user->display_name; ?></h2>
	<small><?php bp_nouveau_member_hook( 'before', 'header_meta' ); ?></small>

	<?php
	bp_member_type_list(
		bp_displayed_user_id(),
		array(
			'label'        => array(
				'plural'   => __( 'Member Types', 'buddypress' ),
				'singular' => __( 'Member Type', 'buddypress' ),
			),
			'list_element' => 'span',
		)
	);
	?>

	<?php bp_nouveau_member_header_buttons( array( 'container_classes' => array( 'member-header-actions' ) ) ); ?>
</div><!-- #item-header-content -->
