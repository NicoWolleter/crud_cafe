<?php
// obtener_productos.php

require_once '../modelo/conexion.php';
function obtenerProductos()
{
    try {
        $conexion = getConnection();
        $sql = "SELECT * FROM productos";
        $statement = $conexion->prepare($sql);
        $statement->execute();
        $productos = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $productos;
    } catch (Exception $e) {
        echo "<script>console.log('Error: " . $e->getMessage() . "');</script>";
        return [];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtenemos los productos
    $productos = obtenerProductos();
    // Devolvemos los productos en formato JSON
    echo json_encode($productos);
}
?>