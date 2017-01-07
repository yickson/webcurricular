<?php
class Noticias extends ActiveRecord
{
  public function subida($titulo, $contenido, $archivo)
  {
    $imagen = Upload::factory($archivo, 'image');
    $imagen->setExtensions(array('jpg', 'png', 'gif'));
    if($imagen->isUploaded()){
      $nombre = $imagen->saveRandom();
      $ruta = PUBLIC_PATH.'img/upload/'.$nombre;
      $noticia = (new Noticias);
      $noticia->titulo = $titulo;
      $noticia->contenido = $contenido;
      $noticia->imagen = $ruta;
      $noticia->save();
      return 1;
    }
    else{
      return 2;
    }
  }
  
  public function modimagen($id, $archivo)
  {
    $noticia = (new Noticias)->find($id);
    if($noticia->imagen){
      $path = "/home/yicksonc/public_html" . $noticia->imagen; //Colocar la ruta absoluta donde se encuentra la imagen en tu servidor
      unlink($path);
    }
    $imagen = Upload::factory($archivo, 'image');
    $imagen->setExtensions(array('jpg', 'png', 'gif'));
    if($imagen->isUploaded()){
      $nombre = $imagen->saveRandom();
      $ruta = PUBLIC_PATH.'img/upload/'.$nombre;
      return $ruta;
    }
    else {
      //
    }
  }
  
  public function borrarnoticia($id)
  {
    $noticia = (new Noticias)->find($id);   
    $path = "/home/yicksonc/public_html" . $noticia->imagen;
    unlink($path);
    if($noticia->delete($id)){
      return true;
    }
    else{
      return false;
    }
  }

  public function ver($page, $ppage=2)
  {
    return $this->paginate("page: $page", "per_page: $ppage", 'order: id desc');
  }
}
?>