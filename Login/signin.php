<html>
    <head>
        <title>Login</title>
    </head>
        <link rel="stylesheet" href="style.css">
    <body>
        <?php
            //Arquivo formulario para o usuario inserir od dados para efetuar o login
            
            //Iniciamos a SESSION
            session_start();
            //Caso foi encontrado algum erro ao efetuar um login anterior
            //é exibido o erro e esvaziado a variavel que guarda erros relacioandos ao login
            if(isset($_SESSION)){
                if(isset($_SESSION['signin_error'])){
                    echo($_SESSION['signin_error']);
                    $_SESSION['signin_error']='';
                }
                //Esta variavel sera usado pelo script JS ao fundo do arquivo para poder
                //reinserir os dados digitados pelo usuario numa tentativa de login anterior
                //obs.:Isso é feito pois acessar a variavel _SESSION em JS é complicado devido as aspas (')
                $jsUsername='';
                if(isset($_SESSION['signin_username'])){
                     $jsUsername=$_SESSION['signin_username'];
                }  
            }
        ?><br>
        <form action="validate.php" method="POST">
            Usuario ou E-mail:<input type="text" name="username" id="username" required><br>
            Senha:<input type="password" name="password" id="password" required><br>
            <button type="submit">Entrar</button><br>
        </form>
        <form action="signup.php" method="POST">
            <button type="submit">Cadastre-se</button>
        </form>        
    </body>
    <script>
        //Aqui os valores digitas numa tentativa de login sao restaurados usando as variaveis criadas no inicio
        window.onload = function(){
            document.getElementById('username').value="<?php echo $jsUsername ; ?>";
        }
    </script>
</html>