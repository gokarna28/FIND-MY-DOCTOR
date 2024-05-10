<?php
require ("doctor_send_mail.php");
$otp = rand(00000, 99999);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor register</title>
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
    <div class="doctor_container">
        <div class="back_btn">
            <button><a href="login.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <h2>Doctor Registration Form</h2>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="msg">
                <?php echo $error_msg; ?>
            </div>
            <input type="hidden" name="otp" value="<?php echo $otp ?>">
            <div class="fields">
                <div class="input_field">
                    <label>NMC:</label><br />
                    <div class="input">
                        <input type="number" name="nmc" placeholder="Enter your nmc number"
                            value="<?php echo $nmc ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $nmc_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Fullname:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-user"></i>
                        <input type="text" name="doctor_name" placeholder="Enter your fullname"
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
                        <input type="email" name="doctor_email" id="user_email" placeholder="Enter your email"
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
                        <input type="password" name="doctor_pass" id="user_pass" placeholder="Enter your password"
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
                        <input type="password" name="doctor_cpass" id="user_cpass" placeholder="Retype your password"
                            value="<?php echo $cpass ?>" />
                        <a href="#" class="ceye_close" onclick="ceyeClose()"><i class="fa-solid fa-eye-slash"></i></a>
                        <a href="#" class="ceye_open hide" onclick="ceyeOpen()"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <span class="field_error">
                        <?php echo $cpass_error ?>
                    </span>
                </div>
                
                <div class="input_field">
                    <label for="speciality">Speciality:</label>
                    <div class="input">
                    <i class="fa-solid fa-building-user"></i>
                        <select name="speciality" id="speciality" value="<?php echo $speciality?>">
                            <option value="" disabled selected>Select your speciality</option>
                            <option value="Physicians">Physicians</option>
                            <option value="Anesthesiologists">Anesthesiologists</option>
                            <option value="Psychiatrists">Psychiatrists</option>
                            <option value="Pathologists">Pathologists</option>
                            <option value="Radiologists">Radiologists</option>
                            <option value="Cardiology">Cardiology</option>
                            <option value="Neurology">Neurology</option>
                            <option value="Opthamalogy">Opthamalogy</option>
                            <option value="Dentist">Dentist</option>
                            <option value="Dermatology">Dermatology</option>
                            <option value="Surgeons">Surgeons</option>
                            <option value="Pediatricians">Pediatricians</option>
                        </select>
                    </div>
                    <span class="field_error">
                        <?php echo $special_error ?>
                    </span>
                </div>

                <div class="input_field">
                    <label>Degree:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-graduation-cap"></i>
                        <input type="text" name="degree" placeholder="Enter your degree" value="<?php echo $degree ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $degree_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Clinic:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-house-medical-circle-check"></i>
                        <input type="text" name="clinic" placeholder="Enter your clinic name"
                            value="<?php echo $clinic ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $clinic_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Clinic Location:</label><br />
                    <div class="input">
                    <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="clinic_address" placeholder="Enter your clinic location"
                            value="<?php echo $clinic_address ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $address_error ?>
                    </span>
                </div>
                <div class="input_field">
                    <label>Upload Profile Image:</label><br />
                    <div class="input">
                        <input type="file" name="image"
                            value="<?php echo $folder ?>" />
                    </div>
                    <span class="field_error">
                        <?php echo $img_error ?>
                    </span>
                </div>
            </div>

            <div class="submit_btn">
                <button type="submit" name="doctor_submit">Register Now</button>
            </div>
            <div class="links">
                Already have a account? <a href="login.php">Login</a> or
                <a href="user_register.php">Register as user</a>
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