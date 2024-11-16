<?php
// Verifique se a sessão já foi iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "models/ProfessorModel.php";
include "models/AulaModel.php";

if ($_SESSION['user_type'] != 'professor' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

$user_id = $_SESSION['user_id'];

$ProfessorModel = new ProfessorModel();

$ProfessorModel->getPermission();

$professor = $ProfessorModel->getUser();

$AulasModel = new AulaModel();
$aulas = $AulasModel->getAulas();

$aluno_rank = 700;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/professor_page.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Professor</title>
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
            <li><a href="/professor_page">Conteúdos</a></li>
            <li><a href="/desafios_prof"  style="color: white">Desafios</a></li>
            <li><a href="/sobre">Sobre nós</a></li>
        </ul>
    </nav>
</header>

<section>
    <div class="">
        <div class="lista_videos">
            <button onclick="toggleVideos()">Esconder/Mostrar <i>VÍDEOS</i></button>
            <?php foreach ($aulas as $a): ?> 
                <?php if ($a['professor'] == $professor['name']): ?>
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
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="lista_exp">
            <button onclick="toggleExp()">Esconder/Mostrar <i>EXPERIÊNCIAS</i></button>
            <?php foreach (range(1, 30) as $i): ?>
                <div class="card exp hidden">
                    <a href="#">
                        <div class="expli-img" style="background-image: url('assets/images/children01.png');">
                            <img src="assets/images/play-ico.svg" alt="" class="play">
                        </div>
                        <div class="inf-exp">
                            <h2>Title exp</h2>
                            <h3>Prof.: Augusto Fagundes</h3>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
    </div>
    <div>
        <h2 style="margin-top: 20px">Novo exercicio</h2>
        <div class="new-desafio">
            <form action="controllers/AulaController.php" method="post" onsubmit="return validadeForm()">

                <input type="hidden" value="create_desafio" name="crud_type">
                
                <label for="title">
                    Titulo:
                    <input type="text" name="title">
                </label>
                <label for="question">
                    Questão:
                    <input type="text" name="question">
                </label>
                <label for="resp-corr">
                    Respota Correta:
                    <input type="text" name="resp1">
                </label>
                <label for="resp-corr">
                    Respota Errada 01:
                    <input type="text" name="resp2">
                </label>
                <label for="resp-corr">
                    Respota Errada 02:
                    <input type="text" name="resp3">
                </label>
                <label for="resp-corr">
                    Respota Errada 03:
                    <input type="text" name="resp4">
                </label>

                <button type="submit"> Criar </button>

            </form>
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

    function validadeForm() {
        const title = document.querySelector('input[name="title"]');
        const question = document.querySelector('input[name="question"]');
        const resp1 = document.querySelector('input[name="resp1"]');
        const resp2 = document.querySelector('input[name="resp2"]');
        const resp3 = document.querySelector('input[name="resp3"]');
        const resp4 = document.querySelector('input[name="resp4"]');

        if (!title.value.trim()) {
            alert('O campo "Título" é obrigatório.');
            title.focus();
            return false;
        }
        if (!question.value.trim()) {
            alert('O campo "Questão" é obrigatório.');
            question.focus();
            return false;
        } else if (!resp1.value.trim()) {
            alert('O campo "Resposta Correta" é obrigatório.');
            resp1.focus();
            return false;
        } else if (!resp2.value.trim()) {
            alert('O campo "Resposta Errada 01" é obrigatório.');
            resp2.focus();
            return false;
        } else if (!resp3.value.trim()) {
            alert('O campo "Resposta Errada 02" é obrigatório.');
            resp3.focus();
            return false;
        } else if (!resp4.value.trim()) {
            alert('O campo "Resposta Errada 03" é obrigatório.');
            resp4.focus();
            return false;
        }

        return true;
    };

</script>

</body>
</html>
