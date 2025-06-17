<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-5">
    <h2>Consultas Recibidas</h2>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Consulta</th>
                    <th>Visto</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <?php if (empty($consulta['consultas_visto']) || $consulta['consultas_visto'] == 0): ?>
                    <tr>
                        <td><?= esc($consulta['consultas_nombre']) ?></td>
                        <td><?= esc($consulta['consultas_apellido']) ?></td>
                        <td><?= esc($consulta['consultas_email']) ?></td>
                        <td><?= esc($consulta['consultas_numero']) ?></td>
                        <td><?= esc($consulta['consultas_pregunta']) ?></td>
                        <td><span class="badge bg-warning">No</span></td>
                        <td>
                            <form action="<?= site_url('consultas/visto/' . $consulta['consultas_id']) ?>" method="post">
                                <button type="submit" class="btn btn-success btn-sm">Dar Visto</button>
                            </form>
                        </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h3>Consultas Vistas</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Consulta</th>
                    <th>Visto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <?php if (!empty($consulta['consultas_visto']) && $consulta['consultas_visto'] == 1): ?>
                    <tr>
                        <td><?= esc($consulta['consultas_nombre']) ?></td>
                        <td><?= esc($consulta['consultas_apellido']) ?></td>
                        <td><?= esc($consulta['consultas_email']) ?></td>
                        <td><?= esc($consulta['consultas_numero']) ?></td>
                        <td><?= esc($consulta['consultas_pregunta']) ?></td>
                        <td><span class="badge bg-success">Sí</span></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
