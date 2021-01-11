<?php
global $wpdb;
$table_name = $wpdb->prefix . BP_TABLE;

$row = $wpdb->get_results( "SELECT * FROM $table_name" );

echo
"<div id='contenedor_carga'>
    <div id='carga'></div>
</div>
<table id='tabla_dt' class='display'>
    <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>PROYECTO</th>
            <th>MODALIDAD</th>
            <th>AREA</th>
            <th>ESTADO</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>";

foreach($row as $rows) {

    echo
    "<tr>
        <td>"."$rows->codigo"."</td>
        <td class='proyecto'>
            <div class='nombre-proyecto'><a href='proyecto/codigo/"."$rows->codigo"."/' target='_blank'>"."$rows->proyecto"."</a></div>
            <div class='autores'><strong>Autores: </strong>"."$rows->autor"."</div>
            <div class='estado-responsive'><span class='color-3'>"."$rows->estado"."</span></div>
            <div class='ver_mas'><a href='proyecto/codigo/"."$rows->codigo"."/' target='_blank'>Ver más</a></div>
        </td>
        <td class='modalidad-oculto'>"."$rows->modalidad"."</td>
        <td class='area-oculto'>"."$rows->area"."</td>
        <td class='estado-oculto'>"."$rows->estado"."</td>
        <td class='estado'><div class='color-3'>"."$rows->estado"."</div></td>
    </tr>";

}

echo
    "</tbody>
</table>";
?>