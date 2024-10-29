<?php

include "models/AdminModel.php";
session_start();

$AdminModel = new AdminModel();

$users = $AdminModel->getAllUsers();



?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <nav>
            <a href="/admin"><img src="assets/images/logo.svg" alt=""></a>

            <ul class="container">
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
                <li><a href="">Lorem</a></li>
            </ul>
        </nav>
    </header>

    <section>

        <form action="">

            

            <table class="container">
                <thead>
                    <tr>
                        <th>Nome:</th>
                        <th>Email:</th>
                        <th>CPF:</th>
                        <th>Tipo de Usuario:</th>
                        <th>ID na tabela:</th>
                        <th style="text-align: center;"> <input type="checkbox" onclick="toggleCheckboxes(this)"> </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><a href="/admin/infoUser?id=<?= $u['id'] ?>"><?= htmlspecialchars($u['name']) ?></a></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['cpf']) ?></td>
                            <td><?= htmlspecialchars($u['user_type']) ?></td>
                            <td><?= htmlspecialchars($u['user_id']) ?></td>
                            <td style="text-align: center;"> <input type="checkbox" name="select" value="<?= $u['id'] ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </form>
    </section>


    <script>
        function toggleCheckboxes(source) {
            const checkboxes = document.querySelectorAll('input[name="select"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
        }
    </script>

</body>

</html>