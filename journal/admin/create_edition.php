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
          <h2 class="py-3 fw-bold text-center">Submit Manuscript</h2>

          <div class="container py-y px-3 mb-5 w50 shadow rounded">
            <form action="../auth/auth.php" method="POST" class="row g-3">
              
              <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Volume</label>
                <input type="text" name="volume" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Issue</label>
                <input type="text" name="issue" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Year</label>
                <input type="text" name="year" class="form-control" id="inputEmail4">
              </div>

              <div class="col-12 mb-5">
                <button type="submit" name="create_edition_btn" class="btn btn-primary">Create Edition</button>
              </div>
            </form>
          </div>
        </div>

        <div class="mb-3">
          <h2 class="py-3 fw-bold text-center">All Editions</h2>

          <div class="container py-y px-3 mb-5 w50 shadow rounded">
            <div class="row">
              <div class="col-12">
                <table class="table table-bordered table-striped">
                  <thead class="bg-dark text-light">
                    <tr class="highlight">
                      <th>SN</th>
                      <th>Volume</th>
                      <th>Issue</th>
                      <th>Year</th>
                      <th>Date Created</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                    if(!$con){
                      die("Connection failed: ". mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM edition ORDER BY id DESC";
                    $result = $con->query($sql);
                    $i = 1;

                    if(!$result){
                      echo "No records found";
                    } else {
                      while($rows = mysqli_fetch_array($result)){
                        $id = $rows['id'];
                        $volume = $rows['volume'];
                        $issue = $rows['issue'];
                        $year = $rows['year'];
                        $date = $rows['date'];
                    ?>

                    <tr>
                      <td><?php echo $i++; ?></td>
                      <td><?php echo $issue; ?></td>
                      <td><?php echo $volume; ?></td>
                      <td><?php echo $year; ?></td>
                      <td><?php echo $date; ?></td>
                      <td><?php echo "<a href='../auth/delete_edition.php?id=$id' class='btn btn-danger text-light'>Delete</a>"; ?></td>
                    </tr>

                    <?php } } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>



<?php include("includes/footer.php")?>