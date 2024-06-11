<?php
// Leemos la variable de entorno PHP
$environment = getenv('php');
if ($environment == 'produccion') {
    $url = 'http://146.83.194.142:1515';
} else {
    $url = 'http://localhost';
}

$conexion = new mysqli("localhost", "pma", "", "test");
?>