<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/aluno.css">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <title>Desafios</title>
</head>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/desafios_aluno.css">
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

                <li><a href="/aulas">Aulas</a></li>

                <li><a href="/desafios_aluno">Desafios</a></li>
                <li><a href="/sobre">Sobre nós</a></li>
            </ul>
        </nav>
    </header>

<body>
    


<section style="padding-top: 100px;">
    <h2 style="margin: 10px 0 0 10px">Desafios</h2>
    <div class="lista_desafios">
        <?php foreach (range(1, 30) as $i): ?>
            <div class="card desafios">
                <a href="#">
                    <div class="desafioli-img">
                        <img src="assets/images/play-ico.svg" alt="" class="play">
                    </div>
                    <div class="inf-desafio">
                        <h2>Title desafio</h2>
                        <h3>Descrição: </h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>


</body>
</html>