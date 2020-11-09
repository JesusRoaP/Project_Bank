<?php
//Instrucciones para desintalar el plugin Banco de Proyectos

if (!defined('ABSPATH') && !defined('WP_UNINSTALL_PLUGIN')) {
    exit();
}
// Borrar tabla wp_proyectos
global $wpdb;
$table_name = $wpdb->prefix . 'proyectos';

$wpdb->query($wpdb->prepare( "DROP TABLE $table_name" ));

?>