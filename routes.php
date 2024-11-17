<?php

$routes = [
    // PAGES

    // geral
    '/' => 'pages/geral/home.php',
    '/login' => 'pages/geral/login.php',
    '/contato' => 'pages/geral/contato.php',
    '/singup/quemevoce' => 'pages/geral/usertype-page.html',
    '/singup' => 'pages/geral/singup.php',
    '/informationsingup' => 'pages/geral/singup_second.php',

    // aluno

    '/aluno' => 'pages/aluno/aluno.php',
    '/video' => 'pages/aluno/video.php',
    '/desafios_aluno' => 'pages/aluno/desafios_aluno.php',
    '/desafio_correct' => 'pages/aluno/desafio_correct.php',
    '/desafio' => 'pages/aluno/desafio_aplicado.php',

    // professor
    '/professor' => 'pages/professor/professor_page.php',
    '/desafios_prof' => 'pages/professor/desafios_prof.php',
    '/new_desafio' => 'pages/professor/new_desafio.php',

    // admin

    '/admin' => 'pages/admin/admin.php',
    '/infoUser'=> 'pages/admin/infoUser.php',
    '/allUsers'=> 'pages/admin/allUsers.php',
    '/newadmin'=> 'pages/admin/newadmin.php',


    // responsavel

    '/responsavel'=> 'pages/responsavel/responsavel.php',

    // outros
    
    '/teste' => 'pages/teste.php',

    // MODELS

    // API
    '/permission' => 'api/permission.php'
    
];