<?php
require_once '../classes/DBController.php';
require_once '../classes/Cardholder.php';
require_once '../classes/CreditCard.php';
require_once '../classes/Person.php';
require_once '../classes/AuthController.php';
require_once '../classes/Transaction.php';
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
        $AccNo = $_POST['Acc'];
        $AmountToTranfer = $_POST['trans'];
        $NewBalance=$balance-$AmountToTranfer;
        $db=new DBController;
        $db->openConnection();
// UPDATE Customers
// SET ContactName = 'Alfred Schmidt', City= 'Frankfurt'
// WHERE CustomerID = 1;
        $query = mysqli_query($conn, "SELECT * FROM login WHERE username='" . $user . "' AND password='" . $pass . "'");
        $numrows = mysqli_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $dbusername = $row['username'];
                $dbpassword = $row['password'];
            }

            if ($user == $dbusername && $pass == $dbpassword) {
                session_start();
                $_SESSION['sess_user'] = $user;

                /* Redirect browser */
                header("Location: member.php");
            }
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "All fields are required!";
    }
}

?>