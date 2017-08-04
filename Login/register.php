<?php

//Arquivo responsavel por efetuar o cadastro de novos usuario

    //Iniciamos a SESSION
    session_start();
    //Iniciamos a conexao com o BD
    include('connect.php');
    //Estas variaves estao sendo guardadas na SESSION como forma de backup
    //para em caso de erro ao cadastrar os valores inseridos pelo usuario 
    //nao sao perdidos, evitando que o usuario tenha q digitar tudo novamente
    $_SESSION['signup_username']=$_POST['username'];
    $_SESSION['signup_email']=$_POST['email'];
    $_SESSION['signup_name']=$_POST['name'];
    $_SESSION['signup_address']=$_POST['address'];
    $_SESSION['signup_tel1']=$_POST['tel1'];
    $_SESSION['signup_tel2']=$_POST['tel2'];
    $_SESSION['signup_validcode']=$_POST['username'].$_POST['tel1'];
    
    //Efetua uma query procurando pelo usuario digitando
    //Isso é feito para verificar se tal usuario ou email ja forma usados em outra conta
    //OBS.: nesse siatem o usuario pode logar usando usuario ou email. Entao essas informaçoes devem ser unicas
    $query = $connection->prepare('select * from login where username = ? or email=?');

    $params = array($_POST['username'],$_POST['email']);

    $query->execute($params);

    $row = $query->fetch();
    //Somente se nao exister um usuario com o valor informado podemos prosseguir
    if(empty($row)){
        
        //Aqui é onde é feito o upload da imagem 
        if ( isset( $_FILES[ 'image' ][ 'name' ] )) {
            //Sao salvas informaçoes importantes sobre o arquivo, como o nome temporario,
            //o nome do arquivo original e a extensao do arquivo
            $tmp = $_FILES[ 'image' ][ 'tmp_name' ];
            $name = $_FILES[ 'image' ][ 'name' ];
            $extension = pathinfo ( $name, PATHINFO_EXTENSION );
            //Aqui é feita a verificaçao se o que esta sendo upado é de fato uma imagem
            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extension ) ) {
                //Aqui é gerado um nome unico para a imagem para evitar a criaçao de imagens com msm nome
                $newName = uniqid ( time () ) . '.' . $extension;
                //Aqui é definida a variavel que contem o caminho final do arquivo
                $dest = 'uploads / ' . $newName;
                //Aqui o arquivo é movido de fato
                if ( move_uploaded_file ( $tmp, $dest ) ) {
                    $_SESSION['signup_error']='Arquivo upado';
                //Caso haja algum erro durante algum desses processo uma mensagem de erro é gravada na
                //SESSION para ser exibida na pagina de formulario de cadastro
                }else{
                    $_SESSION['signup_error']='Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.<br />';
                    header('Location:signup.php');
                    exit;
                }
            }else{
                $_SESSION['signup_error']='Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
                header('Location:signup.php');
                exit;
            }
        }else{
            $_SESSION['signup_error']='Você não enviou nenhum arquivo!';
            header('Location:signup.php');
            exit;
        }
        //Este comando somente sera executa se o upload do arquivo foi realizado com sucesso
        //Aqui entao iremos de fato cadastar o novo usuario no BD usando todas as informaçoes fornecidas no form
        $query = $connection->prepare("INSERT INTO `login`(`username`, `email`, `pass`, `full_name`, `address`, `tel1`, `tel2`, `valid_code`,`image`) VALUES (?,?,?,?,?,?,?,?,?) ");
        
        
        
        $params=array($_POST['username'],
                      $_POST['email'],
                      //As senhas sao encriptografadas
                      crypt($_POST['password']),
                      $_POST['name'],
                     $_POST['address'],
                     $_POST['tel1'],
                     $_POST['tel2'],
                     $_POST['username'].$_POST['tel1'],
                     $dest);
                    
        
        if($query->execute($params)){
            $_SESSION['signup_error']='Usuario cadastrado com sucesso';
            //Se o cadstro foi efetuado entao seremos redirecionados para a pagina de envio de email de verificaçao
            header('Location:emailsend.php');
            exit;
        //Caso haja algum erro durante algum desses processo uma mensagem de erro é gravada na
        //SESSION para ser exibida na pagina de formulario de cadastro
        }else{
            $_SESSION['signup_error']='Erro ao cadastrar usuario '.$_POST['username'];
        }
        
    }else{
        $_SESSION['signup_error']='Usuario ja existe';
    }
    header('Location:signup.php');
    
?>