<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-load.php'); 

require_once('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

global $wpdb;

$table_name = $wpdb->prefix . BP_TABLE;

if (isset($_POST["update"])) {
       
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
     
    if(in_array($_FILES["file"]["type"],$allowedFileType)){
   
        $nombre = $_FILES['file']['name'];
        $guardado = $_FILES['file']['tmp_name'];
        $targetPath = 'uploads/'.$nombre;
       
        if(!file_exists('uploads')) {
            mkdir('uploads',0777,true);
            move_uploaded_file($guardado, $targetPath);
        } else {
            move_uploaded_file($guardado, $targetPath);
        }
   
        $reader = new Xlsx();
        $spreadsheet = $reader->load($targetPath);
           
        $worksheet = $spreadsheet->getActiveSheet();
   
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumn++;
   
        for($row = 2; $row <= $highestRow; ++$row) {
   
            $codigo = $worksheet->getCell('A' . $row)->getValue();

            $sql = $wpdb->query($wpdb->prepare("SELECT * FROM $table_name WHERE codigo LIKE '$codigo'"));      
   
            if ($sql > 0) {
                $proyecto = $wpdb->_real_escape($worksheet->getCell('B' . $row)->getValue());
                $autor = $wpdb->_real_escape($worksheet->getCell('C' . $row)->getValue());
                $estado = $wpdb->_real_escape($worksheet->getCell('D' . $row)->getValue());
                $resumen = $wpdb->_real_escape($worksheet->getCell('E' . $row)->getValue());
                $concepto = $wpdb->_real_escape($worksheet->getCell('F' . $row)->getValue());
                $informe_final = $wpdb->_real_escape($worksheet->getCell('G' . $row)->getValue());
                $certi_cumplimiento = $wpdb->_real_escape($worksheet->getCell('H' . $row)->getValue());
                $area = $wpdb->_real_escape($worksheet->getCell('I' . $row)->getValue()); 
                $modalidad = $wpdb->_real_escape($worksheet->getCell('J' . $row)->getValue());
   
                $r = $wpdb->query($wpdb->prepare("UPDATE $table_name SET `proyecto`='$proyecto',`autor`='$autor',`estado`='$estado',`resumen`='$resumen',`concepto`='$concepto',`informe_final`='$informe_final',`certi_cumplimiento`='$certi_cumplimiento',`area`='$area',`modalidad`='$modalidad' WHERE codigo LIKE '$codigo'"));
   
                if ($r) {
                    $type = "success";
                    $message = "Proyectos actualizados exitosamente";
                } 
            } else {
                $type = "error";
                $message = "Problemas al actualizar los Proyectos:<br><br>Uno o más proyectos pueden no estar cargados en la base de datos, si es así carguelos en la sección <a href='#import'><strong>Importación Masiva</strong></a>. Sin embargo, si cargo conjuntamente proyectos ya existentes, estos se actualizaron exitosamente.";
            }
        }
   
    } else { 
       $type = "error";
       $message = "Tipo de archivo invalido. Cargar archivo en formato Excel (.xlsx)";
    }
}

?>