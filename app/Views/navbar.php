<?php 
$session = session();
$nombre = $session->get('nombre');
$perfil = $session->get('perfil_id');

$carrito = $session->get('carrito') ?? [];
$totalCantidad = 0;
foreach ($carrito as $item) {
    $totalCantidad += $item['cantidad'];
}
?>

<nav class="navbar navbar-expand-lg navbar-custom">

  <button class="navbar-toggler dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Open dropdown menu">
    <span class="navbar-toggler-icon"></span>
  </button>

  <?php if($perfil == 1): ?>

    <div class="btn-info active btn-sm"> 
      <a href="#"><?= esc($nombre) ?> (ADMIN)</a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="<?= base_url('index') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('usuarios/lista') ?>">CRUD Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('productos/tabla') ?>">CRUD Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('ventas') ?>">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('consultas') ?>">Consultas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('logout') ?>">Cerrar Sesión</a>
        </li>
      </ul>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="<?= base_url('index') ?>">Inicio</a>
      <a class="dropdown-item" href="<?= base_url('usuarios/lista') ?>">CRUD Usuarios</a>
      <a class="dropdown-item" href="<?= base_url('productos/tabla') ?>">CRUD Productos</a>
      <a class="dropdown-item" href="<?= base_url('ventas') ?>">Ventas</a>
      <a class="dropdown-item" href="<?= base_url('consultas') ?>">Consultas</a>
      <a class="dropdown-item" href="<?= base_url('logout') ?>">Cerrar Sesión</a>
    </div>

  <?php elseif($perfil == 2): ?>

    <div class="btn-info active btn-sm"> 
      <a href="#"><?= esc($nombre) ?> (CLIENTE)</a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="<?= base_url('index') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('carrito/ver') ?>">
              Carrito 🛒
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('compras') ?>">Mis Compras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('perfil') ?>">Mi Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('logout') ?>">Cerrar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-link" href="<?= base_url('terminosdeuso') ?>">Términos de Uso</a>
        </li>
      </ul>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="<?= base_url('index') ?>">Inicio</a>
      <a class="dropdown-item" href="<?= base_url('productos') ?>">Productos</a>
      <a class="dropdown-item" href="<?= base_url('comercializacion') ?>">Comercialización</a>
      <a class="dropdown-item" href="<?= base_url('carrito/ver') ?>">Carrito</a>
      <a class="dropdown-item" href="<?= base_url('compras') ?>">Mis Compras</a>
      <a class="dropdown-item" href="<?= base_url('perfil') ?>">Mi Perfil</a>
      <a class="dropdown-item" href="<?= base_url('logout') ?>">Cerrar Sesión</a>
      <a class="dropdown-item" href="<?= base_url('terminosdeuso') ?>">Términos de Uso</a>
    </div>

  <?php else: ?>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="<?= base_url('index') ?>">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('productos') ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('comercializacion') ?>">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('login') ?>">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-link" href="<?= base_url('terminosdeuso') ?>">Términos de Uso</a>
        </li>
      </ul>
    </div>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="<?= base_url('index') ?>">Inicio</a>
      <a class="dropdown-item" href="<?= base_url('productos') ?>">Productos</a>
      <a class="dropdown-item" href="<?= base_url('comercializacion') ?>">Comercialización</a>
      <a class="dropdown-item" href="<?= base_url('login') ?>">Ingreso</a>
      <a class="dropdown-item" href="<?= base_url('terminosdeuso') ?>">Términos de Uso</a>
    </div>

  <?php endif; ?>

</nav>
