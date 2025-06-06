<?= $this->extend('layouts/template') ?>

<?= $this->section('contenido') ?>

<h1 class="mb-4 text-center">Catálogo de Productos</h1>


<?php if (!empty($productos) && is_array($productos)): ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="card h-100">
                    <?php if (!empty($producto['imagen'])): ?>
                        <img src="<?= base_url('assets/uploads/' . esc($producto['imagen'])) ?>" class="card-img-top card h-100" alt="<?= esc($producto['nombre_prod']) ?>">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= esc($producto['nombre_prod']) ?></h5>
                        <p class="card-text">Precio: $<?= number_format($producto['precio_vta'], 2, ',', '.') ?></p>

                        <?php if (session()->has('id_usuario')): ?>
                            <form action="<?= site_url('carrito/agregar') ?>" method="post" class="mt-auto">
                                <input type="hidden" name="id_producto" value="<?= esc($producto['id_producto']) ?>">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="precio_vta" value="<?= esc($producto['precio_vta']) ?>">
                                <input type="hidden" name="nombre_prod" value="<?= esc($producto['nombre_prod']) ?>">
                                <button type="submit" class="btn btn-primary w-100">Agregar al Carrito</button>
                            </form>
                        <?php else: ?>
                            <a href="<?= site_url('login') ?>" class="btn btn-warning mt-auto w-100">Debes iniciar sesión</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No hay productos disponibles en este momento.</p>
<?php endif; ?>
<?= $this->endSection() ?>
