<?php
// Verifique se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "models/AlunoModel.php";
include "models/AulaModel.php";

if ($_SESSION['user_type'] != 'aluno' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

$user_id = $_SESSION['user_id'];

$AlunoModel = new AlunoModel();
$aluno = $AlunoModel->getUser();

$AulasModel = new AulaModel();
$desafios = $AulasModel->getDesafios();
?><!DOCTYPE html>
<html lang="pt-br">


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/desafios_aluno.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Desafios</title>
</head>
<body>
<body>
    <header>
        <nav>
            <a href="/"><img src="assets/images/logo.svg" alt=""></a>
            <ul class="container">

                <li><a href="/">Aulas</a></li>

                <li><a href="/desafios_aluno">Desafios</a></li>
                <li><a href="/sobre">Sobre nós</a></li>
            </ul>
        </nav>
    </header>

<body>
    


<section style="padding-top: 100px;">
    <h2 style="margin: 10px 0 0 10px">Desafios</h2>
    <div class="lista_desafios">
        <?php foreach ($desafios as $d): ?>
            <?= $d['id'] ?>
            <div class="card desafios">
                <a href="/desafio?id=<?= $d['id'] ?>">
                    <div class="desafioli-img">
                        <img src="assets/images/play-ico.svg" alt="" class="play">
                    </div>
                    <div class="inf-desafio">
                        <h2><?= $d['title'] ?></h2>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>


</body>
</html>