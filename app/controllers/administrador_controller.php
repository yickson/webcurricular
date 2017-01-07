<?php
class AdministradorController extends AppController
{
//...
  public function index()
  {
    View::template(null);
    Redirect::to("administrador/inicio");
  }

  function before_filter()
  {
    //View::template('admin');
    $valido = New Usuario;

  }

  public function inicio()
  {
    $valido = New Usuario;
    if(!$valido->logged()){
      Redirect::to("administrador/entrar");
    }
      $this->nombre = Session::get('nombre', 'auth');
      $this->nivel = Session::get('nivel', 'auth');
  }

  function entrar()
  {
    if (Input::hasPost("correo", "clave")){
      $auth = New Usuario;
      if($auth->login()){
        Redirect::to("administrador/inicio");
      }
    }
  }

  public function registrar($num = NULL)
  {
    if($num == 'r3g1str4r'){
      if(Input::hasPost('correo')){
          if(Load::model('usuario')->registrar()){
            Redirect::to('administrador/inicio');
          }
        }
    }
    else{
      Redirect::to('administrador/entrar');
    }
  }

  public function cambiarpass($num = NULL)
  {
      if($num == 'c4mb14r'){
          if(Input::hasPost('correo')){
              if((New Usuario)->cambiar(Input::post('correo'))){
                  Redirect::to('administrador/inicio');
              }
              else{
                  Flash::error('No se pudo registrar el cambio de clave');
              }
          }
      }
  }

  public function cerrar()
  {
    View::template(null);
        (New Usuario)->logout();
        Redirect::to('administrador/entrar');
  }
}
?>