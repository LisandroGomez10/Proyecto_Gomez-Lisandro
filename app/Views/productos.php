<?= $this->extend('layouts/template') ?>

<?= $this->section('contenido') ?>

<h1 class="mb-4 text-center">Catálogo de Productos</h1>

<!-- Apartado de categorías -->
<div class="mb-4 d-flex justify-content-center">
    <form method="get" action="<?= site_url('productos') ?>" class="d-flex align-items-center gap-2">
        <label for="categoria_id" class="me-2 fw-bold">Filtrar por categoría:</label>
        <select name="categoria_id" id="categoria_id" class="form-select" style="width: 200px;">
            <option value="">Todas</option>
            <?php if (!empty($categorias)): ?>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= esc($cat['id_categoria']) ?>" <?= isset($categoria_id) && $categoria_id == $cat['id_categoria'] ? 'selected' : '' ?>>
                        <?= esc($cat['descripcion']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <button type="submit" class="btn btn-outline-primary ms-2">Filtrar</button>
    </form>
</div>

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
                        <!-- Mostrar nombre de la categoría -->
                        <?php if (!empty($producto['nombre_cat'])): ?>
                            <span class="badge bg-info mb-2">Categoría: <?= esc($producto['nombre_cat']) ?></span>
                        <?php endif; ?>
                        <p class="card-text">Precio: $<?= number_format($producto['precio_vta'], 2, ',', '.') ?></p>
                        <?php if ($producto['stock'] <= 0): ?>
                            <span class="btn btn-secondary w-100 disabled">Sin stock</span>
                        <?php elseif (session()->has('id_usuario')): ?>
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
