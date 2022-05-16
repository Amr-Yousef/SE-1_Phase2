<?php 

require_once 'DBController.php';
require_once 'AuthController.php';
require_once 'reports-OOP.php';
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
    public static function insertNewAcc(){
        
        $db = new DBController;
        if ($db->openConnection()) {
            $query = "INSERT INTO cardholder 
            SELECT * FROM newacc";
            $result = $db->insert($query);
            if ($result === false) {
                echo "Error in Query";
                return false;
            } else {
                $db->closeConnection();
                return true;
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
    
}

?>