<?php

function js_css_register() {
	/* Registro de script. */
	wp_register_script('datatables-js', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/datatables.js');
	wp_register_script('searchpanes-datatables-js', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/dataTables.searchPanes.min.js');
	wp_register_script('select-datatables-js', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/dataTables.select.min.js');
	wp_register_script('banco-proyectos-js', WP_PLUGIN_URL . '/banco-proyectos/public/js/banco-proyectos.js');
	wp_register_script('proyecto-js', WP_PLUGIN_URL . '/banco-proyectos/public/js/proyecto.js');
	wp_register_script('admin-banco-proyectos-js', WP_PLUGIN_URL . '/banco-proyectos/public/js/admin-banco-proyectos.js');

	wp_register_style('datatables-css', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/datatables.css');
	wp_register_style('searchpanes-datatables-css', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/searchPanes.dataTables.min.css');
	wp_register_style('select-datatables-css', WP_PLUGIN_URL . '/banco-proyectos/includes/DataTables/select.dataTables.min.css');
	wp_register_style('banco-proyectos-css', WP_PLUGIN_URL . '/banco-proyectos/public/css/banco-proyectos.css');
	wp_register_style('banco-proyectos-2-css', WP_PLUGIN_URL . '/banco-proyectos/public/css/banco-proyectos-2.css');
	wp_register_style('proyecto-css', WP_PLUGIN_URL . '/banco-proyectos/public/css/proyecto.css');
	wp_register_style('admin-banco-proyectos-css', WP_PLUGIN_URL . '/banco-proyectos/public/css/admin-banco-proyectos.css');
	wp_register_style('iconos-css', WP_PLUGIN_URL . '/banco-proyectos/public/css/iconos.css');
	wp_register_style('fuente-lato', 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');
	wp_register_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');
	wp_register_style('admin-css', WP_PLUGIN_URL . '/banco-proyectos/admin/css/admin.css');
}
add_action('init', 'js_css_register');

function my_shortcode_styles() {
    global $post;

    if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'banco_proyectos' ) ) {
		wp_enqueue_style( 'datatables-css' );
		wp_enqueue_style( 'searchpanes-datatables-css' );
		wp_enqueue_style( 'select-datatables-css' );
		wp_enqueue_style( 'banco-proyectos-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'fuente-lato' );
		wp_enqueue_style( 'material-icons' );
	}
	
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'proyecto' ) ) {
		wp_enqueue_style( 'proyecto-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'fuente-lato' );
	}
	
	if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'admin_banco_proyectos' ) ) {
		wp_enqueue_style( 'datatables-css' );
		wp_enqueue_style( 'iconos-css' );
		wp_enqueue_style( 'admin-banco-proyectos-css' );
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
	$row = $wpdb->get_results( "SELECT * FROM wp_proyectos" );

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
				<div class='resumen'><strong>Resumen: </strong>"."$rows->resumen"."
					<div class='estado-resumen'><hr><strong>Estado: </strong><span class='color-3'>"."$rows->estado"."</span></div>
					<hr>
					<ul class='certificado vc_row wpb_row vc_row-fluid row '>
						<li class='concepto'>                        
							<a href='"."$rows->concepto"."' title='Concepto Comité de Ética' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Concepto Comité de Ética</a>
						</li>
						<li class='informe_final'>                          
							<a href='"."$rows->informe_final"."' title='Informe Final' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Informe Final</a>
						</li>
						<li class='cumplimiento'>                          
							<a href='"."$rows->certi_cumplimiento"."' title='Certificado Cumplimiento' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Certificado de Cumplimiento</a>
						</li>
					</ul>
				</div>
				<div class='ver_mas'>Ver más</div>
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
add_shortcode('banco_proyectos', 'banco_proyectos');

function proyecto() {

	wp_enqueue_script('proyecto-js');

	global $wpdb;
	$codigo = $_GET['codigo'];
	$row = $wpdb->get_results( "SELECT * FROM wp_proyectos WHERE codigo LIKE '$codigo'" );

	foreach($row as $rows) {

		echo
			"<h3 class='proyecto'>"."$rows->proyecto"."</h3>
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
                    	    <a href='"."$rows->concepto"."' title='Concepto Comité de Ética' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Concepto Comité de Ética</a>
                        </li>
                        <li class='informe_final'>                          
                            <a href='"."$rows->informe_final"."' title='Informe Final' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Informe Final</a>
                        </li>
                        <li class='cumplimiento'>                          
                            <a href='"."$rows->certi_cumplimiento"."' title='Certificado Cumplimiento' target='_blank'><i aria-hidden='true' class='glyphicon glyphicon-file'></i> Certificado de Cumplimiento</a>
                        </li>
                    </ul>
                </div>

                <div class='col-sm-8'>
                    <hr>
                    <div class='resumen'><strong>Resumen: </strong>"."$rows->resumen"."</div>
                </div>
            </div>";

	}

}
add_shortcode('proyecto', 'proyecto');

function cambiar_titulo_pagina_proyecto() {
	$codigo = $_GET['codigo'];
	return "$codigo"; 
}
add_filter('pre_get_document_title', 'cambiar_titulo_pagina_proyecto');

function admin_banco_proyectos() {
	
	wp_enqueue_script('datatables-js');
	wp_enqueue_script('admin-banco-proyectos-js');

	wp_localize_script('admin-banco-proyectos-js','proyecto_newedit',['ajaxurl'=> WP_PLUGIN_URL . '/banco-proyectos/includes/proyecto.newedit.php']);
	wp_localize_script('admin-banco-proyectos-js','proyecto_save',['ajaxurl'=> WP_PLUGIN_URL . '/banco-proyectos/includes/proyecto.save.php']);
	wp_localize_script('admin-banco-proyectos-js','proyecto_delete',['ajaxurl'=> WP_PLUGIN_URL . '/banco-proyectos/includes/proyecto.delete.php']);

	include_once('importacion-masiva.php');
	include_once('actualizacion-masiva.php');

	global $wpdb;
	$row = $wpdb->get_results( "SELECT * FROM wp_proyectos" );

	echo
	"<div class='bg'></div>
	<div class='row'>
	<div class='col-sm-4'>
	<div id='response' class='"."$type"." "."display-block'>
		"."$message"."
	</div>
	<button type='button' class='button lateral showForm' href='#'>Nuevo proyecto</button><hr>
	<form action='' method='post' id='update' enctype='multipart/form-data'>
		<button type='submit' name='update' class='btn-update lateral'>Actualización Masiva</button>
		<label for='update-file' class='btn btn-sm btn-default glyphicon glyphicon-paperclip'></label>
		<input type='file' name='file' id='update-file' accept='.xls,.xlsx'>
		<span>Formato permitido (.xlsx)</span>
	</form>
	<hr>
	<form action='' method='post' id='import' enctype='multipart/form-data'>
		<button type='submit' name='import' class='btn-import lateral'>Importación Masiva</button>
		<label for='import-file' class='btn btn-sm btn-default glyphicon glyphicon-paperclip'></label>
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
	<div class='modalFormProyecto'></div>";

}
add_shortcode('admin_banco_proyectos', 'admin_banco_proyectos');

?>