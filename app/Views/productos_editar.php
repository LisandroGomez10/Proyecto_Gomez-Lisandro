<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <h2>Editar Producto</h2>

    <?php helper(['form']); ?>

    <?php 
        // Mostrar errores de validación si existen
        $errors = session('errors');
        if (isset($validation)) {
            $errors = $validation->getErrors();
        }
    ?>
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?= esc($error) ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('productos/actualizar/' . ($producto['id'] ?? $producto['id_producto'] ?? '')) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre_prod" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_prod" name="nombre_prod"
                   value="<?= old('nombre_prod', esc($producto['nombre_prod'])) ?>">
            <?php if (!empty($errors['nombre_prod'])): ?>
                <div class="text-danger small"> <?= esc($errors['nombre_prod']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio de Costo</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio"
                   value="<?= old('precio', isset($producto['precio']) ? esc($producto['precio']) : '') ?>">
            <?php if (!empty($errors['precio'])): ?>
                <div class="text-danger small"> <?= esc($errors['precio']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="precio_vta" class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" class="form-control" id="precio_vta" name="precio_vta"
                   value="<?= old('precio_vta', esc($producto['precio_vta'])) ?>">
            <?php if (!empty($errors['precio_vta'])): ?>
                <div class="text-danger small"> <?= esc($errors['precio_vta']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock"
                   value="<?= old('stock', esc($producto['stock'])) ?>">
            <?php if (!empty($errors['stock'])): ?>
                <div class="text-danger small"> <?= esc($errors['stock']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="stock_min" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stock_min" name="stock_min"
                   value="<?= old('stock_min', esc($producto['stock_min'])) ?>">
            <?php if (!empty($errors['stock_min'])): ?>
                <div class="text-danger small"> <?= esc($errors['stock_min']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen (opcional)</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <?php if (!empty($producto['imagen'])): ?>
                <img src="<?= base_url('assets/uploads/' . esc($producto['imagen'])) ?>" 
                     alt="Imagen actual" class="img-thumbnail mt-2" style="max-width: 150px;">
            <?php endif; ?>
            <?php if (!empty($errors['imagen'])): ?>
                <div class="text-danger small"> <?= esc($errors['imagen']); ?> </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= site_url('productos/tabla') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
