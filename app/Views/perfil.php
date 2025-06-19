<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-5 mb-5" style="max-width: 500px;">
    <div class="card">
        <div class="card-header text-center">
            <h2>Mi Perfil</h2>
        </div>
        <div class="card-body">
            <?php if (isset($validation)): ?>
                <div class="alert alert-danger">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
            <form method="post" action="<?= site_url('perfil/actualizar') ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control<?= isset($validation) && $validation->hasError('nombre') ? ' is-invalid' : '' ?>" value="<?= esc($usuario['nombre']) ?>">
                    <?php if(isset($validation) && $validation->hasError('nombre')): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('nombre') ?> </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input type="text" name="apellido" class="form-control<?= isset($validation) && $validation->hasError('apellido') ? ' is-invalid' : '' ?>" value="<?= esc($usuario['apellido']) ?>">
                    <?php if(isset($validation) && $validation->hasError('apellido')): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('apellido') ?> </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control<?= isset($validation) && $validation->hasError('email') ? ' is-invalid' : '' ?>" value="<?= esc($usuario['email']) ?>">
                    <?php if(isset($validation) && $validation->hasError('email')): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('email') ?> </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control<?= isset($validation) && $validation->hasError('usuario') ? ' is-invalid' : '' ?>" value="<?= esc($usuario['usuario']) ?>">
                    <?php if(isset($validation) && $validation->hasError('usuario')): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('usuario') ?> </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" name="pass" class="form-control<?= isset($validation) && $validation->hasError('pass') ? ' is-invalid' : '' ?>" placeholder="Dejar en blanco para no cambiar">
                    <?php if(isset($validation) && $validation->hasError('pass')): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('pass') ?> </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary w-100">Actualizar Perfil</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
