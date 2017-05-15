<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class loginController{

    private  $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public  function loginHome(RequestInterface $request,ResponseInterface $response)
    {
        $this->container->view->render($response, 'pages/home.twig');
    }

    public  function logoutHome(RequestInterface $request,ResponseInterface $response)
    {
        session_destroy();
        $this->container->view->render($response, 'pages/home.twig');
    }
}