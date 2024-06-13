<?php

session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "sbs_journal";

$con = mysqli_connect("$host", "$username", "$password", "$dbname");

if(!$con){
  echo "no db found";
  die();
}

else{
  echo "connected";
}


?>