<?php

// requête http => onClickValidateOrder / OrderForm/ ValidationController
class ValidationController{

    public function httpGetMethod()
    {

    }
    // transfert base de donnée en poste
    public function httpPostMethod(Http $http, array $formFields)
    {
        $orderModel=new OrderModel();
        $orderModel->validate(
            $formFields['orderId'],
            $formFields['basketItems']
        );

        $http->sendJsonResponse(true);
    }

}