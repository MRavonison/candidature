<?php

class PaymentController{

    public function httpPostMethod(Http $http,array $formFields)
    {

        $http->redirectTo('/order/payment/success');
    }

    public function httpGetMethod(Http $http, array $queryFields)
    {

        // Voir orderModel
        if(array_key_exists('id',$queryFields)==true)
        {

            if(ctype_digit($queryFields['id'])==true)
            {

                $orderModel=new OrderModel();

                $order=$orderModel->find($queryFields['id']);
                $orderLines=$orderModel->findOrderLine($queryFields['id']);


                $customerModel=new CustomerModel();

                $customer=$customerModel->find($order['Customer_Id']);

                return
                [
                    'order' => $order,
                    'orderLines'=>$orderLines,
                    'customer'=>$customer
                ];

            }
        }

        $http->redirectTo('/');
    }
}