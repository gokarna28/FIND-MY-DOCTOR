<?php
require("doctor_submit_otp.php");
session_start(); // Start the session

// Retrieve data from session
$nmc = $_SESSION['nmc'] ?? '';
$name = $_SESSION['doctor_name'] ?? '';
$email = $_SESSION['doctor_email'] ?? '';
$pass = $_SESSION['doctor_pass'] ?? '';
$otp = $_SESSION['otp'] ?? '';
$speciality = $_SESSION['speciality'] ?? '';
$degree = $_SESSION['degree'] ?? '';
$clinic = $_SESSION['clinic'] ?? '';
$clinic_address = $_SESSION['clinic_address'] ?? '';
$doctor_image = $_SESSION['image'] ?? '';


// Clear session variables (optional)
unset($_SESSION['nmc']);
unset($_SESSION['doctor_name']);
unset($_SESSION['doctor_email']);
unset($_SESSION['doctor_pass']);
unset($_SESSION['speciality']);
unset($_SESSION['degree']);
unset($_SESSION['clinic']);
unset($_SESSION['clinic_address']);
unset($_SESSION['otp']);
unset($_SESSION['image']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <div class="otp_form">
    <div class="back_btn">
            <button><a href="#"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>Verify OTP</h2><br>
        <form action="" method="post" autocomplete="off">
            <div class="mail_msg">
            Check your email <?php echo $email?>  to complete the registration.
            </div>
            <div class="otp_input">
                <div>
                <input type="number" name="check_otp" placeholder="Enter your OTP"><br>
                <span class="field_error">
                        <?php echo $otp_error ?>
                    </span>
                </div>
                <input type="hidden" name="otp" value="<?php echo $otp ?>">
                <input type="hidden" name="nmc" value="<?php echo $nmc ?>">
                <input type="hidden" name="image" value="<?php echo $doctor_image ?>">
                <input type="hidden" name="doctor_name" value="<?php echo $name ?>">
                <input type="hidden" name="doctor_email" value="<?php echo $email ?>">
                <input type="hidden" name="doctor_pass" value="<?php echo $pass ?>"><br>
                <input type="hidden" name="speciality" value="<?php echo $speciality ?>"><br>
                <input type="hidden" name="degree" value="<?php echo $degree ?>"><br>
                <input type="hidden" name="clinic" value="<?php echo $clinic ?>"><br>
                <input type="hidden" name="clinic_address" value="<?php echo $clinic_address ?>"><br>
            </div>
            <div class="otp_submit">
                <button type="submit" name="doctor_verify_otp">Verify</button>
            </div>
        </form>
    </div>
</body>

</html>
