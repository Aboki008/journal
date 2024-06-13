<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../db/db_connect.php");

if(isset($_POST['create_edition_btn'])){
    $volume = mysqli_real_escape_string($con, $_POST['volume']);
    $issue = mysqli_real_escape_string($con, $_POST['issue']);
    $year = mysqli_real_escape_string($con, $_POST['year']);

    // Check if volume exists
    $check_data_query = "SELECT * FROM edition WHERE volume='$volume' AND issue='$issue' AND year='$year'";
    $check_data_query_run = mysqli_query($con, $check_data_query);

    if(mysqli_num_rows($check_data_query_run) > 0){
        $_SESSION['message'] = "Edition already exists";
        header('Location: ../admin/create.php');
        exit();
    }

    // Insert new edition
    $edition_query = "INSERT INTO edition (volume, issue, year, date) VALUES ('$volume', '$issue', '$year', current_timestamp())";
    $edition_query_run = mysqli_query($con, $edition_query);

    if($edition_query_run){
        // Create the directory for the new edition
        $edition_folder = '../published_manuscripts/vol-' . $volume . '-' . $issue . '-' . $year;
        
        // Check if the directory already exists
        if (!is_dir($edition_folder)) {
            mkdir($edition_folder, 0777, true);
        }

        $_SESSION['message'] = "Added successfully";
        header('Location: ../admin/create_edition.php');
        exit();
    } else {
        $_SESSION['message'] = "Check data and try again";
        header('Location: ../admin/create_edition.php');
        exit();
    }
}





