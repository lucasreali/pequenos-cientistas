<?php

include 'models/ResponsavelModel.php';
session_start();

if ($_SESSION['user_type'] != 'responsavel' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

$ResponsavelModel = new ResponsavelModel();

$dependentes = $ResponsavelModel->getDependentes();

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/responsavel_page.css">
    <link rel="stylesheet" href="assets/styles/imports.css">

    <title>Responsavel</title>
</head>

<body>

    <header>
        <nav>
            <a href="/"><img src="/pequenos-cientistas/assets/images/logo.svg" alt=""></a>
            <ul class="container">
                <li><a href="#">Historico do Aluno</a></li>
                <li><a href="#">Acompanhe seu filho</a></li>
                <li><a href="#">Agenda</a></li>
                <li><a href="#">Grupos</a></li>
            </ul>
    </header>


    <section>
        <h2>Assista com seu filho</h2>
        <div class="videos_resp">
            <?php foreach (range(1, 30) as $i): ?>

                <div class="aluno-videos">
                    <div class="video">
                        <a href="">
                            <div class="video-img" style="background-image: url('assets/images/children01.png');">
                                <img src="assets/images/play-ico.svg" alt="" class="play">
                            </div>
                            <h2>Title video</h2>
                            <h3>Prof.: Augusto Fagundes</h3>
                        </a>
                    </div>


                </div>

            <?php endforeach; ?>
        </div>
        <div class="lista_videos">
            <?php foreach (range(1, 30) as $i): ?>

                <div class="card">
                    <a href="">
                        <div class="videoli-img" style="background-image: url('assets/images/children01.png');">
                            <img src="assets/images/play-ico.svg" alt="" class="play">
                        </div>
                        <div class="inf-video">
                            <h2>Title video</h2>
                            <h3>Prof.: Augusto Fagundes</h3>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
    </section>

</body>
</html>


