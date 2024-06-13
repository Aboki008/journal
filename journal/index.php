<?php 
include("db/db_connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>SBS Journal</title>
</head>

<body>


  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand me-auto" href="#"><img src="images/sbs_logo.png" height="67" width="70" alt="sbs logo"></a>
      
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">SBS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link mx-lg-2 active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Current Isuess</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Archives</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Editorial Board</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Authors Guidelines</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">About</a>
            </li>
          </ul>
        </div>
      </div>
      <a href="login.html" class="login-button" data-bs-toggle="modal" data-bs-target="#exampleModal">Publish with Us</a>
      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>


  <div class="hero-section">
    <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
      <h1>SBS Jos JOURNAL</h1>
      <h2>of</h2>
      <h2>Religous Studies and Humanities</h2>

    </div>

  </div>


  <section class="highlights py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Journal Information</h5>
                            <p class="card-text">The SBS Jos Journal of Religious Studies and Humanities is a bi-annual pair-review academic journal.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Journal Scope</h5>
                            <p class="card-text">Journal covers biblical, philosophical, anthropological, sociological and psychological aspects of religion.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Journal Aim</h5>
                            <p class="card-text"> The aim is the advancement of sound scholarly biblical knowledge..</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <!-- Current Published Issues -->
   <div class="container mt-5">
        <h2 class="text-center mb-4">Current Published Issues</h2>
        <div class="row">

        <?php
        // Ensure this block of code is inside a PHP file with the proper PHP opening tag

        // Database connection
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM submitted_journal WHERE status='published'";
        $run = mysqli_query($con, $sql);

        if ($run) {
            while ($rows = mysqli_fetch_array($run)) {
                $p_file = htmlspecialchars($rows['p_file']);
                $authors = htmlspecialchars($rows['authors']);
                $title = htmlspecialchars($rows['title']);
                $edition = htmlspecialchars($rows['edition']);
                $date = htmlspecialchars($rows['date']);
        ?>

            <div class="col-md-4 border-0 rounded shadow py-4 px-4 mb-3">
                <div class="issue-card">
                    <div class="issue-title">
                        <div>
                            <h6><?php echo $title; ?></h6>
                            <p><?php echo $date; ?></p>
                        </div>
                    </div>
                    <p><?php echo $authors; ?></p>
                    <a href="<?php echo "../published_manuscripts/".$edition."/".$p_file; ?>" class="login-button">Download PDF</a>
                </div>
            </div>

        <?php 
            }
        } else {
            echo "No published issues found.";
        }

        // Close the database connection
        mysqli_close($con);
        ?>

        </div>
    </div>


  <div class="review">

    <div class="container align-items-center mt-2 mb-3 fs-4"> 
      <div class="row">
        <div class="col-md-3 col-sm-6 mt-3"><span><i class='bx bxs-plane'></i></span> Fast Review</div>
        <div class="col-md-3 col-sm-6 mt-3"><span><i class='bx bx-lock-alt' ></i></span> Safe Payment</div>
        <div class="col-md-3 col-sm-6 mt-3"><span><i class='bx bx-bar-chart-square' ></i></span> Realtime Update</div>
        <div class="col-md-3 col-sm-6 mt-3"><span><i class='bx bx-headphone'></i></span> 247 Support</div>
      </div>
    </div>

  </div>

  <div class="get-started">
    <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">
      <h1 class="">CALL for PAPERS</h1>
      <h4 class="">Paper Submissions are OPEN NOW</h4>
      <h2><a href="#" class="login-button">Submit Paper</a></h2>

    </div>
  </div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">


      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      
    <div class="my-form align-items-center border-0 shadow">

      <h1>Login Form</h1>
<?php include('message.php');?>
      <form action="auth/auth.php" method="POST">
        <div class="mb-3 mt-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 mt-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="login_btn" class="btn btn-primary mt-3">Submit</button>
      </form>
      <p class="mt-3">Not a member? <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal1">Sign up now</a></p>
    </div>


      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">


      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      
    <div class="my-form align-items-center border-0 shadow">

      <h1>Sign up form</h1>
<?php include('message.php');?>
      <form action="auth/auth.php" method="POST">
        <div class="mb-3 mt-3">
          <label for="exampleInputEmail1" class="form-label">Full name</label>
          <input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 mt-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 mt-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 mt-3">
          <label for="exampleInputPassword1" class="form-label">ConfirmPassword</label>
          <input type="password" name="cpassword" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" name="register_btn" class="btn btn-primary mt-3">Submit</button>
      </form>
      <p class="mt-3">Already a member? <a href="#" class="" data-bs-toggle="modal" data-bs-target="#exampleModal">Login now</a></p>
    </div>


      </div>
    </div>
  </div>
</div>


  <footer class="bg-dark text-white pt-5 pb-4">
    <div class="container text-md-left">
      <div class="row text-md-left">
        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold  text-warning">SBS JOURNAL</h5>
        <p>ISSN (Online): 2583-3138</p>
        <p>Publication Frequency: bi-annual journal (June and December).</p>
        <p>Publication Format: Online</p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Useful Links</h5>
          <p>
            <a href="#" class="">Phone Number</a>
          </p>
          <p>
            <a href="#" class="">Alternate Number</a>
          </p>
          <p>
            <a href="#" class="">Email Address</a>
          </p>
          <p>
            <a href="#" class="">Publish Now</a>
          </p>
          <p>
            <a href="#" class="">Authors Guide</a>
          </p>
          <p>
            <a href="#" class="">Ethical Guidelines</a>
          </p>
          <p>
            <a href="#" class="">Sample Manuscript</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
          <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Editorial Board</h5>
                    
            <p>Dr Tom U. Ekpot</p>
            <p>Dr Joseph Azembeh</p>
            <p>Dr Jacob Hundu</p>
            <p>Emmanuel O. Egyegini</p>
            <p>Chika Onyimba</p>
            <p>Benjamin Jukwey</p>
            <p>Dr Yoila Yilpet</p>

        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-2">
          <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Editorial Consultants</h5>

          <P>Prof. Umar H.D. Danfulani</P>
          <p>Prof. Daniel McCain</p>
          <P>Prof. Shishima</P>
          <P>Prof. Gaiya Musa</P>
          <p>Prof. Udouka</p>
          <p>Dr AbiodunOwulabi</p>
          <p>Dr Philip Asurah</p>



        </div>


      </div>
      <hr>

      <div class="row align-items-center">
        <div class="col-md-7 col-lg-8">
          <p>
            Copyright @2024 All rights reserved by: 
            <a href="#">
              <strong class="text-warning">Steps plus</strong>
            </a>
          </p>
        </div>
      </div>
    </div>
  </footer>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>