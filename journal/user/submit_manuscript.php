<?php include("includes/header.php")?>

<body>
    <div class="wrapper">


    <?php include("includes/sidebar.php")?>

            
    <div class="main">


    <?php include("includes/top_nav.php")?>
      <main class="content px-3 py-4">
        <div class="container-fluid">
          <div class="mb-3">
            <h2 class="py-3 fw-bold text-center">Submit Manuscript</h2>
            <div class="container py-y px-3 mb-5 w50 shadow rounded">
              <form action="../auth/auth.php" method="POST" class="row g-3" enctype="multipart/form-data">
                <?php include('../message.php'); ?>
                <div class="col-md-12">
                  <label for="inputTitle" class="form-label">Title</label>
                  <input type="text" name="title" class="form-control" id="inputTitle">
                </div>
                <div class="col-md-12">
                  <label for="inputAuthors" class="form-label">Names of Authors</label>
                  <input type="text" name="authors" class="form-control" id="inputAuthors" placeholder="e.g PHILIP M., SAMSON G....">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail" class="form-label">Email of Corresponding Author</label>
                  <input type="email" name="email" class="form-control" id="inputEmail">
                </div>
                <div class="col-md-6">
                  <label for="inputPhone" class="form-label">Phone of Corresponding Author</label>
                  <input type="text" name="phone" class="form-control" id="inputPhone">
                </div>
                <div class="col-12">
                  <label for="formFile" class="form-label">Upload Document (only doc files *)</label>
                  <input type="file" class="form-control" name="file" id="formFile" placeholder="Select File">
                </div>
                <div class="col-12 mb-5">
                  <button type="submit" name="submit_manuscript_btn" class="btn btn-primary">Submit Manuscript</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>



<?php include("includes/footer.php")?>