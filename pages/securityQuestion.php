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
$auth=new AuthController();
if (isset($_POST["cont"])) {
    if ( !empty($_POST['trans'])) {
        $ans=$_POST['trans'];
        include('conn.php');
        $x="";
        $query = mysqli_query($conn, "SELECT answer FROM securityquestion WHERE CCN='" . $CCN . "'");
        $numrows = mysqli_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $x = $row['answer'];
            }
        }
        if ($ans == $x) {
            if ($balance - $transaction->getTotal() < 0) {
                echo "<script>alert('Insufficient Balance Charge your account')</script>";
            }
            if ($auth->paymentFormInsertToDB(
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
            ) && 1
            ) {
                $auth->updateBalance($transaction->getCCN(), $balance - $transaction->getTotal());
                sendMail(
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
                
              
                header("Location: ../pages/billing.php");
            }
            
        
        }
          else {
            if ($balance - $transaction->getTotal() < 0) {
                echo "<script>alert('Insufficient Balance Charge your account')</script>";
            }
            else{
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
                $auth->updateBalance($transaction->getCCN(), $balance - $transaction->getTotal());
                sendMail(
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


                header("Location: ../pages/billing.php");
        }
        }
    } 
} else {
    echo "All fields are required!";
}

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