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
    <link rel="stylesheet" href="style.css">

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

        <button id="adicionar" onclick="popup()" title="Adicionar anotação">
            +
        </button>

        <div id="anotacoes">
            <div id="escrever-anotacao"></div>

            <?php if ($qtd_anotacoes == 0): ?>
                <p style="text-align: center; color: white; text-shadow: 2px 2px 2px rgba(0, 0, 0, .7); margin-bottom: 30px;">
                    Você ainda não tem anotações.</br>
                    Clique no ícone abaixo para adicionar.
                </p>

            <?php endif; ?>

            <form action="../tratar_acao.php" method="POST">
                <div>
                    <label for="ititulo">Título: </label>
                    <input type="text" name="titulo" id="ititulo" required>
                </div>
                
                <div>
                    <p style="margin-top: 5px; margin-bottom: 10px;">Digite aqui sua anotação:</p>
                    <textarea name="ta" id="ita" cols="30" rows="10" required></textarea>
                </div>

                <input type="submit" value="Adicionar">
            </form>


            <?php 
                require("../db.php");

                $sql = "SELECT titulo, anotacao, id_anotacao FROM anotacoes WHERE id_usuario = ?";
                
                $stmt = $PDO -> prepare($sql);
                $stmt -> execute([$_SESSION["usuario_id"]]);

                $linha = $stmt -> fetchAll(PDO::FETCH_ASSOC);

                foreach($linha as $dado):
            ?>

                <?php if ($qtd_anotacoes > 0): ?>

                    <div id="mostrar-anotacao">
                        <h3 class="exibir-anotacao" title="Clique para exibir a anotação"><?php echo $dado["titulo"]?></h3>
                        <button id="remover" onclick="window.location.href='../tratar_acao.php?linha=<?= $dado['id_anotacao'] ?>'">
                            <img src="../imagens/remover.svg" alt="Remover anotação" title="Remover anotação">
                        </button>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div id="popup-anotacao">
            <div id="fundo-meio">
                <h3 id="titulo">Título</h3>
                <p id="data">Data de criação: </p>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis fuga temporibus explicabo inventore esse nemo, ipsum assumenda corporis nobis. Nam soluta aut hic, recusandae eaque earum nulla eligendi. Totam, quia.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque excepturi totam sint ipsa, rem quae temporibus numquam expedita odit odio! Doloremque rerum, obcaecati ex aliquid temporibus a voluptates deserunt in.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius cupiditate quis optio quod voluptates mollitia explicabo neque quas est dolore! Aperiam corrupti deserunt adipisci quaerat ratione, possimus atque voluptates consequatur.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut assumenda, sapiente ducimus molestiae voluptate veritatis ad accusantium et nisi dolore est totam ipsam corporis saepe quia aspernatur eaque, vel ab.
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Est, recusandae voluptas quod consequatur suscipit a illo culpa necessitatibus soluta? Cumque officia rerum iusto minus nam accusamus! Ullam cupiditate incidunt suscipit!
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta natus, nobis voluptatem nam fugit esse neque. Maiores autem odit quos magnam dolores, dolorem saepe eaque architecto? Fugiat mollitia consequatur sequi?
                </div>
                
            </div>
        </div>
    </div>
    
</body>

<script>


    //document.getElementById('exibir-anotacao').addEventListener('click', function() {
    //    document.getElementById('popup-anotacao').style.display = 'block';
    // });
    
    var elementos = document.getElementsByClassName('exibir-anotacao');

    for (let i = 0; i < elementos.length;i++) {

        elementos[i].addEventListener('click', function() {
            document.getElementById('popup-anotacao').style.display = 'block';
        });
    }

    document.getElementById('popup-anotacao').addEventListener('click', function() {
        this.style.display = 'none';
    });

    document.getElementById("escrever-anotacao").addEventListener('click', function() {
        
        let form = document.getElementsByTagName('form')[0];

        this.style.display = 'none';
        form.style.display = 'none';
    });
    
    function popup() {
        let popup = document.getElementById('escrever-anotacao');
        let form = document.getElementsByTagName('form')[0];
        
        popup.style.display = 'block';
        form.style.display = 'flex';
    }
    
</script>

<?= include("../templates/footer.php") ?>
</html>