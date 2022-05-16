<?php
require_once 'Person.php';
require_once 'DBController.php';
require_once 'AuthController.php';
class Cardholder extends Person
{

    public function __construct($SSN, $firstName, $lastName, $phoneNo, $monthlyIncome, $country, $city, $email, $password)
    {
        parent::__construct($SSN, $firstName, $lastName, $phoneNo, $monthlyIncome, $country, $city, $email, $password);
    }

    public function getCard()
    {
        return CreditCard::getCard($this->getSSN());
    }

    public function isAdmin()
    {
        return false;
    }

    public static function login($email, $password)
    {
        $table = "cardholder";
        $auth = new AuthController;
        $auth->login($email, $password, $table);
    }

    public function logout()
    {
        session_destroy();
    }
}