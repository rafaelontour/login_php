<?php

    require_once("../sistema/classes/database.php");

    $db = new Database();
    $PDO = $db -> getConexao();