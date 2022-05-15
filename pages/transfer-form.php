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
if (isset($_POST['transfer'])) {
    if (!empty($_POST['Acc']) && !empty($_POST['trans'])) {
        $x;
        $AccNo = $_POST['Acc'];
        $AmountToTranfer = $_POST['trans'];
        $NewBalance = $balance - $AmountToTranfer;
        if ($NewBalance < 0) {
            echo "<script>alert('Insufficient Balance to transfer Charge your account')</script>";
        } else {
            include('conn.php');

            $query = mysqli_query($conn, "SELECT Balance FROM creditcards WHERE CCN = '$AccNo'");
            $numrows = mysqli_num_rows($query);
            if ($numrows != 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    $dbBalanceOfTheSeconduser = $row['Balance'];
                }
                $x = $dbBalanceOfTheSeconduser;
            }
            $auth = new AuthController;
            $auth->updateBalance($AccNo, $AmountToTranfer + $x);
            $auth->updateBalance($CCN, $NewBalance);
            sendMailTransfer($CCN, $AccNo, date('Y-m-d'), $x, $AmountToTranfer + $x, $AmountToTranfer);
            
        }
    }
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
                    <h2 class="title">Transfer to Another Bank Account</h2>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class=" form-row">
                            <div class="name">Account No.</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="Acc" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Transfer Desc.</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="trans" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Price</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="text" name="totalPrice">
                                            <label class="label--desc">Total Price ($)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Transfer Reason</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="subject">
                                            <option disabled="disabled" selected="selected">
                                                Select Type
                                            </option>
                                            <option>Reason 1</option>
                                            <option>Reason 2</option>
                                            <option>Reason 3</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <a href="billing.php"><button class="btn btn--radius-2 btn--red" type="button">
                                    CANCEL
                                </button></a>
                            <button class="btn btn--radius-2 btn--green" type="submit" name="transfer">
                                TRANSFER
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>