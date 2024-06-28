<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php include "../vistas/navbar.php"; ?>

    <div class="container-fluid">
        <div class="row gap-4 p-4">
            <div class="col-4 gap-4">
                <div class="row mb-4"
                    style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3>Venta</h3>
                    <div class="mb-3">
                        <label for="select_productos" class="form-label">Producto</label>
                        <select class="form-select" name="select_productos" id="select_productos">
                            <!-- Opciones de productos se agregarán dinámicamente con JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" value="1">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" id="agregar_producto">Agregar Producto</button>
                        <button type="button" class="btn btn-success" id="registrar_venta" disabled>Registrar Venta</button>
                    </div>
                </div>

                <div class="row"
                    style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                    <h3>Resumen</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">Productos: <span id="resumen">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">Cargos: <span id="cargos">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">Descuentos: <span id="descuentos">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">Subtotal: <span id="subtotal">0</span></li>
                        <li class="list-group-item d-flex justify-content-between">IVA(%): <span id="iva">19</span></li>
                        <li class="list-group-item d-flex justify-content-between"><strong>Total a pagar:</strong> <strong><span id="total_pagar">0</span></strong></li>
                    </ul>
                </div>
            </div>

            <div class="col"
                style="background-color: white; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

                <h3>Detalle</h3>

                <label for="tabla_productos" class="form-label">Tabla de Productos</label>
                <table class="table">
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
                        <!-- Tabla de productos se llenará dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select = document.getElementById('select_productos');
            const cantidadInput = document.getElementById('cantidad');
            const agregarProductoBtn = document.getElementById('agregar_producto');
            const listaProductos = document.getElementById('tabla_productos');
            const resumen = {};

            // Obtener los productos del servidor
            fetch('../controlador/obtener_productos.php')
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
                .catch(error => {
                    console.error('Error:', error);
                });

            // Función para resumir y actualizar los datos mostrados
            function Resumir() {
                const productos = Array.from(listaProductos.children);
                const total = productos.map(tr => parseFloat(tr.children[4].textContent)).reduce((acc, val) => acc + val, 0);
                const iva = parseInt(document.getElementById('iva').textContent);
                const subtotal = total;
                const total_pagar = subtotal + (subtotal * iva / 100);

                document.getElementById('resumen').textContent = productos.length;
                document.getElementById('cargos').textContent = total.toFixed(2);
                document.getElementById('descuentos').textContent = '0'; // No implementado
                document.getElementById('subtotal').textContent = subtotal.toFixed(2);
                document.getElementById('total_pagar').textContent = total_pagar.toFixed(2);
                document.getElementById('registrar_venta').disabled = productos.length === 0;
            }

            // Agregar evento al botón "Agregar Producto"
            agregarProductoBtn.addEventListener('click', function () {
                const productoId = select.value;
                const cantidad = parseInt(cantidadInput.value);

                if (!productoId || cantidad <= 0) {
                    alert('Seleccione un producto y asegúrese de que la cantidad sea mayor a cero.');
                    return;
                }

                fetch('obtener_precio.php?codigo_barra=' + encodeURIComponent(productoId))
                    .then(response => response.text())
                    .then(precio => {
                        if (precio !== '0') {
                            const producto = {
                                id_producto: productoId,
                                producto: select.options[select.selectedIndex].textContent,
                                precio_venta: parseFloat(precio)
                            };

                            if (producto.id_producto in resumen) {
                                resumen[producto.id_producto].cantidad += cantidad;
                                resumen[producto.id_producto].subtotal = resumen[producto.id_producto].cantidad * producto.precio_venta;

                                const row = Array.from(listaProductos.children).find(tr => tr.dataset.id === producto.id_producto);
                                row.children[2].textContent = resumen[producto.id_producto].cantidad;
                                row.children[4].textContent = resumen[producto.id_producto].subtotal.toFixed(2);
                            } else {
                                resumen[producto.id_producto] = {
                                    cantidad: cantidad,
                                    producto: producto.producto,
                                    precio_venta: producto.precio_venta,
                                    subtotal: cantidad * producto.precio_venta
                                };

                                const newRow = document.createElement('tr');
                                newRow.dataset.id = producto.id_producto;
                                newRow.innerHTML = `
                                    <td>${producto.id_producto}</td>
                                    <td>${producto.producto}</td>
                                    <td>${cantidad}</td>
                                    <td>${producto.precio_venta.toFixed(2)}</td>
                                    <td>${(cantidad * producto.precio_venta).toFixed(2)}</td>
                                    <td><button class="btn btn-danger">Eliminar</button></td>
                                `;

                                newRow.querySelector('button').addEventListener('click', function () {
                                    newRow.remove();
                                    delete resumen[producto.id_producto];
                                    Resumir();
                                });

                                listaProductos.appendChild(newRow);
                            }

                            Resumir();
                        } else {
                            alert('No se pudo obtener el precio del producto.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al obtener el precio del producto.');
                    });
            });

            // Agregar evento al botón "Registrar Venta"
            document.getElementById('registrar_venta').addEventListener('click', function () {
                fetch('../controlador/registrar_venta.php', {
                    method: 'POST',
                    body: JSON.stringify(resumen),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data); // Manejar respuesta del servidor (opcional)
                        alert('Venta registrada con éxito.');
                        // Puedes añadir más acciones aquí después de registrar la venta
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al registrar la venta.');
                    });
            });
        });
    </script>
</body>
</html>
