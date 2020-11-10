<?php
header('Content-type: application/json; charset=utf-8');

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-load.php'); 

$id = $_POST['id'];
$table_name = $wpdb->prefix . BP_TABLE;

global $wpdb;

$codigo = $wpdb->_real_escape($_POST['codigo']);
$proyecto = $wpdb->_real_escape($_POST['proyecto']);
$autor =  $wpdb->_real_escape($_POST['autor']);
$resumen = $wpdb->_real_escape($_POST['resumen']);
$estado = $wpdb->_real_escape($_POST['estado']);
$concepto = $wpdb->_real_escape($_POST['concepto']);
$informe_final = $wpdb->_real_escape($_POST['informe_final']);
$certi_cumplimiento = $wpdb->_real_escape($_POST['certi_cumplimiento']);
$area = $wpdb->_real_escape($_POST['area']);
$modalidad = $wpdb->_real_escape($_POST['modalidad']);


if ($id == 0) { // Nuevo
	$r = $wpdb->query($wpdb->prepare( "INSERT INTO $table_name (`codigo`, `proyecto`, `autor`, `estado`, `resumen`, `concepto`, `informe_final`, `certi_cumplimiento`, `area`, `modalidad`) VALUES ('$codigo','$proyecto','$autor','$estado','$resumen','$concepto','$informe_final','$certi_cumplimiento','$area','$modalidad')"));

	if($r){
		$arr = ['resultado' => true, 'mensaje' => 'Proyecto añadido', 'id' => $r['insert_id'] ];
	}else{
		$arr = ['resultado' => false, 'mensaje' => 'Error al añadir el Proyecto'];
	}
} else { // Update
	$r = $wpdb->query($wpdb->prepare("UPDATE $table_name SET `codigo`='$codigo',`proyecto`='$proyecto',`autor`='$autor',`estado`='$estado',`resumen`='$resumen',`concepto`='$concepto',`informe_final`='$informe_final',`certi_cumplimiento`='$certi_cumplimiento',`area`='$area',`modalidad`='$modalidad' WHERE id LIKE '$id'"));

	if($r){
		$arr = ['resultado' => true, 'mensaje' => 'Proyecto actualizado' ];
	}else{
		$arr = ['resultado' => false, 'mensaje' => 'Error al actualizar el Proyecto'];
	}
}
die(json_encode($arr));
