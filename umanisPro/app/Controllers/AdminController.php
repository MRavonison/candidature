<?php

namespace App\Controllers;

use App\Model\CustomerModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdminController{

    private  $container;


    public function __construct($container)
    {
        $this->container = $container;
    }

    public function adminHome(RequestInterface $request,ResponseInterface $response)
    {
        $customerModel = new CustomerModel();
        $searchuser = $customerModel->searchuser();

       return $this->container->view->render($response, 'pages/adminview.twig', array(
            'data' => $searchuser,
            'user' => $_SESSION['user'],
            'statut' => $_SESSION['statut'],
            'disponibility' => $_SESSION['disponibility']
        ));
           // $this->container->view->render($response, 'pages/adminview.twig');
    }
}