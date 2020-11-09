jQuery(document).ready(function() {

    // Asignacion de las variables de estado del proyecto
    var finalizado =  jQuery(".color-3:contains('FINALIZADO')");
    var cancelado =  jQuery(".color-3:contains('CANCELADO')");
    var noAprobado =  jQuery(".color-3:contains('NO APROBADO')");
    var enEjecucion =  jQuery(".color-3:contains('EN EJECUCIÓN')");

    if (finalizado) {
        finalizado.css({'background-color': '#D5F5E3'});
    } 
    if (cancelado) {
        cancelado.css({'background-color': '#EFEBE9'});
        cancelado.closest('.resumen').find('.certificado').css({'display': 'none'});
    }
    if (noAprobado) {
        noAprobado.css({'background-color': '#FADBD8'});
        noAprobado.closest('.resumen').find('.certificado .informe_final').css({'display': 'none'});
        noAprobado.closest('.resumen').find('.certificado .cumplimiento').css({'display': 'none'});
    }
    if (enEjecucion) {
        enEjecucion.css({'background-color': '#FCF3CF'});
        enEjecucion.closest('.resumen').find('.certificado .informe_final').css({'display': 'none'});
        enEjecucion.closest('.resumen').find('.certificado .cumplimiento').css({'display': 'none'});
    }

    // Creacion del slide 'Ver más'
    jQuery("#tabla_dt .resumen").hide();
    
    jQuery('#tabla_dt .ver_mas').click(function () {
        jQuery(this).prev().slideToggle('slow');
        jQuery(this).toggleClass('ocultar');
  
        if (jQuery(this).hasClass('ocultar')) {
          jQuery(this).text('Ver menos');
        }
        else {
          jQuery(this).text('Ver más');
        }
    });

	// Configuraciones DataTables

    jQuery('#tabla_dt').DataTable({
        searchPanes:{
            layout: 'columns-1',
            dataLength: 20,
            cascadePanes: true,
            viewTotal: true, // Problema: ralentiza la busqueda en tiempo real
            controls: false,
        },
        dom: '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P><"dtsp-dataTable"frtip>>',
        pageLength: 20,
        language: {
            searchPanes: {
                title: 'Filtros Activos: %d',
                clearMessage: 'autorenew',
            }   
        },
        columnDefs:[
            {
                searchPanes: {
                    header: 'Modalidad'
                },
                targets: [2]
            },
            {
                searchPanes: {
                    header: 'Área'
                },
                targets: [3]
            },
            {
                searchPanes: {
                    header: 'Estado'
                },
                targets: [4]
            }
        ]
    });
    
    // Agrega el boton filtros en modo responsivo
    jQuery("#tabla_dt_wrapper").prepend('<button id="filtrar" type="button">Filtros <span class="material-icons">filter_alt</span></button><div class="oscuro_filtros"></div>');
    // Agrega el fondo oscuro de los filtros en modo responsivo    
    jQuery('#filtrar').click(function() {
        jQuery('body').addClass('filtros_active');
    })  
    jQuery('.oscuro_filtros').click(function() {
        jQuery('body').removeClass('filtros_active');
    })
    
    // Cuenta el numero de proyectos y lo coloca arriba de la seccion de filtros
    var table = jQuery('#tabla_dt').DataTable();
    var totalProyectos = "Total de Proyectos: "+table.data().length;
    jQuery('.dtsp-verticalPanes').prepend('<div id="total-proyectos" style="text-align: center"></div>');
    jQuery('#total-proyectos').html(totalProyectos);
    
    jQuery('.dtsp-clearAll').addClass('material-icons');

});

// Animación de carga de la página Banco de Proyectos
jQuery(window).load(function() {
    jQuery("#contenedor_carga").fadeOut(2000);

    setTimeout(function() { jQuery('body').removeClass('over-hidden'); }, 2000);
});
