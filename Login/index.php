<html>
    <head>
        <title>Principal</title>
    </head>
        <link rel="stylesheet" href="style.css">
    <body>
        <?php
        //Este arquivo é a pagina incial do site
        //Esta pagina so pode ser acessada qunado um usuario estiver logado
        //caso nao haja nenum usuario logado seremos redirecionados para a pagina de login
        session_start();
        if(isset($_SESSION['logged'])){
            if(!$_SESSION['logged']){
                header('Location:signin.php');
            }
        }else{
            header('Location:signin.php');
        }
        //Exibe a imagem que foi upada durante o cadastro
        echo " <img src = '" . $_SESSION['image'] . "' height='150px' width='200px'/>";
        ?>
        Ola <?php echo($_SESSION['name']); ?> <br>
        <a href="logout.php">Sair</a>
    </body>
</html>