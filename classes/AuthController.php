<?php 
require_once 'Cardholder.php';
// require_once 'Admin.php';
require_once 'Person.php';
require_once 'DBController.php';
class AuthController
{
    protected $db;

    public function login($email, $password, $table)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select * from cardholder where email='$email' and password ='$password'";
            $result=$this->db->select($query);
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {

                if(count($result)==0)
                {
                    //$_SESSION["errMsg"]="You have entered wrong email or password";
                    echo "You have entered wrong email or password";
                    $this->db->closeConnection();
                    return false;
                }
                else
                {
                    if($table == 'cardholder')
                    {
                        $cardholder = new Cardholder($result[0]["SSN"], $result[0]["firstName"], $result[0]["lastName"], $result[0]["phoneNo"], $result[0]["monthlyIncome"], $result[0]["country"], $result[0]["city"], $result[0]["email"], $result[0]["password"]);
                        $this->db->closeConnection();
                        $_SESSION['userOBJ'] = $cardholder;
                    }
                    $this->db->closeConnection();
                    return true;
                }
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
}
?>