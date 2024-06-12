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

    <h1 class="text-center p-3">INVENTARIO DE CAFETERIA</h1>
    <div class="container-fluid">
        <div class="row">
            <!-- tabla de visualizacion de productos -->
            <div class="col-md-12">
                <button type="button" class="btn btn-primary position-relative top-50 start-50 translate-middle"
                    id="agregarProducto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Agregar producto
                </button>
            </div>
            <div class="col">
                <table class="table" id="tablaProductos" pageLength=5> <!-- Añade el ID "tablaProductos" a la tabla -->
                    <thead>
                        <tr class="bg-info">
                            <th scope="col">Id</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Precio de adquisición</th>
                            <th scope="col">Precio de venta</th>
                            <th scope="col">Fecha de adquisición</th>
                            <th scope="col">Fecha de caducidad</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Codigo de barra</th>
                            <th scope="col">Productos vendidos</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <buttonbutton></button>
            </div>
        </div>

    </div>
    <?php
    include "../vistas/modal_registro_producto.php";
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- Agrega jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Agrega DataTables -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        const url = '<?php echo $url ?>';
        const base_path = '<?php echo $base_path ?>';
        console.log(url);
        console.log(base_path);

        $(document).ready(function () {
            const tabla = $('#tablaProductos').DataTable({
                "pagingType": "simple_numbers", // Muestra solo los números de paginación
                "pageLength": 5 // Establece la cantidad máxima de elementos por página
            });
            // Obtenemos los productos
            fetch([url, base_path, 'controlador/obtener_productos.php'].join('/'),
                {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            )
                .then(response => {
                    console.log(response);
                    return response.json();
                })
                .then(data => {
                    // Imprimimos los productos en consola
                    console.log(data);
                    let transformedData = data.map(producto => {
                        return [
                            producto.id_producto,
                            producto.producto,
                            producto.proveedor,
                            producto.precio_adq,
                            producto.precio_venta,
                            producto.fecha_ingreso,
                            producto.fecha_caducidad,
                            producto.categoria,
                            producto.cantidad,
                            producto.codigo_barra,
                            producto.productos_vendidos,
                            `<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="console.log(${producto.id_producto})">
                                    <i class="fas fa-trash-alt"></i>
                            </button>`
                        ];
                    });
                    tabla.data().clear();
                    tabla.rows.add(transformedData);
                    tabla.columns.adjust().draw();
                })
                .catch(error => console.error(error));
            // Inicializa la tabla con DataTables

            let select = $("#tablaProductos_length").find("select")
            select.prepend('<option value="5">5</option>');
            let label = $("#tablaProductos_length").find("label")
            label.text("Mostrar: ")
            label.append(select)
            label.append(" elementos")

            // Agrega el modal de registro de productos, cargamos desde el php
            $("#agregarProducto").click(function () {
                $("#container").load("../vistas/modal.php");
            });
            // Agrega los elementos de la tabla a la tabla de registro

        });
    </script>
</body>

</html>