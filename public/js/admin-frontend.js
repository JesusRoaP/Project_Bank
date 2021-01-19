// Creación de la tabla con DataTable
jQuery(document).ready(function() {
  jQuery('#tabla_dt').DataTable();
});

// Cambia el color de los botones Importacion y Actualizacion Masiva si se carga un archivo
jQuery('input[type=file]').change(function() {
  var idname = jQuery(this).attr('id');

  jQuery('#'+idname).closest('form').find('button').css({'background-color': '#35de69', 'color': 'white', 'border-color': '#269e4b'});
});

jQuery("body").on("click", ".hideForm", function () {
  jQuery("#formularioProyecto_new, #formularioProyecto").fadeOut(500);
  jQuery("body").css({
     "overflow": "initial"
  });
});
  
