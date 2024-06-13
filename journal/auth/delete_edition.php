<?php
session_start();
include("../db/db_connect.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Fetch the edition details
    $query = "SELECT * FROM edition WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) > 0){
        $edition = mysqli_fetch_assoc($query_run);
        $volume = $edition['volume'];
        $issue = $edition['issue'];
        $year = $edition['year'];

        // Construct the directory path
        $edition_folder = '../published_manuscripts/vol-' . $volume . '-' . $issue . '-' . $year;

        // Function to delete a directory and its contents
        function deleteDirectory($dir) {
            if (!file_exists($dir)) {
                return true;
            }

            if (!is_dir($dir)) {
                return unlink($dir);
            }

            foreach (scandir($dir) as $item) {
                if ($item == '.' || $item == '..') {
                    continue;
                }

                if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                    return false;
                }
            }

            return rmdir($dir);
        }

        // Attempt to delete the directory
        if (deleteDirectory($edition_folder)) {
            // Delete the edition from the database
            $delete_query = "DELETE FROM edition WHERE id='$id'";
            $delete_query_run = mysqli_query($con, $delete_query);

            if($delete_query_run){
                $_SESSION['message'] = "Edition deleted successfully along with its folder";
                header('Location: ../admin/create_edition.php');
                exit(0);
            } else {
                $_SESSION['message'] = "Failed to delete edition from the database";
                header('Location: ../admin/create_edition.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Failed to delete the edition folder";
            header('Location: ../admin/create_edition.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Edition not found";
        header('Location: ../admin/create_edition.php');
        exit(0);
    }
} else {
    $_SESSION['message'] = "Invalid request";
    header('Location: ../admin/index.php');
    exit(0);
}

