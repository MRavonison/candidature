<?php
// controle stockage du produit

class MealController{

    public function httpGetMethod()
    {

    }

    public function httpPostMethod(Http $http,array $formFields)
    {
        if($http->hasUploadedFile('picture')==true)
        {
            $photo=$http->moveUploadedFile('picture','/images/meals');

        }
        else
        {
           $photo='no-photo.png';
        }
        $mealModel= new MealModel();
        $mealModel->create(
            $formFields['name'],// mettre les names présent dans le html
            $formFields['description'],
            $photo,
            $formFields['initialStock'],
            $formFields['buyPrice'],
            $formFields['salePrice']
        );

        $http->redirectTo('/');
    }

}