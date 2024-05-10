<?php
include ("connection.php");


$otp_error = "";
if (isset($_POST['verify_otp'])) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $otp = $_POST['otp'];
    $check_otp = $_POST['check_otp'];

    if ($check_otp == $otp) {
        // OTP verification successful, proceed with user registration
        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $register_query = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$name', '$email', '$hashed_password')";
        $result = mysqli_query($conn, $register_query);

        if ($result) {
            $user_id = mysqli_insert_id($conn); // Get the auto-generated user_id

            // Start session
            session_start();

            // Store doctor_id in session variable
            $_SESSION['user_id'] = $user_id;
            // Redirect to user dashboard 
            header("Location: user_dashboard.php");
            exit; // Stop further execution
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $otp_error = "Invalid OTP";
    }
}
?>