<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-5">
    <h2>Detalle de la Venta</h2>
    <?php if (isset($venta) && $venta): ?>
        <div class="mb-4">
            <strong>ID Venta:</strong> <?= esc($venta['id']) ?><br>
            <strong>Cliente:</strong> <?= esc($venta['cliente']) ?><br>
            <strong>Fecha:</strong> <?= esc($venta['fecha']) ?>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td>
                                <?php if (!empty($detalle['imagen_producto'])): ?>
                                    <img src="<?= base_url('assets/uploads/' . esc($detalle['imagen_producto'])) ?>" alt="Imagen" class="img-thumbnail" style="max-width: 80px;">
                                <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($detalle['producto_nombre']) ?></td>
                            <td><?= esc($detalle['cantidad']) ?></td>
                            <td>$<?= number_format($detalle['precio'], 2) ?></td>
                            <td>$<?= number_format($detalle['cantidad'] * $detalle['precio'], 2) ?></td>
                        </tr>
                        <?php $total += $detalle['cantidad'] * $detalle['precio']; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total:</th>
                        <th>$<?= number_format($total, 2) ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No se encontró la venta.</div>
    <?php endif; ?>
    <a href="<?= site_url('ventas') ?>" class="btn btn-secondary mt-3">Volver al listado de ventas</a>
</div>
<?= $this->endSection() ?>
