<?= $this->extend('layouts/template') ?>

<?= $this->section('contenido') ?>

<div class="container my-5">
    <div class="text-center">
        <h1 class="mb-4">¡Gracias por tu Compra!</h1>
        <p>Hemos recibido tu pedido y se está procesando.</p>

        <?php if (!empty($detalle_venta) && is_array($detalle_venta)): ?>
            <h2 class="mb-4">Resumen de tu Compra:</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mx-auto" style="max-width: 700px;">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($detalle_venta as $item): ?>
                            <tr>
                                <td><?= esc($item['nombre_prod']) ?></td>
                                <td>$<?= number_format($item['precio'], 2, ',', '.') ?></td>
                                <td><?= esc($item['cantidad']) ?></td>
                                <td>$<?= number_format($item['precio'] * $item['cantidad'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>$<?= number_format($total_venta, 2, ',', '.') ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php else: ?>
            <p>No se encontró el detalle de la venta.</p>
        <?php endif; ?>

        <p><a href="<?= site_url('productos') ?>" class="btn btn-primary mt-4">Seguir comprando</a></p>
    </div>
</div>

<?= $this->endSection() ?>
