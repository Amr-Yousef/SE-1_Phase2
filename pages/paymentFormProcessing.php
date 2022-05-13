<?php
require_once '../classes/DBController.php';
require_once '../classes/Cardholder.php';
require_once '../classes/CreditCard.php';
require_once '../classes/Person.php';
require_once '../classes/AuthController.php';
require_once '../classes/Transaction.php';

session_start();
if (isset($_POST['pay'])) {

    if (
        !empty($_POST['item_desc'])
        && !empty($_POST['totalPrice'])
        && !empty($_POST['quantity'])
        && !empty($_POST['website'])
        && !empty($_POST['email'])
        && !empty($_POST['area_code'])
        && !empty($_POST['phone'])
        && !empty($_POST['country'])
        && !empty($_POST['city'])
    ) {
        $item_desc = $_POST['item_desc'];
        $Price = $_POST['totalPrice'];
        $quantity = $_POST['quantity'];
        $website = $_POST['website'];
        $email = $_POST['email'];
        $area_code = $_POST['area_code'];
        $phone = $_POST['phone'];
        $date = date("Y-m-d");
        $ID = "";
        $status = "1";
        $type = "Payment";
        $country = $_POST['country'];
        $city = $_POST['city'];
        $phoneNo = $area_code . $phone;
        $CCN = $_SESSION['ccn'];
        echo $CCN;
        $transaction = new Transaction(
            $ID,
            $CCN,
            $date,
            $Price,
            $quantity,
            $website,
            $item_desc,
            $type,
            $country,
            $city,
            $phoneNo,
            $status
        );

        $auth = new AuthController();
       if( $auth->paymentFormInsertToDB(
            $transaction->getCCN(),
            $transaction->getDate(),
            $transaction->getTotal(),
            $transaction->getQuantity(),
            $transaction->getWebsite(),
            $transaction->getDescription(),
            $transaction->getType(),
            $transaction->getCountry(),
            $transaction->getCity(),
            $transaction->getPhoneNo(),
            $transaction->getStatus()
        )){
            header("Location: ../pages/billing.php");
        }
        //$transaction->sendEmail($email);
        echo "Payment Successful!";
    } else {
        echo "All fields are required!";
    }
}