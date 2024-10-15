<?php
session_start();
include "controllers/AlunoController.php";


$AlunoController = new AlunoController();
$aluno = $AlunoController->getUser($_SESSION['user_id']);


echo '<h1>' . $aluno['id'], $aluno['name'], $aluno['email'] . '</h1>';