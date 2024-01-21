<?php 
    class Database {
        private $host = "localhost";
        private $dbname = "sistema";
        private $usuario = "root";
        private $senha = "";
        private $conexao;
        
        public function __construct() {
            try {
                $this -> conexao = new PDO("mysql:host=" . $this -> host . ";dbname=" . $this -> dbname, $this -> usuario, $this -> senha);

            } catch(PDOException $e) {
                echo "Erro ao conectar ao banco de dados: " . $e -> getMessage();
            }
        }

        # Gets

        public function getConexao() {
            return $this -> conexao;
        }

        public function verificar($email) : bool {

            $PDO = $this -> getConexao();

            $sql = "SELECT email FROM usuarios WHERE email = ?";
            $stmt = $PDO -> prepare($sql);

            $stmt -> execute([$email]);
            $res = $stmt -> fetchAll();

            $existe = false;

            foreach ($res as $item) {
                if ($item['email'] == $email) {
                    $existe = true;
                }
            }

            return $existe;
        }
    }
