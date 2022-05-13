<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    public $email;
    public $name;
    public $token;

    public function __construct($name, $email, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }
    public function sendConfirmation()
    {
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'f65cc79a5c7bae';
        $phpmailer->Password = '44da01dd987367';

        $phpmailer->setFrom('admin@appsalon.com');
        $phpmailer->addAddress('admin@appsalon.com', 'AppSalon.com');
        $phpmailer->Subject = 'Confirma tu cuenta';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hola ". $this->name ."</strong> Has creado tu cuenta en App Salon, solo debes confirmala presionando el siguiente enlace</p>";
        $content .="<p>Presiona aquí: <a href='http://localhost:3000/confirm-account?token=". $this->token ."'>Confirmar Cuenta</a></p>";
        $content .= "<p>Si tu no solicitaste esta cuenta puedes ignorar el mensaje</p>";
        $content .= "</html>";

        $phpmailer->Body = $content;

        $phpmailer->send();
    }
    public function sendInstructions(){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = 'f65cc79a5c7bae';
        $phpmailer->Password = '44da01dd987367';

        $phpmailer->setFrom('admin@appsalon.com');
        $phpmailer->addAddress('admin@appsalon.com', 'AppSalon.com');
        $phpmailer->Subject = 'Restablece tu contraseña';

        $phpmailer->isHTML(TRUE);
        $phpmailer->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hola ". $this->name ."</strong> Has solicitado restablecer tu contraseña, sigue el siguiente enlace para hacerlo</p>";
        $content .="<p>Presiona aquí: <a href='http://localhost:3000/restore?token=". $this->token ."'>Restablecer Contraseña</a></p>";
        $content .= "<p>Si tu no solicitaste este cambio puedes ignorar el mensaje</p>";
        $content .= "</html>";

        $phpmailer->Body = $content;

        $phpmailer->send();
    }
}
