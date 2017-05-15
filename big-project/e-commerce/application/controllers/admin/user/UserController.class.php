<?php
//Admin
class UserController
{
    public function httpGetMethod()
    {
        return [ '_form' => new AdminUserForm() ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        try
        {
            // Inscription de l'utilisateur.
            $userAccountModel = new UserAccountModel();
            $userAccountModel->create
            (
            $formFields['email'],
            $formFields['password']
            );

        // Redirection vers la page d'accueil.
            $http->redirectTo('/admin');
        }

        catch(DomainException $exception)
        {
            // Réaffichage du formulaire avec un message d'erreur.
            $form = new AdminUserForm();
            $form->bind($formFields);
            $form->setErrorMessage($exception->getMessage());

            return [ '_form' => $form ];
        }
    }
}
