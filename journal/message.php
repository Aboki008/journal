<?php
session_start(); 

if(isset($_SESSION['message'])){
    ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6 class="text-dark"><?= $_SESSION['message']; ?></h6>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
    unset($_SESSION['message']); // Unset the message session variable
}
?>
