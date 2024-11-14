<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/styles/professor_page.css">
    <link rel="stylesheet" href="../../assets/styles/style.css">
    <link rel="stylesheet" href="../../assets/styles/imports.css">
    <title>Professor</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="/professor_page"><img src="assets/images/logo.svg" alt=""></a>
        <ul class="container">
            <li><a href="/professor_page" style="color: white">Conteúdos</a></li>
            <li><a href="/professor/desafios">Desafios</a></li>
            <li><a href="/professor/agenda">Agenda</a></li>
            <li><a href="/professor/library">Biblioteca</a></li>
            <li><a href="/geral/sobre">Sobre nós</a></li>
        </ul>
    </nav>
</header>

<section>
    <div class="lista_videos">
        <button class=onclick="toggleVideos()">Esconder/Mostrar</button>
        <?php foreach (range(1, 30) as $i): ?>
            <div class="card video">
                <a href="#">
                    <div class="videoli-img" style="background-image: url('assets/images/children01.png');">
                        <img src="assets/images/play-ico.svg" alt="" class="play">
                    </div>
                    <div class="inf-video">
                        <h2>Title video</h2>
                        <h3>Prof.: Augusto Fagundes</h3>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
    function toggleVideos() {
        const videos = document.querySelectorAll('.video'); // Seleciona todos os elementos com a classe "video"
        videos.forEach(video => {
            video.classList.toggle('hidden'); // Alterna a classe "hidden" em cada vídeo
        });
    }
</script>

</body>
</html>
