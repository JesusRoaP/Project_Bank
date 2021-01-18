<?php
//Restringir panel admin al perfil bp_admin
function restrict_admin_area_by_rol() {
    if (!current_user_can('manage_options') && (!defined('DOING_AJAX') || ! DOING_AJAX )) {
		$user = wp_get_current_user();
    	if( ! empty( $user ) && in_array( "admin_pb", (array) $user->roles ) ) {
			wp_redirect(site_url());
    		exit;
		}
	}
}
add_action('admin_init', 'restrict_admin_area_by_rol', 1);

// Mostrar barra admin al perfil bp_admin
function hide_admin_bar($content) {
	$user = wp_get_current_user();
	if( ! empty( $user ) && in_array( "admin_pb", (array) $user->roles )) $content = false;
		return $content;
}
add_filter( 'show_admin_bar' , 'hide_admin_bar');
?>