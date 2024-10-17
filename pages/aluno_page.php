<?php
session_start();
include "controllers/AlunoController.php";

$AlunoController = new AlunoController();
$aluno = $AlunoController->getUser($_SESSION['user_id']);

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

        <main>
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

            <a href="">
                <div class="aluno-videos">
                    <div class="video">
                        <img src="assets/images/children01.png" alt="">
                        <h2>Title video</h2>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod cum illo atque, fugit
                            voluptatibus suscipit, deleniti accusantium quasi dignissimos, nihil architecto amet.
                            Molestiae assumenda ratione expedita facere eum? Doloremque, a.
                        </p>
                    </div>

                </div>
            </a>

        </main>
    </header>
</body>

</html>