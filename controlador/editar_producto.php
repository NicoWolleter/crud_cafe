<?php
// Verificar si se ha recibido el id_producto
if (isset($_GET['id'])) {
    // Incluir el archivo de conexión a la base de datos
    include "modelo/conexion.php";

    // Obtener el id_producto de la URL
    $id_producto = $_GET['id'];

    // Obtener los datos del producto de la base de datos
    $sql = $conexion->query("SELECT * FROM productos WHERE id_producto = $id_producto");
    $datos = $sql->fetch_object();

    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['boton_editar']) && $_POST['boton_editar'] === "ok") {
        // Obtener los datos del formulario
        $producto = $_POST['producto'];
        $proveedor = $_POST['proveedor'];
        $precio_adq = $_POST['precio_adq'];
        $precio_venta = $_POST['precio_venta'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $fecha_caducidad = $_POST['fecha_caducidad'];
        $categoria = $_POST['categoria'];
        $cantidad = $_POST['cantidad'];
        $codigo_barra = $_POST['codigo_barra'];

        // Actualizar los datos en la base de datos
        $sql_update = $conexion->prepare("UPDATE productos SET producto=?, proveedor=?, precio_adq=?, precio_venta=?, fecha_ingreso=?, fecha_caducidad=?, categoria=?, cantidad=?, codigo_barra=? WHERE id_producto=?");
        $sql_update->bind_param("ssddssssii", $producto, $proveedor, $precio_adq, $precio_venta, $fecha_ingreso, $fecha_caducidad, $categoria, $cantidad, $codigo_barra, $id_producto);

        if ($sql_update->execute()) {
            echo "<p class='text-success'>Los datos se han actualizado correctamente.</p>";
            header("Location: gestion_inventario.php");
        } else {
            echo "<p class='text-danger'>Error al actualizar los datos.</p>";
        }
    }
}
?>