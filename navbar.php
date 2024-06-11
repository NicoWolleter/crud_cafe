<?php
// navbar.php

?>
<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="container-fluid">
       <a class="navbar-brand" href="main.php">Inicio</a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav">
               <li class="nav-item">
                   <a class="nav-link" href="crud_cafe/rutas/gestion_inventario.php">Gestión de Inventario</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="crud_cafe/rutas/proveedores.php">Gestión de Proveedores</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="crud_cafe/rutas/agregar_productos.php">Ventas</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="crud_cafe/rutas/ventas_registradas.php">Ventas registradas</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link" href="#">Estadísticas</a>
               </li>
           </ul>
       </div>
       <form class="d-flex">
           <button class="btn btn-outline-light logout-button" type="submit" formaction="logout.php">Cerrar Sesión</button>
       </form>
   </div>
</nav>