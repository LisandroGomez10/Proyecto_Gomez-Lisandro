<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>
<div class="container mt-2 mb-5 d-flex justify-content-center">
    <div class="card" style="width: 50%;">
      <div class="card-header text-center">
        <h2>Registrarse</h2>
      </div>
      <?php helper(['form']); ?>
      <?php if (isset($validation) && $validation->hasError('nombre')): ?>
        <div class='alert alert-danger mt-2'><?= $validation->getError('nombre'); ?></div>
      <?php endif; ?>
      <form method="post" action="<?= site_url('enviar-form') ?>">
        <div class="card-body justify-content-center" media="(max-width:768px)">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" class="form-control" placeholder="Ingresa tu nombre" value="<?= old('nombre', $usuario['nombre'] ?? '') ?>">
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
          <input type="hidden" name="perfil_id" value="2">
          <input type="submit" value="Guardar" class="btn btn-success">
          <a href="<?= site_url('login') ?>" class="btn btn-danger">Cancelar</a>
          <input type="reset" value="Borrar" class="btn btn-secondary">
        </div>
      </form>
    </div>
</div>
<?= $this->endSection() ?>