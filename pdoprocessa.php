<?php


    /***************************************************************************************************
    *                                      CONEXÃO COM O BANDO                                         *     
    ***************************************************************************************************/
	try{
        $pdo = new PDO ("mysql:dbname=mark1;host=localhost","root","");        
    } 
    catch(PDOException $e){
        echo "Erro com o banco de dados: ".$e->getMessege();
    }
    catch(Exception $e){
        echo "Erro generico: ".$e->getMessege(); 
    }

    
    /***************************************************************************************************
    *                                              INSERT                                              *     
    ***************************************************************************************************/
    //1 FORMA
     /**aceita a inserção de parâmetros metodos e variaveis*/

    /* $res = $pdo->prepare("INSERT INTO usuario(nome, estado)
                    VALUES(:n, :e)");
    //bindValue - efetua a substituição dos parametros por variaveis, string ou funçoes
    $res->bindValue(":n","GOD");
    $res->bindValue(":e","Na ativa");
    $res->execute();*/

    //bindParam - aceita apenas variaveis.
    //$test = "allan";
    //$res->bindParam("n:","$test");
    
    //2 FORMA
     /**manda o comando diretamente, sem parametros*/
    //$pdo->query("INSERT INTO usuario (nome, estado)
    //             VALUES ('JESUS','Na ativa')");

    /***************************************************************************************************
    *                                            DELETE                                                *     
    ***************************************************************************************************/
    //1 efetuando um delete na tabela usuário com PREPARE();

    /*$cmd = $pdo->prepare("DELETE FROM usuario WHERE id=:id");
    $id = 6;
    $cmd->bindValue(":id", $id);
    $cmd->execute();*/

    //2 efetuando um delete na tabela usuário com QUERY();
    /*$test = 8;
    $cmd = $pdo->query("DELETE FROM usuario WHERE id='$test'");*/


    /***************************************************************************************************
    *                                             UPDATE                                               *     
    ***************************************************************************************************/
    //1 efetuando um update na tabela usuário com PREPARE();

    /*$cmd = $pdo->prepare("UPDATE usuario SET nome = :n WHERE id=:id");
    $cmd->bindValue(":n", "Alex");
    $cmd->bindValue(":id", 9);
    $cmd->execute();*/

    //2 efetuando um update na tabela usuário com QUERY();
    //$cmd = $pdo->query("UPDATE usuario SET nome = ALAIDE WHERE id='8'");

    /***************************************************************************************************
    *                                             SELECT                                               *     
    ***************************************************************************************************/
    //1 efetuando um select na tabela usuário com PREPARE();

    $cmd = $pdo->prepare("SELECT * FROM usuario WHERE id = :id");
    $cmd->bindValue(":id", 1);
    $cmd->execute();
    
    /** TRANSFORMAÇÃO EM ARRAY**************************************************
     * 1 - fetch();     NESSE CASO DEVE AVER SOMENTE UMA LINHA DE RESULTADO.   *
     *                                                                         *
     * 2 - fetchAll();  QUANDO O RESULTADO FOR MAIS DE UMA LINHA.              *
     **************************************************************************/

    $resultado = $cmd->fetch(PDO::FETCH_ASSOC);
    //PDO::FETCH_ASSOC - parametro usado para que o arrey traga apenas a coluna e o resultado.

    /*echo "<pre>";
    print_r($resultado);
    echo "</pre>";

    var_dump($resultado);*/

    /***************************************************************************************************
    *                                        PERCORRER O ARREY                                         *     
    ***************************************************************************************************/
    foreach ($resultado as $key => $value){
        echo $key.": ".$value."<br>";
    }



?>
