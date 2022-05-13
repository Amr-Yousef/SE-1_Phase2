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
                    // $_SESSION["userId"]=$result[0]["id"];
                    // $_SESSION["userName"]=$result[0]["name"];
                    // if($result[0]["roleId"]==1)
                    // {
                    //     $_SESSION["userRole"]="Admin";
                    // }
                    // else
                    // {
                    //     $_SESSION["userRole"]="Client";
                    // }
                    if($table == 'cardholder')
                    {
                        
                        $cardholder = new Cardholder($result[0]["SSN"], $result[0]["firstName"], $result[0]["lastName"], $result[0]["phoneNo"], $result[0]["monthlyIncome"], $result[0]["country"], $result[0]["city"], $result[0]["email"], $result[0]["password"]);
                        $this->db->closeConnection();
                        $_SESSION['userOBJ'] = $cardholder;
                    }
                    // else if($table == 'admin')
                    // {
                    //     $admin = new Admin($result[0]["SSN"], $result[0]["firstName"], $result[0]["lastName"], $result[0]["phoneNo"], $result[0]["monthlyIncome"], $result[0]["country"], $result[0]["city"], $result[0]["email"], $result[0]["password"]);
                    //     $this->db->closeConnection();
                    //     return $admin;
                    // }

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
    // public function register(Person $user)
    // {
    //     $this->db=new DBController;
    //     if($this->db->openConnection())
    //     {
    //         $query="insert into users values ('','$user->name','$user->email','$user->password',2)";
    //         $result=$this->db->insert($query);
    //         if($result!=false)
    //         {
    //             session_start();
    //             $_SESSION["userId"]=$result;
    //             $_SESSION["userName"]=$user->name;
    //             $_SESSION["userRole"]="Client";
    //             $this->db->closeConnection();
    //             return true;
    //         }
    //         else
    //         {
    //             $_SESSION["errMsg"]="Somthing went wrong... try again later";
    //             $this->db->closeConnection();
    //             return false;
    //         }
    //     }
    //     else
    //     {
    //         echo "Error in Database Connection";
    //         return false;
    //     }
    // }
}
?>