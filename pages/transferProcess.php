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
$CCN = $card->getCCN();
$cvv = $card->getCVV();
$balance = $card->getBalance();
$cardName = $card->getNameOnCard();
$expDate = $card->getExpDate();
if(isset($_POST['transfer'])){
    if (!empty($_POST['Acc']) && !empty($_POST['trans'])) {
        $x;
        $AccNo = $_POST['Acc'];
        $AmountToTranfer = $_POST['trans'];
        $NewBalance=$balance-$AmountToTranfer;
        if($NewBalance<0){
            echo "<script>alert('Insufficient Balance to transfer Charge your account')</script>";
        }
        else{
        include('conn.php');

        $query = mysqli_query($conn, "SELECT Balance FROM creditcards WHERE CCN = '$AccNo'");
        $numrows = mysqli_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $dbBalanceOfTheSeconduser = $row['Balance'];
            }
            $x= $dbBalanceOfTheSeconduser;
        }
        $auth=new AuthController;
        $auth->updateBalance($AccNo,$AmountToTranfer+$x);
        $auth->updateBalance($CCN, $NewBalance);
        sendMailTransfer($CCN,$AccNo,date('Y-m-d'),$x,$AmountToTranfer+$x,$AmountToTranfer);
    }
}
}
?>