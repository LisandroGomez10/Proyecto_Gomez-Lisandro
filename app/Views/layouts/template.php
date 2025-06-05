<!DOCTYPE html>
<html lang="es">
<head>
    <?= view('head') ?>
</head>
<body>
    <?= view('titulo') ?>
    <?= view('navbar') ?>
    
    <main class="container">
        <?= $this->renderSection('contenido') ?>
    </main>


    <?= view('footer') ?>
</body>
</html>
