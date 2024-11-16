<html lang="pt-br">
<link rel="shortcut icon" href="assets/images/logo.svg" type="image/x-icon">


<?php
require_once "routes.php";

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (array_key_exists($url, $routes)) {
    require $routes[$url];
} else {
    require "pages/404.php";
};
?>

</html>