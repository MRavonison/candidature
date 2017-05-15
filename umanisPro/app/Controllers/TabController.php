<?php

namespace App\Controllers;

use App\Model\CustomerModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


class TabController{

    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function tabHome(RequestInterface $request,ResponseInterface $response)
    {
        $customerModel = new CustomerModel();
        $searchunassignedtask = $customerModel->searchunassignedtask();
        $searchuser = $customerModel->searchuser();
        $userTasks = $customerModel->userTask();


        if ($_SESSION['id'] == NULL)
        {
            return $response->withStatus(302)->withHeader('Location', 'auth');
        }
        else
        {
            $this->container->view->render($response, 'pages/tabview.twig', array(
                'userdispo' =>$searchuser,
                'task' => $searchunassignedtask,
                'userTasks'=> $userTasks,
                'user' => $_SESSION['user'],
                'statut' => $_SESSION['statut'],
                'disponibility' => $_SESSION['disponibility']
            ));
        }
    }




    public function getauth(RequestInterface $request,ResponseInterface $response)
    {
        $this->container->view->render($response, 'pages/login.twig');
    }



    public function postauth(RequestInterface $request,ResponseInterface $response)
    {

        $compte = $request->getParam('user');

        $customerModel = new CustomerModel();
        $customers     = $customerModel->findByCompte($compte);
        $_SESSION['id'] = $customers[0]['id'];
        $_SESSION['statut'] = $customers[0]['statut'];
        $_SESSION['user'] = $customers[0]['compte'];

        if ($customers[0]['disponibility'] == 0)
        {
            $_SESSION['disponibility'] = 'Available';
        }
        elseif ($customers[0]['disponibility'] == 1)
        {
            $_SESSION['disponibility'] = 'holidays';
        }
        elseif ($customers[0]['disponibility'] == 2)
        {
            $_SESSION['disponibility'] = 'sick';
        }
        elseif ($customers[0]['disponibility'] == 3)
        {
            $_SESSION['disponibility'] = 'other';
        }



       if ($request->getParam('user') == '' || $request->getParam('password') == '')
        {
            return $response->withStatus(302)->withHeader('Location', 'auth');
        }
        else if ($customers[0]['pass'] == $request->getParam('password') )
        {
            if ($_SESSION['statut'] == 1)
            {
                return $response->withStatus(302)->withHeader('Location', 'admin');
            }
            else
            {
                return $response->withStatus(302)->withHeader('Location', 'user');
            }
        }
        else
        {
            return $response->withStatus(302)->withHeader('Location', 'auth');
        }
    }


    public function getcreateuser(RequestInterface $request,ResponseInterface $response)
    {
        $this->container->view->render($response, 'pages/createuser.twig');
    }

    public function postcreateuser(RequestInterface $request,ResponseInterface $response)
    {

        $customerModel = new CustomerModel();
        $nameuser = $request->getParam('nameUser');
        $firstNameUser = $request->getParam('firstNameUser');
        $emailUser = $request->getParam('emailUser');
        $passwordUser = $request->getParam('passwordUser');
        $statut = $request->getParam('optionsRadios');

        $customers     = $customerModel->adduser($statut, $nameuser, $firstNameUser, $emailUser, $passwordUser);
        return $response->withStatus(302)->withHeader('Location', 'admin');
    }


    public function getcreatetask(RequestInterface $request,ResponseInterface $response)
    {
        $this->container->view->render($response, 'pages/createtask.twig');
    }



    public function postcreatetask(RequestInterface $request,ResponseInterface $response)
    {
        $customerModel = new CustomerModel();

        $nametask = $request->getParam('nameTask');
        $nameSociety = $request->getParam('nameSociety');
        $deliveryDate = $request->getParam('deliveryDate');
        $priorityServ = $request->getParam('priorityServ');
        $optionsRadios = $request->getParam('optionsRadios');
        $customers     = $customerModel->addtask($nametask, $nameSociety, $deliveryDate, $priorityServ, $optionsRadios);
        return $response->withStatus(302)->withHeader('Location', 'admin');
    }

}