<?php

function bp_menu_administrador() {

    add_menu_page(BP_NOMBRE,BP_NOMBRE,'manage_options',BP_RUTA . '/admin/configuration.php');

}
add_action( 'admin_menu', 'bp_menu_administrador' );

?>