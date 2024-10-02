<?php

require_once "../database/connection.php";

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

if (!empty($name) || !empty($email) || !empty($password)) {
    $sql = "INSERT INTO user (name, email, password) VALUES (':name', ':email', ':password')";
    $smt = $conn->prepare($sql);
    $smt->bindParam(":name", $name);
    $smt->bindParam(":email", $email);
    $smt->bindParam(":password", $password);

    $smt->execute();
    header("location:../");
} else {
    header("Location: ../");
}



