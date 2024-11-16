<!DOCTYPE html>
<html lang="pt-br">


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/aluno.css">
    <link rel="stylesheet" href="assets/styles/desafio_aplicado.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Desafios</title>
</head>
<body>
<body>
    <header>
        <nav>
            <a href="/"><img src="assets/images/logo.svg" alt=""></a>
            <ul class="container">

                <li><a href="/">Aulas</a></li>

                <li><a href="/desafios_aluno">Desafios</a></li>
                <li><a href="/sobre">Sobre nós</a></li>
            </ul>
        </nav>
    </header>
<body>


<?php
// Simula um banco de dados de desafios
$desafios = [
    1 => [

    ],
    2 => [

    ],
    // Adicione mais desafios conforme necessário
];

// Obtém o ID do desafio pela URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

// Verifica se o desafio existe
if (!$id || !isset($desafios[$id])) {
    echo "Desafio não encontrado.";
    exit;
}

$desafio = $desafios[$id];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Aplicado</title>

</head>
<body>
    <section style="padding-top: 50px;">
        <h2>Desafio <?= $id ?></h2>
        <div class="card">
            <h3><?= $desafio['pergunta'] ?></h3>
            <form action="desafio_correct.php" method="POST">
                <?php foreach ($desafio['alternativas'] as $index => $alternativa): ?>
                    <div class="alternativa">
                        <label>
                            <input type="radio" name="resposta" value="<?= $index ?>" required>
                            <?= $alternativa ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" name="id" value="<?= $id ?>">
                <button type="submit">Enviar Resposta</button>
            </form>
        </div>
    </section>
</body>
</html>
