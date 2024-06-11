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
    include "vistas/navbar.php";
    ?>

    <h1 class="text-center p-3">INVENTARIO DE CAFETERIA</h1>
    <div class="container-fluid">
        <div class="row">
            <!-- tabla de visualizacion de productos -->
            <div class="col position-relative">
                <button type="button" class="btn btn-primary position-relative top-50 start-50 translate-middle"
                    id="agregarProducto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Agregar producto
                </button>
            </div>
            <div class="col">
                <table class="table" id="tablaProductos" pageLength=5> <!-- Añade el ID "tablaProductos" a la tabla -->
                    <thead>
                        <tr class="bg-info">
                            <th scope="col">id_producto</th>
                            <th scope="col">producto</th>
                            <th scope="col">proveedor</th>
                            <th scope="col">precio de adquisición</th>
                            <th scope="col">precio de venta</th>
                            <th scope="col">fecha de adquisición</th>
                            <th scope="col">fecha de caducidad</th>
                            <th scope="col">categoria</th>
                            <th scope="col">cantidad</th>
                            <th scope="col">codigo_barra</th>
                            <th scope="col">productos vendidos</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "controlador/registro_productos.php";
                        $sql = $conexion->query("SELECT * FROM productos");
                        while ($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <td><?= $datos->id_producto ?></td>
                                <td><?= $datos->producto ?></td>
                                <td><?= $datos->proveedor ?></td>
                                <td><?= $datos->precio_adq ?></td>
                                <td><?= $datos->precio_venta ?></td>
                                <td><?= $datos->fecha_ingreso ?></td>
                                <td><?= $datos->fecha_caducidad ?></td>
                                <td><?= $datos->categoria ?></td>
                                <td><?= $datos->cantidad ?></td>
                                <td><?= $datos->codigo_barra ?></td>
                                <td><?= $datos->productos_vendidos ?></td>
                                <td>
                                    <a href="editar_productos.php?id=<?= $datos->id_producto ?>"
                                        class="btn btn-small btn-warning"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="eliminar_productos.php?id=<?= $datos->id_producto ?>"
                                        class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php
    include "vistas/modal_registro_producto.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Agrega jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Agrega DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializa la tabla con DataTables
            $('#tablaProductos').DataTable({
                "pagingType": "simple_numbers", // Muestra solo los números de paginación
                "pageLength": 5 // Establece la cantidad máxima de elementos por página
            });
            // Añade la opcion de 5 elementos por página
            $("#tablaProductos_length").find("select").prepend('<option value="5">5</option>');
            // Agrega el modal de registro de productos, cargamos desde el php
            $("#agregarProducto").click(function () {
                $("#container").load("vistas/modal.php");
            });
        });
    </script>
</body>

</html>