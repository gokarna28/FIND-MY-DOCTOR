<?php
session_start();
include ("connection.php");

$email_error = "";
$pass_error = "";
$email = "";
$pass = "";
$error_msg = "";

if (isset($_POST['login_submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if (empty(trim($email)) || empty(trim($pass))) {
        $error_msg = "Fill all the fields";
    }

    // Email validation
    if (empty($email)) {
        $email_error = "Email is required*";
    }
    // Password validation
    if (empty($pass)) {
        $pass_error = "Password is required*";
    }

    // If no validation errors, proceed with login
    if (empty($email_error) && empty($pass_error)) {

        // Check if the email exists in either 'user' or 'doctor' or 'admin' table
        $check_user_query = "SELECT * FROM user WHERE user_email='$email'";
        $user_result = mysqli_query($conn, $check_user_query);

        $check_doctor_query = "SELECT * FROM doctor WHERE doctor_email='$email' AND status='approved'";
        $doctor_result = mysqli_query($conn, $check_doctor_query);

        $check_admin_query = "SELECT * FROM admin WHERE admin_email='$email'";
        $admin_result = mysqli_query($conn, $check_admin_query);

        // Check for user login
        if (mysqli_num_rows($user_result) == 1) {
            $user = mysqli_fetch_assoc($user_result);
            if (password_verify($pass, $user['user_password'])) {
                $_SESSION['user_id'] = $user['uid'];
                header("location: user_dashboard.php");
                exit;
            }
        }
        // Check for doctor login
        elseif (mysqli_num_rows($doctor_result) == 1) {
            $doctor = mysqli_fetch_assoc($doctor_result);
            if (password_verify($pass, $doctor['doctor_password'])) {
                $_SESSION['doctor_id'] = $doctor['did'];
                header("location: doctor_dashboard.php");
                exit;
            }
        }
        // Check for admin login
        elseif (mysqli_num_rows($admin_result) == 1) {
            $admin = mysqli_fetch_assoc($admin_result);
            if (password_verify($pass, $admin['admin_password'])) {
                $_SESSION['admin_id'] = $admin['admin_id'];
                header("location: admin_dashboard.php");
                exit;
            } else {
                $pass_error = "Incorrect password";
            }
        } else {
            $error_msg = "No account found. Please register.";
        }



    }
}
?>