<?php
include ("connection.php");
session_start(); // Start the session

$mail_msg = "";
$error_msg = "";
$name_error = "";
$email_error = "";
$pass_error = "";
$cpass_error = "";
$name = "";
$email = "";
$pass = "";
$cpass = "";
$otp = "";

if (isset($_POST['user_submit'])) {

    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $pass = $_POST['user_pass'];
    $cpass = $_POST['user_cpass'];
    $otp = $_POST['otp'];

    // Store data in session
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['pass'] = $pass;
    $_SESSION['otp'] = $otp;

    // Check if all required fields are filled
    if (empty(trim($name)) || empty(trim($email)) || empty(trim($pass)) || empty(trim($cpass))) {
        $error_msg = "Fill all the fields";
    } else {
        // Name validation
        if (empty($name)) {
            $name_error = "Name is required*";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $name_error = "Name can only contain letters and spaces.";
        } elseif (strlen($name) > 40) {
            $name_error = "Full name exceeds 40 characters.";
        }

        // Email validation
        if (empty($email)) {
            $email_error = "Email is required*";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        } else {
            // Check if email already exists in the database
            $query = "SELECT * FROM user WHERE user_email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $email_error = "User with this email already exists.";
            }
        }

        // Password validation
        if (empty($pass)) {
            $pass_error = "Password is required*";
        } elseif (strlen($pass) < 8) {
            $pass_error = "Password must be at least 8 characters long";
        }

        // Confirm Password validation
        if (empty($cpass)) {
            $cpass_error = "Confirm Password is required*";
        } elseif ($cpass != $pass) {
            $cpass_error = "Passwords do not match";
        }

        // If no validation errors, proceed to send email
        if (empty($name_error) && empty($email_error) && empty($pass_error) && empty($cpass_error)) {
            // Send email
            $to = $email;
            $subject = "OTP Authentication";

            // Use HTML content for the email message
            $message = '<html><body>';
            $message .= '<p>Your OTP is: <strong style="font-size: 16px;">'  . $otp .  ' </strong>Use the OTP for complete registration.</p>';
            $message .= '</body></html>';

            $headers = "From: gokarnachy28@gmail.com\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // Set content type as HTML

            $check = mail($to, $subject, $message, $headers);

            if ($check) {
                header("location: mail.php"); // Redirect to mail.php after sending email
                exit; // Terminate script execution after redirection
            } else {
                echo "Failed to send the email";
            }
        }
    }
}

