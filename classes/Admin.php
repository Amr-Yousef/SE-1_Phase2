<?php 

require_once 'DBController.php';
require_once 'AuthController.php';
class Admin
{
    private $email;
    private $password;
    
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getPassword()
    {
        return $this->password;
    }

    public function isAdmin()
    {
        return true;
    }

    public static function login($email, $password)
    {
        $table = "admin";
        $auth = new AuthController;
        $auth->login($email, $password, $table);
    }

    public function logout()
    {
        session_destroy();
    }
}

?>