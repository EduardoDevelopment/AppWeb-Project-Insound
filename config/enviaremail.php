<?php
// Incluir los archivos necesarios de PHPMailer desde la carpeta correosinfo
require 'correosinfo/Exception.php';
require 'correosinfo/PHPMailer.php';
require 'correosinfo/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreo($destinatario, $asunto, $cuerpo) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mediodechorizo@dg20.xyz';
        $mail->Password   = 'E<tAu*@4xjPyd!#tQ';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Utilizar SSL/TLS
        $mail->Port       = 465;

        // Configuración del correo
        $mail->setFrom('mediodechorizo@dg20.xyz', 'Eduardo y Alfredo');
        $mail->addAddress($destinatario);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        $mail->AltBody = strip_tags($cuerpo);

        // Enviar el correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
