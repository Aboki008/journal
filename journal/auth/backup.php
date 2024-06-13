<?php
session_start();
include("../db/db_connect.php");

function sanitize_input($con, $input) {
    return mysqli_real_escape_string($con, htmlspecialchars($input));
}

// Create Edition
function create_edition($con) {
    $volume = sanitize_input($con, $_POST['volume']);
    $issue = sanitize_input($con, $_POST['issue']);
    $year = sanitize_input($con, $_POST['year']);

    // Check if volume and issue already exist
    $check_data_query = "SELECT * FROM edition WHERE volume=? AND issue=?";
    $stmt = $con->prepare($check_data_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("ss", $volume, $issue);
    $stmt->execute();
    $check_data_query_run = $stmt->get_result();

    if ($check_data_query_run->num_rows > 0) {
        $_SESSION['message'] = "Edition already exists";
        header('Location: ../admin/create.php');
        exit(0);
    }

    // Insert new edition
    $edition_query = "INSERT INTO edition (volume, issue, year, date) VALUES (?, ?, ?, current_timestamp())";
    $stmt = $con->prepare($edition_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("sss", $volume, $issue, $year);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Added successfully";
        header('Location: ../admin/create_edition.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Check data and try again";
        header('Location: ../admin/create_edition.php');
        exit(0);
    }
}

// Register User
function register_user($con) {
    $fname = sanitize_input($con, $_POST['fname']);
    $email = sanitize_input($con, $_POST['email']);
    $password = sanitize_input($con, $_POST['password']);
    $cpassword = sanitize_input($con, $_POST['cpassword']);
    $status = 'pending';

    // Check if user exists
    $check_email_query = "SELECT email FROM users WHERE email=?";
    $stmt = $con->prepare($check_email_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $check_email_query_run = $stmt->get_result();

    if ($check_email_query_run->num_rows > 0) {
        $_SESSION['message'] = "User already exists";
        header('Location: ../login.php');
        exit(0);
    }

    if ($password == $cpassword) {
        // Insert user data
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password
        $insert_query = "INSERT INTO users (fname, email, password, status, role_as, date) VALUES (?, ?, ?, ?, '0', current_timestamp())";
        $stmt = $con->prepare($insert_query);
        if (!$stmt) {
            die("Prepare failed: " . $con->error);
        }
        $stmt->bind_param("ssss", $fname, $email, $hashed_password, $status);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Registered successfully";
            header('Location: ../user/index.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Registration not successful, try again";
            header('Location: ../index.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Passwords do not match";
        header('Location: ../index.php');
        exit(0);
    }
}

// User Login
function login_user($con) {
    $email = sanitize_input($con, $_POST['email']);
    $password = sanitize_input($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email=?";
    $stmt = $con->prepare($login_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $login_query_run = $stmt->get_result();

    if ($login_query_run->num_rows > 0) {
        $userdata = $login_query_run->fetch_assoc();
        if (password_verify($password, $userdata['password'])) { // Verify the password
            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'fname' => $userdata['fname'],
                'id' => $userdata['id'],
                'email' => $userdata['email']
            ];
            $_SESSION['role_as'] = $userdata['role_as'];

            if ($userdata['role_as'] == 1) {
                $_SESSION['message'] = "Welcome Admin";
                header('Location: ../admin/index.php');
                exit(0);
            } else {
                $_SESSION['message'] = "User logged in successfully";
                header('Location: ../user/index.php');
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Invalid user login details";
            header('Location: ../index.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid user login details";
        header('Location: ../index.php');
        exit(0);
    }
}

// Submit Manuscript
function submit_manuscript($con) {
    $author = sanitize_input($con, $_POST['author']);
    $user_id = 10; // Placeholder, should be dynamically set
    $title = sanitize_input($con, $_POST['title']);
    $manuscript_id = 'sbs-1-1-3-2024'; // Placeholder, should be dynamically generated
    $authors = sanitize_input($con, $_POST['authors']);
    $email = sanitize_input($con, $_POST['email']);
    $phone = sanitize_input($con, $_POST['phone']);
    $status = 'processing';
    $pname = 'test.png'; // Placeholder for file upload handling

    $manuscript_query = "INSERT INTO submitted_journal (user_id, manuscript_id, title, authors, email, phone, status, file, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, current_timestamp())";
    $stmt = $con->prepare($manuscript_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("isssssss", $user_id, $manuscript_id, $title, $authors, $email, $phone, $status, $pname);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Submitted successfully";
        header('Location: ../user/submitted_manuscript.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Check data and try again";
        header('Location: ../user/submit_manuscript.php');
        exit(0);
    }
}

// Update User
function update_user($con) {
    $user_id = sanitize_input($con, $_POST['user_id']);
    $fname = sanitize_input($con, $_POST['fname']);
    $email = sanitize_input($con, $_POST['email']);
    $phone = sanitize_input($con, $_POST['phone']);
    $alt_phone = sanitize_input($con, $_POST['alt_phone']);
    $address = sanitize_input($con, $_POST['address']);
    $alt_address = sanitize_input($con, $_POST['alt_address']);
    $state = sanitize_input($con, $_POST['state']);
    $city = sanitize_input($con, $_POST['city']);
    $status = 'updated';

    $update_query = "UPDATE users SET fname=?, email=?, phone=?, alt_phone=?, address=?, alt_address=?, state=?, city=?, status=? WHERE id=?";
    $stmt = $con->prepare($update_query);
    if (!$stmt) {
        die("Prepare failed: " . $con->error);
    }
    $stmt->bind_param("sssssssssi", $fname, $email, $phone, $alt_phone, $address, $alt_address, $state, $city, $status, $user_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Updated successfully";
        header('Location: ../user/index.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Update failed";
        header('Location: ../user/profile.php');
        exit(0);
    }
}

// Handling form submissions
if (isset($_POST['create_edition_btn'])) {
    create_edition($con);
} elseif (isset($_POST['register_btn'])) {
    register_user($con);
} elseif (isset($_POST['login_btn'])) {
    login_user($con);
} elseif (isset($_POST['submit_manuscript_btn'])) {
    submit_manuscript($con);
} elseif (isset($_POST['update_user'])) {
    update_user($con);
} else {
    echo "No valid form submission detected.";
}
?>
