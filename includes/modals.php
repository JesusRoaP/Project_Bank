<?php
if (!empty($_POST['edit']) && $_POST['edit'] == 'Edit') {
  $result = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id LIKE '$id'"));
?>

<div id='formularioProyecto'>
  <div class='modalFormProyecto'>
    
    <form id="formProyecto" method="post" class="form">
      <div class="pb-modal-header">
        Editar Proyecto
        <button type="button" class="button hideForm glyphicon glyphicon-remove" href="#"></button>
      </div>
      <div class="pb-modal-body">
        <input type="hidden" name="id" value="<?= $id ?>" />
        <?php
        foreach($result as $row) {
        ?>
        <label>
          Código
          <input type="text" name="codigo" value="<?php if(isset($row)) echo $row->codigo ?>" required />
        </label>
        <label>
          Proyecto
          <textarea name="proyecto" required><?php if(isset($row)) echo $row->proyecto ?></textarea>
        </label>
        <label>
          Autores
          <textarea name="autor"><?php if(isset($row)) echo $row->autor ?></textarea>
        </label>
        <label>
          Resumen
          <textarea name="resumen"><?php if(isset($row)) echo $row->resumen ?></textarea>
        </label>
        <label>
          Estado
          <select name="estado"><option value="<?php if(isset($row)) echo $row->estado ?>" selected=""><?php if(isset($row)) echo $row->estado ?></option><option value="FINALIZADO">FINALIZADO</option><option value="EN EJECUCIÓN" >EN EJECUCIÓN</option><option value="NO APROBADO">NO APROBADO</option><option value="CANCELADO">CANCELADO</option></select>
        </label>
        <label>
          Concepto Ético
          <textarea name="concepto"><?php if(isset($row)) echo $row->concepto ?></textarea>
        </label>
        <label>
          Informe Final
          <textarea name="informe_final"><?php if(isset($row)) echo $row->informe_final ?></textarea>
        </label>
        <label>
          Certificado de Cumplimiento
          <textarea name="certi_cumplimiento"><?php if(isset($row)) echo $row->certi_cumplimiento ?></textarea>
        </label>
        <label>
          Área
          <select name="area"><option value="<?php if(isset($row)) echo $row->area ?>" selected=""><?php if(isset($row)) echo $row->area ?></option><option value="ADM. EMPRESAS">ADM. EMPRESAS</option><option value="DERECHO">DERECHO</option><option value="ENFERMERÍA">ENFERMERÍA</option><option value="GESTIÓN SALUD">GESTIÓN SALUD</option><option value="INGE. AMBIENTAL">INGE. AMBIENTAL</option><option value="INGE. INDUSTRIAL">INGE. INDUSTRIAL</option><option value="MEDICINA">MEDICINA</option><option value="RADIOLOGÍA">RADIOLOGÍA</option><option value="TRANSVERSAL">TRANSVERSAL</option></select>
        </label>
        <label>
          Modalidad
          <select name="modalidad"><option value="<?php if(isset($row)) echo $row->modalidad ?>" selected=""><?php if(isset($row)) echo $row->modalidad ?></option><option value="GRUPOS INV.">GRUPOS INV.</option><option value="SEMILLEROS INV.">SEMILLEROS INV.</option><option value="MIN. EDUCACIÓN">MIN. EDUCACIÓN</option><option value="MOD. DE GRADO">MOD. DE GRADO</option></select>
        </label>
        <?php
        }
        ?>
      </div>
      <div class="pb-modal-footer">
        <button class="button pb-button-right" type="submit" name="update" value="Update">Actualizar</button>
      </div>
      <br class="pb-clear">
    </form>

  </div>
</div>

<script>
	jQuery(document).ready(function () {
        jQuery('#formularioProyecto').fadeIn(500);
        jQuery("body").css({
        	"overflow": "hidden"
		});
	});
</script>

<?php
}
?>

<div id='formularioProyecto_new' style="display: none">
  <div class='modalFormProyecto'>
    
    <form id="formProyecto" method="post" class="form">
      <div class="pb-modal-header">
        Agregar Proyecto
        <button type="button" class="button hideForm glyphicon glyphicon-remove" href="#"></button>
      </div>
      <div class="pb-modal-body">
        <input type="hidden" name="id" value="" />
        <label>
          Código
          <input type="text" name="codigo" value="" required />
        </label>
        <label>
          Proyecto
          <textarea name="proyecto" required></textarea>
        </label>
        <label>
          Autores
          <textarea name="autor"></textarea>
        </label>
        <label>
          Resumen
          <textarea name="resumen"></textarea>
        </label>
        <label>
          Estado
          <select name="estado"><option value="" selected=""></option><option value="FINALIZADO">FINALIZADO</option><option value="EN EJECUCIÓN" >EN EJECUCIÓN</option><option value="NO APROBADO">NO APROBADO</option><option value="CANCELADO">CANCELADO</option></select>
        </label>
        <label>
          Concepto Ético
          <textarea name="concepto"></textarea>
        </label>
        <label>
          Informe Final
          <textarea name="informe_final"></textarea>
        </label>
        <label>
          Certificado de Cumplimiento
          <textarea name="certi_cumplimiento"></textarea>
        </label>
        <label>
          Área
          <select name="area"><option value="" selected=""></option><option value="ADM. EMPRESAS">ADM. EMPRESAS</option><option value="DERECHO">DERECHO</option><option value="ENFERMERÍA">ENFERMERÍA</option><option value="GESTIÓN SALUD">GESTIÓN SALUD</option><option value="INGE. AMBIENTAL">INGE. AMBIENTAL</option><option value="INGE. INDUSTRIAL">INGE. INDUSTRIAL</option><option value="MEDICINA">MEDICINA</option><option value="RADIOLOGÍA">RADIOLOGÍA</option><option value="TRANSVERSAL">TRANSVERSAL</option></select>
        </label>
        <label>
          Modalidad
          <select name="modalidad"><option value="" selected=""></option><option value="GRUPOS INV.">GRUPOS INV.</option><option value="SEMILLEROS INV.">SEMILLEROS INV.</option><option value="MIN. EDUCACIÓN">MIN. EDUCACIÓN</option><option value="MOD. DE GRADO">MOD. DE GRADO</option></select>
        </label>
      </div>
      <div class="pb-modal-footer">
        <button class="button pb-button-right" type="submit" name="save" value="Save">Guardar</button>
      </div>
      <br class="pb-clear">
    </form>

  </div>
</div>

<script>
	jQuery("body").on("click", ".showForm", function () {
        jQuery("#formularioProyecto_new").fadeIn(500);
        jQuery("body").css({
           "overflow": "hidden"
        });
        return false;
	});
</script>