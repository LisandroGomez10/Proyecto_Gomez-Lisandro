<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>

<div class="container my-5">
    <h1>Historial de Compras</h1>

    <?php if (!empty($ventas)): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($venta['fecha'])) ?></td>
                        <td>$<?= number_format($venta['total_venta'], 2, ',', '.') ?></td>
                        <td>
                            <a href="<?= site_url('carrito/detalle-compra/'.$venta['id']) ?>" class="btn btn-primary btn-sm">Detalles</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No tenés compras registradas.</p>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>
