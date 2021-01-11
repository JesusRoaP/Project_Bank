<?php
function js_css_register() {
	/* Registro de script. */
	wp_register_script('datatables-js', BP_URL . '/includes/DataTables/datatables.js');
	wp_register_script('searchpanes-datatables-js', BP_URL . '/includes/DataTables/dataTables.searchPanes.min.js');
	wp_register_script('select-datatables-js', BP_URL . '/includes/DataTables/dataTables.select.min.js');
	wp_register_script('accent-neutralise-js', BP_URL . '/includes/DataTables/accent-neutralise.js');
	wp_register_script('banco-proyectos-js', BP_URL . '/public/js/banco-proyectos.js');
	wp_register_script('proyecto-js', BP_URL . '/public/js/proyecto.js');
	wp_register_script('admin-banco-proyectos-js', BP_URL . '/public/js/admin-banco-proyectos.js');

	wp_register_style('datatables-pb-css', BP_URL . '/includes/DataTables/datatables.css');
	wp_register_style('searchpanes-datatables-css', BP_URL . '/includes/DataTables/searchPanes.dataTables.min.css');
	wp_register_style('select-datatables-css', BP_URL . '/includes/DataTables/select.dataTables.min.css');
	wp_register_style('banco-proyectos-css', BP_URL . '/public/css/banco-proyectos.css');
	wp_register_style('banco-proyectos-2-css', BP_URL . '/public/css/banco-proyectos-2.css');
	wp_register_style('proyecto-css', BP_URL . '/public/css/proyecto.css');
	wp_register_style('admin-banco-proyectos-css', BP_URL . '/public/css/admin-banco-proyectos.css');
	wp_register_style('iconos-css', BP_URL . '/public/css/iconos.css');
	wp_register_style('fuente-lato', 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
	wp_register_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
	wp_register_style('admin-css', BP_URL . '/admin/css/admin.css');
	wp_register_style('fontawesome-free-5-css', BP_URL . '/includes/fontawesome-free-5.15.1/css/all.css');
	wp_register_style('logo-pb-css', BP_URL . '/admin/css/logo-pb.css');
}
add_action('init', 'js_css_register');

function my_shortcode_styles() {
    global $post;

    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'project_bank' ) ) {
		wp_enqueue_style( 'datatables-pb-css' );
		wp_enqueue_style( 'searchpanes-datatables-css' );
		wp_enqueue_style( 'select-datatables-css' );
		wp_enqueue_style( 'banco-proyectos-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'fuente-lato' );
		wp_enqueue_style( 'material-icons' );
		wp_enqueue_style( 'fontawesome-free-5-css' );
	}
	
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'project' ) ) {
		wp_enqueue_style( 'proyecto-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'fuente-lato' );
		wp_enqueue_style( 'fontawesome-free-5-css' );
	}
	
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'project_bank_admin' ) ) {
		wp_enqueue_style( 'datatables-pb-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'admin-banco-proyectos-css' );
		wp_enqueue_style( 'login' );
    }
}
add_action( 'wp_enqueue_scripts', 'my_shortcode_styles' );

function my_shortcode_styles_admin() {
	wp_enqueue_style( 'admin-css' );
	wp_enqueue_style( 'logo-pb-css' );
}
add_action( 'admin_enqueue_scripts', 'my_shortcode_styles_admin' );

function banco_proyectos() {
	wp_enqueue_script('banco-proyectos-js');	
	wp_enqueue_script('datatables-js');
	wp_enqueue_script('searchpanes-datatables-js');
	wp_enqueue_script('select-datatables-js');
	wp_enqueue_script('accent-neutralise-js');

	require_once('banco-proyectos.php');
}
add_shortcode('project_bank', 'banco_proyectos');

function rewrite_projects_permalinks() {
    global $wp;
    $wp->add_query_var('codigo');
    add_rewrite_rule( '(.?.+?)/codigo/([^/]*)/?$', 'index.php?pagename=$matches[1]&codigo=$matches[2]', 'top' );
}
add_action( 'init', 'rewrite_projects_permalinks' );

function proyecto() {
	wp_enqueue_script('proyecto-js');

	require_once('proyecto.php');
}
add_shortcode('project', 'proyecto');

function filter_project_title_content( $titulo ) {
	$codigo = get_query_var('codigo');
	if ( is_page('Proyecto codigo') ) {
		$titulo = str_replace('codigo', $codigo, $titulo);
	}
    return $titulo;
}
add_filter( 'the_title', 'filter_project_title_content' );

function filter_project_wpyoastseo_title($title) {
    if( is_page('Proyecto codigo') ) {
        $title = get_the_title() . " - Banco de Proyectos - " . get_bloginfo( 'name' );
    }
    return $title;
}
add_filter('wpseo_title', 'filter_project_wpyoastseo_title');

function filter_project_wprankmathseo_title( $title ) {
    if( is_page('Proyecto codigo') ) {
        $title = get_the_title() . " - Banco de Proyectos - " . get_bloginfo( 'name' );
    }
    return $title;
}
add_filter( 'rank_math/frontend/title', 'filter_project_wprankmathseo_title');

function filter_project_title($title) {
	if ( is_page('Proyecto codigo') ) {
		$title = get_the_title() . " - Banco de Proyectos - " . get_bloginfo( 'name' ); 
	}
	return $title;
}
add_filter('pre_get_document_title', 'filter_project_title');

function admin_banco_proyectos() {
	wp_enqueue_script('datatables-js');
	wp_enqueue_script('admin-banco-proyectos-js');

	wp_localize_script('admin-banco-proyectos-js','proyecto_newedit',['ajaxurl'=> BP_URL . '/includes/proyecto.newedit.php']);
	wp_localize_script('admin-banco-proyectos-js','proyecto_save',['ajaxurl'=> BP_URL . '/includes/proyecto.save.php']);
	wp_localize_script('admin-banco-proyectos-js','proyecto_delete',['ajaxurl'=> BP_URL . '/includes/proyecto.delete.php']);

	global $wpdb;
	$table_name = $wpdb->prefix . BP_TABLE;

	require_once('importacion-masiva.php');
	require_once('actualizacion-masiva.php');
	require_once('admin-banco-proyectos.php');
}
add_shortcode('project_bank_admin', 'admin_banco_proyectos');

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