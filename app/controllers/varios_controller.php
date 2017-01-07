<?php

/**
 * Controller para los scripts
 *
 */
class VariosController extends AppController
{

    public function index()
    {
        Redirect::to('index/');
    }

    public function arbol()
    {
	//Arbol de navidad :D
      View::template('otro');
    }

}

