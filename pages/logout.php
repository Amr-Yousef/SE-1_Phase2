<?php   
session_start();  
unset($_SESSION['userOBJ']);  
session_destroy();  
header("location:sign-in.php");