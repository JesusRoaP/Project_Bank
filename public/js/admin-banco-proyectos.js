// Creación de la tabla con DataTable
jQuery(document).ready(function() {
  jQuery('#tabla_dt').DataTable();
});

// Cambia el color de los botones Importacion y Actualizacion Masiva si se carga un archivo
jQuery('input[type=file]').change(function() {
  var idname = jQuery(this).attr('id');

  jQuery('#'+idname).closest('form').find('button').css({'background-color': '#35de69', 'color': 'white', 'border-color': '#269e4b'});
});
  
// Mediante AJAX recupera el formulario Editar Proyecto
function mostrarFormProyecto(id) {
  jQuery.ajax({
    method: "get",
    url: proyecto_newedit.ajaxurl,
    data: {
			id: id
    },
    success: function(resultado) {
      jQuery(".modalFormProyecto").html(resultado);		
    }
  });

  jQuery(".bg, .modalFormProyecto").show();
}
  
// Mostrar formulario Editar Proyecto - Creacion de Proyecto Nuevo
jQuery(".showForm").click(function(event){
  event.preventDefault();
  mostrarFormProyecto(0);
});
  
// Cerrar formulario Editar Proyecto
jQuery(".modalFormProyecto").on("click", ".hideForm", function(event) {
  event.preventDefault();
  jQuery(".bg, .modalFormProyecto").hide();
});
jQuery(".bg").click(function() {
  jQuery(".bg, .modalFormProyecto").hide();
});
  
// Grabar datos del formulario Editar Proyecto
jQuery(document).on("submit","#formProyecto", function(event) {
  event.preventDefault();
  
  jQuery.ajax({
    method: "post",
    url: proyecto_save.ajaxurl,
    data: jQuery( this ).serialize()
  })
  .done(function( data ) {
    if(data.resultado){
      jQuery(".bg, .modalFormProyecto").hide();
      location.reload();
    }

    alert(data.mensaje);
  });
});
  
// Mostrar formulario Editar Proyecto - Actualizar Proyecto Existente
jQuery(".lista-proyectos").on("click", ".edit", function(event) {
  event.preventDefault();
  var proyecto_id = jQuery(this).attr('data-id');

  mostrarFormProyecto(proyecto_id);
});
  
// Eliminar Proyecto
jQuery(".lista-proyectos").on("click", ".delete", function(event) {
  event.preventDefault();
  var delete_proyecto = confirm("¿Está seguro de eliminar el proyecto?");

  if ( delete_proyecto ) {

    var proyecto_id = jQuery(this).attr('data-id');

    jQuery.ajax({
      method: "get",
      url: proyecto_delete.ajaxurl,
      data: {
        id: proyecto_id
      },
    })
    .done(function( data ) {
      if(data.resultado) {
        location.reload();
      }
      
      alert(data.mensaje);
    });
  }
});