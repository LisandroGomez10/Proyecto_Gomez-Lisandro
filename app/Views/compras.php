<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>

<div class="container my-5">
    <div class="text-center">
        <h1 class="mb-4">¡Gracias por tu Compra!</h1>
        <p>Hemos recibido tu pedido y se está procesando.</p>

        <?php if (!empty($detalle_venta) && is_array($detalle_venta)): ?>
            <h2 class="mb-4">Resumen de tu Compra Reciente:</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mx-auto" style="max-width: 700px;">
                    <thead class="table-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle_venta as $item): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($item['imagen_producto'])): ?>
                                        <img src="<?= base_url('assets/uploads/' . esc($item['imagen_producto'])) ?>" alt="Imagen" class="img-thumbnail" style="max-width: 80px;">
                                    <?php else: ?>
                                        <span class="text-muted">Sin imagen</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($item['nombre_producto']) ?></td>
                                <td>$<?= number_format($item['precio'], 2, ',', '.') ?></td>
                                <td><?= esc($item['cantidad']) ?></td>
                                <td>$<?= number_format($item['precio'] * $item['cantidad'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td><strong>$<?= number_format($total_venta, 2, ',', '.') ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>

        <hr>

        <h3>Historial de Compras Anteriores</h3>

        <?php if (!empty($ventas_anteriores)): ?>
            <ul class="list-group mx-auto" style="max-width: 500px;">
                <?php foreach ($ventas_anteriores as $venta): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Fecha: <?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?>
                        <span>Total: $<?= number_format($venta['total_venta'], 2, ',', '.') ?></span>
                        <a href="<?= site_url('carrito/detalle-compra/'.$venta['id']) ?>" class="btn btn-sm btn-outline-primary">Ver Detalle</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay compras anteriores.</p>
        <?php endif; ?>
        <p><a href="<?= site_url('productos') ?>" class="btn btn-primary mt-4">Seguir comprando</a></p>
    </div>
</div>

<?= $this->endSection() ?>