if(isset($_POST['register_btn']))
	{
		$fname = mysqli_real_escape_string($con,$_POST['fname']);
		$email = mysqli_real_escape_string($con,$_POST['email']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		$cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
    $status = 'pending';
	

	//check if user exist
	$check_email_query = " SELECT email FROM users where email='$email' ";
	$check_email_query_run = mysqli_query($con,$check_email_query);

	if(mysqli_num_rows($check_email_query_run) > 0){

		$_SESSION['message'] = "User already exist";
		header('Location: ../index.php');
    exit(0);
	}

	else{
	if($password == $cpassword){

		//insert user data
		$insert_query = "INSERT INTO `users` (`id`, `fname`, `email`, `password`, `phone`, `alt_phone`, `address`, `alt_address`, `city`, `state`, `status`, `role_as`, `date`) VALUES (NULL, '$fname', '$email', '$password', '', '', '', '', '', '', '$status', '0', current_timestamp())";
		$insert_query_run = mysqli_query($con, $insert_query);

		if($insert_query_run){

			//$to = "$email";
			//$subject = "Registration Status";
			//$message = "Welcome to International Journal for Science and Applied Research. Your registration was successful thank you.";
			//mail($to, $subject, $message);
			$_SESSION['message'] = "Registered successfully";
			header('Location: ../index.php');
      exit(0);
		}
		else{
			$_SESSION['message'] = "Registration not successful try again";
			header('Location: ../index.php');
      exit(0);
		}

	}
	else{
		$_SESSION['message'] = "Passwords do not match";
		header('Location: ../index.php');
    exit(0);
	}
}

}


	if (isset($_POST['login_btn'])) {
		

		// login code

		$email = mysqli_real_escape_string($con, $_POST['email']);
		$password = mysqli_real_escape_string($con, $_POST['password']);
	
		$login_query = "SELECT * FROM users where email='$email' AND password='$password'";
		$login_query_run = mysqli_query($con, $login_query);

		if (mysqli_num_rows($login_query_run) > 0) {
			// code...

			$_SESSION['auth'] =  true;

			$userdata = mysqli_fetch_array($login_query_run);
			$userid = $userdata['id'];
			$fname = $userdata['fname'];
			$useremail = $userdata['email'];
			$role_as = $userdata['role_as'];
			
			$_SESSION['auth_user'] = [

				'fname' => $fname,
				'id' => $userid,
				'email' => $useremail
			];

			$_SESSION['role_as'] = $role_as;

			if($role_as == 1){

			$_SESSION['message'] = "Welcome Admin";
			header('LOCATION: ../admin/index.php');
      exit(0);

			}

			else{
			$_SESSION['message'] = "User Logged in successfully";
			header('LOCATION: ../user/index.php');
      exit(0);

			}


		}

		else{
			$_SESSION['message'] = "Invalid user login details";
			header('Location: ../index.php');
      exit(0);
		}

	}



if(isset($_POST['submit_manuscript_btn'])){
  $authors = $_POST['authors'];
  $user_id = $_SESSION['auth_user']['id'];
  $title = $_POST['title'];
  $manuscript_id = 'SBS'.'-'.rand(01,99).'-'.$_SESSION['auth_user']['id'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $status = 'proccessing';

	$new_file_name = $manuscript_id.".docx";


	$tname = $_FILES["file"]["tmp_name"];
	var_dump($_FILES);

	$uploads_dir = '../submitted_manuscripts';

	// Debugging: Check if $tname is set correctly
	var_dump($tname);

	// Debugging: Check if $new_file_name is set correctly
	var_dump($new_file_name);

	// Attempt to move the uploaded file
	move_uploaded_file($tname, $uploads_dir.'/'.$new_file_name);
	
	// Debugging: Check if the file was moved successfully
	var_dump(file_exists($uploads_dir.'/'.$new_file_name));

	$validdoc = ['pdf','doc','docx'];
	$docExtention = explode('.', $new_file_name);
	$docExtention = strtolower(end($docExtention));

	if (in_array($docExtention, $validdoc)) {
		// code...		

		$manuscript_query = "INSERT INTO `submitted_journal` (`id`, `user_id`, `manuscript_id`, `title`, `authors`, `email`, `phone`, `status`, `file`, `comment`, `a_comment`, `edition`, `p_file`, `date`) VALUES (NULL, '$user_id', '$manuscript_id', '$title', '$authors', '$email', '$phone', '$status', '$new_file_name', '', '', '', '', current_timestamp())";

		$manuscript_query_run = mysqli_query($con, $manuscript_query);

		if($manuscript_query_run){
			$_SESSION['message'] = "Submitted successfully";
			header('Location: ../user/submit_manuscript.php');
		}
		else{
			$_SESSION['message'] = "Check data and try again";
			header('Location: ../user/submit_manuscript.php');
		}

	} else {
		$_SESSION['message'] = "Check file information";
		header('Location: ../user/submit_manuscript.php');

	}
  

}


if (isset($_POST['update_user'])) {

  $user_id = $_POST['user_id'];
  $fname = $_POST['fname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $alt_phone = $_POST['alt_phone'];
  $address = $_POST['address'];
  $alt_address = $_POST['alt_address'];
  $state = $_POST['state'];
  $city = $_POST['city'];
  $status = 'updated';

  // Correct the SQL query by using the variables for address and state
  $update_query = "UPDATE users SET fname='$fname', email='$email', phone='$phone', alt_phone='$alt_phone', address='$address', alt_address='$alt_address', state='$state', city='$city', status='$status' WHERE id='$user_id' ";

  // Run the query
  $update_query_run = mysqli_query($con, $update_query);

  if ($update_query_run) {
    $_SESSION['message'] = "Updated successfully";
    header('Location: ../user/profile.php');
    exit(0);
  } else {
    $_SESSION['message'] = "Update failed";
    header('Location: ../user/profile.php');
    exit(0);
  }
}



if(isset($_POST['comment_btn'])){

	$id = $_POST['id'];
	$comment = $_POST['comment'];

		// code...		

		$update_query = "UPDATE `submitted_journal` SET comment='$comment' WHERE id='$id' ";

		$update_query_run = mysqli_query($con, $update_query);
	
		if($update_query_run){
	
	
			$_SESSION['message'] = "Updated successfully";
			header('Location: ../user/index.php');
			exit(0);
			}
	
			else{
	
			$_SESSION['message'] = "Update failed ";
			header('Location: ../user/index.php');
			exit(0);
	
			}
 
}


if(isset($_POST['a_comment_btn'])) {

  $id = mysqli_real_escape_string($con, $_POST['id']);
  $edition = mysqli_real_escape_string($con, $_POST['edition']);
  $status = mysqli_real_escape_string($con, $_POST['status']);
  $manuscript_id = mysqli_real_escape_string($con, $_POST['manuscript_id']);
  $a_comment = mysqli_real_escape_string($con, $_POST['a_comment']);

  $p_file = $manuscript_id."-".$id.".pdf";

  $tname = $_FILES["p_file"]["tmp_name"];

  $uploads_dir = '../published_manuscripts/'.$edition;

  // Check if the directory exists and create it if not
  if (!is_dir($uploads_dir)) {
      mkdir($uploads_dir, 0777, true);
  }

  // Attempt to move the uploaded file
  move_uploaded_file($tname, $uploads_dir.'/'.$p_file);

  $validdoc = ['pdf','doc','docx'];
  $docExtention = explode('.', $p_file);
  $docExtention = strtolower(end($docExtention));

  if (in_array($docExtention, $validdoc)) {

      // Update query
      $update_query = "UPDATE `submitted_journal` SET edition='$edition', a_comment='$a_comment', status='$status', p_file='$p_file' WHERE id='$id'";

      $update_query_run = mysqli_query($con, $update_query);

      if ($update_query_run) {
          $_SESSION['message'] = "Updated successfully";
          header('Location: ../admin/index.php');
          exit(0);
      } else {
          $_SESSION['message'] = "Update failed: " . mysqli_error($con);
          header('Location: ../admin/index.php');
          exit(0);
      }
  } else {
      $_SESSION['message'] = "Invalid file type.";
      header('Location: ../admin/index.php');
      exit(0);
  }
}

