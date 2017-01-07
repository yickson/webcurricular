<?php

class NoticiasController extends AppController{

	public function index($page = 1)
	{
		$noticia = new Noticias;
		$this->noticias = $noticia->ver($page);
	}

	public function nuevo()
	  {
	    //subir noticias
	    if(Input::hasPost('titulo')){
	      $titulo = Input::post('titulo');
	      $contenido = Input::post('contenido');
	      $imagen = 'imagen';
	      $respuesta = (new Noticias)->subida($titulo, $contenido, $imagen);
	      if($respuesta == 1){
	        Flash::valid('Se ha subido exitosamente la noticia');
	        Input::delete();
	      }
	      else{
	        Flash::error('No se ha podido subir la noticia');
	      }
	    }
	  }

	//Metodo para modificar la noticia toma en cuenta si cambia o no la imagen
	public function editar($id)
	{
	    if(!(new Usuario)->logged()){
	             Redirect::to('administrador/entrar');
	        }
	        $noticias = (new Noticias)->find($id);
	        //se verifica si se ha enviado el formulario (submit)
	        if(Input::hasPost('id')){
	            $noticias->titulo = Input::post('titulo');
	            $noticias->contenido = Input::post('contenido');
	            if($_FILES['imagen']){
	              $nombre = "imagen";
	              $noticias->imagen = (new Noticias)->modimagen($id, $nombre);
	            }
	            if($noticias->save()){
	                 Flash::valid('Se ha modificado exitosamente');
	                //enrutando por defecto al index del controller
	                return Redirect::to('administrador/noticia');
	            } else {
	                Flash::error('Falló Operación');
	            }
	        } else {
	            //Aplicando la autocarga de objeto, para comenzar la edición
	            $this->noticias = (new Noticias)->find($id);
	        }
	}

	public function borrar($id)
	{
		View::template(null);
		//Borrar noticia implica borrar la imagen del servidor
		$noticias = new Noticias();
		if($noticias->borrarnoticia($id)){
			Flash::valid('Se ha eliminado la noticia');
		}
		else{
			Flash::error('No se ha eliminado la noticia');
		}
	}
}

?>