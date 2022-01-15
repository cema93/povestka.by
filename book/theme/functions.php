<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
    
function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


function custom_content_filter_the_content( $content ) {
      $content .= '<div class="ya-share2" data-copy="extraItem" data-size="m" data-services="vkontakte,twitter,facebook,odnoklassniki,telegram,viber,whatsapp,messenger"></div>';
    return $content;
}
add_filter( 'the_content', 'custom_content_filter_the_content' );


?>