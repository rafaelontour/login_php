<?php 
   session_start();

   if (isset($_GET["linha"])) {
      try {
         require_once("db.php");
   
         $sql = "DELETE FROM anotacoes WHERE id_anotacao = ?";
         $sql2 = "SELECT id_usuario FROM anotacoes WHERE id_anotacao = ?";

         $stmt = $PDO -> prepare($sql2);
         $stmt -> execute([$_GET["linha"]]);

         $usuario = $stmt -> fetch(PDO::FETCH_ASSOC);

         $stmt = $PDO -> prepare($sql);
         $stmt -> execute([$_GET["linha"]]);

         $sql3 = "UPDATE usuarios SET qtd_anotacoes = qtd_anotacoes - 1 WHERE id = ?";

         $stmt = $PDO -> prepare($sql3);
         $stmt -> execute([$usuario["id_usuario"]]);

         header("Location: pages/inicio.php?removeu=true");
      } catch(PDOException $e) {
         echo "<script>alert('Falha ao remover. Tenter novamente.')</script>";
         header("Location: pages/inicio.php?removeu=falso");
      }
   } else if (!empty($_POST["ta"]) && !empty($_POST["titulo"])) {
      require("db.php");

      $r = $db -> adicionarAnotacao($_POST["titulo"], $_POST["ta"], $_SESSION["usuario_id"]);

      if ($r) {
         header("Location: ../sistema/pages/inicio.php?inseriu=true");
      } else {
         header("Location: ../sistema/pages/inicio.php?inseriu=false");
         
      }
   }