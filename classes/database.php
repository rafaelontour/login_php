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

        public function verificar_login($email, $senha) {
            $PDO = $this -> getConexao();

            $sql = "SELECT id, nome, email, senha, qtd_anotacoes FROM usuarios WHERE email = ?";

            $stmt = $PDO -> prepare($sql);
            $stmt -> execute([$email]);

            $linha = $stmt -> fetch(PDO::FETCH_ASSOC);

            if ($linha == false) {
                header("Location: ../sistema/pages/login.php?status=0");
                die();
            }

            if (password_verify($senha, $linha["senha"])) {
                // Redireciona pra página inicial e inicia a sessão

                session_start();
                $_SESSION["usuario_id"] = $linha["id"];
                $_SESSION["usuario_nome"] = $linha["nome"];
                
                header("Location: ../sistema/pages/inicio.php");
                die();
            } else {
                header("Location: ../sistema/pages/login.php?status=1");
                die();
            }
            
        }

        public function adicionarAnotacao($titulo, $anotacao, $usuario) : bool {
            $r = false;

            try {
                $PDO = $this -> getConexao();
    
                $sql = "INSERT INTO anotacoes (titulo, id_usuario, anotacao) VALUES (?, ?, ?)";
    
                $stmt = $PDO -> prepare($sql);
    
                $stmt -> execute([$titulo, $usuario, $anotacao]);

                session_start();

                $sql = "UPDATE usuarios SET qtd_anotacoes = qtd_anotacoes + 1 WHERE id = ?";

                $stmt = $PDO -> prepare($sql);

                $stmt -> execute([$usuario]);

                $r = true;
                
            } catch(PDOException $e) {
                $r = false;
                echo "Erro: " . $e -> getMessage();
            }

            return $r;
        }
    }
