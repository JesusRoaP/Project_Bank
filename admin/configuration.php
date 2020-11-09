<?php
if (! current_user_can ('manage_options')) wp_die (__ ('No tienes suficientes permisos para acceder a esta página.'));

?>

<div class="wrap">
	<h2><?php _e( 'Banco de Proyectos', 'banco de proyectos' ) ?></h2>
	Bienvenido a la configuración de Banco de Proyectos
</div>
<br>
<div>
	<ul>
		<li>Utiliza el siguiente shortcode para la página principal del Banco de Proyectos: <strong>[banco_proyectos]</strong></li>
		<li>Utiliza el siguiente shortcode para la página individual del proyecto: <strong>[proyecto]</strong>
			<ul>
				<li>Esta página debe tener como página superior el Banco de Proyectos.</li>
				<li>Esta página debe tener el siguiente slug: <strong>proyecto</strong></li>
			</ul>
		</li>
		<li>Utiliza el siguiente shortcode para la página de Administración del Banco de Proyectos: <strong>[admin_banco_proyectos]</strong>
			<ul>
				<li>Esta página debe tener como página superior el Banco de Proyectos.</li>
				<li>Esta página debe tener el siguiente slug: <strong>admin</strong></li>
			</ul>
		</li>
	</ul>
</div>

