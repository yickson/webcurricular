<?php
class Email {
    /**
	 * Realiza el envio del correo.
	 *
	 * @param $destino correo receptor
	 */
    
    public static function enviar($nombre, $correo, $motivo){
        $header = "From:" . $from . "\nReply-To:" . $from . "\n";
        $header = $header . "X-Mailer:PHP/" . phpversion() . "\n";
        $header = $header . "Mime-Version: 1.0\n";
        $header = $header . "Content-Type: text/html";
        
        $asunto = "Entrevista de trabajo de ".$nombre;
        $html = $motivo;
        $from = $correo;
        mail($destino, $asunto, $html, $header) or die("Su mensaje no pudo enviarse.");
    }
}


<?