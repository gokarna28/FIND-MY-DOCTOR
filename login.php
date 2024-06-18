<?php
require ("login_submit.php");

// Check if insert success session variable is set
if (isset($_SESSION['insert_success']) && $_SESSION['insert_success'] === true) {
    // Display alert message using JavaScript
    echo "<script>alert('Your request is sent successfully! You can login only after the admin approval.');</script>";
    
    // Unset the session variable to prevent the alert from showing again
    unset($_SESSION['insert_success']);
}
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
    <div class="login_container">
        <div class="back_btn">
            <button><a href="dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>Login Form</h2>

        <form action="" method="post" onsubmit="return validateForm()">

            <div class="msg">
                <?php echo $error_msg; ?>
            </div>
            <div class="fields">

                <div class="input_field">
                    <label>Email:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-user"></i>
                        <input type="email" name="email" id="user_email" placeholder="Enter your email"
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
                        <input type="password" name="pass" id="user_pass" placeholder="Enter your password"
                            value="<?php echo $pass ?>" />
                        <a href="#" class="eye_close" onclick="eyeClose()"><i class="fa-solid fa-eye-slash"></i></a>
                        <a href="#" class="eye_open hide" onclick="eyeOpen()"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <span class="field_error">
                        <?php echo $pass_error ?>
                    </span>
                </div>

            </div>
            <div class="forgot_pass">
                <!-- <a href="#">Forgot Password</a> -->
            </div>

            <div class="submit_btn">
                <button type="submit" name="login_submit" id="user_btn">Login Now</button>
            </div>
            <div class="links">
                Don't have a account? Register as <a href="user_register.php">user</a> or
                <a href="doctor_register.php">doctor</a>
            </div>
        </form>
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

        </script>
    </div>
</body>

</html>
