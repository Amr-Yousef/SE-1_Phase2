<?php

class Transaction
{
    private $ID;
    private $CCN;
    private $date;
    private $amount;
    private $type;
    private $description;
    private $location;
    private $status;

    public function __construct($ID, $CCN, $date, $amount, $type, $description, $location, $status)
    {
        $this->ID = $ID;
        $this->CCN = $CCN;
        $this->date = $date;
        $this->amount = $amount;
        $this->type = $type;
        $this->description = $description;
        $this->location = $location;
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

    public function getAmount()
    {
        return $this->amount;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getLocation()
    {
        return $this->location;
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
            $transactions[] = new Transaction($row['ID'], $row['CCN'], $row['date'], $row['amount'], $row['type'], $row['description'], $row['location'], $row['status']);
        }
        return $transactions;
    }
}