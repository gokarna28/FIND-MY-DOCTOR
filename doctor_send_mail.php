<?php
include ("connection.php");
session_start(); // Start the session

$mail_msg = "";
$error_msg = "";
$nmc_error = "";
$name_error = "";
$email_error = "";
$pass_error = "";
$cpass_error = "";
$special_error = "";
$degree_error = "";
$clinic_error = "";
$address_error = "";
$name = "";
$email = "";
$pass = "";
$cpass = "";
$speciality = "";
$degree = "";
$clinic = "";
$clinic_address = "";
$otp = "";
$folder = "";
$img_error = "";

if (isset($_POST['doctor_submit'])) {

    //image upload field
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "doctor/" . $filename;
    move_uploaded_file($tempname, $folder);

    $otp = $_POST['otp'];
    $nmc = $_POST['nmc'];
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $pass = $_POST['doctor_pass'];
    $cpass = $_POST['doctor_cpass'];
    $speciality = isset($_POST['speciality']) ? $_POST['speciality'] : '';
    $degree = $_POST['degree'];
    $clinic = $_POST['clinic'];
    $clinic_address = $_POST['clinic_address'];

    // Store data in session
    $_SESSION['nmc'] = $nmc;
    $_SESSION['doctor_name'] = $name;
    $_SESSION['doctor_email'] = $email;
    $_SESSION['doctor_pass'] = $pass;
    $_SESSION['otp'] = $otp;
    $_SESSION['speciality'] = $speciality;
    $_SESSION['degree'] = $degree;
    $_SESSION['clinic'] = $clinic;
    $_SESSION['clinic_address'] = $clinic_address;
    $_SESSION['image'] = $folder;

    // Check if all required fields are filled
    if (empty(trim($nmc)) || empty(trim($name)) || empty(trim($email)) || empty(trim($pass)) || empty(trim($cpass)) || empty(trim($speciality)) || empty(trim($degree)) || empty(trim($clinic)) || empty(trim($clinic_address)) || empty(trim($folder))) {
        $error_msg = "Fill all the fields";
    }

    // NMC validation
    if (empty($nmc)) {
        $nmc_error = "Email is required*";
    } else {
        // Check if nmc already exists in the database
        $query = "SELECT * FROM doctor WHERE nmc = '$nmc'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $nmc_error = "Doctor with this nmc already exists.";
        }
    }
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
        $query = "SELECT * FROM doctor WHERE doctor_email = '$email'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $email_error = "Doctor with this email already exists.";
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
    //speciality validation
    if (empty($speciality)) {
        $special_error = "speciality is required*";
    }
    //degree validation
    if (empty($degree)) {
        $degree_error = "degree is required*";
    }
    //clinic name validation
    if (empty($clinic)) {
        $clinic_error = "Name is required*";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $clinic)) {
        $clinic_error = "Clinic name can only contain letters and spaces.";
    } elseif (strlen($clinic) > 50) {
        $clinic_error = "Clinic name exceeds 50 characters.";
    }
    //clinic address validation
    if (empty($clinic_address)) {
        $address_error = "address is required*";
    } elseif (strlen($clinic_address) > 50) {
        $address_error = "Address exceeds 100 characters.";
    }
    //image validation
    if (empty($folder)) {
        $img_error = "address is required*";
    }
    // If no validation errors, proceed to send email
    if (empty($nmc_error) && empty($name_error) && empty($email_error) && empty($pass_error) && empty($cpass_error) && empty($special_error) && empty($degree_error) && empty($clinic_error) && empty($address_error) && empty($img_error)) {
        // Send email
        $to = $email;
        $subject = "OTP Authentication";

        // Use HTML content for the email message
        $message = '<html><body>';
        $message .= '<p>Your OTP is: <strong style="font-size: 16px;">' . $otp . ' </strong>Use the OTP for complete registration.</p>';
        $message .= '</body></html>';

        $headers = "From: gokarnachy28@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n"; // Set content type as HTML

        $check = mail($to, $subject, $message, $headers);

        if ($check) {
            //echo "email successfully sent";
            header("location: doctor_mail.php"); // Redirect to mail.php after sending email
            exit; // Terminate script execution after redirection
        } else {
            echo "Failed to send the email";
        }
    }
}

