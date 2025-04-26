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
      <a href="">ADMIN: <?php echo $nombre; ?> </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="productos">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="comercializacion">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="login">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="logout">Cerrar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-link" href="terminosdeuso">Términos de Uso</a>
        </li>
      </ul>
    </div>

    <!-- Desplegable del navbar para admin -->
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="productos">Productos</a>
      <a class="dropdown-item" href="comercializacion">Comercialización</a>
      <a class="dropdown-item" href="login">Ingreso</a>
      <a class="dropdown-item" href="logout">Cerrar Sesión</a>
      <a class="dropdown-item" href="terminosdeuso">Términos de Uso</a>
    </div>

  <?php elseif($perfil == 2): ?>

    <div class="btn-info active btn-sm"> 
      <a href="">CLIENTE: <?php echo $nombre; ?> </a>
    </div>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="productos">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="comercializacion">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="<?= base_url('carrito/ver') ?>">
            Carrito (<?= $totalCantidad ?>)
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="logout">Cerrar Sesión</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-link" href="terminosdeuso">Términos de Uso</a>
        </li>
      </ul>
    </div>

    <!-- Desplegable del navbar para cliente -->
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="productos">Productos</a>
      <a class="dropdown-item" href="comercializacion">Comercialización</a>
      <a class="dropdown-item" href="<?= base_url('carrito/ver') ?>">Carrito (<?= $totalCantidad ?>)</a>
      <a class="dropdown-item" href="logout">Cerrar Sesión</a>
      <a class="dropdown-item" href="terminosdeuso">Términos de Uso</a>
    </div>

  <?php else: ?>

    <!-- navbar para clientes no logueados --> 
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav nav-pills">
        <li class="nav-item active">
          <a class="nav-link me-3 custom-link" href="productos">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="comercializacion">Comercialización</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-3" href="login">Ingreso</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-link" href="terminosdeuso">Términos de Uso</a>
        </li>
      </ul>
    </div>

    <!-- Desplegable del navbar para clientes no logueados -->
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" href="productos">Productos</a>
      <a class="dropdown-item" href="comercializacion">Comercialización</a>
      <a class="dropdown-item" href="login">Ingreso</a>
      <a class="dropdown-item" href="terminosdeuso">Términos de Uso</a>
    </div>

  <?php endif; ?>

</nav>
