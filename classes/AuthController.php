<?php 
require_once 'Cardholder.php';
require_once 'CreditCard.php';
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

    public function authCard($CCN, $CCV, $expDate)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select * from creditcards where CCN='$CCN'";
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
                    echo "This credit card is not registered";
                    $this->db->closeConnection();
                    return false;
                }
                else
                {
                    if($result[0]["CCV"]!=$CCV || strcmp(date('m/y', strtotime($result[0]["expDate"])), $expDate))
                    {
                        echo "You have entered wrong credit card number or CVV or expiry date";
                        $this->db->closeConnection();
                        return false;
                    }
                    else
                    {
                        
                        $this->db->closeConnection();
                        return true;
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
    public function paymentFormInsertToDB($CCN, $date, $total, $quantity, $website, $description, $type, $country,$city,$phoneNo,$status)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="insert into transaction( CCN,date, total, quantity, website, description, type, country, city, phoneNo, status) values( '$CCN','$date', '$total', '$quantity', '$website', '$description', '$type', '$country','$city','$phoneNo','$status')";
            $result=$this->db->insert($query);
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                $this->db->closeConnection();
                return true;
            }
        }
        else
        {
            echo "Error in Database Connection";
            return false;
        }
    }
    public function reportInsertToDB($ID,$CCN, $Name,$date,   $status,$reason)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "insert into report( ID,CCN, Name,date,status,reason) values('$ID','$CCN', '$Name','$date',   '$status','$reason')";
            $result = $this->db->insert($query);
            if ($result === false) {
                echo "Error in Query";
                return false;
            } else {
                $this->db->closeConnection();
                return true;
            }
        } else {
            echo "Error in Database Connection";
            return false;
        }
    }
}
?>