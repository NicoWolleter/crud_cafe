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
</head>

<body>
    <!-- Barra de navegación -->
    <?php include "../vistas/navbar.php"; ?>

    <h1 class="text-center p-3">INVENTARIO DE CAFETERIA</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <button type="button" class="btn btn-primary position-relative top-50 start-50 translate-middle" id="agregarProducto" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Agregar producto
                </button>
            </div>
            <div class="col">
                <table class="table" id="tablaProductos">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col">Id</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Precio de adquisición</th>
                            <th scope="col">Precio de venta</th>
                            <th scope="col">Fecha de adquisición</th>
                            <th scope="col">Fecha de caducidad</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Código de barra</th>
                            <th scope="col">Productos vendidos</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Datos serán llenados dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de registro de productos -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formRegistroProducto">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Registrar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="producto" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="producto" name="producto" required>
                        </div>
                        <div class="mb-3">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="proveedor" name="proveedor" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_adq" class="form-label">Precio de adquisición</label>
                            <input type="number" step="0.01" class="form-control" id="precio_adq" name="precio_adq" required>
                        </div>
                        <div class="mb-3">
                            <label for="precio_venta" class="form-label">Precio de venta</label>
                            <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de adquisición</label>
                            <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_caducidad" class="form-label">Fecha de caducidad</label>
                            <input type="date" class="form-control" id="fecha_caducidad" name="fecha_caducidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <input type="text" class="form-control" id="categoria" name="categoria" required>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="codigo_barra" class="form-label">Código de barra</label>
                            <input type="text" class="form-control" id="codigo_barra" name="codigo_barra" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="boton_registro">Registrar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            const url = 'tu_url_aqui';
            const base_path = 'tu_base_path_aqui';
            
            // Inicializar DataTable
            const tabla = $('#tablaProductos').DataTable({
                "pagingType": "simple_numbers",
                "pageLength": 5
            });

            // Obtener y cargar productos en la tabla
            fetch([url, base_path, 'controlador/obtener_productos.php'].join('/'), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let transformedData = data.map(producto => [
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
                    <button type="button" class="btn btn-danger" onclick="eliminarProducto(${producto.id_producto})">
                        <i class="fas fa-trash-alt"></i>
                    </button>`
                ]);
                tabla.clear().rows.add(transformedData).draw();
            })
            .catch(error => console.error('Error al cargar productos:', error));

            // Enviar formulario de registro de producto
            $("#formRegistroProducto").on("submit", async function(e) {
                e.preventDefault();
                try {
                    let response = await fetch([url, base_path, 'controlador/registro_productos.php'].join('/'), {
                        method: 'POST',
                        body: new FormData(this)
                    });
                    let data = await response.text();
                    console.log(data);
                    // Actualizar la tabla de productos después del registro
                    // Aquí puedes agregar lógica para recargar la tabla
                    alert("Producto registrado exitosamente");
                } catch (error) {
                    console.error('Error al registrar producto:', error);
                    alert("Error al registrar producto");
                }
            });
        });

        // Función para eliminar producto
        function eliminarProducto(idProducto) {
            if (confirm('¿Está seguro de que desea eliminar este producto?')) {
                const url = 'tu_url_aqui';
                const base_path = 'tu_base_path_aqui';
                
                fetch([url, base_path, 'controlador/eliminar_producto.php'].join('/'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id_producto: idProducto })
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                    alert("Producto eliminado exitosamente");
                    // Aquí puedes agregar lógica para recargar la tabla
                })
                .catch(error => console.error('Error al eliminar producto:', error));
            }
        }
    </script>
</body>

</html>
