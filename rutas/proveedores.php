<?php
// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include_once $_SERVER['DOCUMENT_ROOT'] . "/modelo/conexion.php";

    // Obtener los datos del formulario
    $nombre_proveedor = $_POST['nombre_proveedor'];
    $contacto_proveedor = $_POST['contacto_proveedor'];
    $info_facturacion = $_POST['info_facturacion'];
    $info_envio = $_POST['info_envio'];
    $categoria_proveedor = $_POST['categoria_proveedor'];
    $fecha_registro = $_POST['fecha_registro'];
    $estado_proveedor = $_POST['estado_proveedor'];

    // Insertar el proveedor en la base de datos
    $sql_insert = "INSERT INTO proveedores (nombre_proveedor, contacto_proveedor, info_facturacion, info_envio, categoria_proveedor, fecha_registro, estado_proveedor) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bind_param("sssssss", $nombre_proveedor, $contacto_proveedor, $info_facturacion, $info_envio, $categoria_proveedor, $fecha_registro, $estado_proveedor);

    if ($stmt_insert->execute()) {
        // Proveedor registrado exitosamente
        echo "<p class='text-success'>Proveedor registrado correctamente.</p>";
    } else {
        echo "<p class='text-danger'>Error al registrar el proveedor.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD CAFETERIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/52820557f8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <!--dataTables CSS-->
</head>

<body>
    <!-- Barra de navegación -->
    <?php
    include "../vistas/navbar.php";
    ?>
    <h1 class="text-center p-3">GESTION DE PROVEEDORES</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col position-relative">
                <button type="button" class="btn btn-primary position-relative top-50 start-50 translate-middle"
                    id="agregarProveedor" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Agregar proveedor
                </button>

            </div>
            <!-- tabla de visualizacion de productos -->
            <div class="col-md-12">
                <table id="tablaProveedores" class="table">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Contacto</th>
                            <th scope="col">Información de facturación</th>
                            <th scope="col">Información de envio</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Fecha de registro</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "../modelo/conexion.php";
                        $conexion = getConnection();
                        $sql = $conexion->query("SELECT * FROM proveedores");
                        while ($datos = $sql->fetch(PDO::FETCH_OBJ)) { ?>
                            <tr>
                                <td><?= $datos->id_proveedor ?></td>
                                <td><?= $datos->nombre_proveedor ?></td>
                                <td><?= $datos->contacto_proveedor ?></td>
                                <td><?= $datos->info_facturacion ?></td>
                                <td><?= $datos->info_envio ?></td>
                                <td><?= $datos->categoria_proveedor ?></td>
                                <td><?= $datos->fecha_registro ?></td>
                                <td><?= $datos->estado_proveedor ?></td>
                                <td class="d-flex flex-column align-items-end">
                                    <a href="editar_proveedor.php?id=<?= $datos->id_proveedor ?>"
                                        class="btn btn-small btn-warning" style="width:54px"><i
                                            class="fa-solid fa-user-pen"></i></a>
                                    <a href="eliminar_proveedor.php?id=<?= $datos->id_proveedor ?>"
                                        class="btn btn-small btn-danger" style="width:54px"><i
                                            class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    include "../vistas/modal_registro_proveedor.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> <!-- jQuery -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script> <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#tablaProveedores').DataTable({
                "pagingType": "simple_numbers", // Muestra solo los números de paginación
                "pageLength": 5 // Establece la cantidad máxima de elementos por página
            });
            let select = $("#tablaProveedores_length").find("select")
            select.prepend('<option value="5">5</option>');
            let label = $("#tablaProveedores_length").find("label")
            label.text("Mostrar: ")
            label.append(select)
            label.append(" elementos")
            $("#agregarProveedor").click(function () {
                $("#container").load("../vistas/modal.php");
            });
        });

    </script>
</body>

</html>