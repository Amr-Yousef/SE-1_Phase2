<?php 

require_once 'DBController.php';
require_once 'AuthController.php';
require_once 'Cardholder.php';
require_once 'CreditCard.php';
//require_once 'Admin.php';
require_once 'Person.php';

class report
{
    private $ID;
    public $CCN;
    private $Name;
    private $date;
    private $status;
    private $reason;
    
    public function __construct($ID, $CCN, $Name, $date, $status, $reason)
    {
        $this->ID = $ID;
        $this->CCN = $CCN;
        $this->Name = $Name;
        $this->date = $date;
        $this->status = $status;
        $this->reason = $reason;
    }
    function getReason()
    {
        return $this->reason;
    }

    function setReason($reason)
    {
        $this->reason = $reason;
    }
    function getStatus()
    {
        return $this->status;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    function getDate()
    {
        return $this->date;
    }

    function setDate($date)
    {
        $this->date = $date;
    }

    function getName()
    {
        return $this->Name;
    }

    function setName($Name)
    {
        $this->Name = $Name;
    }

    function getCCN()
    {
        return $this->CCN;
    }

    function setCCN($CCN)
    {
        $this->CCN = $CCN;
    }

    function getID()
    {
        return $this->ID;
    }

    function setID($ID)
    {
        $this->ID = $ID;
    }
    public static function getAllReports()
    {
        $reports = array();
        $sql = "SELECT * FROM report";
        $db = mysqli_connect("localhost", "root", "", "cc fraud detection");
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $reports[] = new report($row['ID'], $row['CCN'], $row['Name'], $row['date'], $row['status'], $row['reason']);
        }
        return $reports;
        // $db = new DBController();
        // return $db->selectAll("transaction", "CCN", $CCN);
    } 
}

?>