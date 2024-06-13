<?php include("includes/header.php")?>

<body>
    <div class="wrapper">
      

    <?php include("includes/sidebar.php")?>

            
    <div class="main">
      

    <?php include("includes/top_nav.php")?>
  
        <main class="content px-3 py-4">
          <div class="container-fluid">

          <?php include('../message.php');?>

            <div class="mb-3">
              <h2 class="py-3 fw-bold text-center">Users Profile</h2>

              <div class="container py-y px-3 mb-5 w50 shadow rounded">
                <div class="row">
                  <div class="col-12">
                    <table class="table table-striped">
                      <thead>
                        <tr class="highlight">
                          <th scope="col">SN</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone No.</th>
                          <th scope="col">Date</th>
                        </tr>
                      </thead>



                      <?php

                      //check database connection

                      //$userid = $_SESSION['auth_user']['id'];



                      if(!$con){
                        die("Connection failed: ". mysqli_connect_error());
                      }

                      $sql = "SELECT * FROM users ORDER BY id DESC";
                      $result = $con->query($sql);
                      $i=1;

                      if(!$result){
                        echo "No records found";
                      }

                      while($rows= mysqli_fetch_array($result))
                      {
                      $id=$rows['id'];
                      $fname=$rows['fname'];
                      $email=$rows['email'];
                      $phone=$rows['phone'];
                      $date=$rows['date'];

                      ?>


                      <tbody>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $date; ?></td>
                      <td><?php echo "<a href='../auth/delete_users.php?id=$id' class='btn btn-danger text-light'>Delete</a>"; ?></td>
                      </tr>
                      </tbody>

                      <?php } ?>


                    </table>
                  </div>
                </div>
              </div>

            </div>

          </div>
        </main>
        

<?php include("includes/footer.php")?>