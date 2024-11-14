<?php
session_start();
include "models/AlunoModel.php";

if ($_SESSION['user_type'] != 'aluno' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

$user_id = $_SESSION['user_id'];

$AlunoModel = new AlunoModel();
$aluno = $AlunoModel->getUser();

$aluno_rank = 700;
?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/aluno_page.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Aluno</title>
</head>

<body>
    <header>
        <nav>
            <a href="/"><img src="assets/images/logo.svg" alt=""></a>
            <ul class="container">
                <li><a href="/">Aulas</a></li>
                <li><a href="/contato">Desafios</a></li>
                <li><a href="/agenda">Agenda</a></li>
                <li><a href="/grupos">Grupos</a></li>
                <li><a href="/biblioteca">Biblioteca</a></li>
                <li><a href="/ranking">Ranking</a></li>
                <li><a href="/sobre">Sobre nós</a></li>
            </ul>
        </nav>
    </header>

    <main style="padding-top: 100px;">
        <div class="aluno-rank">
            <img src="assets/images/aluno-ico.svg" alt="">
            <div class="xp-aluno">
                <div style="width: 500px;">
                    <h3>Level <?= (int) ($aluno_rank / 500) ?></h3>
                    <p><?= $aluno_rank % 500 ?>/500xp</p>
                    <div style="width: <?= $aluno_rank % 500 ?>px;"></div>
                </div>
            </div>
        </div>

        <div class="aluno-videos">
            <div class="video">
                <a href="">
                    <video src=""></video>
                    <h2>Title video</h2>
                    <h3>Prof.: Augusto Fagundes</h3>
                </a>
            </div>
        </div>

    </main>
</body>

</html>