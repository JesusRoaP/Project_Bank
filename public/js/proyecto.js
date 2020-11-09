jQuery(document).ready(function() {

    var textP = jQuery(".color-3").text();

    if (textP === "FINALIZADO") {
        jQuery(".color-3").css({"background-color": "#D5F5E3"});
    } else if (textP === "EN EJECUCIÓN") {
        jQuery(".color-3").css({"background-color": "#FCF3CF"});
        jQuery(".informe_final").css({"display": "none"});
        jQuery(".cumplimiento").css({"display": "none"});
    } else if (textP === "NO APROBADO") {
        jQuery(".color-3").css({"background-color": "#FADBD8"});
        jQuery(".informe_final").css({"display": "none"});
        jQuery(".cumplimiento").css({"display": "none"});
    } else if (textP === "CANCELADO") {
        jQuery(".color-3").css({"background-color": "#EFEBE9"});
        jQuery(".certificado").css({"display": "none"});
    }    

});

