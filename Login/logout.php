<?php
//Arquivo responsavel por efeturar o logour do usuario
session_start();
 //Esvazia a variavel SESSIO
$_SESSION = array();
//Destroi a SESSION
session_destroy();
//Redireciona para a pagina principal. Como nao existe usuario logado ao chegar em index.php
//seremos redirecionados para pagina de login
header('Location: index.php');
?>