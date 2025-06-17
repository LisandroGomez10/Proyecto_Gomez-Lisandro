<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>

<div class="container mt-4">
    <h2>Alta de Producto</h2>

    <?php helper(['form']); ?>

    <?php 
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

    <form action="<?= site_url('producto/guardar') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nombre_prod" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_prod" name="nombre_prod" value="<?= old('nombre_prod') ?>">
            <?php if (!empty($errors['nombre_prod'])): ?>
                <div class="text-danger small"> <?= esc($errors['nombre_prod']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio de Costo</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= old('precio') ?>">
            <?php if (!empty($errors['precio'])): ?>
                <div class="text-danger small"> <?= esc($errors['precio']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="precio_vta" class="form-label">Precio de Venta</label>
            <input type="number" step="0.01" class="form-control" id="precio_vta" name="precio_vta" value="<?= old('precio_vta') ?>">
            <?php if (!empty($errors['precio_vta'])): ?>
                <div class="text-danger small"> <?= esc($errors['precio_vta']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?= old('stock') ?>">
            <?php if (!empty($errors['stock'])): ?>
                <div class="text-danger small"> <?= esc($errors['stock']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="stock_min" class="form-label">Stock Mínimo</label>
            <input type="number" class="form-control" id="stock_min" name="stock_min" value="<?= old('stock_min') ?>">
            <?php if (!empty($errors['stock_min'])): ?>
                <div class="text-danger small"> <?= esc($errors['stock_min']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <?php if (!empty($errors['imagen'])): ?>
                <div class="text-danger small"> <?= esc($errors['imagen']); ?> </div>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría</label>
            <select class="form-control" id="categoria_id" name="categoria_id">
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>" <?= old('categoria_id') == $cat['id_categoria'] ? 'selected' : '' ?>>
                        <?= esc($cat['descripcion']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['categoria_id'])): ?>
                <div class="text-danger small"> <?= esc($errors['categoria_id']); ?> </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= site_url('tabla_productos') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?= $this->endSection() ?>
