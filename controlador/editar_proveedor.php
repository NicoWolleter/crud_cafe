<?php
// Verificar si se ha recibido el id_proveedor
if (isset($_GET['id'])) {
    // Incluir el archivo de conexión a la base de datos
    include "modelo/conexion.php";

    // Obtener el id_proveedor de la URL
    $id_proveedor = $_GET['id'];

    // Obtener los datos del proveedor de la base de datos
    $sql = $conexion->query("SELECT * FROM proveedores WHERE id_proveedor = $id_proveedor");
    $datos = $sql->fetch_object();

    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['boton_editar']) && $_POST['boton_editar'] === "ok") {
        // Obtener los datos del formulario
        $nombre_proveedor = $_POST['nombre_proveedor'];
        $contacto_proveedor = $_POST['contacto_proveedor'];
        $info_facturacion = $_POST['info_facturacion'];
        $info_envio = $_POST['info_envio'];
        $categoria_proveedor = $_POST['categoria_proveedor'];
        $fecha_registro = $_POST['fecha_registro'];
        $estado_proveedor = $_POST['estado_proveedor'];

        // Actualizar los datos en la base de datos
        $sql_update = $conexion->prepare("UPDATE proveedores SET nombre_proveedor=?, contacto_proveedor=?, info_facturacion=?, info_envio=?, categoria_proveedor=?, fecha_registro=?, estado_proveedor=? WHERE id_proveedor=?");
        $sql_update->bind_param("sssssssi", $nombre_proveedor, $contacto_proveedor, $info_facturacion, $info_envio, $categoria_proveedor, $fecha_registro, $estado_proveedor, $id_proveedor);

        if ($sql_update->execute()) {
            echo "<p class='text-success'>Los datos se han actualizado correctamente.</p>";
            header("Location: proveedores.php");
        } else {
            echo "<p class='text-danger'>Error al actualizar los datos.</p>";
        }
    }
}
?>