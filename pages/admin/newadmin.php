<?php



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/newadmin.css">
    <link rel="stylesheet" href="../assets/styles/imports.css">
    <title>Document</title>
</head>
<body>

<header>
    <nav>
        <a href="/admin"><img src="assets/images/logo.svg" alt=""></a>
        <ul class="container">
            <li><a href="/admin">Inicio</a></li>
            <li><a href="/admin/content">Conteúdo</a></li>
            <li><a href="/admin/newadmin" style="color: white">Novo Admin</a></li>
        </ul>
    </nav>
</header>
    <div class="form-login">
        <form name="form" action="controllers/AuthController.php" method="post">
            <input type="hidden" name="case" value="login">

            <div class="box-size">
                <a href="/"><img src="../assets/images/arrow-left-circle.svg" alt="voltar para a pagina inicial"></a>
            </div>
            <h3>Obrigado por fazer parte dos</h3>
            <h1>Pequenos Cientistas!</h1>

            <div class="input-wrapper">
                <label for="email">E-mail:</label>
                <input type="email" name="email" placeholder="Digite aqui" required>
            </div>

            <div class="input-wrapper">
                <input type="hidden" value="add-video" name="crud_type">
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Digite aqui" required>
            </div>

            <p class="fgt-passw"><a href="/">Esqueci minha senha</a></p>

            <button type="submit">Entrar</button>

            <p>Não tem conta? <a href="/singup/quemevoce">Clique aqui</a></p>

        </form>
    </div>
</body>
</html>