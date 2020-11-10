<?php
if (! current_user_can ('manage_options')) wp_die (__ ('No tienes suficientes permisos para acceder a esta página.'));

?>

<div class="wrap">
	<h2><?php _e( 'Project Bank', 'project bank' ) ?></h2>
	Bienvenido a la configuración del plugin Project Bank
</div>
<br>
<div>
	<ul>
		<li>Utiliza el siguiente shortcode para mostrar la tabla wp_project (esta será la página principal del plugin): <strong>[project_bank]</strong></li>
		<li>Utiliza el siguiente shortcode para mostrar individualmente las filas de la tabla wp_project: <strong>[project]</strong>
			<ul>
				<li>Esta página debe tener como página superior la página principal del plugin.</li>
				<li>Esta página debe tener el siguiente slug: <strong>proyecto</strong></li>
			</ul>
		</li>
		<li>Utiliza el siguiente shortcode para administrar la tabla wp_project (esta será la página de administración del plugin en el frontend): <strong>[project_bank_admin]</strong>
			<ul>
				<li>Esta página debe tener como página superior la página principal del plugin.</li>
				<li>Esta página debe tener el siguiente slug: <strong>admin</strong></li>
			</ul>
		</li>
	</ul>
</div>

