<?php
//Insertion d'un produit

class MealModel{



    public function listAll()
    {
        $database   = new Database();

        return $database->query('SELECT * FROM Meal');
    }

    public function create($name,$description,$photo,$initialStock,$buyPrice,$salePrice)
    {
        $database = new Database();
        $sql=(
            "INSERT INTO Meal
                (
                  Name,
                  Description,
                  Photo,
                  QuantityInStock,
                  BuyPrice,
                  SalePrice
                )
        VALUES
        (?,?,?,?,?,?)");

        $database->executeSql($sql,[$name,$description,$photo,$initialStock,$buyPrice,$salePrice]);
    }

    public function find($mealId)
    {
        $database = new Database();
        $sql=(
            "SELECT
              Name,
              Description,
              Photo,
              BuyPrice,
              SalePrice
            FROM Meal
            WHERE Id=?"
        );
            return $database->queryOne($sql,[$mealId]);
        //MealController
    }
}