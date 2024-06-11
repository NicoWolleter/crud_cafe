<?php
// Verificar si se ha recibido el id_proveedor
if (isset($_GET['id'])) {
    // Incluir el archivo de conexión a la base de datos
    include "modelo/conexion.php";

    // Obtener el id_proveedor de la URL
    $id_proveedor = $_GET['id'];

    // Verificar si se ha enviado el formulario de eliminación
    if (isset($_POST['boton_eliminar']) && $_POST['boton_eliminar'] === "ok") {
        // Eliminar el registro de la base de datos
        $sql_delete = $conexion->prepare("DELETE FROM proveedores WHERE id_proveedor = ?");
        $sql_delete->bind_param("i", $id_proveedor);

        if ($sql_delete->execute()) {
            // Redirigir al usuario a proveedores.php después de eliminar el proveedor
            header("Location: proveedores.php?mensaje=Proveedor+eliminado");
            exit(); // Es importante salir del script después de redirigir
        } else {
            echo "<p class='text-danger'>Error al eliminar el proveedor.</p>";
        }
    }
} else {
    echo "<p class='text-danger'>No se ha proporcionado un ID de proveedor válido.</p>";
}
?>