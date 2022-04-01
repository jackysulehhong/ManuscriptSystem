<?php
//https://phpenthusiast.com/blog/the-singleton-design-pattern-in-php
//https://stackoverflow.com/questions/6873033/establishing-database-connection-in-php-using-singleton-class
class Database
{
 // Hold the class instance.
 private static $instance = null;

 private $_host = "localhost";
 private $_username = "root";
 private $_password = "";
 private $_database = "jacytech";
 private $_connection = null;
 // The constructor is private
 // to prevent initiation with outer code.
 private function __construct()
 {
  // The expensive process (e.g.,db connection) goes here.
  $this->_connection = new mysqli(
   $this->_host,
   $this->_username,
   $this->_password,
   $this->_database
  );
  if (mysqli_connect_error()) {
   exit('Error connecting to database');
  }
  if ($this->_connection) {
   $this->_connection->set_charset("utf8mb4");
  }
 }

 // The object is created from within the class itself
 // only if the class has no instance.
 public static function getInstance()
 {
  if (self::$instance == null) {
   self::$instance = new Database();
  }

  return self::$instance;
 }
 // Magic method clone is for prevent duplication of connection
 private function __clone()
 {
 }
 public function getConnection()
 {
  return $this->_connection;
 }

 public function query($query)
 {
  return $this->_connection->query($query);
 }
}