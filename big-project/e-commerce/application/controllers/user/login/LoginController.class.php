<?php

class LoginController{

    // controle du message d'erreur mail et password

    public function httpGetMethod()
    {
        return
        [
            '_form' => new LoginForm()
        ];
    }
    public function httpPostMethod(Http $http,array $formFields)
    {
        // Ajout d'une méthode qui va rattraper l'exception donc par :
        try
        {

            $userServiceModel   = new UserServiceModel();
            $userSession        =$userServiceModel->login(
                $formFields['e-mail'],
                $formFields['password']
            );

            if($userSession->isCustomer()==true)
                {
                    $http ->redirectTo('/');
                }
            else
                {
                    $http ->redirectTo('/admin');
                }

        }
        // puis rattrape (le type int dans catch est obligatoire):
        catch(DomainException $exception)
        {
            $form= new LoginForm(); // Création de la classes représentant le formulaire
            $form->bind($formFields); // Remplissage du formulaire avec les donnnés précedentes
            $form->setErrorMessage($exception->getMessage()); // indique quelle erreur afficher au dessus du formulaire

            return
            [
                '_form' =>$form
            ];
        }
    }
}