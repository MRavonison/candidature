<?php
// Cookie stockage

class UserSession{

    public function __construct()
    {
        if(session_status()== PHP_SESSION_NONE)
        {
            session_start();
        }
    }

    public function create($userAccountId,$customer_Id,$firstName,$lastName,$email)
    {
        $_SESSION['user']=
        [
                "UserAccountId" =>$userAccountId,
                "CustomerId"    =>$customer_Id,
                "FirstName"     =>$firstName,
                "LastName"      =>$lastName,
                "Email"         =>$email
        ];
    }

    public function destroy()
    {
        $_SESSION= array();

    }

    public function isAuthenticated()
    {
        if(array_key_exists('user',$_SESSION)==true)
        {
            if(empty($_SESSION['user'])==false)
            {
                return true;
            }
        }

        return false;
    }

    public function isCustomer()
    {
        if($this->isAuthenticated()==false)
        {
            return true;
        }

        return $_SESSION['user']['CustomerId'] != null;
    }

    public function getEmail()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }
        return $_SESSION['user']['Email'];
    }

    // Peut etre redigé egalement de cette façon la maniere true
    public function getFirstName()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }
        return $_SESSION['user']['FirstName'];
    }

    public  function getLastName()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }
        return $_SESSION['user']['LastName'];

    }
    public function getCustomer_Id()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }
        return $_SESSION['user']['CustomerId'];

    }
    public  function getUserAccountId()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }
        return $_SESSION['user']['UserAccountId'];

    }
    public function getFullName()
    {
        if($this->isAuthenticated()==false)
        {
            return null;
        }

        return $_SESSION['user']['FirstName'] . " " . $_SESSION['user']['LastName'];
    }



}
