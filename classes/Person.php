<?php

abstract class Person
{
    private $SSN;
    private $firstName;
    private $lastName;
    private $phoneNo;
    private $monthlyIncome;
    private $country;
    private $city;
    private $email;
    private $password;

    public function __construct($SSN, $firstName, $lastName, $phoneNo, $monthlyIncome, $country, $city, $email, $password)
    {
        $this->SSN = $SSN;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNo = $phoneNo;
        $this->monthlyIncome = $monthlyIncome;
        $this->country = $country;
        $this->city = $city;
        $this->email = $email;
        $this->password = $password;
    }

    public function getSSN()
    {
        return $this->SSN;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getPhoneNo()
    {
        return $this->phoneNo;
    }

    public function getMonthlyIncome()
    {
        return $this->monthlyIncome;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    abstract public function logout();

    abstract public function isAdmin();
}