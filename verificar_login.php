<?php 

    require("includes/db.php");

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $db -> verificar_login($email, $senha);