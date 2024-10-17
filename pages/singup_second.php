<?php
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];

if (!isset($name) || !isset($email) || !isset($password) || !isset($usertype)) {
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
    <title>Aluno</title>
</head>

<body>
    <section>
        <div class="form-login">
            <form name="form" method="post" action="controllers/<?= ucfirst($usertype) ?>Controller.php">
                <input type="hidden" name="crud_type" value="create">
                <input type="hidden" name="usertype" value="<?= $usertype ?>">
                <input type="hidden" name="name" value="<?= $name ?>">
                <input type="hidden" name="email" value="<?= $email ?>">
                <input type="hidden" name="password" value="<?= $password ?>">

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
                if ($usertype == 'aluno') {
                    echo '
                    <div class="input-wrapper">
                        <label for="emailresponsavel">Email do responsável:</label>
                        <input type="email" name="emailresponsavel" placeholder="Digite aqui" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="dateborn">Data de nascimento:</label>
                        <input type="date" name="dateborn" placeholder="Digite aqui" required>
                    </div>';

                } else if ($usertype == 'responsavel') {
                    echo '
                        <div class="input-wrapper">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" name="phone" placeholder="Digite aqui" required>
                        </div>
                    ';
                } else if ($usertype == 'professor') {
                    echo '
                        <div class="input-wrapper">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" name="telefone" placeholder="Digite aqui" required>
                        </div>

                        <div class="input-wrapper">
                            <label for="certificacao">Insira sua certificação:</label>
                            <input type="file" name="cetificacao" required>
                        </div>
                    ';
                }
                if ($usertype == 'responsavel') {
                    echo '
                    

                    <div class="input-wrapper">
                        <label for="cpf">CPF:</label>
                        <input type="cpf" name="cpf" placeholder="Digite aqui" required>
                    </div>



                    <div class="input-wrapper">
                        <label for="phone">Telefone:</label>
                        <input type="phone" name="phone" placeholder="Digite aqui" required>
                    </div>
                    ';
        
                }
                ?>
                <button type="submit" style="margin-top: 50px;">Proximo</button>

                <p>Ja possui conto? <a href="/login">Clique aqui</a></p>

            </form>
        </div>
        <div class="img-login">
            <img src="assets/images/logo-completa.svg" alt="">
        </div>
    </section>
</body>
</html>