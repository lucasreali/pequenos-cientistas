<?php

$routes = [
    // PAGES

    // geral
    '/' => 'pages/geral/home.php',
    '/login' => 'pages/geral/login.php',
    '/sobre' => 'pages/geral/sobre.php',
    '/contato' => 'pages/geral/contato.php',
    '/singup/quemevoce' => 'pages/geral/usertype-page.html',
    '/singup' => 'pages/geral/singup.php',
    '/informationsingup' => 'pages/geral/singup_second.php',

    // aluno

    '/aluno' => 'pages/aluno/aluno.php',

    // admin

    '/admin' => 'pages/admin/admin.php',

    // outros
    
    '/teste' => 'pages/teste.php',

    // MODELS
    '/ResponsavelModel'=> 'models/ResponsavelModel.php',
    '/AlunoModel'=> 'models/AlunoModel.php',
    '/ProfessorModel'=> 'models/ProfessorModel.php',
    '/ModelAdmin'=> 'models/AdminModel.php',
];