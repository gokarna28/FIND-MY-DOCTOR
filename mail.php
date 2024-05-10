<?php
require("submit_otp.php");
session_start(); // Start the session

// Retrieve data from session
$name = $_SESSION['name'] ?? '';
$email = $_SESSION['email'] ?? '';
$pass = $_SESSION['pass'] ?? '';
$otp = $_SESSION['otp'] ?? '';

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
                <input type="hidden" name="user_name" value="<?php echo $name ?>">
                <input type="hidden" name="user_email" value="<?php echo $email ?>">
                <input type="hidden" name="user_pass" value="<?php echo $pass ?>"><br>
            </div>
            <div class="otp_submit">
                <button type="submit" name="verify_otp">Verify</button>
            </div>
        </form>
    </div>
</body>

</html>
