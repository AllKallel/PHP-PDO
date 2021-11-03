<?php
    require_once "classe-pessoa.php";
    $p = new Pessoa("mark1","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="utf8">
        <title>CRUD - PESSOA</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>

        <?php
            if(isset($_POST['nome'])){
                //QUANDO CLICOU NO BOTÃO EDITAR OU CADASTRAR

                    /** ------------------------EDITAR----------------------------- */

                        if(isset($_GET['id_up']) && !empty($_GET['id_up'])){

                            $id_upd = addslashes($_GET['id_up']);
                            $nome = addslashes($_POST['nome']);
                            $telefone = addslashes($_POST['telefone']);
                            $email = addslashes($_POST['email']);

                            if(!empty($nome) && !empty($telefone) && !empty($email)){
                                //ATUALIZANDO DADOS PESSOA                
                                $p->atualizardadosPessoa($id_upd, $nome, $telefone, $email);
                                header("location: index.php");                                
                            
                            }else {
                                ?>
                                <div>
                                    <img src="img/aviso.png">
                                    <h4>PREENCHA TODOS OS CAMPOS<h4>
                                </div>
                                <?php
                            }

                        /** -------------------CADASTRAR-------------------------- */
                        }else{
                            $nome = addslashes($_POST['nome']);
                            $telefone = addslashes($_POST['telefone']);
                            $email = addslashes($_POST['email']);

                            if(!empty($nome) && !empty($telefone) && !empty($email)){
                            //CADASTRANDO PESSOA                
                            if(!$p->cadastrarPessoa($nome, $telefone, $email)){
                                ?>
                                <div class="aviso">
                                    <img src="img/aviso.png">
                                    <h4>PREENCHA TODOS OS CAMPOS<h4>
                                </div>
                                <?php
                            }
                            }else {
                                ?>
                                <div class="aviso">
                                    <img src="img/aviso.png">
                                    <h4>PREENCHA TODOS OS CAMPOS<h4>
                                </div>
                                <?php
                            }
                        }                        
            }
        ?>

        <?php         
            //QUANDO A VARIAVEL ID_UP É ENVIADA PELO BOTÃO EDITAR
            if(isset($_GET['id_up'])){
                $id_update = addslashes($_GET['id_up']);
                $res = $p->buscarDadosPessoa($id_update);
            }   
        ?>

        <section id="esquerda">

            <form method="POST">

                <h2>CADASTRAR PESSOA</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($res)){ echo $res['nome'];} ?>">

                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];} ?>">

                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php if(isset($res)){echo $res['email'];} ?>">

                <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";} ?>">

            </form>

        </section>
        
        <section id="direita">

            <table>
                
                <tr id="titulo">
                    <td>NOME</td>
                    <td>TELEFONE</td>
                    <td colspan="2">EMAIL</td>
                </tr>

                
                <?php //LISTA OS DADOS NA TELA
                    $dados = $p->buscarDados(); 
                    if(count($dados) > 0){
                        for($i=0; $i < count($dados); $i++){
                            echo "<tr>";
                                foreach($dados[$i] as $k => $v){
                                    if($k != "id"){
                                        echo"<td>".$v."</td>";
                                    }                            
                                }
                                ?>
                                <td>
                                <a href="index.php?id_up=<?php echo $dados[$i]['id'];?>" >Editar</a>
                                <a href="index.php?id=<?php echo $dados[$i]['id'];?>" >Excluir</a>
                                </td>
                                <?php
                            echo "</>";
                        }
                    }else {
                        
                    }
                ?>     
                
            </table>
                <div class="aviso">
                    <h4>AINDA NÃO HÁ PESSOAS CADASTRADAS<h4>
                </div>

        </section>

    </body>

</html>

<?php
    //QUANDO A VARIÁVEL ID É ENVIADA PELO BOTÃO EXCLUIR
    if(isset($_GET['id'])){
        $id_pessoa = addslashes($_GET['id']);
        $p->excluirPessoa($id_pessoa); 
        header("location:index.php");  
    }
?>