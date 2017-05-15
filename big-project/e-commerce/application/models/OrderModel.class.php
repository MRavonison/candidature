<?php

class OrderModel
{

    public function create($customer_Id)
    {
        $database= new Database();
        $sql=// Voir PHPmyAdmin, la table order on demande ceux qui ne sont pas NUll
        ('
              INSERT INTO `Order`
                  (Customer_Id,
                  CreationTimestamp,
                  TaxRate)
              VALUE
              (?,NOW(),20.0)
        ');

        $orderId =$database->executeSql($sql,[$customer_Id]);

        return $orderId;
    }


    public function find($orderId)
    {
        $database=new Database;
        $sql=('
        SELECT
                Customer_Id,
                CreationTimestamp,
                CompleteTimestamp,
                TotalAmount,
                TaxRate,
                TaxAmount
        FROM `Order`
        WHERE Id=?
        ');
       return $database->queryOne($sql,[$orderId]);
    }

    public function findOrderLine($orderId)
    {
        $database = new Database();
        $sql=('
            SELECT
                    QuantityOrder,
                    PriceEach,
                    Name,
                    Photo
            FROM OrderLine
            INNER JOIN Meal ON Meal.Id = OrderLine.Meal_Id
            WHERE Order_Id=?
        ');

        return $database->query($sql,[$orderId]);
    }

    public function validate($OrderId,array $basketItems)
    {
        $totalAmounts=0;

        $database= new Database();
        $sql=(
        'INSERT INTO OrderLine
              (Order_Id,
              Meal_Id,
              QuantityOrder,
              PriceEach)
              VALUES
              (?,?,?,?)
            ');

        foreach( $basketItems as $basketItem)
        {

            $database->executeSql($sql,[$OrderId,$basketItem['mealId'],$basketItem['quantity'],$basketItem['salePrice']]);
            $totalAmounts+= $basketItem['quantity']*$basketItem['salePrice'];
        }

        $sql=('
        UPDATE `Order`
        SET
            CompleteTimestamp=NOW(),
            TotalAmount= ?,
            TaxAmount= ?*TaxRate/100
        WHERE id=?'
        );

        $database->executeSql($sql,[$totalAmounts,$totalAmounts,$OrderId]);
    }


}