<?php

class CreditCard
{
    private $CCN;
    private $SSN;
    private $balance;
    private $expDate;
    private $cvv;
    private $nameOnCard;
    private $maxDaily;

    public function __construct($CCN, $SSN, $balance, $expDate, $cvv, $nameOnCard, $maxDaily)
    {
        $this->CCN = $CCN;
        $this->SSN = $SSN;
        $this->balance = $balance;
        $this->expDate = $expDate;
        $this->cvv = $cvv;
        $this->nameOnCard = $nameOnCard;
        $this->maxDaily = $maxDaily;
    }

    public function getCCN()
    {
        return $this->CCN;
    }

    public function getSSN()
    {
        return $this->SSN;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function getExpDate()
    {
        return $this->expDate;
    }

    public function getCVV()
    {
        return $this->cvv;
    }

    public function getNameOnCard()
    {
        return $this->nameOnCard;
    }

    public function getMaxDaily()
    {
        return $this->maxDaily;
    }

    public static function getCard($SSN)
    {
        $db = mysqli_connect("localhost","root","", "cc fraud detection");
        $sql = "SELECT * FROM creditcards WHERE SSN = '$SSN'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);
        if ($row) {
            if ($row['SSN'] == $SSN) {
                return new CreditCard($row['CCN'], $row['SSN'], $row['Balance'], $row['expDate'], $row['CCV'], $row['nameOnCard'], $row['maxDaily']);
            }
        } else {
            return null;
        }
    }

    
    public function getAllTransactions()
    {
        return Transaction::getAllTransactions($this->getCCN());
    }
}