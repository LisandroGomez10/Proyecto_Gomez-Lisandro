<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-2 mb-5 d-flex justify-content-center">
    <div class="card" style="width: 50%;">
      <div class="card-header text-center">
        <h2>Editar Usuario</h2>
      </div>
      <?php helper(['form']); ?>
      <form method="post" action="<?= site_url('usuarios/actualizar/' . ($usuario['id_usuario'] ?? $usuario['id'] ?? '')) ?>">
        <div class="card-body justify-content-center" media="(max-width:768px)">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" placeholder="Nombre" value="<?= old('nombre', $usuario['nombre'] ?? '') ?>">
            <?php if(isset($validation) && $validation->getError('nombre')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('nombre'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" placeholder="Apellido" value="<?= old('apellido', $usuario['apellido'] ?? '') ?>">
            <?php if(isset($validation) && $validation->getError('apellido')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('apellido'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" placeholder="Correo@algo.com" value="<?= old('email', $usuario['email'] ?? '') ?>">
            <?php if(isset($validation) && $validation->getError('email')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('email'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" placeholder="Usuario" value="<?= old('usuario', $usuario['usuario'] ?? '') ?>">
            <?php if(isset($validation) && $validation->getError('usuario')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('usuario'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="perfil_id" class="form-label">Perfil</label>
            <select name="perfil_id" class="form-control">
                <option value="1" <?= old('perfil_id', $usuario['perfil_id'] ?? '') == 1 ? 'selected' : '' ?>>Administrador</option>
                <option value="2" <?= old('perfil_id', $usuario['perfil_id'] ?? '') == 2 ? 'selected' : '' ?>>Cliente</option>
            </select>
            <?php if(isset($validation) && $validation->getError('perfil_id')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('perfil_id'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="pass" class="form-label">Password (dejar vacío para no cambiar)</label>
            <input name="pass" type="password" class="form-control" placeholder="Password">
            <?php if(isset($validation) && $validation->getError('pass')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('pass'); ?></div>
            <?php endif; ?>
          </div>
          <input type="submit" value="Guardar" class="btn btn-success">
          <a href="<?= site_url('usuarios/lista') ?>" class="btn btn-danger">Cancelar</a>
        </div>
      </form>
    </div>
</div>
<?= $this->endSection() ?>
