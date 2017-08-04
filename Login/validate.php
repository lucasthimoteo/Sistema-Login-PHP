<?php
//Arquivo responsavel por efeturar o login
//Aqui é verificado se o usuario e senha conferem

//Iniicia a SESSION
session_start();
//Conecta com o BD
include('connect.php');
//Guarda o que foi digitado pelo usuario no furmulario 
//para usar como backup caso haja algum erro duranto o login
$_SESSION['signin_username']=$_POST['username'];
//È efetuada uma query procurando pelo usuario digitado
$query=$connection->prepare('select * from login where username=? or email=?');

$params = array($_POST['username'],$_POST['username']);

if($query->execute($params)){
    $row=$query->fetch();
    //Aqui é verificado se a query retornou um resultado, se retornou entao este usuario existe
    if(!empty($row)){
        //Aqui é verificado se a senha digitada é igual a senha do usuario encontrado
        //obs.: as senhas sempre sao encriptografadas
        if(crypt( $_POST['password'], $row['pass']) === $row['pass'] ){
            //Aqui é verificado se esta conta ja foi verificada usando a verificçao por email
            if($row['active']==1){
                //Aqui o login foi bem sucedido, entao sao guardas as informaçoes do usuairo logado
                //na variavel SESSION, esta isformaçoes serao usadas no site inteiro
                $_SESSION['signin_error']='Usuario logado com sucesso';
                $_SESSION['logged']=true;
                $_SESSION['username']=$row['username'];
                $_SESSION['email']=$row['email'];
                $_SESSION['name']=$row['full_name'];
                $_SESSION['image']=$row['image'];
            //Caso haja algum erro durante algum desses processo uma mensagem de erro é gravada na
            //SESSION para ser exibida na pagina de formulario de login
            }else{
                $_SESSION['signin_error']='Usuario não validado';
            }
        }else{
            $_SESSION['signin_error']='Senha Incorreta ';
        }
    }else{
        $_SESSION['signin_error']='Usuario não encontrado';
    }
}else{
    $_SESSION['signin_error']='Erro ao logar';
}
header('Location:index.php');
?>