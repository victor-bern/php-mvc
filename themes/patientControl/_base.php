<!doctype html>
<?php $cropper = new \Source\Support\Images(); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= theme("/css/materialize.css") ?>">
    <title><?= $v->e($title) ?></title>
</head>
<body class="red" style="padding: 20px">

<ul id="slide-out" class="sidenav sidenav-fixed" style="min-width: 20%;">
    <a href="<?= url() ?>" class="brand-logo"><img src="<?= theme("/images/logo.png") ?>" alt="logo"
                                                   style="margin: 0 0 70px 35%; height: 64px;"></a>
    <li><a href="<?= url("/cadastrar"); ?>">Registrar Paciente</a></li>
    <li><a class='dropdown-trigger' href='#' data-target='dropdown1'">Lista de Pacientes</a></li>
</ul>
<ul id='dropdown1' class='dropdown-content'>
    <li><a href="<?= url("/listagem"); ?>">Listar Todos</a></li>
    <li><a href="<?= url("/listagem/com-consulta-feita"); ?>">Com consulta feita</a></li>
    <li><a href="<?= url("/listagem/sem-consulta-feita"); ?>">Sem consulta feita</a></li>
</ul>

<main class="main-container">
    <?= $v->section("content"); ?>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="<?= theme("js/materialize.js") ?>"></script>
<script>
    $('.dropdown-trigger').dropdown();
</script>
<?= $v->section("script"); ?>
</body>
</html>