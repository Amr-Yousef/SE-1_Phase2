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
$transaction = $_SESSION["newTransaction"];
$question = $transaction->getSecurityQuestion();
$answer = $transaction->getSecurityAnswer();
$card = $user->getCard();
$CCN = $card->getCCN();
$cvv = $card->getCVV();
$balance = $card->getBalance();
$cardName = $card->getNameOnCard();
$expDate = $card->getExpDate();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Title Page-->
    <title>transfer</title>

    <!-- Font special for pages -->
    <!-- NOTE: DOWNLOAD THE FONTS LATER FOR OFFLINE USE -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
        rel="stylesheet" />

    <!-- Main CSS-->
    <link href="../assets/css/payment-form.css" rel="stylesheet" media="all" />
</head>

<body>
    <div class="page-wrapper p-t-45 p-b-50" style="background-color: #f8f9fa;">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">Please answer the following question:</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class=" form-row">
                            <div class="name">Question: </div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Acc" placeholder=<?=$question?> readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Answer: </div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="trans" placeholder=<?=$answer?> />
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <a href="billing.php"><button class="btn btn--radius-2 btn--red" type="button">
                                    CANCEL
                                </button></a>
                            <button class="btn btn--radius-2 btn--green" type="submit" name="cont">
                                Finish
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>