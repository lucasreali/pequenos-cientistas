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
    <div class="">
        <div class="lista_videos">
            <button onclick="toggleVideos()">Esconder/Mostrar <i>VÍDEOS</i></button>
            <?php foreach (range(1, 30) as $i): ?>
                <div class="card video1 hidden">
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
        <div class="lista_exp">
            <button onclick="toggleExp()">Esconder/Mostrar <i>EXPERIÊNCIAS</i></button>
            <?php foreach (range(1, 30) as $i): ?>
                <div class="card exp hidden">
                    <a href="#">
                        <div class="expli-img" style="background-image: url('assets/images/children01.png');">
                            <img src="assets/images/play-ico.svg" alt="" class="play">
                        </div>
                        <div class="inf-exp">
                            <h2>Title exp</h2>
                            <h3>Prof.: Augusto Fagundes</h3>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
           <button class="adc_cont">Adicionar conteúdo <i>+</i></button>
           <form action="controllers/ProfessorController.php" method="post">
                <input type="hidden" value="create_aula" name="crud_type">
                <label>URL do vídeo<input type="text" name="url"></label>
                <label>Titulo do Video<input type="text" name="title"></label>
                <label>Descrição do video<input type="text" name="description"></label>
                <button type="submit">Enviar</button>
           </form>
    </div>
    <div>
        <h2>Mais populares</h2>
        <div class="most_popular_vids">
            <?php foreach (range(1, 30) as $i): ?>

                <div class="videos">
                    <div class="video">
                        <a href="">
                            <div class="video-img" style="background-image: url('assets/images/children01.png');">
                                <img src="assets/images/play-ico.svg" alt="" class="play">
                            </div>
                            <h2>Title video</h2>
                            <h3>Prof.: Augusto Fagundes</h3>
                        </a>
                    </div>


                </div>

            <?php endforeach; ?>
        </div>
    </div>
</section>

<script>
    function toggleVideos() {
        const videos = document.querySelectorAll('.video1');
        videos.forEach(video => {
            video.classList.toggle('hidden');
        });
    }
    function toggleExp() {
        const exps = document.querySelectorAll('.exp');
        exps.forEach(exp => {
            exp.classList.toggle('hidden'); 
        });
    }
</script>

</body>
</html>