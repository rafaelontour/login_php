<?php 
   session_start();

   if (isset($_GET["linha"])) {
      echo "funcioou";

   } else if (!empty($_POST["ta"]) && !empty($_POST["titulo"])) {
      require("db.php");

      echo "funcionou";

      $r = $db -> adicionarAnotacao($_POST["titulo"], $_POST["ta"], $_SESSION["usuario_id"]);

      if ($r) {
         header("Location: ../sistema/pages/inicio.php?inseriu=true");
      } else {
         header("Location: ../sistema/pages/inicio.php?inseriu=false");
         
      }
   }