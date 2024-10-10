<?php
require_once "routes.php";
require_once "database/connection.php";
require_once "controllers/alunoController.php";

$db = new Database();
$conn = $db->connect();

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($url, $routes)) {
    require $routes[$url];
} else {
    require "pages/404.php";
};