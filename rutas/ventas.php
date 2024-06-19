<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
    <!-- Agrega los estilos CSS del sistema -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



</head>
<?php
include "../vistas/navbar.php";
// include "../controlador/obtener_productos.php";
?>

<body>

    <div class="container-fluid">
        <!-- Select para mostrar los productos -->
        <div class="row gap-4 p-4">
            <div class="col-4 gap-4">
                <div class="row mb-4"
                    style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3>Venta</h3>
                    <!-- Your content here -->
                    <div class="mb-3">
                        <label for="select_productos" class="form-label">Producto</label>
                        <select class="form-select" name="select_productos" id="select_productos">
                            <!-- <?php
                            // Obtener los productos
                            $productos = obtenerProductos();
                            // Iterar sobre los productos y agregar opciones al select
                            foreach ($productos as $producto) {
                                echo "<option value='" . json_encode($producto) . "'>{$producto['producto']}</option>";
                            }
                            ?> -->
                        </select>
                    </div>
                    <!-- Divider -->
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="1">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type=" button" class="btn btn-primary" id="agregar_producto">Agregar
                            Producto</button>
                        <button type="button" class="btn btn-success" id="registrar_venta" disabled="true">Registrar
                            Venta</button>

                    </div>
                </div>

                <div class="row"
                    style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3>Resumen</h3>
                    <ui class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">Productos: <span
                                id="resumen">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">Cargos: <span id="cargos">0</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">Descuentos: <span
                                id="descuentos">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">Subtotal: <span
                                id="subtotal">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">IVA(%): <span id="iva">19</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Total a pagar:</strong>
                            <strong> <span id="total_pagar">0</span></strong>
                        </li>
                    </ui>
                </div>
            </div>
            <div class="col"
                style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                <h3>Detalle</h3>

                <label for="tabla_productos" class="form-label">Tabla de Productos</label>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Código de Barras</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_productos">
                        <!-- Tabla de productos -->
                    </tbody>
                </table>
            </div>
            <!-- Agrega los scripts de Bootstrap -->

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
                crossorigin="anonymous"></script>
            <script>
                const url = '<?php echo $url ?>';
                console.log(url);
                // Obtener los elementos del formulario
                const select = document.getElementById('select_productos');
                const cantidadInput = document.getElementById('cantidad');
                const agregarProductoBtn = document.getElementById('agregar_producto');
                const listaProductos = document.getElementById('tabla_productos');
                const productosInput = document.getElementById('productos_input');
                const resumen = {};
                const Resumir = () => {
                    const productos = Array.from(listaProductos.children)
                    const total = productos.map(tr => tr.children[4].textContent).reduce((acc, val) => acc + parseFloat(val), 0);
                    document.getElementById('resumen').textContent = productos.length;
                    document.getElementById('cargos').textContent = total;
                    document.getElementById('descuentos').textContent = 0;
                    document.getElementById('subtotal').textContent = total;
                    document.getElementById('total_pagar').textContent = total * parseInt(document.getElementById('iva').textContent) / 100 + total;
                    document.getElementById('registrar_venta').disabled = productos.length === 0;
                };
                // Obtenemos los productos del servidor
                fetch('localhost/crud_cafe/controlador/obtener_productos.php')
                    .then(response => response.json())
                    .then(data => {
                        // Iteramos sobre los productos y los agregamos al select
                        data.forEach(producto => {
                            const option = document.createElement('option');
                            option.value = producto.id_producto;
                            option.textContent = producto.producto;
                            select.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });

                // Agregar evento al botón "Agregar Producto"
                agregarProductoBtn.addEventListener('click', function () {

                    const producto = JSON.parse(select.value);
                    const cantidad = parseInt(cantidadInput.value);

                    if (producto && cantidad) {
                        // Crear un nuevo elemento de fila para la tabla
                        if (producto.codigo_barra in resumen) {
                            resumen[producto.codigo_barra] += cantidad;
                            const row = Array.from(listaProductos.children).find(tr => tr.children[0].textContent === producto.codigo_barra);
                            row.children[2].textContent = resumen[producto.codigo_barra];
                            row.children[4].textContent = resumen[producto.codigo_barra] * producto.precio_venta;
                            Resumir();
                            return;
                        } else {
                            resumen[producto.codigo_barra] = cantidad;

                            const newRow = document.createElement('tr');
                            newRow.id = producto.codigo_barra;
                            const row = [producto.codigo_barra, producto.producto, cantidad, producto.precio_venta, cantidad * producto.precio_venta];
                            row.forEach((element) => {
                                const cell = document.createElement('td');
                                cell.textContent = element;
                                newRow.appendChild(cell);
                            });
                            const deleteCell = document.createElement('td');
                            deleteCell.innerHTML = '<button class="btn btn-danger">Eliminar</button>';
                            newRow.appendChild(deleteCell);
                            deleteCell.addEventListener('click', function () {
                                newRow.remove();
                                delete resumen[producto.codigo_barra];
                                Resumir();
                            });
                            // Agregar la fila a la tabla
                            listaProductos.appendChild(newRow);
                            Resumir();
                        }
                    }
                });
                // Agregar evento al botón "Registrar Venta"
                document.getElementById('registrar_venta').addEventListener('click', function () {
                    // Envía una solicitud POST a procesar_venta.php.
                    fetch('../controlador/registrar_venta.php', {
                        method: 'POST',
                        body: JSON.stringify(resumen),
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                        .then(response => response.text())
                        .then(data => {
                            // Aquí puedes manejar la respuesta de la solicitud.
                            // Por ejemplo, podrías mostrar un mensaje de éxito.
                            console.log(data);
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                });
            </script>
</body>

</html>