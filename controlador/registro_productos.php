<?php
include "../modelo/conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el formulario ha sido enviado y el botón de registro se ha presionado
    echo $_POST["producto"];

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

        // Realizar la inserción en la base de datos
        $sql = $conexion->prepare("INSERT INTO productos (producto, proveedor, precio_adq, precio_venta, fecha_ingreso, fecha_caducidad, categoria, cantidad,codigo_barra) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssddsssis", $producto, $proveedor, $precio_adq, $precio_venta, $fecha_ingreso, $fecha_caducidad, $categoria, $cantidad, $codigo_barra);
        $sql->execute();

        // Verificar si la inserción fue exitosa
        if ($sql->affected_rows > 0) {
            echo '<div class="alert alert-success">Producto registrado exitosamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error de registro</div>';
        }

        //header("Location: ".$_SERVER['PHP_SELF']);
        //exit();

    } else {
        echo '<div class="alert alert-warning">Se detectaron campos vacíos, favor rellenar para avanzar</div>';
    }
}
?>