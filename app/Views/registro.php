<div class="container mt-2 mb-5 d-flex justify-content-center">
    <div class="card" style="width: 50%;">
      <div class="card-header text-center">
        <h2>Registrarse</h2>
      </div>
            
   <?php $validation = \Config\Services::validation(); ?>
     
     <form method="post" action="<?php echo base_url('/enviar-form') ?>">
           <?php if(!empty (session()->getFlashdata('fail'))):?>
           <div class="alert alert-danger"><?=session()->getFlashdata('fail');?></div>
          <?php endif?>
             <?php if(!empty (session()->getFlashdata('success'))):?>
               <div class="alert alert-danger"><?=session()->getFlashdata('success');?></div>
            <?php endif?>    	
  <div class ="card-body justify-content-center" media="(max-width:768px)">
      <div class="form">
        <label for="exampleFormControlInput1" class="form-label">Nombre</label>
        <input name="nombre" type="text"  class="form-control" placeholder="Ingresa tu nombre" >
       <!-- Error -->
          <?php if($validation->getError('nombre')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('nombre'); ?>
              </div>
          <?php }?>
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Apellido</label>
         <input type="text" name="apellido"class="form-control" placeholder="Apellido" >
         <!-- Error -->
          <?php if($validation->getError('apellido')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('apellido'); ?>
              </div>
          <?php }?>
      </div>
      <div class="mb-3">
           <label for="exampleFormControlInput1" class="form-label">email</label>
        <input name="email"  type="femail" class="form-control"  placeholder="Correo@algo.com" >
         <!-- Error -->
          <?php if($validation->getError('email')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('email'); ?>
              </div>
          <?php }?>
      </div>
         <div class="mb-3">
       <label for="exampleFormControlInput1" class="form-label">Usuario</label>
        <input  tyupe="text" name="usuario" class="form-control" placeholder="Usuario">
        <!-- Error -->
          <?php if($validation->getError('usuario')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('usuario'); ?>
              </div>
          <?php }?>
      </div>
      
      <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Password</label>
        <input name="pass" type="password" class="form-control"  placeholder="Password">
        <!-- Error -->
          <?php if($validation->getError('pass')) {?>
              <div class='alert alert-danger mt-2'>
                <?= $error = $validation->getError('pass'); ?>
              </div>
          <?php }?>
       </div>
                <input type="submit" value="Guardar" class="btn btn-success">
              <a href="<?php echo base_url('registro'); ?>" class="btn btn-danger">Cancelar</a>
                 <input type="reset" value="Borrar" class="btn btn-secondary" onclick="borrarTextArea()">
            </div>
    </form>
       
  </div>
  </div>
  </div>
  </div>
  