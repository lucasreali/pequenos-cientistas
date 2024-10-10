<?php
$usertype = $_POST['usertype'];

if (!isset($usertype))
{
    header('Location: /');
}

?><!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="../assets/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/styles/imports.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    <title>Login</title>
</head>
<body>
<section>
    <div class="form-login">
        <form name="form" action="../controllers/<?= $usertype?>Controller.php" method="post">
            <input type="hidden" name="$crud_form" value="create">
            <input type="hidden" name="$usertype" value="<?= $usertype ?>">

            <div class="box-size">
                <a href="/quemevoce"><img src="../assets/images/arrow-left-circle.svg" alt="voltar para a pagina inicial"></a>
            </div>
                <div class="header">
                    <img src="../assets/images/<?= $usertype ?>-ico.svg" alt="<?= $usertype ?> icone">
                    <h3>Obrigado por querer fazer parte dos</h3>
                    <h1>Pequenos Cientistas!</h1>
                </div>


            <div class="input-wrapper">
                <label for="email">Name:</label>
                <input type="text" name="name" placeholder="Digite aqui" required>
            </div>

            <div class="input-wrapper">
                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Digite aqui" required>
            </div>

            <div class="input-wrapper">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Digite aqui" required>
            </div>

            <button type="submit" style="margin-top: 50px;">Proximo</button>

            <p>Ja possui conto? <a href="/login">Clique aqui</a></p>

        </form>
    </div>
    <div class="img-login">
        <img src="../assets/images/logo-completa.svg" alt="">
    </div>
</section>
</body>
</html>