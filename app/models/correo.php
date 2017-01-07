<?php
class Correo {

    public static function informacion($nombre, $correo1, $motivo)
    {
      //Método para enviar correo mediante PHPMailer
      Load::lib('PHPMailerAutoload');
      //Inicio de la clase de phpmailer
      $correo = new PHPMailer(true);
      $correo->setFrom($correo1);
      $correo->addAddress('sistemas@yickson.com.ve');     // Add a recipient
      $correo->addReplyTo($correo1);
      $correo->isHTML(true);                                  // Set email format to HTML

      $correo->Subject = 'Motivo de entrevista de parte de: '.$nombre;
      $correo->Body = $motivo;
      if(!$correo->send()) {
          Return 2; //No se envio el correo
      } else {
          Return 1; //Se envio el correo
      }
    }
  }
