<?php
session_start();
include("../db/db_connect.php");

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Fetch the user details
    $query = "SELECT * FROM users WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){
        $user = mysqli_fetch_array($query_run);

        // Delete the user from the database
        $delete_query = "DELETE FROM users WHERE id='$id'";
        $delete_query_run = mysqli_query($con, $delete_query);

        if($delete_query_run){

            $_SESSION['message'] = "User deleted successfully";
            header('Location: ../admin/users.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Failed to delete user";
            header('Location: ../admin/users.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "User not found";
        header('Location: ../admin/users.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid request";
    header('Location: ../admin/index.php');
    exit(0);
}
?>
