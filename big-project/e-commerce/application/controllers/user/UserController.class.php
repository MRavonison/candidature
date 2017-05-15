<?php

// controle affichage donnée client

class UserController{

    public function httpGetMethod()
    {
        // Méthode appelée lorsque l'on fait une requête HTTP GET sur l'URL /
        return
            [
                '_form'=> new UserForm()
            ];
    }
    public function httpPostMethod(Http $http, array $formFields)
    {
        // $formFields correspond exactement à $_POST
        // exemple: $formFields['city]=$_POST['city']
        try
        {


            $userServiceModel= new UserServiceModel();
            $userServiceModel->signUp
            (
                $formFields['firstname'],
                $formFields['lastname'],
                $formFields['address'],
                $formFields['city'],
                $formFields['zipCode'],
                $formFields['phone'],
                $formFields['birthYear']. '-' .$formFields['birthMonth'] .'-'.$formFields['birthDay'],
                $formFields['email'],
                $formFields['password']
            );

            $http->redirectTo('/');
        }

        catch(DomainException $exception)
        {
            $form=new UserForm();
            $form->bind($formFields);
            $form->setErrorMessage($exception->getMessage());

            return
            [
                '_form'=>$form
            ];

        }
    }

}