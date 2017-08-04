<html>
    <head>
        <title>Validação</title>
    </head>
        <link rel="stylesheet" href="style.css">
    <body>
        <?php
        //Este arquivo é responsavel pelo envio do email de verificaçao da conta de usuario
        
        session_start();
        
        //Informaçoes necessarias para enviar o email
        //Esta variavel é o destinatario
        $to = $_SESSION['signup_email'];
        //Esta variavel é o assunto
        $subject = "Validação Login";
        //Esta variavel é mensagem que é enviada de fato
        //A mensagem é uma pagina HTML que possui um link de ativaçao
        //Este link de ativaçao é construido de forma que possa ser usado pelo arquivo emailreceive.php
        //que usará as variaves de _GET para efetuar a validaçao final
        $message = "
        <html>
        <head>
        </head>
        <body>
        clique no link para ativar seu email<br>
        <br>
        <a href='http://localhost/Login/emailreceive.php?validcode=".$_SESSION['signup_validcode']."&user=".$_SESSION['signup_username']."'>Link de ativação</a>
        </body>
        </html>
        ";
            
        //Esta variavel guarda informaçoes importantes sobre o envio do email
        //OBS.: para poder enviar email usando o protocolo SMTP em seu localhost é necessario possuir um servidor SMTP em sua maquina
        //Um exemplo do que pode ser usado é a extensao senmail que esta no repositorio GIT junto com todos os arquivos
        $headers  = 'From: flarsclan@gmail.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
        //Aqui o email é enviado de fato
        if(mail($to, $subject, $message, $headers)){
            echo('Um email de validaçao foi enviado para '.$_SESSION['signup_email']);
        }else{
            echo('Erro ao enviar email de verificação');
        }
        ?>
        <br>
        <a href="index.php">Clique aqui para continuar</a>        
    </body>
</html>