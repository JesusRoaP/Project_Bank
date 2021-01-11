<?php
if ( is_user_logged_in() ) {
    $current_user = wp_get_current_user();
    echo
    "<header id='header-admin'>¡Bienvenid@ " . $current_user->user_login . "! <a href='". wp_logout_url(get_permalink()) ."' class='log-out'>Cerrar Sesión</a></header>
    <hr>
    <div class='bg'></div>
    <div id='admin-banco-proyectos'>
    <div class='row'>
    <div class='col-sm-4'>
    <div id='response' class='"."$type"." "."display-block'>
        "."$message"."
    </div>
    <button type='button' class='button lateral showForm' href='#'>Nuevo proyecto</button><hr>
    <form action='' method='post' id='update' enctype='multipart/form-data'>
        <button type='submit' name='update' class='btn-update lateral'>Actualización Masiva</button>
        <label for='update-file' class='btn-sm btn-default glyphicon glyphicon-paperclip'></label>
        <input type='file' name='file' id='update-file' accept='.xls,.xlsx'>
        <span>Formato permitido (.xlsx)</span>
    </form>
    <hr>
    <form action='' method='post' id='import' enctype='multipart/form-data'>
        <button type='submit' name='import' class='btn-import lateral'>Importación Masiva</button>
        <label for='import-file' class='btn-sm btn-default glyphicon glyphicon-paperclip'></label>
        <input type='file' name='file' id='import-file' accept='.xls,.xlsx'>
        <span>Formato permitido (.xlsx)</span>
    </form>
    </div>
    <div class='col-sm-8'>
    <table id='tabla_dt' class='display'>
        <thead>
            <tr>
                <th>CÓDIGO</th>
                <th>PROYECTO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody class='lista-proyectos'>";
    
    $row = $wpdb->get_results( "SELECT * FROM $table_name" );

    foreach($row as $rows) {
        echo
        "<tr>
            <td>"."$rows->codigo"."</td>
            <td class='proyecto'>"."$rows->proyecto"."</td>
            <td>
                <div class='btn-toolbar'>
                    <div class='btn-group'>
                        <button type='button' class='edit btn btn-sm btn-default' data-id='"."$rows->id"."' href='#'>
                            <span class='glyphicon glyphicon-pencil'></span>
                        </button>
                        <button type='button' class='delete btn btn-sm btn-default' data-id='"."$rows->id"."' href='#'>
                            <span class='glyphicon glyphicon-trash'></span>
                        </button>
                    </div>
                </div>
            </td>
        </tr>";
    }

    echo
        "</tbody>
    </table>
    </div>
    </div>
    </div>
    <div id='formularioProyecto'><div class='modalFormProyecto'></div></div>";
} else {
    echo "<div class='login wp-core-ui'>
    <div id='login'>";
    wp_login_form();
    echo "</div></div>";
}
?>