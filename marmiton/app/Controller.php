<?php
/**
 * Created by PhpStorm.
 * User: miharizoravonison
 * Date: 17/01/2017
 * Time: 10:52
 */

namespace App;

class Controller
{
    protected $viewPath;
    protected $template;
    private $viewData;

    public function __construct()
    {
        $this->viewData =
            [
            'variable'=>
                [
                    'url' => $_SERVER['SCRIPT_NAME']
                ]
        ] ;
    }

    protected function render($view, $variables = [])
    {
        ob_start();
        extract($variables);
       require ($this->viewPath . str_replace('.','/',$view) . '.php') ;
       $content = ob_get_clean();
       require ($this->viewPath . 'templates/' . $this->template . '.php');

    }

    protected function forbidden()
    {
        header('HTTP/1.0 403 Forbidden');
        die('Accés interdit');
    }

    protected function notFound()
    {
        header('HTTP/1.0 404 Not Fount');
        die('Page introuvable');
    }
}