<?php

require_once "../database/connection.php";

$email = $_POST["email"];
$password = $_POST["password"];

echo "$email: $password";