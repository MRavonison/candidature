<?php
// insertion compte client /connexion/Securité mot de passe

class UserAccountModel{

    public function create($email,$password,$customer_Id=null)
    {
        // instancer pour appeler une classe dans le library
        $database = new Database();
        //requete d'insertion SQL
        $sql= (
        "INSERT INTO UserAccount
                    (
                    Email,
                    Password,
                    Customer_Id,
                    CreationTimestamp
                    )
     VALUES
     (?,?,?,NOW())");

        // utilisation la methode pour crypter le mot de passe
        $passwordHash=$this->hashPassword($password);

        // envoie dans la base de donnée des informations saisient
        $database->executeSql($sql,[ $email,$passwordHash,$customer_Id]);

    }

    public function findWithCredentials($email,$password)
    {
        $database= new Database();

        //requete SQL d'extraction
        $sql=
        "SELECT
            Id,
            Password,
            Customer_Id,
            CreationTimestamp,
            LastLoginTimestamp
        FROM UserAccount
        WHERE Email=?
        ";

        // On stock dans une ligne la requete sql de la variable :
        $userAccount=$database->queryOne($sql,[$email]);

        // verification du mail et du compte
        if (empty($userAccount)==true)
        {
           // on quitte grace à l'exception toute un enchainement d'appel ,qui sera ensuite rattrapé (logincontroller)
            throw new DomainException("Il n'y a pas de compte utilisateur associé à cette adresse email");
        }

        // verification du mot de passe
        if($this->verifyPassword($password,$userAccount['Password'])==false)
        {
           throw new DomainException('Le mot de passe spécifié est incorrect');
        }

        return $userAccount;
    }

    public function saveLoginDate($userAccountId)
    {
        $database= new Database();
        $sql=(
        "UPDATE UserAccount
        SET LastLoginTimestamp=NOW()
        WHERE Id=?
        ");
        $database->executeSql($sql,[$userAccountId]);
    }



    // Securité password cryptage du mot de passe dans la base de donnée
    private function hashPassword($password)
    {
        $salt='$2y$11$'. substr(bin2hex(openssl_random_pseudo_bytes(32)),0,22); // securité voir devdocs

        return crypt($password,$salt);
    }

    // verification du motde passe
    private function verifyPassword($clearPassword,$hashedPassword)
    {
        return crypt($clearPassword,$hashedPassword)==$hashedPassword;
        // si le mot de passe en clair et le meme que le mot de passe chiffré alors il envoie true
    }
}
