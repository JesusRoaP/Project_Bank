<?php
require_once('vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$id = (int) $_POST['id'];
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

// New

if (!empty($_POST['save']) && $_POST['save'] == 'Save') {
	$r = $wpdb->query($wpdb->prepare( "INSERT INTO $table_name (`codigo`, `proyecto`, `autor`, `estado`, `resumen`, `concepto`, `informe_final`, `certi_cumplimiento`, `area`, `modalidad`) VALUES ('$codigo','$proyecto','$autor','$estado','$resumen','$concepto','$informe_final','$certi_cumplimiento','$area','$modalidad')"));

	if ($r) {
		$type = "success";
        $message = "Proyecto agregado exitosamente";
	} else {
		$type = "error";
        $message = "Problemas al agregar el proyecto";
	}
} 

// Update

if (!empty($_POST['update']) && $_POST['update'] == 'Update') {
	$r = $wpdb->query($wpdb->prepare("UPDATE $table_name SET `codigo`='$codigo',`proyecto`='$proyecto',`autor`='$autor',`estado`='$estado',`resumen`='$resumen',`concepto`='$concepto',`informe_final`='$informe_final',`certi_cumplimiento`='$certi_cumplimiento',`area`='$area',`modalidad`='$modalidad' WHERE id LIKE '$id'"));

	if ($r) {
		$type = "success";
        $message = "Proyecto actualizado exitosamente";
	} else {
		$type = "error";
        $message = "Problemas al actualizar el proyecto";
	}
}

// Delete

if (!empty($_POST['delete']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
	$r = $wpdb->query($wpdb->prepare( "DELETE FROM $table_name WHERE id LIKE '$id'"));

	if ($r) {
		$type = "success";
        $message = "Proyecto eliminado exitosamente";
	} else {
		$type = "error";
        $message = "Problemas al eliminar el proyecto";
	}
}

// Importación Masiva

if (isset($_POST["massive-import"])) {
       
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

            $sql = $wpdb->query($wpdb->prepare( "SELECT * FROM $table_name WHERE codigo LIKE '$codigo'"));

            if ($sql == 0) {
                $codigo = $wpdb->_real_escape($worksheet->getCell('A' . $row)->getValue());
                $proyecto = $wpdb->_real_escape($worksheet->getCell('B' . $row)->getValue());
                $autor = $wpdb->_real_escape($worksheet->getCell('C' . $row)->getValue());
                $estado = $wpdb->_real_escape($worksheet->getCell('D' . $row)->getValue());
                $resumen = $wpdb->_real_escape($worksheet->getCell('E' . $row)->getValue());
                $concepto = $wpdb->_real_escape($worksheet->getCell('F' . $row)->getValue());
                $informe_final = $wpdb->_real_escape($worksheet->getCell('G' . $row)->getValue());
                $certi_cumplimiento = $wpdb->_real_escape($worksheet->getCell('H' . $row)->getValue());
                $area = $wpdb->_real_escape($worksheet->getCell('I' . $row)->getValue()); 
                $modalidad = $wpdb->_real_escape($worksheet->getCell('J' . $row)->getValue());

                $r = $wpdb->query($wpdb->prepare( "INSERT INTO $table_name (`codigo`, `proyecto`, `autor`, `estado`, `resumen`, `concepto`, `informe_final`, `certi_cumplimiento`, `area`, `modalidad`) VALUES ('$codigo','$proyecto','$autor','$estado','$resumen','$concepto','$informe_final','$certi_cumplimiento','$area','$modalidad')"));
                
                if ($r) {
                    $type = "success";
                    $message = "Proyectos importados exitosamente";
                } 
            } else {
                $type = "error";
                $message = "Problemas al importar los Proyectos:<br><br> Todos los proyectos de su archivo ya estan cargados en la base de datos. Para actualizar los datos de proyectos existentes diríjase a <a href='#update'><strong>Actualización Masiva</strong></a>.";
            }
        }

    } else { 
    $type = "error";
    $message = "Tipo de archivo invalido. Cargar archivo en formato Excel (.xlsx)";
    }
}

// Actualización Masiva

if (isset($_POST["massive-update"])) {
       
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
