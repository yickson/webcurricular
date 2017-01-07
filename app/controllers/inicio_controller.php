<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class InicioController extends AppController
{

    public function index()
    {
        Redirect::to('index/');
    }

    public function yickson()
    {
      //
    }

    public function blog($page = 1)
    {
      $noticia = new Noticias;
      $this->noticias = $noticia->ver($page);
    }

    public function contacto()
    {
      //Contacto
      if(Input::hasPost('motivo')){
        $nombre = Input::post('nombre');
        $correo = Input::post('correo');
        $motivo = Input::post('motivo');

        $respuesta = Correo::informacion($nombre, $correo, $motivo);
        if($respuesta == 1){
          Flash::valid('Envío exitoso del formulario, le daré respuesta a la brevedad posible');
          Input::delete();
        }
        else{
          Flash::error('No se ha podido realizar el envio');
        }
      }
    }

}
