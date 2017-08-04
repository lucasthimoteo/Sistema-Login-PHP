<?php

//Arquivo que se encarregar de realizar a conexão com o banco de dados


//Se for a primeira conexao a ser feita com o BD inicia a variaver
//responsavel por verificar se algum usuario esta logado
if (!isset($_SESSION['logged'])){
    $_SESSION['logged']=false;
}

//Estas são as credenciais usadas para acessar o BD
//Um arquivo SQL irá se responsabilizar por criar este banco de dados e este usuario
//obs: é necessario que na sua maquina tenha um servidor localhosta como WAMP
$host='localhost';
$database='login_lucas_thimoteo';
$user='admin';
$password='admin';

try{
$connection = new PDO('mysql:host=' . $host . ';dbname='. $database, $user, $password);
}catch (PDOException $e) {
    print "Erro: " . $e->getMessage() . "<br/>";
    die();
}
?>



