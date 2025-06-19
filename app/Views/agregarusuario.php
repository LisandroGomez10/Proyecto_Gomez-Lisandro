<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-2 mb-5 d-flex justify-content-center">
    <div class="card w-100" style="max-width: 500px;">
      <div class="card-header text-center">
        <h2>Agregar Usuario</h2>
      </div>
      <?php helper(['form']); ?>
      <form method="post" action="<?= site_url('usuarios/guardar') ?>">
        <div class="card-body justify-content-center" media="(max-width:768px)">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" placeholder="Ingresa el nombre" value="<?= old('nombre', $usuario['nombre'] ?? '') ?>">
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
            <label for="pass" class="form-label">Password</label>
            <input name="pass" type="password" class="form-control" placeholder="Password">
            <?php if(isset($validation) && $validation->getError('pass')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('pass'); ?></div>
            <?php endif; ?>
          </div>
          <div class="mb-3">
            <label for="perfil_id" class="form-label">Perfil</label>
            <select name="perfil_id" class="form-select">
              <option value="2" selected>Cliente</option>
              <option value="1">Administrador</option>
            </select>
            <?php if(isset($validation) && $validation->getError('perfil_id')): ?>
              <div class='alert alert-danger mt-2'><?= $validation->getError('perfil_id'); ?></div>
            <?php endif; ?>
          </div>
          <div class="d-flex flex-column flex-md-row gap-2 mt-3">
            <input type="submit" value="Guardar" class="btn btn-success w-100">
            <a href="<?= site_url('usuarios/lista') ?>" class="btn btn-danger w-100">Cancelar</a>
            <input type="reset" value="Borrar" class="btn btn-secondary w-100">
          </div>
        </div>
      </form>
    </div>
</div>
<?= $this->endSection() ?>
