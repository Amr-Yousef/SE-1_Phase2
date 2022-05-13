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

    public static function login($email, $password)
    {
        $table = "cardholder";
        // $db = mysqli_connect("localhost","root","", "cc fraud detection");
        // $sql = "SELECT * FROM cardholder WHERE email = '$email' AND password = '$password'";
        // $result = mysqli_query($db, $sql);
        // $row = mysqli_fetch_array($result);
        // if ($row) {
        //     if ($row['email'] == $email && $row['password'] == $password) {
        //         return new Cardholder($row['SSN'], $row['firstName'], $row['lastName'], $row['phoneNo'], $row['monthlyIncome'], $row['country'], $row['city'], $row['email'], $row['password']);
        //     }
        // } else {
        //     return null;
        // }
        $auth = new AuthController;
        $_SESSION['user_obj'] = $auth->login($email, $password, 'cardholder');
    }

    public function logout()
    {
        session_destroy();
    }
}