<?php
global $wpdb;
$table_name = $wpdb->prefix . BP_TABLE;
$codigo = get_query_var('codigo');

$row = $wpdb->get_results( "SELECT * FROM $table_name WHERE codigo LIKE '$codigo'" );

foreach($row as $rows) {
    echo
        "<div id='proyecto-individual'>
        <h3 class='proyecto'>"."$rows->proyecto"."</h3>
        <div class='row'>

            <div class='col-sm-4'>
                <div class='id'><strong>Código: </strong>"."$rows->codigo"."</div>
                <div class='autores'><strong>Autores: </strong>"."$rows->autor"."</div>
                <div class='area'><strong>Área: </strong><p>"."$rows->area"."</p></div>
                <hr>
                <div class='estado'><strong>Estado: </strong><p class='color-3'>"."$rows->estado"."</p></div>
                <hr>
                <ul class='certificado vc_row wpb_row vc_row-fluid row '>
                    <li class='concepto'>                        
                        <a href='"."$rows->concepto"."' title='Concepto Comité de Ética' target='_blank'> Concepto Comité de Ética</a>
                    </li>
                    <li class='informe_final'>                          
                        <a href='"."$rows->informe_final"."' title='Informe Final' target='_blank'> Informe Final</a>
                    </li>
                    <li class='cumplimiento'>                          
                        <a href='"."$rows->certi_cumplimiento"."' title='Certificado Cumplimiento' target='_blank'> Certificado de Cumplimiento</a>
                    </li>
                </ul>
            </div>

            <div class='col-sm-8'>
                <hr>
                <div class='resumen'><strong>Resumen: </strong>"."$rows->resumen"."</div>
            </div>
        </div>
        </div>";
}
?>