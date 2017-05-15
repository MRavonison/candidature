<?php
// Insertion d'un client

class CustomerModel
{

    public function create($firstName,$lastName,$address,$city,$zipCode,$phone,$birthDate)
    {
        // requete de base de donnée
        $database = new Database();
        $sql= (
            "INSERT INTO Customer
            (
            FirstName,
            LastName,
            Address,
            City,
            ZipCode,
            Phone,
            BirthDate
            )
            VALUES
            (?,?,?,?,?,?,?)");// Pour la sécurité il faut utiliser des points d'interrogations sinon voir phmyadmin


        $customerId= $database->executeSql($sql,[ $firstName,$lastName,$address,$city,$zipCode,$phone,$birthDate]);
        return $customerId;
    }
    public function find($customerId)
    {
        //Construire la requête SQL qui récupère les données du client ayant l'id spécifié dans $customerId
        //Colonnes SQL FirstName, LastName, Address, City, ZipCode, Phone, BirthDate

        $database= new Database();
        $sql=
        "SELECT
            FirstName,
            LastName,
            Address,
            City,
            ZipCode,
            Phone,
            BirthDate
        FROM Customer
        WHERE Id=?
        ";


        //Appeler la méthode queryOne() pour lire la ligne dans la base de données et renvoyer le résultat
        return $database->queryOne($sql,[$customerId]);
    }
}

