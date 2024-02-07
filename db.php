<?php

    require_once("classes/database.php");

    $db = new Database();
    $PDO = $db -> getConexao();