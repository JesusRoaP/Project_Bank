<?php
header('Content-type: application/json; charset=utf-8');

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-load.php'); 

$id = $_GET['id'];
$table_name = $wpdb->prefix . BP_TABLE;

global $wpdb;

$result = $wpdb->query($wpdb->prepare( "DELETE FROM $table_name WHERE id LIKE '$id'"));

if ($result) {
	$arr = ['resultado' => true, 'mensaje' => 'Elemento eliminado' ];
} else {
	$arr = ['resultado' => false, 'mensaje' => $r['error']];
}
die(json_encode($arr));
?>
