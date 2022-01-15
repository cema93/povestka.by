<?php
	$post = $wp_query->post;
	
	if( has_term('sluzhby-pomoshhi-prizyvnikam', 'place-cat') ) {
		include(TEMPLATEPATH.'/single-place-help.php');
	} else {
		include(TEMPLATEPATH.'/single-place-military.php');
	}
?>