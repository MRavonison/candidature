<?php

namespace App\Controllers;

use App\Model\CustomerModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController{

    private $container;

    public function __construct($container)
    {
        $this->container= $container;

    }

    public function userHome(RequestInterface $request,ResponseInterface $response)
    {
        $customerModel = new CustomerModel();
        $searchuser = $customerModel->searchuser();
        $this->container->view->render($response,'pages/userview.twig', array(
            'userdispo' =>$searchuser,
            'user' => $_SESSION['user'],
            'statut' => $_SESSION['statut'],
            'disponibility' => $_SESSION['disponibility']
        ));
    }

    public function userProfileView(RequestInterface $request,ResponseInterface $response)
    {
        $this->container->view->render($response,'pages/userProfilView.twig');
    }
}