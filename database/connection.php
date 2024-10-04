<?php

$db_name = "pequenos_cientistas";
$host = "localhost";
$user = "root";
$password = "1234";

$conn = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
