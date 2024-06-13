<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

  if(isset($_POST['logout_btn'])){

    unset($_SESSION['auth']);
    unset($_SESSION['auth_role']);
    unset($_SESSION['auth_user']);

    $_SESSION['messsage'] = "Logged out successfully";
    header("location: ../index.php");
  }

?>