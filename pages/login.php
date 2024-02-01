<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>
<body>
    <?= include("../templates/headerLogin.php") ?>

    <form action="../verificar_login.php" method="POST">

        
        <fieldset>

            <h3>Insira seus dados</h3>

            <div>
                <label for="iemail">Email: <br /></label>
                <input type="email" name="email" id="iemail" required>
            </div>
            <div>
                <label for="isenha">Senha: <br /></label>
                <input type="password" name="senha" id="isenha" min="8" max="20">
            </div>

            <?php 
                if (isset($_GET['status']) and $_GET['status'] == 0) {
                    echo "<p class='ja-cadastrado'>E-mail não cadastrado!</p>";
                } else if (isset($_GET["status"]) and $_GET["status"] == 1) {
                    echo "<p class='aviso'>Senha incorreta!</p>";
                }
                
            ?>

            <input type="submit" value="Entrar">

        </fieldset>

        
    </form>
    
</body>

<?= include("../templates/footer.php") ?>

</html>