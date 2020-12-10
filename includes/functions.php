<?php

function js_css_register() {
	/* Registro de script. */
	wp_register_script('datatables-js', BP_URL . '/includes/DataTables/datatables.js');
	wp_register_script('searchpanes-datatables-js', BP_URL . '/includes/DataTables/dataTables.searchPanes.min.js');
	wp_register_script('select-datatables-js', BP_URL . '/includes/DataTables/dataTables.select.min.js');
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
}
add_action( 'admin_enqueue_scripts', 'my_shortcode_styles_admin' );

function banco_proyectos() {
	wp_enqueue_script('banco-proyectos-js');	
	wp_enqueue_script('datatables-js');
	wp_enqueue_script('searchpanes-datatables-js');
	wp_enqueue_script('select-datatables-js');

	global $wpdb;
	$table_name = $wpdb->prefix . BP_TABLE;

	$row = $wpdb->get_results( "SELECT * FROM $table_name" );

	echo
	"<div id='contenedor_carga'>
		<div id='carga'></div>
	</div>
	<table id='tabla_dt' class='display'>
		<thead>
			<tr>
				<th>CÓDIGO</th>
				<th>PROYECTO</th>
				<th>MODALIDAD</th>
				<th>AREA</th>
				<th>ESTADO</th>
				<th>ESTADO</th>
			</tr>
		</thead>
		<tbody>";

	foreach($row as $rows) {

		echo
		"<tr>
			<td>"."$rows->codigo"."</td>
			<td class='proyecto'>
				<div class='nombre-proyecto'><a href='proyecto/?codigo="."$rows->codigo"."' target='_blank'>"."$rows->proyecto"."</a></div>
				<div class='autores'><strong>Autores: </strong>"."$rows->autor"."</div>
				<div class='estado-responsive'><span class='color-3'>"."$rows->estado"."</span></div>
				<div class='ver_mas'><a href='proyecto/?codigo="."$rows->codigo"."' target='_blank'>Ver más</a></div>
			</td>
			<td class='modalidad-oculto'>"."$rows->modalidad"."</td>
			<td class='area-oculto'>"."$rows->area"."</td>
			<td class='estado-oculto'>"."$rows->estado"."</td>
			<td class='estado'><div class='color-3'>"."$rows->estado"."</div></td>
		</tr>";

	}

	echo
		"</tbody>
	</table>";
}
add_shortcode('project_bank', 'banco_proyectos');

function proyecto() {
	wp_enqueue_script('proyecto-js');

	global $wpdb;
	
	$table_name = $wpdb->prefix . BP_TABLE;
	$codigo = $_GET['codigo'];

	$row = $wpdb->get_results( "SELECT * FROM $table_name WHERE codigo LIKE '$codigo'" );

	foreach($row as $rows) {
		echo
			"<div id='proyecto-individual'>
			<h3 class='proyecto'>"."$rows->proyecto"."</h3>
        	<div class='row'>

                <div class='col-sm-4'>
                    <div class='id'><strong>Código: </strong>"."$rows->codigo"."</div>
                    <div class='autores'><strong>Autores: </strong>"."$rows->autor"."</div>
					<div class='area'><strong>Área: </strong><p>"."$rows->area"."</p></div>
					<hr>
					<div class='estado'><strong>Estado: </strong><p class='color-3'>"."$rows->estado"."</p></div>
					<hr>
                    <ul class='certificado vc_row wpb_row vc_row-fluid row '>
                        <li class='concepto'>                        
                    	    <a href='"."$rows->concepto"."' title='Concepto Comité de Ética' target='_blank'> Concepto Comité de Ética</a>
                        </li>
                        <li class='informe_final'>                          
                            <a href='"."$rows->informe_final"."' title='Informe Final' target='_blank'> Informe Final</a>
                        </li>
                        <li class='cumplimiento'>                          
                            <a href='"."$rows->certi_cumplimiento"."' title='Certificado Cumplimiento' target='_blank'> Certificado de Cumplimiento</a>
                        </li>
                    </ul>
                </div>

                <div class='col-sm-8'>
                    <hr>
                    <div class='resumen'><strong>Resumen: </strong>"."$rows->resumen"."</div>
                </div>
			</div>
			</div>";
	}
}
add_shortcode('project', 'proyecto');

function filter_project_title_content( $titulo ) {
	$codigo = $_GET['codigo'];
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

	include_once('importacion-masiva.php');
	include_once('actualizacion-masiva.php');

	global $wpdb;
	$table_name = $wpdb->prefix . BP_TABLE;

	$row = $wpdb->get_results( "SELECT * FROM $table_name" );

	if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
		echo
		"<header id='header-admin'>¡Bienvenid@ " . $current_user->user_login . "! <a href='". wp_logout_url(get_permalink()) ."' class='log-out'>Cerrar Sesión</a></header>
		<hr>
		<div class='bg'></div>
		<div id='admin-banco-proyectos'>
		<div class='row'>
		<div class='col-sm-4'>
		<div id='response' class='"."$type"." "."display-block'>
			"."$message"."
		</div>
		<button type='button' class='button lateral showForm' href='#'>Nuevo proyecto</button><hr>
		<form action='' method='post' id='update' enctype='multipart/form-data'>
			<button type='submit' name='update' class='btn-update lateral'>Actualización Masiva</button>
			<label for='update-file' class='btn-sm btn-default glyphicon glyphicon-paperclip'></label>
			<input type='file' name='file' id='update-file' accept='.xls,.xlsx'>
			<span>Formato permitido (.xlsx)</span>
		</form>
		<hr>
		<form action='' method='post' id='import' enctype='multipart/form-data'>
			<button type='submit' name='import' class='btn-import lateral'>Importación Masiva</button>
			<label for='import-file' class='btn-sm btn-default glyphicon glyphicon-paperclip'></label>
			<input type='file' name='file' id='import-file' accept='.xls,.xlsx'>
			<span>Formato permitido (.xlsx)</span>
		</form>
		</div>
		<div class='col-sm-8'>
		<table id='tabla_dt' class='display'>
			<thead>
				<tr>
					<th>CÓDIGO</th>
					<th>PROYECTO</th>
					<th>ACCIONES</th>
				</tr>
			</thead>
			<tbody class='lista-proyectos'>";

		foreach($row as $rows) {
			echo
			"<tr>
				<td>"."$rows->codigo"."</td>
				<td class='proyecto'>"."$rows->proyecto"."</td>
				<td>
					<div class='btn-toolbar'>
						<div class='btn-group'>
							<button type='button' class='edit btn btn-sm btn-default' data-id='"."$rows->id"."' href='#'>
								<span class='glyphicon glyphicon-pencil'></span>
							</button>
							<button type='button' class='delete btn btn-sm btn-default' data-id='"."$rows->id"."' href='#'>
								<span class='glyphicon glyphicon-trash'></span>
							</button>
						</div>
					</div>
				</td>
			</tr>";
		}

		echo
			"</tbody>
		</table>
		</div>
		</div>
		</div>
		<div id='formularioProyecto'><div class='modalFormProyecto'></div></div>";
	} else {
		echo "<div class='login wp-core-ui'>
		<div id='login'>";
		wp_login_form();
		echo "</div></div>";
	}
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