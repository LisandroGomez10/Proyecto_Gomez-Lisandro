<?= $this->extend('layouts/template') ?>

<?= $this->section('contenido') ?>

<div class="container text-center">
    <h1 class="mb-4">Carrito Compras</h1>

    <?php if (session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= esc(session('error')) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($cart->totalItems() > 0): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mx-auto align-middle" style="max-width: 900px;">
            <thead class="table-dark">
                <tr>
                    <th>Producto</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($cart->contents() as $item): ?>
    <tr>
        <td><?= esc($item['name']) ?></td>
        <td><strong>$<?= number_format($item['price'], 2, ',', '.') ?></strong></td>
        <td>
            <form action="<?= site_url('carrito/actualizar') ?>" method="post" class="d-inline">
                <input type="hidden" name="rowid" value="<?= esc($item['rowid']) ?>">
                <input type="number" name="qty" value="<?= esc($item['qty']) ?>" min="1" style="width:60px;">
                <button type="submit" class="btn btn-sm btn-primary ms-1">Actualizar</button>
            </form>
        </td>
        <td>$<?= number_format($item['subtotal'], 2, ',', '.') ?></td>
        <td>
            <form action="<?= site_url('carrito/eliminar') ?>" method="post" class="d-inline">
                <input type="hidden" name="rowid" value="<?= esc($item['rowid']) ?>">
                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
            </tbody>
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                    <td colspan="1"><strong>$<?= number_format($cart->total(), 2, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
        <form action="<?= site_url('carrito/comprar') ?>" method="post" class="mt-3">
            <button type="submit" class="btn btn-success">Comprar</button>
        </form>
    <?php else: ?>
        <p>Tu carrito está vacío.</p>
        <p><a href="<?= site_url('productos') ?>" class="btn btn-link">Volver al Catálogo</a></p>
    <?php endif; ?>

    <p class="mt-3"><a href="<?= site_url('productos') ?>" class="btn btn-link">Seguir comprando</a></p>
</div>

<?= $this->endSection() ?>
