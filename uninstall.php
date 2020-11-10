<?php
//Instrucciones para desintalar el plugin Banco de Proyectos

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}
// Borrar tabla wp_proyectos
global $wpdb;
$table_name = $wpdb->prefix . 'project';

$wpdb->query( $wpdb->prepare( "DROP TABLE IF EXISTS $table_name" ) );

?>