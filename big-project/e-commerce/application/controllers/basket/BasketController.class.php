<?php

class BasketController{

    public function httpGetMethod()
    {

    }


// voir Orderform.class.js et basketSession.class.js
    public function httpPostMethod(Http $http, array $formFields)
    {


        if(array_key_exists('basketItems',$formFields)==true)
        {
             $basketItems =$formFields['basketItems'];

        }
        else
        {
            $basketItems=[];
        }

        $orderId=$formFields['orderId'];

        if ($orderId== null)
        {
            $userSession= new UserSession();

            $orderModel=new OrderModel();
            $orderId = $orderModel->create($userSession->getCustomer_Id());
        }



        return
         [
            '_raw_template'     => true, //Il ne faut pas charger le layout !
            'basketItems'       => $basketItems,
            'orderId'           => $orderId

         ];
    }
}