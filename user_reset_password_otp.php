<?php
include ('connection.php');

if (isset($_POST['send_otp'])) {
    $otp = $_POST['otp'];
    $user_email = $_POST['user_email'];

    if (empty($user_email)) {
        echo "Fill email field first.";
    } else {
        // Perform OTP verification logic here
        // For example:
        $stored_otp = ''; // Fetch the stored OTP for the user_email from database

        if ($otp == $stored_otp) {
            echo "OTP verified successfully!";
        } else {
            echo "Invalid OTP. Please try again.";
        }
    }
}
?>
