<?php


namespace MyApp\Controllers;

class BaseController 
{
    protected $view;

    public function __construct($view)
    {
        $this->view = $view;
    }

    public function mmostrarHeader()
    {
        $this->view->header();
    }

    public function mostrarFooter()
    {
        $this->view->footer();
    }


}
