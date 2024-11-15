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
    '/video' => 'pages/aluno/video.php',

    // professor
    '/professor' => 'pages/professor/professor_page.php',
    '/desafios_prof' => 'pages/professor/desafios_prof.php',

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