<html>
    <head>
        <title>Validação</title>
    </head>
        <link rel="stylesheet" href="style.css">
<body>
    <?php
    
        //Arquivo responsavel pela validaçao da conta do usuario apos receber o email de confirmaçao
    
    
        //Inicia a conexao com o BD
        include('connect.php');

        //Prepara e executa uma query para achar o usuario a ser verificado
        $query=$connection->prepare('select * from login where username=?');
    
        //A verificaçao é feita passando o nome de usuario pelo metodo GET a partir
        //de um link que foi enviado para o email do usuario
        $params = array($_GET['user']);

        if($query->execute($params)){
            $row=$query->fetch();
            if(!empty($row)){
                //Quando o usuario se cadastrou foi gerado um codigo de validação
                //esse codigo de validaçao é enviado pelo metodo codigo tambem e é aqui que verificamos 
                //se o codigo de verificaçao que veio do metodo get é o msm que foi salvo em BD no momento do cadastro
                if( $_GET['validcode'] === $row['valid_code'] ){
                    $query=$connection->prepare('update login set active=1 where username=?');
                    $params = array($_GET['user']);
                    if($query->execute($params)){
                        echo('validado');
                    }else{
                        echo('erro no update');
                    }
                }else{
                    echo('erro na autenticaçao');
                }
            }else{
                echo('Usuario não encontrado');
            }
        }else{
           echo('Erro SQL');
        }
    ?>
    <br>
    <a href="index.php">Clique aqui para continuar</a>  
</body>
</html>