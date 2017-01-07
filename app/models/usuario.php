<?php

class Usuario extends ActiveRecord
{
    public function registrar()
    {
    	$usuario = Load::model('usuario');
      $usuario->nombre = Input::post('nombre');
    	$usuario->correo = Input::post('correo');
    	$usuario->clave = md5(Input::post('clave').'fr4s3');
    	if($usuario->save()){
    		Flash::valid('Guardado exitoso');
            Input::delete();
    	}
        else{
            Flash::error('No se pudo guardar');
        }
    }

    public function login()
    {
      $auth = Auth2::factory('model');
      $auth->setModel('usuario');
      $auth->setLogin('correo');
      $auth->setPass('clave');
      $auth->setAlgos('md5'); 
      $auth->setSessionNamespace('auth');
      $auth->setFields(array('id', 'nombre'));

      if($auth->identify()) return true;

      Flash::error($auth->getError());
      return false;
    }

    public function logout()
    {
      Auth2::factory('model')->logout();
    }

    public function logged()
    {
      return Auth2::factory('model')->isValid();
    }
}
?>
