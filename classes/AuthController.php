<?php 
require_once 'Cardholder.php';
require_once 'CreditCard.php';
//require_once 'Admin.php';
require_once 'Person.php';
require_once 'DBController.php';
require_once 'Transaction.php';

class AuthController
{
    protected $db;

    public function login($email, $password, $table)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
           
            $query = "select * from ".$table." where email='$email' and password ='$password'";
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

                    else if($table == 'admin')
                    {
                        $admin = new Admin($result[0]["email"], $result[0]["password"]);
                        $this->db->closeConnection();
                        $_SESSION['userOBJ'] = $admin;
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
    public function updateBalance($CCN,$newBalance)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="update creditcards set Balance='$newBalance' where CCN='$CCN'";
            $result=$this->db->update($query);
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
    public function updateStatus($ID)
    {
        $this->db = new DBController;
        if ($this->db->openConnection()) {
            $query = "update report set status=1 where ID='$ID'";
            $result = $this->db->update($query);
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
    public function getBalance($CCN)
    {
        $this->db=new DBController;
        if($this->db->openConnection())
        {
            $query="select Balance from creditcards where CCN='$CCN'";
            $result=$this->db->select($query);
            if($result===false)
            {
                echo "Error in Query";
                return false;
            }
            else
            {
                $this->db->closeConnection();
                return $result[0]["Balance"];
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
    public static function calDeviation(Transaction $newTransaction)
    {
        $deviation=0;
        $CCN = $newTransaction->getCCN();
        $cardholder = $_SESSION['userOBJ'];
        $maxTotalIncrease = 3; // aka 300%
        $maxQuantityIncrease = 2; // aka 100%
        $allTotal =0;
        $allQuantity =0;
        $totalDeviation =0;
        $quantityDeviation =0;

        $total = $newTransaction->getTotal(); // 19% V
        $quantity = $newTransaction->getQuantity(); // 10% V
        $website = $newTransaction->getWebsite(); // 6% B
        $country = $newTransaction->getCountry(); // 50% B
        $city = $newTransaction->getCity(); // 10% B
        $phoneNo = $newTransaction->getPhoneNo(); // 5% B

        $websiteFlag = 0;
        $countryFlag = 0;
        $cityFlag = 0;
        $phoneNoFlag = 0;

        $allTransactions = Transaction::getAllTransactions($CCN);

        //loop through all transactions to calculate the binary values
        foreach ($allTransactions as $transaction) {
            $allTotal += $transaction->getTotal();
            $allQuantity += $transaction->getQuantity();

            $websiteFlag = ($transaction->getWebsite() != $website) ? 1 : 0;
            $countryFlag = ($transaction->getCountry() != $cardholder->getCountry()) ? 1 : 0;
            $cityFlag = ($transaction->getCity() != $cardholder->getCity()) ? 1 : 0;
            $phoneNoFlag = ($transaction->getPhoneNo() != $cardholder->getPhoneNo()) ? 1 : 0;
        }

        $avgTotal = $allTotal / count($allTransactions);
        $avgQuantity = $allQuantity / count($allTransactions);

        if($total > $avgTotal)
        {
            $totalDeviation = (($total - $avgTotal) / $avgTotal);

            if ($totalDeviation >= $maxTotalIncrease) {
                $totalDeviation = 0.19;
            } else if ($totalDeviation <= 0) {
                $totalDeviation = 0;
            } else {
                $totalDeviation = round(($totalDeviation * 0.19) / $maxTotalIncrease, 2);
            }
        }

        if($quantity > $avgQuantity)
        {
            $quantityDeviation = (($quantity - $avgQuantity) / $avgQuantity);

            if ($quantityDeviation >= $maxQuantityIncrease) {
                $quantityDeviation = 0.1;
            } else if ($quantityDeviation <= 0) {
                $quantityDeviation = 0;
            } else {
                $quantityDeviation = round(($quantityDeviation * 0.1) / $maxQuantityIncrease, 2);
            }
        }

        $deviation = ($websiteFlag)? $deviation + 0.06 : $deviation + 0;
        $deviation = ($countryFlag)? $deviation + 0.5 : $deviation + 0;
        $deviation = ($cityFlag)? $deviation + 0.1 : $deviation + 0;
        $deviation = ($phoneNoFlag)? $deviation + 0.05 : $deviation + 0;
        $deviation = $deviation + $totalDeviation + $quantityDeviation;

        return $deviation;
    }
}