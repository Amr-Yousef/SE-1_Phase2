<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
class Controller
{
    function __construct()
    {
        $this->processMobileVerification();
    }
    function processMobileVerification()
    {
        switch ($_POST["action"]) {

            case "save_into_db":

                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                $phoneNo = $_POST['phoneNo'];
                $SSN = $_POST['SSN'];
                $country = $_POST['country'];
                $city = $_POST['city'];
                $monthlyIncome = $_POST['monthlyIncome'];
                $password = $_POST['password'];
                $password = md5($password);
                $conn = mysqli_connect('localhost', 'root', '', 'cc fraud detection');
                $query1 = "SELECT * FROM cardholder WHERE SSN='$SSN'";
                $result1 = mysqli_query($conn, $query1);
                $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
                if ($row) {
                    echo json_encode(array("type" => "error", "message" => "This Account already exist."));
                    exit();
                } else {

                    $query = "INSERT INTO newacc (firstName,lastName,email,phoneNo,SSN,country,city,monthlyIncome,password) 
                    VALUES ('$firstName','$lastName','$email','$phoneNo','$SSN','$country','$city','$monthlyIncome','$password')";

                    $result = mysqli_query($conn, $query);
                    if ($result == FALSE) {
                        die(mysqli_error($conn));
                        echo json_encode(array("type" => "error", "message" => "Error."));
                        exit();
                    } else

                        echo json_encode(array("type" => "success", "message" => "Successfully inserted."));
                }

                break;
        }
    }
}
$controller = new Controller();
