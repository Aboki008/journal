<?php include("includes/header.php")?>

<body>
    <div class="wrapper">


    <?php include("includes/sidebar.php")?>
            
    <div class="main">


    <?php include("includes/top_nav.php")?>
  
        <main class="content px-3 py-4">
          <div class="container-fluid">

          <div class="mb-3">
          <h2 class="py-3 fw-bold text-center">Update User Profile</h2>

          <div class="container py-y px-3 mb-5 w50 shadow rounded">

            <?php 
              $user_query = "SELECT * FROM users WHERE id='$user_id'";
              $user_run = mysqli_query($con, $user_query);

              if(mysqli_num_rows($user_run) > 0) {
                foreach($user_run as $user) {
            ?>

            <form action="../auth/auth.php" method="POST" class="row g-3">

              <?php include('../message.php');?>

              <input type="hidden" name="user_id" value="<?= $user['id']?>" >

              <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Full Name</label>
                <input type="text" name="fname" value="<?= $user['fname']?>" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" value="<?= $user['email']?>" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Phone Number</label>
                <input type="text" name="phone" value="<?= $user['phone']?>" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Alternate Phone Number</label>
                <input type="text" name="alt_phone" value="<?= $user['alt_phone']?>" class="form-control" id="inputPassword4">
              </div>
              <div class="col-12">
                <label for="inputAddress" class="form-label">Home Address</label>
                <input type="text" name="address" value="<?= $user['address']?>" class="form-control" id="inputAddress" placeholder="Home address">
              </div>
              <div class="col-12">
                <label for="inputAddress2" class="form-label">Work Address</label>
                <input type="text" name="alt_address" value="<?= $user['alt_address']?>" class="form-control" id="inputAddress2" placeholder="Work address...">
              </div>
              <div class="col-md-6">
                <label for="inputCity" class="form-label">State</label>
                <input type="text" name="state" value="<?= $user['state']?>" class="form-control" id="inputCity">
              </div>
              <div class="col-md-6">
                <label for="inputZip" class="form-label">City</label>
                <input type="text" name="city" value="<?= $user['city']?>" class="form-control" id="inputZip">
              </div>
              <p class="text-danger">Note: Please check data, it can only be updated once...</p>
              <div class="col-12 mb-5">
                <button type="submit" name="update_user" class="btn btn-primary">Update Information</button>
              </div>
            </form>

            <?php
                }
              } else {
            ?>

            <h2>No record found</h2>

            <?php
              }
            ?>

  </div>
</div>



          </div>
        </main>


<?php include("includes/footer.php")?>