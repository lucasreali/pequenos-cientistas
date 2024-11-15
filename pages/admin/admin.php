<?php

session_start();
include "models/AlunoModel.php";
include "models/AulaModel.php";

if ($_SESSION['user_type'] != 'admin' || !isset($_SESSION['user_type'])) {
    header('Location: /');
    exit();
}

include "models/AdminModel.php";

$AdminModel = new AdminModel();

$users = $AdminModel->getAllUsers();
$teachersWithNotPermission = $AdminModel->getTeachersWithNotPermission();

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles/imports.css">
    <link rel="stylesheet" href="assets/styles/admin.css">
    <title>Admin Page</title>
</head>
<body>
<header>
    <nav>
        <a href="/admin"><img src="assets/images/logo.svg" alt=""></a>
        <ul class="container">
            <li><a href="/admin" style="color: white">Inicio</a></li>
            <li><a href="/admin">Conteúdo</a></li>
            <li><a href="/admin/newadmin">Novo Admin</a></li>
        </ul>
    </nav>
</header>

<main>
    <section>
        <div class="permissions">
            <h1>Professores sem Permissão</h1>
            <ul>
                <?php foreach ($teachersWithNotPermission as $teacher): ?>
                    <li>
                        <?= htmlspecialchars($teacher['name']); ?> 
                        
                        <div class="rigth-li">
                            <?= htmlspecialchars($teacher['email']); ?>
                            
                            <form action="controllers/AdminController.php" method="post">
                                <input type="hidden" name="id" value="<?= $teacher['id'] ?>">
                                <input type="hidden" name="crud_type" value="aprove">
                                <button><img src="assets/images/check.png" alt="aprovar"></button>
                            </form>
                            
                            <form action="controllers/AdminController.php" method="post">
                                <input type="hidden" name="id" value="<?= $teacher['id'] ?>">
                                <input type="hidden" name="crud_type" value="block">
                                <button><img src="assets/images/close.png" alt="negar"></button>
                            </form>
                            
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="table">
        <table>
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
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['cpf']) ?></td>
                            <td><a href="/admin/infoUser?id=<?= $u['id'] ?>"><?= htmlspecialchars($u['name']) ?></a></td>
                            <td><?= htmlspecialchars($u['user_type']) ?></td>
                            <td><?= htmlspecialchars($u['user_id']) ?></td>
                            <td style="text-align: center;"> <input type="checkbox" name="select" value="<?= $u['id'] ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </section>
</main>



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
