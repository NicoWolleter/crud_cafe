<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Registro de proveedores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <!-- formulario de registro de proveedores -->
                    <form method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Nombre del proveedor</label>
                            <input type="text" class="form-control" name="nombre_proveedor">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contacto</label>
                            <input type="text" class="form-control" name="contacto_proveedor">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Información de facturación</label>
                            <input type="text" class="form-control" name="info_facturacion">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Información de envío</label>
                            <input type="text" class="form-control" name="info_envio">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Categoria de proveedor</label>
                            <input type="text" class="form-control" name="categoria_proveedor">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Fecha de registro</label>
                            <input type="date" class="form-control" name="fecha_registro">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Estado de proveedor</label>
                            <input type="text" class="form-control" name="estado_proveedor">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="boton_registro" value="ok">Ingresar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>