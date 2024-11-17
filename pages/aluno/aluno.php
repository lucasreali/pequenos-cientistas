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
$aulas = $AulasModel->getAulas();

$aluno_rank = 700;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/aluno.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Aluno</title>
</head>

<body>
    <header>
        <nav>
            <a href="/"><img src="assets/images/logo.svg" alt=""></a>
            <ul class="container">
                <li><a href="/" style="color: white">Aulas</a></li>
                <li><a href="/desafios_aluno">Desafios</a></li>
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
        <div class="videos_aluno">
            <?php foreach ($aulas as $a): ?>
                <div class="aluno-videos">
                    <div class="video">
                        <a href="<?= $a['url'] ?>">
                            <iframe width="304" height="171" src="<?= $a['url'] ?>" frameborder="-1"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </a>
                        <h2><?= $a['title'] ?></h2>
                        <h3 style="font-size: 10px"><?= $a['description'] ?></h3>
                        <h3>Prof.: <?= $a['professor'] ?></h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


    </main>
</body>

</html>