<?php
session_start();

echo '<h1>Você esta logado' . $_SESSION['user_id'] . '</h1>';