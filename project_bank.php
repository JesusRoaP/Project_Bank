<?php
/*
Plugin Name: Project Bank
Plugin URI: https://github.com/JesusRoaP/project_bank
Description: Crea, muestra y administra la tabla wp_proyectos de la base de datos de wordpress.
Author: Jesus Mauricio Roa Polania
Version: 1.1
Author URI: https://github.com/JesusRoaP
*/

defined('ABSPATH') or die("Acceso Denegado");

define('BP_RUTA',plugin_dir_path(__FILE__));

define('BP_URL', WP_PLUGIN_URL . '/project_bank');

define('BP_NOMBRE','Project Bank');

define('BP_TABLE','project');

include(BP_RUTA . 'includes/functions.php');

include(BP_RUTA . 'includes/options.php');

function bp_activar() {

    /****************** Creación tabla wp_proyectos *****************/
  
    global $wpdb;
    
    $table_name = $wpdb->prefix . BP_TABLE;
   
    $sql = "CREATE TABLE $table_name (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `codigo` varchar(50) NOT NULL,
        `proyecto` varchar(255) NOT NULL,
        `autor` varchar(255) NOT NULL,
        `estado` varchar(50) NOT NULL,
        `resumen` varchar(255) NOT NULL,
        `concepto` varchar(255) NOT NULL,
        `informe_final` varchar(255) NOT NULL,
        `certi_cumplimiento` varchar(255) NOT NULL,
        `area` varchar(50) NOT NULL,
        `modalidad` varchar(50) NOT NULL,
        PRIMARY KEY id (id)
    ) CHARACTER SET=utf8 COLLATE=utf8_spanish_ci;";

    // Revisión de existencia de la tabla
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    // Creación de la tabla
    dbDelta($sql);

}
register_activation_hook(__FILE__,'bp_activar');

function bp_desactivar() {

// Instrucciones para desactivar el plugin banco de proyectos

}
register_deactivation_hook(__FILE__,'bp_desactivar');