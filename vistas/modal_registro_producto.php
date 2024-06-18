<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Registro de productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- formulario de registro de productos -->
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                                <input type="text" class="form-control" name="producto">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Categoria</label>
                                <input type="text" class="form-control" name="categoria">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Proveedor</label>
                                <input type="text" class="form-control" name="proveedor">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Precio de adquisición</label>
                                <input type="number" class="form-control" name="precio_adq">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Precio de venta</label>
                                <input type="number" class="form-control" name="precio_venta">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fecha de ingreso</label>
                                <input type="date" class="form-control" name="fecha_ingreso">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fecha de caducidad</label>
                                <input type="date" class="form-control" name="fecha_caducidad">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Codigo de barra</label>
                                <input type="number" class="form-control" name="codigo_barra">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" name="boton_registro" value="ok"
                            id="boton_registro">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>