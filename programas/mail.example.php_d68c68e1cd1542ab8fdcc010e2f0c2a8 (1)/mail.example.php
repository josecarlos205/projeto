​<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'SEU ENDERECO SMTP';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'SEU EMAIL';
$mail->Password = 'SUA SENHA';
$mail->SMTPSecure = false;
$mail->isHTML(true);
$mail->CharSet = 'UTF-8';
$mail->setFrom('SEU EMAIL​', "SEU NOME");
$mail->addAddress('EMAIL DO DESTINATARIO');
$mail->Subject = 'E-mail de teste';
$mail->Body = "<h1>EMail enviado com sucesso!</h1><p>Parabéns!! Deu tudo certo.</p>";

if($mail->send())
    echo "E-mail enviado com sucesso!!";
else
    echo "Falha ao enviar e-mail.";

?>