<body class="d-flex flex-column min-vh-100" style="background-color: rgb(150, 150, 150);">

<main class="flex-grow-1">
    <!-- Título con logotipo -->
<br>
    <div class="container">
        <div class="title row align-items-center rounded-2">
            <div class="titleLogo col-md-2 text-center text-md-left">
                <a href="<?= base_url('index') ?>">
                    <img src="<?= base_url('assets/img/logo.jpg') ?>" alt="Logotipo de PowerSource Insumos" class="img-fluid mr-3 rounded-2">
                </a>
            </div>
            <div class="col-md-10 text-center text-md-left">
                <!-- En pantallas grandes se muestra el h1 y en pantallas pequeñas el h2 -->
                <h1 class="display-2 d-none d-sm-block">PowerSource Insumos</h1> <!-- Solo en pantallas grandes -->
                <h2 class="display-4 d-block d-sm-none">PowerSource Insumos</h2> <!-- Solo en pantallas pequeñas -->
            </div>
        </div>
    </div>
<br>
