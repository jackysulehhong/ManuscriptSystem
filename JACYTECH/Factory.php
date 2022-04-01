<?php
class QueryFactory
{
 private $_db;
 private $_result;

 function __construct()
 {
  $_db = Database::getInstance();
 }

 function query($query)
 {
  $this->_result = $this->_db->getConnection()->query($query);
 }
 function displayError()
 {
  return $this->_db->getConnection()->error;
 }
}

class UserQuery implements QueryFactory
{
 function getUser()
 {
  return mysqli_fetch_assoc($this->_result);
 }
}