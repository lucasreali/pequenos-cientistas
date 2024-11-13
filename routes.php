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
    '/admin/infoUser'=> 'pages/admin/infoUser.php',
    '/admin/allUsers'=> 'pages/admin/allUsers.php',
    '/admin/newadmin'=> 'pages/admin/newadmin.php',


    // responsavel

    '/responsavel'=> 'pages/responsavel/responsavel.php',

    // outros
    
    '/teste' => 'pages/teste.php',

    // MODELS

    // API
    '/permission' => 'api/permission.php'
    
];