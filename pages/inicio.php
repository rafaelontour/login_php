<?php 
    session_start();
    if (isset($_GET["inseriu"])) {
        if ($_GET["inseriu"] == true) {
            echo "<script>alert('Sua anotação foi inserida com sucesso!')</script>";
        } else {
            echo "<script>alert('Falha ao inserir anotação! Tente de novo.')</script>";
        }

    }    
    require_once("../db.php");

    $stmt = $PDO -> prepare("SELECT qtd_anotacoes FROM usuarios WHERE id = ?");

    $stmt -> execute([$_SESSION["usuario_id"]]);

    $linha = $stmt -> fetch(PDO::FETCH_ASSOC);

    $qtd_anotacoes = $linha["qtd_anotacoes"];

    echo $qtd_anotacoes;
?>

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

        button#adicionar {
            display: block;
            width: 60px;
            height: 60px;
            text-decoration: none;
            margin: auto;
            margin-bottom: 45px;
            line-height: 62px;
            color: gray;
            text-align: center;
            font-size: 40px;
            background-color: antiquewhite;
            border: none;
            border-radius: 50%;
            transition: 0.2s;
            
        }

        button#adicionar:hover {
            color: greenyellow;
            transform: scale(120%);
            cursor: pointer;
        }

        #escrever-anotacao {
            position: fixed;
            display: none;
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
            display: none;
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

        #mostrar-anotacao {
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: 300px;
            height: 80px;
            background-color: aliceblue;
            margin-top: 20px;
            border-radius: 5px;
        }

        #mostrar-anotacao > h3 {
            font-size: 20px;
            margin-left: -40px;
            padding-left: 5px;
            border-left: 5px solid greenyellow;

        }

        #mostrar-anotacao > button {
            margin-right: -40px;
            border: none;
            cursor: pointer;
            padding: 5px;
            background-color: whitesmoke;
            border-radius: 5px;
            transition: 0.2s;
        }

        #mostrar-anotacao > button:hover {
            background-color: red;
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
            <div id="escrever-anotacao"></div>

            <?php if ($qtd_anotacoes == 0): ?>
                <p style="text-align: center; color: white; text-shadow: 2px 2px 2px rgba(0, 0, 0, .7); margin-bottom: 30px;">
                    Você ainda não tem anotações.</br>
                    Clique no ícone abaixo para adicionar.
                </p>

                <form action="../tratar_acao.php" method="POST">
                    <div>
                        <label for="itutulo">Título: </label>
                        <input type="text" name="titulo" id="ititulo" required>
                    </div>
                    
                    <div>
                        <p style="margin-top: 5px; margin-bottom: 10px;">Digite aqui sua anotação:</p>
                        <textarea name="ta" id="ita" cols="30" rows="10" required></textarea>
                    </div>

                    <input type="submit" value="Adicionar">
                </form>
                

            <?php endif; ?>

            <button id="adicionar" onclick="popup()" title="Adicionar anotação">
                +
            </button>

            <?php 
                require("../db.php");

                $sql = "SELECT titulo, anotacao FROM anotacoes WHERE id_usuario = ?";
                
                $stmt = $PDO -> prepare($sql);

                $stmt -> execute([$_SESSION["usuario_id"]]);

                $linha = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                foreach($linha as $dado):
            ?>

            <?php if ($qtd_anotacoes > 0): ?>

                <div id="mostrar-anotacao">
                    <h3><?php echo $dado["titulo"]?></h3>
                    <button id="remover">
                        <img src="../imagens/remover.svg" alt="Remover anotação" title="Remover anotação">
                    </button>
                </div>

            <?php endif; ?>

            <?php endforeach; ?>
           
        </div>

    </div>
    
</body>

<script>
    document.getElementById("escrever-anotacao").addEventListener('click', function() {
        
        let form = document.getElementsByTagName('form')[0];
        let fundoCinza = document.getElementById("escrever-anotacao");

        fundoCinza.style.display = 'none';
        form.style.display = 'none';
    });
    
    function popup() {
        let popup = document.getElementById('escrever-anotacao');
        let form = document.getElementsByTagName('form')[0];
        console.log("funcionando");
        popup.style.display = 'block';
        form.style.display = 'flex';
    }
    
</script>


<?= include("../templates/footer.php") ?>
</html>