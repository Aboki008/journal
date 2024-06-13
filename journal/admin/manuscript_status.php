<?php include("includes/header.php")
?>

<body>
    <div class="wrapper">


    <?php include("includes/sidebar.php")?>
            
    <div class="main">


    <?php include("includes/top_nav.php")?>
  
        <main class="content px-3 py-4">
          <div class="container-fluid">


            <div class="mb-3">
              <h4 class="py-3 fw-bold text-center">Manuscript Details</h4>

              <?php include('../message.php');?>
              <h1><?php //echo $doc_id=$_GET['doc_id']; ?></h1>


                <?php

                //check database connection

                //$userid = $_SESSION['auth_user']['id'];



                if(!$con){
                  die("Connection failed: ". mysqli_connect_error());
                }


                $doc_id=$_GET['doc_id'];
                $sql = "SELECT * FROM submitted_journal WHERE manuscript_id='$doc_id' ORDER BY id DESC";
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
                $authors=$rows['authors'];
                $email=$rows['email'];
                $phone=$rows['phone'];
                $comment=$rows['comment'];
                $edition=$rows['edition'];
                $p_file=$rows['p_file'];
                $file=$rows['file'];
                $status=$rows['status'];
                $date=$rows['date'];

                ?>


              <div class="container py-4 mb-5 w50 shadow rounded">
              <form action="../auth/auth.php" method="POST" enctype="multipart/form-data">
             
              <div class="row py-2 px-3">


              <input type="hidden" name="id" value="<?php echo $id;?>" >
              <input type="hidden" value='<?php echo $manuscript_id; ?>' name="manuscript_id" id="">

              
              <div class="col-12">
                <p><span class="fw-bold">Manuscript Title: </span><?php echo $title; ?></p>
              </div>
              <div class="col-12">
                <p><span class="fw-bold">Authors:</span> <?php echo $authors?></p>
              </div>
              <div class="col-12">
                <p><span class="fw-bold">Affiliations:</span> affiliations</p>
              </div>
              <div class="col-md-4">
                <p><span class="fw-bold">Corresponders Email: </span> <?php echo $email; ?></p>
              </div>
              <div class="col-md-4">
                <p><span class="fw-bold">Corresponders Phone Number:</span> <?php echo $phone; ?></p>
              </div>
              <div class="col-md-4">
                <p><span class="fw-bold">Status: </span><?php echo $status?></p>
              </div>
              <div class="col-8">
                <p><span class="fw-bold">Manuscript ID: </span> <?php echo $manuscript_id; ?> </p>
              </div>
              <div class="col-4">
              <?php

                  if($status=='published'){
                    ?>
                          <a href="<?php echo "../published_manuscripts/".$edition."/".$p_file; ?>" class="btn btn-sm btn-success">PDF File</a>
                  <?php
                  }
                  else if($status!=='published'){
                    ?>
                          <a href="<?php echo "../submitted_manuscripts/".$file; ?>" class="btn btn-sm btn-secondary">PDF File</a>
                  <?php
                  }
                  else{
                    echo "error";
                  }

              ?>
              </div>
              <div class="col-md-6">
                <p class="fw-bold">Comment:</p>
                  <textarea name="" id="" col="6" class="form-control" disabled><?php echo $comment; ?></textarea>
              </div>
              <div class="col-md-6">
                <div class="col-12">
                <p class="fw-bold">Reply comment:</p>
                  <textarea name="a_comment" id="" col="6" class="form-control"></textarea>
                </div>
              </div>
                <div class="col-6 mt-3">
                  <P class="fw-bold">Action</P>
                  <select class="form-select" name="status" aria-label="Default select example">
                  <option selected>Select Action</option>
                    <option value="accepted">Accepted</option>
                    <option value="rejected">Rejected</option>
                    <option value="published">Published</option>
                  </select>
                </div>

                    <div class="col-6 mt-3">
                    <p class="fw-bold">Edition</p>
                    <select class="form-select" name="edition" aria-label="Default select example">
                        <option selected>Select Edition</option>

                        <?php
                        // Ensure this block of code is inside a PHP file with the proper PHP opening tag

                        // Database connection
                        if (!$con) {
                        die("Connection failed: " . mysqli_connect_error());
                        }

                        $sql = "SELECT * FROM edition  ORDER BY date DESC";
                        $run = mysqli_query($con, $sql);

                        if ($run) {
                        while ($rows = mysqli_fetch_array($run)) {
                        $volume = htmlspecialchars($rows['volume']);
                        $issue = htmlspecialchars($rows['issue']);
                        $year = htmlspecialchars($rows['year']);
                        ?>
                        <option value='<?php echo "vol-" . $volume . "-" . $issue . "-" . $year; ?>'>
                            <?php echo "vol-" . $volume . "-" . $issue . "-" . $year; ?>
                        </option>

                        <?php 
                          }
                          } else {
                          echo "No published issues found.";
                          }

                          // Close the database connection
                          mysqli_close($con);
                          ?>

                    </select>
                    </div>


                  <div class="col-12 mt-3">
                    <label for="formFile" class="form-label">Upload file</label>
                    <input type="file" class="form-control" name="p_file" id="formFile" placeholder="Select File">
                  </div>
                <div class="col-12 mt-4">
                  <button type="submit" name="a_comment_btn" class="btn btn-success">Update information</button>
                </div>
              </form>
              
              </div>

              </div>

            </div>


          </div>
        </main>


        <?php }?>
        

<?php include("includes/footer.php")?>