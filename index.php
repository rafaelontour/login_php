<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?= include("templates/header.php"); ?>

    <form action="processar_formulario.php" method="POST">
        <fieldset>

            <h3>Insira seus dados</h3>

            <div>
                <label for="inome">Nome completo: <br /></label>
                <input type="text" name="nome" id="inome" max="60">
            </div>

            <div>
                <label for="iemail">Email: <br /></label>
                <input type="email" name="email" id="iemail">
            </div>

            <div>
                <label for="itel">Telefone: <br /></label>
                <input type="tel" name="tel" id="itel" pattern="^\(\d{2}\)9\d{4}-\d{4}$">
            </div>

            <div>
                <label for="isenha">Senha: <br /></label>
                <input type="password" name="senha" id="isenha" min="8" max="20">
            </div>

            <?php 
                if (isset($_GET['status']) && $_GET['status'] == 0) { 
                    echo "<p class='aviso'>Preencha todos os campos!</p>";
                } elseif (isset($_GET['status']) && $_GET['status'] == 1) {
                    echo "<p class='sucesso'>Cadastro bem sucedido!</p>";
                } elseif (isset($_GET["status"]) && $_GET["status"] == 2) {
                    echo "<p class='ja-cadastrado'>E-mail já cadastrado!</p>";
                }
            ?>

            <input type="submit" value="Cadastrar">
        </fieldset>
    </form>

</body>
<?= include("templates/footer.php"); ?>
</html>