<?php
    class Pessoa{
        private $pdo;

        //CONEXÃO COM O BANCO
        public function __construct($dbname, $host, $user, $senha){
            try{
                $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $senha);
            }catch(PDOException $e){
                echo "Erro com o banco de dados".$e->getMessage();
                exit();
            }catch(Exception $e){
                echo "Erro com o banco de dados".$e->getMessage();
                exit();
            }
        }

        //SELECT NA TABELA PESSOA
        public function buscarDados(){
            $res = array();
            $cmd = $this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
            $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }

        //FUNÇÃO PARA CADASTRAR PESSOAS NO BANCO DE DADOS
        public function cadastrarPessoa($nome, $telefone, $email){

            //VERIFICAR ANTES SE EMAIL JÁ EXISTE
            $cmd = $this->pdo->prepare("SELECT id FROM pessoa WHERE email = :e");
            $cmd->bindValue(":e",$email);
            $cmd->execute();

            if($cmd->rowCount() > 0){
                return false;
               // var_dump($cmd);
            }else{
                $cmd = $this->pdo->prepare("INSERT INTO pessoa (nome, telefone, email)
                                          VALUES (:n, :t, :e)");
                $cmd->bindValue(":n",$nome);
                $cmd->bindValue(":t",$telefone);
                $cmd->bindValue(":e",$email);
                $cmd->execute();

                return true;
            }
                        
        }

        //FUNCTION PARA EXCUIR PESSOA
        public function excluirPessoa($id){
            $cmd = $this->pdo->prepare("DELETE FROM pessoa WHERE id = :id");
            $cmd->bindValue(":id",$id);
            $cmd->execute();           
        }

        //FUNCTION PARA BUSCAR OS DADOS DA PESSOA
        public function buscarDadosPessoa($id){
            $resultado = array();
            $cmd = $this->pdo->prepare("SELECT * FROM pessoa WHERE id = :id");
            $cmd->bindValue(':id',$id);
            $cmd->execute();
            $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }

        //FUNCTION PARA ATUALIZAR DADOS DA PESSSOA
        public function atualizarDadosPessoa($id_upd, $nome, $telefone, $email){
            $cmd = $this->pdo->prepare("UPDATE pessoa SET nome = :n, telefone = :t, email = :e WHERE id = :id");
            $cmd->bindValue(':id',$id_upd);
            $cmd->bindValue(':n',$nome);
            $cmd->bindValue(':t',$telefone);
            $cmd->bindValue(':e',$email);
            $cmd->execute();
        }
    }
?>