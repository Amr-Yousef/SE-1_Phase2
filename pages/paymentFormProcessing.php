<?php
require_once '../classes/DBController.php';
require_once '../classes/Cardholder.php';
require_once '../classes/CreditCard.php';
require_once '../classes/Person.php';
require_once '../classes/AuthController.php';
require_once '../classes/Transaction.php';
include '../classes/phpmailer.php';
session_start();
$user = $_SESSION["userOBJ"];
$card = $user->getCard();
$balance = $card->getBalance();

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


        //calculating the devation
        $deviation = $transaction->calDeviation();
        echo $deviation;

        $auth = new AuthController();
        if ($deviation <= 0.15) {
            if ($balance - $transaction->getTotal() < 0) {
                echo "<script>alert('Insufficient Balance Charge your account')</script>";
            } if ($auth->paymentFormInsertToDB(
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
            ) && 1) {
                $auth->updateBalance($transaction->getCCN(), $balance - $transaction->getTotal());
                // sendMail(
                //     $transaction->getCCN(),
                //     $transaction->getDate(),
                //     $transaction->getTotal(),
                //     $transaction->getQuantity(),
                //     $transaction->getWebsite(),
                //     $transaction->getDescription(),
                //     $transaction->getType(),
                //     $transaction->getCountry(),
                //     $transaction->getCity(),
                //     $transaction->getPhoneNo(),
                //     $transaction->getStatus()
                // );
                // echo $deviation;
                // echo $transaction->getStatus();
                header("Location: ../pages/billing.php");
            }
        }
             else if ($deviation > 0.15 && $deviation <= 0.80) {
                $_SESSION['newTransaction'] = $transaction;
                header("Location: securityQuestion.php");
            } else if ($deviation > 0.80) {
                $transaction->setStatus(0);
                $auth->paymentFormInsertToDB(
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
                );
            } else {
                echo "we are screwed";
            }
        }
    } else {
        echo "All fields are required!";
    }

