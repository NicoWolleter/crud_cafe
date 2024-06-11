<?
include "modelo/conexion.php";
// Obtener el id_proveedor de la URL
$id_proveedor = $_GET['id'];
// Obtener los datos del proveedor de la base de datos
$sql = $conexion->query("SELECT * FROM proveedores WHERE id_proveedor = $id_proveedor");
$datos = $sql->fetch_object();
?>