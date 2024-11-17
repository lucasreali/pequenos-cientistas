<?php

include 'models/ResponsavelModel.php';
include 'models/AulaModel.php';
session_start();

if ($_SESSION['user_type'] != 'responsavel' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

$ResponsavelModel = new ResponsavelModel();

$AulasModel = new AulaModel();
$aulas = $AulasModel->getAulas();
$desafios = $AulasModel->getDesafios();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/professor_page.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Responsavel</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="/"><img src="assets/images/logo.svg" alt=""></a>
        <ul class="container">
            <li><a href="/professor_page" style="color: white">Conteúdos</a></li>
        </ul>
    </nav>
</header>

<section>
    <div class="">
        <div class="lista_videos">
            <button onclick="toggleVideos()">Esconder/Mostrar <i>VÍDEOS</i></button>
            <?php foreach ($aulas as $a): ?> 
                <div class="card video1 hidden">
                    <a href="#">
                    <iframe
                            width="112"
                            height="63"
                            src="<?= $a['url'] ?>"
                            frameborder="-1"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                        <div class="inf-video">
                            <h2><?= $a['title'] ?></h2>
                            <h3>Prof.: <?= $a['professor'] ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="lista_exp">
            <button onclick="toggleExp()">Esconder/Mostrar <i>EXPERIÊNCIAS</i></button>
            <?php foreach ($desafios as $d): ?>
                <div class="card exp hidden">
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
           
    </div>
    <div>
        <h2 style="margin-top: 20px">Mais populares</h2>
        <div class="most_popular_vids">
        <?php foreach ($aulas as $a): ?> 
            <div class="aluno-videos">
                <div class="video">
                        <iframe
                            width="304"
                            height="171"
                            src="<?= $a['url'] ?>"
                            frameborder="-1"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    
                        <h2><?= $a['title'] ?></h2>
                        <h3><?= substr($a['description'], 0, 25) ?>...</h3>
                        <h3>Prof.: <?= $a['professor'] ?></h3>
                    </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    function toggleVideos() {
        const videos = document.querySelectorAll('.video1');
        videos.forEach(video => {
            video.classList.toggle('hidden');
        });
    }
    function toggleExp() {
        const exps = document.querySelectorAll('.exp');
        exps.forEach(exp => {
            exp.classList.toggle('hidden'); 
        });
    }
    function toggleAdcVid() {
        const adcs = document.getElementById('formContent')
            formContent.classList.toggle('hidden');
    }

</script>

</body>
</html>

