<?php

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Leer los datos del cuerpo de la solicitud
    $datos = file_get_contents('php://input');

    // Los datos enviados con fetch son una cadena JSON, así que necesitamos decodificarlos
    $datos = json_decode($datos, true);

    // Ahora puedes usar los datos
    var_dump($datos);

    echo 'Venta registrada exitosamente';
}

?>