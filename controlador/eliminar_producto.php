<?php
// Verificar si se ha recibido el id_producto
if (isset($_GET['id'])) {
    // Incluir el archivo de conexión a la base de datos
    include "modelo/conexion.php";

    // Obtener el id_producto de la URL
    $id_producto = $_GET['id'];

    // Verificar si se ha enviado el formulario de eliminación
    if (isset($_POST['boton_eliminar']) && $_POST['boton_eliminar'] === "ok") {
        // Eliminar el registro de la base de datos
        $sql_delete = $conexion->prepare("DELETE FROM productos WHERE id_producto = ?");
        $sql_delete->bind_param("i", $id_producto);

        if ($sql_delete->execute()) {
            // Redirigir al usuario a gestion_inventario.php después de eliminar el producto
            header("Location: gestion_inventario.php?mensaje=Producto+eliminado");
            exit(); // Es importante salir del script después de redirigir
        } else {
            echo "<p class='text-danger'>Error al eliminar el producto.</p>";
        }
    }
} else {
    echo "<p class='text-danger'>No se ha proporcionado un ID de producto válido.</p>";
}
?>