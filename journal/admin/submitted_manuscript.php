<?php include("includes/header.php")?>
<body>
    <div class="wrapper">
      

    <?php include("includes/sidebar.php")?>

            
    <div class="main">
      

    <?php include("includes/top_nav.php")?>
  
        <main class="content px-3 py-4">
          <div class="container-fluid">


            <div class="mb-3">
              <h2 class="py-3 fw-bold text-center">Submitted Manuscript</h2>

              <div class="container py-y px-3 mb-5 w50 shadow rounded">
                <div class="row">
                  <div class="col-12">
                    <table class="table table-striped">
                      <thead>
                        <tr class="highlight">
                          <th scope="col">SN</th>
                          <th scope="col">Manuscript ID</th>
                          <th scope="col">Title</th>
                          <th scope="col">Email</th>
                          <th scope="col">Status</th>
                          <th scope="col">File</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>


                        <?php

                        //check database connection

                        //$userid = $_SESSION['auth_user']['id'];



                        if(!$con){
                          die("Connection failed: ". mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM submitted_journal ORDER BY id DESC";
                        $result = $con->query($sql);
                        $i=1;

                        if(!$result){
                          echo "No records found";
                        }

                        while($rows= mysqli_fetch_array($result))
                        {
                        $id=$rows['id'];
                        $manuscript_id=$rows['manuscript_id'];
                        $title=$rows['title'];
                        $email=$rows['email'];
                        $phone=$rows['phone'];
                        $comment=$rows['comment'];
                        $file=$rows['file'];
                        $status=$rows['status'];
                        $date=$rows['date'];

                        ?>


                        <tbody>
                        <tr>
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $manuscript_id; ?></td>
                          <td><?php echo $title; ?></td>
                          <td><?php echo $email; ?></td>
                          <td><?php

                            if($status=='proccessing'){
                            echo "<button type='button' class='btn text-white btn-warning btn-sm' disabled>Processing</button>";
                            }
                            else if($status=='editorial_check'){
                            echo "<button type='button' class='btn text-white btn-primary btn-sm' disabled>Editorial Check</button>";
                            }
                            else if($status=='accepted'){
                            echo "<button type='button' class='btn text-white btn-info btn-sm' disabled>Accepted</button>";
                            }
                            else if($status=='rejected'){
                            echo "<button type='button' class='btn text-white btn-danger btn-sm' disabled>Rejected</button>";
                            }
                            else if($status=='published'){
                            echo "<button type='button' class='btn text-white btn-success btn-sm' disabled>Published</button>";
                            }
                            else{
                            echo "error";
                            }

                            ?>
                            </td>
                          <td><?php echo $file; ?></td>
                          <td><?php echo $date; ?></td>
                          <td><?php echo "<a href='manuscript_status.php?doc_id=$manuscript_id' class='btn btn-danger text-light'>View</a>"?></td>
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