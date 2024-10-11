<?php
$cpf = $_POST['CPF'];
$phone = $_POST['Telefone'];
$area = $_POST['Área Disciplinar'];

if (!isset($cpf) || !isset($phone) || !isset($area) ) {
    header('location: /quemevoce');
}

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <link rel="stylesheet" href="assets/styles/login.css">
    <title>Professor</title>
</head>

<body>
    <section>
        <div class="form-login">
            <form name="form" method="post" action="controllers/<?= $usertype ?>Controller.php">
                <input type="hidden" name="crud_type" value="create">
                <input type="hidden" name="usertype" value="<?= $usertype ?>">
                <input type="hidden" name="CPF" value="<?= $cpf ?>">
                <input type="hidden" name="Telefone" value="<?= $phone ?>">
                <input type="hidden" name="Área Disciplinar" value="<?= $area ?>">

                <div class="box-size">
                    <a href="/quemevoce"><img src="assets/images/arrow-left-circle.svg"
                            alt="voltar para a pagina inicial"></a>
                </div>
                <div class="header">
                    <img src="assets/images/<?= $usertype ?>-ico.svg" alt="<?= $usertype ?> icone">
                    <h3>Obrigado por querer fazer parte dos</h3>
                    <h1>Pequenos Cientistas!</h1>
                </div>


                <div class="input-wrapper">
                        <label for="cpf">Cpf:</label>
                        <input type="number" name="cpf" placeholder="Digite aqui" required>
                    </div>
                <?php
                if ($usertype == 'professor') {
                    echo '
                    <div class="input-wrapper">
                        <label for="email">email:</label>
                        <input type="email" name="email" placeholder="Digite aqui" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="phone">Telefone:</label>
                        <input type="number" name="phone" placeholder="Digite aqui" required>
                    </div>
                    ';
                }
                ?>

                <button type="submit" style="margin-top: 50px;">Proximo</button>

                <p>Já possui conta? <a href="/login">Clique aqui</a></p>

            </form>
        </div>
        <div class="img-login">
            <img src="assets/images/logo-completa.svg" alt="">
        </div>
    </section>
</body>
</html>