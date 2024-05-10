<?php
include ("connection.php");

$otp_error = "";
if (isset($_POST['doctor_verify_otp'])) {
    $nmc = $_POST['nmc'];
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $pass = $_POST['doctor_pass'];
    $speciality = $_POST['speciality'];
    $degree = $_POST['degree'];
    $clinic = $_POST['clinic'];
    $clinic_address = $_POST['clinic_address'];
    $otp = $_POST['otp'];
    $check_otp = $_POST['check_otp'];
    $image = $_POST['image'];

    if ($check_otp == $otp) {
        // OTP verification successful, proceed with user registration
        // Hash the password
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $register_query = "INSERT INTO doctor (doctor_image,nmc,doctor_name, doctor_email, doctor_password, speciality, degree, clinic, clinic_address) VALUES ('$image','$nmc','$name', '$email', '$hashed_password', '$speciality', '$degree', '$clinic', '$clinic_address')";
        $result = mysqli_query($conn, $register_query);

        if ($result) {
            session_start();
            // Registration successful
            $_SESSION['insert_success'] = true; // Set session variable for success

            header("Location:login.php");
            exit; // Stop further execution
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        $otp_error = "Invalid OTP";
    }
}
?>