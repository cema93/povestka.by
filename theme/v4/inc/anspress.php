<?php
/**
 * Adds custom field in ask form.
 */
function custom_form_fields( $form ) {
	
	$args = array(
		'type' => 'radio',
		'label' => __( 'Показывать Ваше имя?' ),
		'desc' => 'Данная опция является бонусом для пользователей <a href="https://povestka.by/donate/" target="_blank">сделавших пожертвование</a>.',
		'output_order' => [ 'wrapper_start', 'label', 'field_wrap_start', 'errors', 'desc', 'field_markup', 'field_wrap_end', 'wrapper_end' ],
		'options' => array(
			'yes' => 'Да, показать моё имя',
			'no' => 'Нет, опубликовать анонимно'
		),
	);
	
	$form['fields']['display_name'] = $args;
	return $form;
}
add_filter( 'ap_question_form_fields', 'custom_form_fields' );
/**
 * Things to do after creating a question
 */
function question_mysave( $post_id, $post ) {
	$user = wp_get_current_user();
	$values = anspress()->get_form( 'question' )->get_values();
	
	if ( isset( $values['display_name'], $values['display_name']['value'] ) AND in_array( 'donor', (array) $user->roles ) ) {
//	if ( isset( $values['display_name'], $values['display_name']['value'] ) ) {
		update_field( 'display_name', $values['display_name']['value'], $post_id );
	}else{
		update_field( 'display_name', 'yes', $post_id );
	}
}
add_action( 'ap_processed_new_question', 'question_mysave', 0, 2 );
add_action( 'ap_processed_update_question', 'question_mysave', 0, 2 );



function ap_no_permission_wpseo($presenters){
	$post = get_post();

	if ( is_anspress() AND !ap_user_can_read_post($post->ID, get_current_user_id()) ){
		return array();  
	}else{
		return $presenters;    
	}

}
add_filter('wpseo_frontend_presenter_classes', 'ap_no_permission_wpseo', 10, 1);


?>