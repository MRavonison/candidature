<?php

class OrderController{

    public function httpGetMethod(Http $http)
    {
        $userSession = new UserSession;

        if($userSession->isAuthenticated()==false)
        {
            $http->redirectTo('/user/login');
        }

        $mealModel=new MealModel();
        $meals= $mealModel->listAll();

        return
        [
            'meals'=>$meals

        ];

    }


}