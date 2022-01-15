<?php
function wp_maintenance_mode(){
if(!current_user_can('edit_themes') || !is_user_logged_in()){
wp_die('<h1 style="color:red">Сайт находится на техническом обслуживании</h1><br />Как только работы будут завершены мы снова с вами встретимся!'); }
}
add_action('get_header', 'wp_maintenance_mode');
?>