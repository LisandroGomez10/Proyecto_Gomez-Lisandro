<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-4">
   <h1 class="text-center">Usuarios</h1>
    <div class="mb-1 text-end">
        <a href="<?= site_url('usuarios/agregar') ?>" class="btn btn-success">Agregar Usuario</a>
    </div>
    <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Perfil</th>
                <th>Baja</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios) && is_array($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= esc($usuario['id'] ?? $usuario['id_usuario'] ?? '') ?></td>
                        <td><?= esc($usuario['nombre'] ?? '') ?></td>
                        <td><?= esc($usuario['email'] ?? '') ?></td>
                        <td><?= esc($usuario['perfil'] ?? $usuario['perfil_id'] ?? '') ?></td>
                        <td><?= (isset($usuario['baja']) && $usuario['baja'] === 'SI') ? 'Sí' : 'No' ?></td>
                        <td>
                            <a href="<?= site_url('usuarios/editar/' . esc($usuario['id'] ?? $usuario['id_usuario'] ?? '')) ?>" class="btn btn-primary btn-sm mb-1 w-100">Editar</a>
                            <?php if (isset($usuario['baja']) && $usuario['baja'] === 'SI'): ?>
                                <a href="<?= site_url('usuarios/activar/' . esc($usuario['id'] ?? $usuario['id_usuario'] ?? '')) ?>" class="btn btn-success btn-sm mb-1 w-100">Dar de alta</a>
                            <?php else: ?>
                                <a href="<?= site_url('usuarios/borrar/' . esc($usuario['id'] ?? $usuario['id_usuario'] ?? '')) ?>" class="btn btn-danger btn-sm mb-1 w-100">Dar de baja</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6" class="text-center">No hay usuarios registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>
<?= $this->endSection() ?>
