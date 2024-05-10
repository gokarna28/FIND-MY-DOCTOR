<?php
require ("send_mail.php");
$otp = rand(00000, 99999);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user register</title>
    <link rel="stylesheet" href="css/forms.css" />
    <!-- Link to Font Awesome CSS -->
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
    <div class="container">
        <div class="back_btn">
            <button><a href="login.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>User Registration Form</h2>

        <form action="" method="post" onsubmit="return validateForm()">

            <div class="msg">
                <?php echo $error_msg; ?>
            </div>
            <input type="hidden" name="otp" value="<?php echo $otp ?>">
            <div class="fields">
                <div class="input_field">
                    <label>Fullname:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-user"></i>
                        <input type="text" name="user_name" id="user_name" placeholder="Enter your fullname"
                            value="<?php echo $name ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $name_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Email:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="user_email" id="user_email" placeholder="Enter your email"
                            value="<?php echo $email ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $email_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Password:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-lock"></i>
                        <input type="password" name="user_pass" id="user_pass" placeholder="Enter your password"
                            value="<?php echo $pass ?>" />
                        <a href="#" class="eye_close" onclick="eyeClose()"><i class="fa-solid fa-eye-slash"></i></a>
                        <a href="#" class="eye_open hide" onclick="eyeOpen()"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <span class="field_error">
                        <?php echo $pass_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Confirm Passwoed:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-lock"></i>
                        <input type="password" name="user_cpass" id="user_cpass" placeholder="Retype your password"
                            value="<?php echo $cpass ?>" />
                        <a href="#" class="ceye_close" onclick="ceyeClose()"><i class="fa-solid fa-eye-slash"></i></a>
                        <a href="#" class="ceye_open hide" onclick="ceyeOpen()"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <span class="field_error">
                        <?php echo $cpass_error ?>
                    </span>
                </div>
            </div>

            <div class="submit_btn">
                <button type="submit" name="user_submit" id="user_btn">Register Now</button>
            </div>
            <div class="links">
                Already have a account? <a href="login.php">Login</a> or
                <a href="doctor_register.php">Register as doctor</a>
            </div>
        </form>
    </div>


    <script>
        //password visible
        function eyeClose() {
            document.querySelector("#user_pass").type = "text";
            document.querySelector(".eye_open").classList.remove("hide");
            document.querySelector(".eye_close").classList.add("hide");
        }
        //password hide
        function eyeOpen() {
            document.querySelector("#user_pass").type = "password";
            document.querySelector(".eye_open").classList.add("hide");
            document.querySelector(".eye_close").classList.remove("hide");
        }
        //confirm password visible
        function ceyeClose() {
            document.querySelector("#user_cpass").type = "text";
            document.querySelector(".ceye_open").classList.remove("hide");
            document.querySelector(".ceye_close").classList.add("hide");
        }
        //confirm password hide
        function ceyeOpen() {
            document.querySelector("#user_cpass").type = "password";
            document.querySelector(".ceye_open").classList.add("hide");
            document.querySelector(".ceye_close").classList.remove("hide");
        }

    </script>

</body>

</html>