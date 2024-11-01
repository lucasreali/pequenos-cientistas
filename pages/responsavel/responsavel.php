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
            <a href="/admin"><img src="assets/images/logo.svg" alt=""></a>

            <ul class="container">
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
            </ul>
        </nav>
    </header>


    <section>

        <div>

            

        </div>

    </section>

</body>
</html>
