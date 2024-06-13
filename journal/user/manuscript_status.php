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
                $a_comment=$rows['a_comment'];
                $file=$rows['file'];
                $status=$rows['status'];
                $date=$rows['date'];

                ?>

<form action="../auth/auth.php" method="POST">
              <div class="container py-4 mb-5 w50 shadow rounded">
             
              <div class="row py-2 px-3">
              <div class="col-12">
                <p>Manuscript Title: <span><?php echo $title; ?></span></p>
              </div>
              <div class="col-12">
                <p>Authors: <span><?php echo $authors?></span></p>
              </div>
              <div class="col-12">
                <p>Affiliations: <span>affiliations</span></p>
              </div>
              <div class="col-md-4">
                <p>Corresponders Email: <span><?php echo $email; ?></span></p>
              </div>
              <div class="col-md-4">
                <p>Corresponders Phone Number: <span><?php echo $phone; ?></span></p>
              </div>
              <div class="col-md-4">
                <p>Status: <span><?php echo $status?></span></p>
              </div>
              <div class="col-8">
                <p>Manuscript ID: <span><?php echo $manuscript_id; ?></span></p>
              </div>
              <div class="col-4">
              <?php

                  if($status=='published'){
                    ?>
                          <a href="<?php echo "../published_manuscripts/".$edition."/".$p_file; ?>" class="btn btn-sm btn-sccess">PDF File</a>
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
                <p>Comment:</p>
                  <textarea name="" id="" col="6" class="form-control" disabled><?php echo $a_comment; ?></textarea>
              </div>
              <div class="col-md-6">
                <div class="col-12">
                <p>Reply comment:</p>
                  <textarea name="comment" id="" col="6" class="form-control"></textarea>
                </div>
                <div class="col-12 mt-4">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                  <button class="btn btn-success" name="comment_btn">Send comment</button>
                </div>
              </div>
              
              </div>

              </div>
</form>
            </div>


          </div>
        </main>


        <?php }?>
        

<?php include("includes/footer.php")?>