<?php
include("shared/sendMail.php");
class MailFacade
{
  private $_db;
  function __construct()
  {
    $this->_db = Database::getInstance();
  }
  function resetPass($email)
  {
    $bytes = random_bytes(16);
    $token = bin2hex($bytes);
    $this->_db->query("INSERT INTO `verification`(`email`,`token`) VALUES('$email','$token')");
    $result = $this->_db->query("SELECT `name` FROM `user_account` WHERE  `email`='$email'");

    $row = mysqli_fetch_assoc($result);

    sendMail($email,  $row['name'], "Reset Password", "<p>
                       Please click the button below to reset your password. 
                       If it's not you, please ignore the email.
                      </p>", "http://" . $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/")) . "/resetPassword.php?email=" . $email . "&token=" . $token . "", "Reset Password");
  }
}
/*
  $row = mysqli_fetch_assoc($result);
                $bytes = random_bytes(16);
                $token = bin2hex($bytes);
                query($conn, "INSERT INTO `verification`(`email`,`token`) VALUES('$email','$token')");
                include_once("shared/sendMail.php");
                sendMail($row['email'], $row['name'], "Reset Password", "<p>
                    Please click the button below to reset your password. 
                    If it's not you, please ignore the email.
                   </p>", "http://" . $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/")) . "/resetPassword.php?email=" . $email . "&token=" . $token . "", "Reset Password");
                    */