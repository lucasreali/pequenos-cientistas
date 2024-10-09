<!doctype html>
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
        <form name="form" action="../actions/login.php" method="post">
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
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Digite aqui" required>
            </div>

            <p class="fgt-passw"><a href="/">Esqueci minha senha</a></p>

            <button type="submit">Entrar</button>

            <p>Não tem conta? <a href="/quemevoce">Clique aqui</a></p>

        </form>
    </div>
    <div class="img-login">
        <img src="../assets/images/logo-completa.svg" alt="">
    </div>
</section>
</body>
</html>