<?php
include "../modelo/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificar si todos los campos están llenos
    if (
        !empty($_POST["producto"]) &&
        !empty($_POST["proveedor"]) &&
        !empty($_POST["precio_adq"]) &&
        !empty($_POST["precio_venta"]) &&
        !empty($_POST["fecha_ingreso"]) &&
        !empty($_POST["fecha_caducidad"]) &&
        !empty($_POST["categoria"]) &&
        !empty($_POST["cantidad"]) &&
        !empty($_POST["codigo_barra"])
    ) {
        // Recuperar los datos del formulario
        $producto = $_POST["producto"];
        $proveedor = $_POST["proveedor"];
        $precio_adq = $_POST["precio_adq"];
        $precio_venta = $_POST["precio_venta"];
        $fecha_ingreso = $_POST["fecha_ingreso"];
        $fecha_caducidad = $_POST["fecha_caducidad"];
        $categoria = $_POST["categoria"];
        $cantidad = $_POST["cantidad"];
        $codigo_barra = $_POST["codigo_barra"];

        try {
            // Preparar la consulta SQL
            $sql = $conexion->prepare("INSERT INTO productos (producto, proveedor, precio_adq, precio_venta, fecha_ingreso, fecha_caducidad, categoria, cantidad, codigo_barra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            if (!$sql) {
                throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
            }

            // Vincular parámetros
            $sql->bind_param("ssddsssis", $producto, $proveedor, $precio_adq, $precio_venta, $fecha_ingreso, $fecha_caducidad, $categoria, $cantidad, $codigo_barra);

            // Ejecutar la consulta
            if ($sql->execute()) {
                echo '<div class="alert alert-success">Producto registrado exitosamente</div>';
            } else {
                throw new Exception("Error en la ejecución de la consulta: " . $sql->error);
            }

            // Cerrar la consulta
            $sql->close();

        } catch (Exception $e) {
            // Capturar y mostrar errores
            echo '<div class="alert alert-danger">Se produjo un error: ' . $e->getMessage() . '</div>';
        }

    } else {
        echo '<div class="alert alert-warning">Se detectaron campos vacíos, favor rellenar para avanzar</div>';
    }
}
?>
