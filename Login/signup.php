<html>
    <head>
        <title>Cadastro</title>
    </head>
    <link rel="stylesheet" href="style.css">
    <body>
        <?php
            //Arquivo formulario para o usuario inserir od dados para efetuar o cadastro
            
            //Iniciamos a SESSION
            session_start();
            //Caso foi encontrado algum erro ao efetuar um cadastro anterior
            //é exibido o erro e esvaziado a variavel que guarda erros relacioandos ao cadastro
            if(isset($_SESSION)){
                if(isset($_SESSION['signup_error'])){
                    echo($_SESSION['signup_error']);
                    $_SESSION['signup_error']='';
                    
                }
                
                //Estas variaveis sao usadas pelo script JS ao fundo do arquivo para poder
                //reinserir os dados digitados pelo usuario numa tentativa de cadastro anterior
                //obs.:Isso é feito pois acessar a variavel _SESSION em JS é complicado devido as aspas (')
                $jsUsername='';
                if(isset($_SESSION['signup_username'])){
                     $jsUsername=$_SESSION['signup_username'];
                }  
                
                $jsEmail='';
                if(isset($_SESSION['signup_email'])){
                     $jsEmail=$_SESSION['signup_email'];
                }  
                
                $jsName='';
                if(isset($_SESSION['signup_name'])){
                     $jsName=$_SESSION['signup_name'];
                }
                
                $jsAddress='';
                if(isset($_SESSION['signup_address'])){
                     $jsAddress=$_SESSION['signup_address'];
                }  
                
                $jsTel1='';
                if(isset($_SESSION['signup_tel1'])){
                     $jsTel1=$_SESSION['signup_tel1'];
                } 
                
                $jsTel2='';
                if(isset($_SESSION['signup_tel2'])){
                     $jsTel2=$_SESSION['signup_tel2'];
                } 
            }
        ?><br>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            Usuario:<input type="text" name="username" id="username" required><br>
            E-mail:<input type="text" name="email" id="email" required ><br>
            Senha:<input type="password" id="pass" name="password" required ><br>
            Repita a senha:<input type="password" id="rep_pass" required ><br>
            Nome Completo:<input type="text" name="name" id="name" required ><br>
            Endereço:<input type="text" name="address" id="address" required ><br>
            Telefone 1:<input type="text" name="tel1" id="tel1" required ><br>
            Telefone 2:<input type="text" name="tel2" id="tel2" ><br>
            Foto:<input type="file" name="image" id="image" ><br>
            <button type="submit" disabled id="signupBtn">Cadastre-se</button><br>
        </form>
        <form action="signin.php" method="POST">
            <button type="submit">Voltar</button>
        </form>        
    </body>
    <script>
        //Aqui é verificado se a senha digitada confere com a reptiçao
        var rep = document.getElementById('rep_pass');
        rep.onblur = function(){
            if(document.getElementById('pass').value == document.getElementById('rep_pass').value){
                document.getElementById('signupBtn').disabled=false;
                rep.setAttribute('class','normalTextbox');
            }else{
                document.getElementById('signupBtn').disabled=true;
                rep.setAttribute('class','errorTextbox');
            }
        }
        //Aqui os valores digitas numa tentativa de login sao restaurados usando as variaveis criadas no inicio
        window.onload = function(){
            document.getElementById('username').value="<?php echo $jsUsername ; ?>";
            document.getElementById('email').value="<?php echo $jsEmail ; ?>";
            document.getElementById('name').value="<?php echo $jsName ; ?>";
            document.getElementById('address').value="<?php echo $jsAddress ; ?>";
            document.getElementById('tel1').value="<?php echo $jsTel1 ; ?>";
            document.getElementById('tel2').value="<?php echo $jsTel2 ; ?>";
        }
    </script>
</html>