<?php 

    $validar = true;

    foreach ($_POST as $key => $value) {

        if (empty($value)) {
            $validar = false;
            break;
        }
    }

    if (!$validar) {
        header('Location: index.php?status=0');
        exit();
    }

    try {
        include("classes/database.php");
        include("includes/db.php");

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $telefone = $_POST["tel"];
        $senha = $_POST["senha"];

        $PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $res = $db -> verificar($email);

        if ($res) {
            header('Location: index.php?status=2');
            exit();
        }

        $sql = "INSERT INTO usuarios (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";

        $stmt = $PDO -> prepare($sql);

        $stmt -> execute([$nome, $email, $telefone, $senha]);

        header('Location: index.php?status=1');


    } catch(PDOException $e) {
        echo "Erro ao inserir no banco de dados: " . $e -> getMessage();
    }
