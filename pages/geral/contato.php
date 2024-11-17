<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/contato.css">
    <title>Contato</title>
</head>

<body>

    <header>
        <nav>
            <a href="/"><img src="../assets/images/logo.svg" alt=""></a>
            <div class="menu-wrapper container">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="/contato">Contato</a></li>
                </ul>

                <a href="/login">Login</a>
            </div>
        </nav>
    </header>


    <section>

        <div class="box-contato">
            <div class="message">

                <h1>Contato:</h1>

                <form action="/contato">

                    <div class="input-wrapper">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Digite aqui" required>
                    </div>

                    <div class="input-wrapper">
                        <label for="text-area">Digite sua mensagem</label>
                        <textarea name="message" required placeholder="Digite aqui"></textarea>
                    </div>

                    <button type="submit">Enviar</button>
                </form>

            </div>

            <div class="info-contato">

                <h2>Informações para contato:</h2>

                <ul>
                    <li>
                        <div class="user-wrapper">
                            <img src="https://avatar.iran.liara.run/public/boy" alt="" style="height: 30px;">
                            <h3>Clodoaldo Rodrigues</h3>
                        </div>
                        <p> ullam? Ex excepturi ab doloribus cum illum dolores quis velit eum voluptatem asperiores?</p>
                        <p>Email: clodoaldorodrigues@gmail.com</p>
                    </li>

                    <li>
                        <div class="user-wrapper">
                            <img src="https://avatar.iran.liara.run/public/girl" alt="" style="height: 30px;">
                            <h3>Maria Fernanda</h3>
                        </div>
                        <p> ullam? Ex excepturi ab doloribus cum illum dolores quis velit eum voluptatem asperiores?</p>
                        <p>Email: mariafernanda@gmail.com</p>
                    </li>

                    <li>
                        <div class="user-wrapper">
                            <img src="https://avatar.iran.liara.run/public/" alt="" style="height: 30px;">
                            <h3>Rafael Dias</h3>
                        </div>
                        <p> ullam? Ex excepturi ab doloribus cum illum dolores quis velit eum voluptatem asperiores?</p>
                        <p>Email: rafaeldias@gmail.com</p>
                    </li>

                </ul>
            </div>
        </div>

    </section>
</body>

</html>