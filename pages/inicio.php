<?= session_start() ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Início</title>
    <style>
        #ola {
            text-align: center;
            margin: 40px;
        }

        #centro {
            display: flex;
            justify-content: flex-start;
            align-items: center ;
            flex-direction: column;
            margin: auto;
            min-height: 500px;
            width: 400px;
            background-color: cadetblue;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, .643);
        }

        a {
            display: block;
            width: 60px;
            height: 60px;
            text-decoration: none;
            margin: auto;
            line-height: 62px;
            color: gray;
            text-align: center;
            font-size: 40px;
            background-color: antiquewhite;
            margin-top: 30px;
            border: none;
            border-radius: 50%;
            transition: 0.2s;
            
        }

        a:hover {
            color: greenyellow;
            transform: scale(120%);
        }

        #escrever-anotacao {
            position: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            opacity: 0.5;
            background-color: black;
        }

        form {
            display: flex;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 10px;
            width: 400px;
            height: 500px;
            z-index: 1;
        }

        #ita {
            background-color: #BDB9B9;
            border-radius: 10px;
            padding: 10px;
            width: 320px;
            resize: none;
            border: none;
            box-shadow: 3px 3px 5px rgba(0, 0, 0, .6);
        }

    </style>
</head>
<body>
    <?php 
        include("../templates/headerLogin.php");
        
        echo "<h2 id='ola'>Olá, " . $_SESSION["usuario_nome"] . "!</h2>"
        
    ?>
    
    <div id="centro">
        <p style="color: white; margin: 30px; font-size: 25px; text-align: center;">
            Suas anotações
        </p>

        <div id="anotacoes">
            <?php if ($_SESSION["qtd_anotacoes"] == 0): ?>
                <p style="text-align: center; color: white; text-shadow: 2px 2px 2px rgba(0, 0, 0, .7)">
                    Você ainda não tem anotações.</br>
                    Clique no ícone abaixo para adicionar.
                </p>

                <div id="escrever-anotacao">
                    
                </div>

                <form action="../tratar_acao.php" method="POST">
                    <div>
                        <label for="itutulo">Título: </label>
                        <input type="text" name="titulo" id="titulo">
                    </div>
                    
                    <div>
                        <p style="margin-top: 5px; margin-bottom: 10px;">Digite aqui sua anotação:</p>
                        <textarea name="ta" id="ita" cols="30" rows="10"></textarea>
                    </div>

                    <input type="submit" value="Adicionar" style="">
                </form>

            <?php endif; ?>

            <a href="www.google.com" title="Adicionar anotação">
                +
            </a>
        </div>

    </div>

</body>
<?= include("../templates/footer.php") ?>
</html>