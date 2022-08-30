<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $nombre;
    public $token;


    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    private static function crearObjEmail()
    {
        //Crear objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host       = 'smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = '89250a7cd94aed';
        $mail->Password   = 'e151121efc78ea';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 2525;

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'Appsalon.com');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        return $mail;
    }

    public function enviarConfirmacion()
    {
        $mail = self::crearObjEmail();

        $mail->Subject = 'Confima tu cuenta de Appsalon';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> has creado tu cuenta en 
        appsalon, solo falta confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'> 
        Confirma Cuenta</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este email</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }

    public function enviarInstrucciones()
    {
        $mail = self::crearObjEmail();

        $mail->Subject = 'Reestablecer Password Appsalon';

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> has solicitado 
        reestablecer tu contraseña visita el siguiente elace para hacerlo:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recover?token=" . $this->token . "'> 
        Reestablecer password</a></p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignorar este email</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}
