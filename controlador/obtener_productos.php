<?php
// obtener_productos.php

require_once '../modelo/conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtenemos los productos
    $productos = obtenerProductos();
    // Devolvemos los productos en formato JSON
    echo json_encode($productos);
}
function obtenerProductos()
{
    try {
        global $conexion;
        $sql = "SELECT * FROM productos";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
        $productos = $resultado->get_result()->fetch_all(MYSQLI_ASSOC);
        // Imprimimos los productos en consola
        // echo "<script>console.log('Productos: " . json_encode($productos) . "');</script>";
        // Cerramos la conexión
        return $productos;
    } catch (Exception $e) {
        // Imprimimos el error en consola
        // echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
        return [];
    }
}
?>