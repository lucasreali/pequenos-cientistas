<?php

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

$id = $_GET['id'];

$AulasModel = new AulaModel();
$desafio = $AulasModel->getDesafioById($id);

$question = $AulasModel->getQuestions($id);


?><!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/desafios_aluno.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <link rel="stylesheet" href="assets/styles/desafios.css">
    <title>Desafio Aplicado</title>
    
 <body>


    <header>
        <nav>
            <a href="/"><img src="assets/images/logo.svg" alt=""></a>
            <ul class="container">                
                <li><a href="/aulas">Aulas</a></li>
                <li><a href="/desafios_aluno">Desafios</a></li>
            </ul>
        </nav>
    </header>

    <section>


        <h1><?= $desafio['title'] ?></h1>

        <p><?= $desafio['question'] ?></p>
        <div class="options">
            <a href="/resposta-certa"><?= $question['resp_1'] ?></a>
            <a href="/resposta-certa"><?= $question['resp_2'] ?></a>
            <a href="/resposta-certa"><?= $question['resp_3'] ?></a>
            <a href="/resposta-certa"><?= $question['resp_4'] ?></a>
        </div>

    </section> 


</body>
</html>