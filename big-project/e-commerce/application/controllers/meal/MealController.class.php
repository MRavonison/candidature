<?php

class MealController{

    // $_GET = $queryFields
    public function httpGetMethod(Http $http, array $queryFields)
    {
        // Verifcation si l'id existe
        if(array_key_exists('id',$queryFields)==true)
        {
            // Verification si id existe dans le tableau
            if(ctype_digit($queryFields['id'])==true)
            {
                $mealModel=new MealModel();
                $meal=$mealModel->find($queryFields['id']);

                // renvoi en post les infos , voir onAjaxChangeMeal OrderForm.js
                $http->sendJsonResponse($meal);
            }
        }

    }
}