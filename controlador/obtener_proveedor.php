<?php
include "modelo/conexion.php";

// Obtener el id_producto de la URL
$id_producto = $_GET['id'];

// Obtener los datos del producto de la base de datos
$sql = $conexion->query("SELECT * FROM productos WHERE id_producto = $id_producto");
$datos = $sql->fetch_object();
?>