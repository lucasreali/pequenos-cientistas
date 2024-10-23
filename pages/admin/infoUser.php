<?php

include 'models/AdminModel.php';

$AdminModel = new AdminModel();

$user_id = $_GET['id'];
$usertype = $AdminModel->getUserTypeById($user_id);

echo $usertype;

