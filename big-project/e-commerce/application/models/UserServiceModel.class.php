<?php
// analyse adresse de l'utilisateur

class UserServiceModel{

    public function signUp($firstName,$lastName,$address,$city,$zipCode,$phone,$birthDate,$email,$password)
    {
        // Verification de l'adresse email
        $database= new Database();
        $sql=(" SELECT Email
                FROM UserAccount
                WHERE Email=?");

        $userAccount=$database->queryOne($sql,[$email]);
        // Test de verification si email présent
        if(empty($userAccount)==false)
        {
            throw new DomainException("Il existe déjà un compte utilisateur avec cette adresse e-mail");
        }

        $customerModel= new CustomerModel();
        $customer_Id = $customerModel->create($firstName,$lastName,$address,$city,$zipCode,$phone,$birthDate);

        $userAccountModel= new UserAccountModel();
        $userAccountModel->create($email,$password,$customer_Id);

        $flashBag = new FlashBag();
        $flashBag->add('Votre compte client a bien été créé !');

    }

    public function login($email,$password)
    {
        $userAccountModel= new UserAccountModel();
        $userAccount=$userAccountModel->findWithCredentials($email,$password);

        if($userAccount['Customer_Id'] != null)
        {

            //Créer une instance de la classe CustomerModel
            //Appeler la méthode find() de la classe CustomerModel

            $customerModel= new CustomerModel();
            $customer=$customerModel->find($userAccount['Customer_Id']);

            //Initialiser deux variables $firstName et $lastName avec le prénom et le nom du client

            $firstName=$customer['FirstName'];
            $lastName=$customer['LastName'];
        }
            //Si c'est un admin :
            //Initialiser deux variables $firstName = 'Administrateur' et $lastName = null
        else
        {
            $firstName='Administrateur';
            $lastName=null;
        }

            //Créer une instance de la classe UserSession
            //- Appeler la méthode create() de la classe UserSession , sachant que les argument son appeler ci-dessus
        $userSession= new UserSession();
        $userSession->create($userAccount['Id'],$userAccount['Customer_Id'],$firstName,$lastName,$email);


        $userAccountModel->saveLoginDate($userAccount['Id']);
        return $userSession;

    }

}