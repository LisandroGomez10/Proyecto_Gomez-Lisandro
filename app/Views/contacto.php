<?= $this->extend('layouts/template') ?>
<?= $this->section('contenido') ?>


<section id="contacto" class="container-fluid d-flex flex-column min-vh-100">
    
    <div class="flex-grow-1">
        <br>

        <div class="contactoTitulos row">
            <h2 style="text-align: center;"> PowerSource Insumos ™ </h2>
        </div>

        <div class="row">
            <div style="text-align: center;">
             
                <i class="bi bi-geo-alt-fill"> <img src="assets/icons/geo-alt-fill.svg" alt="Direccion"> Piragine Niveyro 1978 </i> 
            
            </div>
        </div>
        <br>
        <div class="row">
            <div id="mapa">
                <a href="https://www.google.com.ar/maps/place/P.+Niveiro+1978,+Corrientes/@-27.4789287,-58.8488639,17z/data=!3m1!4b1!4m6!3m5!1s0x94456c94287b0743:0xe760ce5ecc79ad24!8m2!3d-27.4789335!4d-58.846289!16s%2Fg%2F11h3c4gtgs?entry=ttu" target="_blank"><img src="assets/img/mapa.jpg" alt="..."></a>               
            </div>
        </div>

        <br>
        
        <div class="row" style="text-align: center;">
            <p> De <span style="font-style:normal; font-weight: bold;"> Lunes a Viernes </span>
                de 8 a 13 y de 17 a 22 hs. 
                
                <span style="font-style:normal; font-weight: bold;"> Sábados </span>
                de 16 a 21 hs. 
            </p>
        </div>

        <div class="row" style="text-align: center;">
            <p> <i class="bi bi-telephone"> <img src="assets/icons/telephone.svg" alt="Phone"> </i> +54-3794-403829 </p>
            <p> <i class="bi bi-envelope-at"> <img src="assets/icons/envelope-at.svg" alt="Mail"> </i>leonardofsirota@gmail.com </p>
            <p> <i class="bi bi-telephone"> <img src="assets/icons/telephone.svg" alt="Phone"> </i> +54-3795-074605</p>
            <p> <i class="bi bi-envelope-at"> <img src="assets/icons/envelope-at.svg" alt="Mail"> </i>lisandroygomezhertler.99@gmail.com</p>

        </div>        

        <div class="container text-center my-5">
    <div class="row">
        <div class="col">
            <h2 class="fw-bold">TITULARES DE LA EMPRESA</h2>
        </div>
    </div>

    <div class="row g-4 justify-content-center align-items-center">
        <div class="col-md-4">
            <img src="assets/img/self.jpg" class="img-fluid rounded-circle" style="width: 200px;">
            <h3 class="mt-3">Leonardo E. Fleitas Sirota</h3>
        </div>

        <div class="col-md-4">
            <img src="assets/img/Imagen_Lisandro.jpg" class="img-fluid rounded-circle" style="width: 200px;">
            <h3 class="mt-3">Lisandro L. Gomez Hertler</h3>
        </div>
    </div>
</div>



        <div class="contactoTitulos row">
            <h2 style="text-align: center;"> ENVIANOS TU CONSULTA </h2>
        </div>


<div class="container form-container">
    <form method="post" action="<?= base_url('consultas/guardar') ?>">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa tu apellido">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu e-mail">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="numero" placeholder="Ingresa tu teléfono">
        </div>
        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="pregunta" rows="3" placeholder="Escribe tu mensaje aquí" maxlength="1000"></textarea>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-secondary">Restablecer</button>
    </form>
</div>

        <br>
    </div>

</section>

<?= $this->endSection() ?>
