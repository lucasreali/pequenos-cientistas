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



<!-- PHP DA PÁGINA, NÃO SEI SE TA CERTO, ENTÃO FIZ A OUTRA PARTE IGUAL NO FIGMA PRA GARANTIR 
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
 -->
    
 <body>

    <!-- Barra de navegação -->
    <div class="navbar">
        <a href="#">Aulas</a>
        <a href="#">Desafios</a>
        <a href="#">Experimentos</a>
        <a href="#">Agenda</a>
        <a href="#">Grupos</a>
        <a href="#">Biblioteca</a>
        <a href="#">Ranking</a>
        <a href="#">Sobre nós</a>
    </div>

    <!-- Conteúdo principal -->
    <div class="main">
        <!-- Pergunta do desafio -->
        <div class="question">
            <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate neque eu metus placerat?</h2>
        </div>

        <!-- Alternativas -->
        <div class="alternatives">
            <div class="alternative">A. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <div class="alternative">B. Proin vulputate neque eu metus placerat, eu consectetur tortor.</div>
            <div class="alternative">C. Morbi at accumsan est, duis nec placerat sapien.</div>
            <div class="alternative">D. Pellentesque consequat viverra lacus.</div>
        </div>

        <!-- Ranking -->
        <div class="ranking">
            <h3>TOP 3</h3>
            <ul>
                <li>
                    <span>João</span>
                    <span>Level 100</span>
                </li>
                <li>
                    <span>Roberta</span>
                    <span>Level 98</span>
                </li>
                <li>
                    <span>Mário</span>
                    <span>Level 82</span>
                </li>
            </ul>
        </div>
    </div>

</body>
</html>