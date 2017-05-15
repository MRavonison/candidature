<?php

namespace App\Model;


use App\Infrastructure\Database;

class CustomerModel
{
    public function findByCompte($compte)
    {
        $database = new Database();

        $sql = 'SELECT
                    id,
                    statut,
                    compte,
                    pass,
                    disponibility
                FROM user
                WHERE compte LIKE ?';

        return $database->query($sql, [ $compte ]);
    }

    public function searchuser()
    {
        $database = new Database();

        $sql = 'SELECT
                    id,
                    statut,
                    compte,
                    pass,
                    disponibility
                    FROM user';

        return $database->query($sql);
    }

    public function searchunassignedtask()
    {
        $database = new Database();

        $sql = "SELECT * FROM task
                WHERE assigned='0'";

        return $database->query($sql);
    }

    public function searchdisponibility()
    {
        $database = new Database();

        $sql = 'SELECT disponibility FROM user';

        return $database->query($sql);
    }

    public function adduser($statut,$compte, $firstname, $email, $pass)
    {
        $database = new Database();

        $sql = "INSERT INTO user
                      ( statut,
                        compte,
                        firstname,
                        mail,
                        pass)
                      VALUES(
                          '{$statut}',
                          '{$compte}',
                          '{$firstname}',
                          '{$email}',
                          '{$pass}')";

        return $database->query($sql, [ $compte ]);
    }

    public function addtask($nametask,$namesociety, $deliverydate, $priorityserv, $prioritycolor)
    {
        $database = new Database();

        $sql = "INSERT INTO task
                        (nametask,
                        namesociety,
                        deliverydate,
                        priorityserv,
                        prioritycolor)
                      VALUES(
                          '{$nametask}',
                          '{$namesociety}',
                          '{$deliverydate}',
                          '{$priorityserv}',
                          '{$prioritycolor}')";

        return $database->query($sql, [ $nametask ]);
    }

    public function  userTask()
    {
        $database = new Database();

        $sql = 'select * from task INNER JOIN user on user.idtask = task.idtask';

        return $database->query($sql);
    }
}