<?php

class Transaction
{
    private $ID;
    private	$CCN;
    private $date;
    private	$total;
    private	$quantity;
    private	$website;
    private	$description;
    private	$type;
    private	$country;
    private	$city;
    private	$phoneNo;
    private	$status;
    

    public function __construct($ID, $CCN, $date, $total, $quantity, $website, $description, $type, $country, $city, $phoneNo, $status)
    {
        $this->ID = $ID;
        $this->CCN = $CCN;
        $this->date = $date;
        $this->total = $total;
        $this->quantity = $quantity;
        $this->website = $website;
        $this->description = $description;
        $this->type = $type;
        $this->country = $country;
        $this->city = $city;
        $this->phoneNo = $phoneNo;
        $this->status = $status;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getCCN()
    {
        return $this->CCN;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public static function getAllTransactions($CCN)
    {
        $transactions = array();
        $sql = "SELECT * FROM transaction WHERE CCN = '$CCN'";
        $db = mysqli_connect("localhost","root","", "cc fraud detection");
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result)) {
            $transactions[] = new Transaction($row['ID'], $row['CCN'], $row['date'], $row['total'], $row['quantity'], $row['website'], $row['description'], $row['type'], $row['country'], $row['city'], $row['phoneNo'], $row['status']);
        }
        return $transactions;
        // $db = new DBController();
        // return $db->selectAll("transaction", "CCN", $CCN);
    }
}