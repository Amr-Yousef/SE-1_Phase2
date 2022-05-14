<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
// require 'PHPMailer-master/PHPMailerAutoload.php';
function sendMail(
    $CCN,
    $date,
    $total,
    $quantity,
    $website,
    $description,
    $type,
    $country,
    $city,
    $phoneNo,
    $status
) {
    echo "<script>alert('Your payment is successfully check your Email');</script>";
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 465;
    $mail->Username = 'ahmedhisham392002@gmail.com';
    $mail->Password = 'Ahmed_3920';
    $mail->setFrom('ahmedhisham392002@gmail.com');
    $mail->addAddress('ahisham819@gmail.com');
    $mail->Subject = 'CC Transaction System - New Transaction';
    $mail->Body = 'There is a transcation by your card number: 
' . $CCN . '
on 
' . $date . ' 
for 
' . $total . '
$ and 
' . $quantity .
        ' items, from '
        . $website .
        ', with description: ' .
        $description . ', type: ' . $type . ', country: ' . $country . ', city: ' . $city .
        ', phone number: ' . $phoneNo . ', status: ' . $status;
    //send the message, check for errors
    if (!$mail->send()) {
        echo "ERROR: " . $mail->ErrorInfo;
    } else {
        echo "SUCCESS";
    }
}