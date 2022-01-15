<?php
	if (!defined('ABSPATH')) {
		die();
	} 
	add_action('init', 'pp_durne_init');
	function pp_durne_init() {
			// Unhook the actions from wp-includes/default-filters.php
			remove_action('register_new_user', 'wp_send_new_user_notifications');
			remove_action('edit_user_created_user', 'wp_send_new_user_notifications', 10, 2);
	       
			// Replace with our action that sends the user email only
			add_action('register_new_user', 'pp_durne_send_notification');
			add_action('edit_user_created_user', 'pp_durne_send_notification', 10, 2);
	}
	
	function pp_durne_send_notification($userId, $to='both') {
			if (empty($to) || $to == 'admin') {
					// Admin only, so we don't do anything
					return;
			}
			// For 'both' or 'user', we notify only the user
			wp_send_new_user_notifications($userId, 'user');
	}