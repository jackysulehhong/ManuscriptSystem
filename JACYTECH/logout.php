<?php
include("shared/connect.php");
date_default_timezone_set("Asia/Kuala_Lumpur");
//$username = $_SESSION["curUser"];
//$insQuery = "UPDATE `user_account` SET `last_Activity`= CURRENT_TIMESTAMP WHERE username = '$username'";
//$result = mysqli_query($con, $insQuery);
session_unset();
session_destroy();
$url = "login.php";
if (isset($_GET["session_expired"])) {
    $url .= "?session_expired=" . $_GET["session_expired"];
    header('Location:' . $url . '');
} else {
    header('Location:login.php');
}