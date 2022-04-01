<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
//connect to database
//https: //websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
session_start();

//$conn = new mysqli("sql202.epizy.com", "epiz_27015830", "CjDbokV7Xqq2X", "epiz_27015830_busbooking");
/*
$conn = new mysqli("localhost", "root", "", "breastcancerdb");
date_default_timezone_set("Asia/Kuala_Lumpur");
if (mysqli_connect_error()) {
    exit('Error connecting to database');
}
$conn->set_charset("utf8mb4");
*/
include_once("DatabaseModel.php");
$db = Database::getInstance();
$conn = $db->getConnection();
function query($conn, $query)
{
    return $conn->query($query);
}


include("./shared/utils.php");
include("./shared/userSession.php");