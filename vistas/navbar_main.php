<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/crud_cafe/main.php">Inicio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'rutas/productos.php'; ?>">Gestión de
                        Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'rutas/proveedores.php'; ?>">Gestión de
                        Proovedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'rutas/ventas.php ' ?>">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo 'rutas/registros.php ' ?>">Ventas
                        registradas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Estadísticas</a>
                </li>
            </ul>
        </div>
        <form class="d-flex">
            <button class="btn btn-outline-light logout-button" type="submit" formaction="logout.php">Cerrar
                Sesión</button>
        </form>
    </div>
</nav>