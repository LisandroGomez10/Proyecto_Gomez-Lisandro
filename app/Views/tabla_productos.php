<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container table-container">
    <!-- Fila solo para centrar el título -->
    <div class="row mt-4">
        <div class="col text-center">
            <h1>Lista de Productos</h1>
        </div>
    </div>
    <!-- Fila para los botones -->
    <div class="d-flex justify-content-end mb-2 flex-wrap gap-2">
        <a href="<?= base_url('productos/agregar') ?>" class="btn btn-success btn-agregar mb-2">Agregar</a>
        <a href="<?= base_url('productos/eliminados') ?>" class="btn btn-danger btn-agregar mb-2">Eliminados</a>
    </div>
    <div class="table-responsive">
        <table id="tablaProductos" class="table table-bordered table-hover align-middle">
            <thead class="thead-light">
                <tr>
                    <th>Id</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Precio Vta</th>
                    <th>Stock</th>
                    <th>Stock Minimo</th>
                    <th>Imagen</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= esc(isset($producto['id']) ? $producto['id'] : (isset($producto['id_producto']) ? $producto['id_producto'] : '')) ?></td>
                        <td><?= esc($producto['nombre_prod']) ?></td>
                        <td><?= number_format($producto['precio'], 2) ?></td>
                        <td><?= number_format($producto['precio_vta'], 2) ?></td>
                        <td><?= esc($producto['stock']) ?></td>
                        <td><?= esc($producto['stock_min']) ?></td>
                        <td>
                            <?php if (!empty($producto['imagen'])): ?>
                                <img src="<?= base_url('assets/uploads/' . $producto['imagen']) ?>" class="img-thumbnail mx-auto d-block" style="width: 80px; height: 80px; object-fit: cover;" alt="Producto">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('productos/editar/' . (isset($producto['id']) ? $producto['id'] : (isset($producto['id_producto']) ? $producto['id_producto'] : ''))) ?>" class="btn btn-primary btn-sm mb-1 w-100">Editar</a>
                            <a href="<?= base_url('productos/borrar/' . (isset($producto['id']) ? $producto['id'] : (isset($producto['id_producto']) ? $producto['id_producto'] : ''))) ?>" class="btn btn-secondary btn-sm w-100">Borrar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>