<?php

include "models/AdminModel.php";
session_start();

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
            <li><a href="/admin">Inicio</a></li>
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
        <div class=""></div>
    </section>
</main>



<script src="assets/scripts/asyncAdmin.js"></script>
</body>
</html>
