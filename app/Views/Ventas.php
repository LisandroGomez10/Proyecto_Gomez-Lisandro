<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<main class="min-vh-100 d-flex justify-content-center align-items-center flex-column animate__animated animate__fadeInDown">
<div class="container-fluid">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Listado de <b>Ventas</b></h2>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID Venta</th>
                            <th class="text-center">Cliente</th>
                            <th class="text-center">Fecha de Venta</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Ver Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $granTotal = 0;
                        if (!empty($ventas) && is_array($ventas)) : ?>
                            <?php foreach ($ventas as $venta) : ?>
                                <tr>
                                    <td class="text-center"><?= esc($venta['venta_id']) ?></td>
                                    <td class="text-center"><?= esc($venta['usuario_nombre']) ?></td>
                                    <td class="text-center"><?= esc($venta['venta_fecha']) ?></td>
                                    <td class="text-center">$<?= number_format($venta['venta_total'], 2) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('detalle_venta/' . $venta['venta_id']) ?>" class="btn btn-info text-white abrir-detalle">Ver Detalle</a>
                                    </td>
                                </tr>
                                <?php $granTotal += $venta['venta_total']; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center">No hay ventas disponibles</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Gran Total:</th>
                            <th class="text-center">$<?= number_format($granTotal, 2) ?></th>
                            <th colspan="2"></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="clearfix">
            
                </div>
            </div>
        </div>
    </div>
</main>


<?php $this->endSection(); ?>