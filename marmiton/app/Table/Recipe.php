<?php

namespace App\Table;

//use App\App;
use App\Database;

class Recipe {


    /**
     * @return Database
     * connect to BDD
     */
    private function getDatabase() {
        $database = new Database();
        return $database;
    }

    /**
     * @return array
     * function test
     */
    public function getNomRecette()
    {
        //$database = new Database();
        $sql = "SELECT * FROM recette";

        return $this->getDatabase()->query($sql);
    }

    public function create($nom_rec, $pseudo, $email, $descriptif, $image)
    {
        $database = new Database();
        $sql=(
        "INSERT INTO recette
                (
                  nom_rec,
                  pseudo_rec,
                  email_rec,
                  descript_rec,
                  image
                )
        VALUES
        (?,?,?,?,?)");

        return $database->executeSql($sql,[$nom_rec, $pseudo, $email, $descriptif, $image]);
    }

    /**
     * @param $id
     * @param $nom_rec
     * @param $pseudo_rec
     * @param $email_rec
     * @return string
     * Edit one recipe into BDD
     */
    public function edit($id, $nom_rec, $pseudo_rec, $email_rec)
    {
        $sql = "UPDATE recette 
                SET 
                  nom_rec = :nom_rec, 
                  pseudo_rec = :pseudo_rec, 
                  email_rec = :email_rec
                WHERE 
                  id_rec = :id_rec";

        return $this->getDatabase()->executeSql($sql, [$id, $nom_rec, $pseudo_rec, $email_rec]);
    }

    /**
     * @param $id
     * @return string
     * Delete one recipe
     */
    public function delete($id)
    {
        $sql = "DELETE FROM recette 
                WHERE 
                  id_rec = :id_rec";

        return $this->getDatabase()->executeSql($sql, [$id]);
    }



}