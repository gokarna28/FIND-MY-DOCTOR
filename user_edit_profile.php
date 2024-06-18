<?php
include ("connection.php");
require ("user_edit_submit.php");
require ("appointment_cancel.php");
require ("user_reset_pass.php");

session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}

// Sanitize the input to prevent SQL injection
$UID = mysqli_real_escape_string($conn, $_GET['uid']);

$user_query = "SELECT * FROM user WHERE uid='$UID'";
$id_data = mysqli_query($conn, $user_query);
$row_user = mysqli_fetch_assoc($id_data);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user profile</title>
    <link rel="stylesheet" href="css/user_edit.css" />
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
    <!-- edit profile -->
    <div class="profile_container">
        <a href="user_dashboard.php"><button style="padding:2px 10px;"><i
                    class="fa-solid fa-arrow-left"></i></button></a>

        <div class="profile_wrapper">

            <div class="sidebar">
                <div class="side_menu active" id="edit" onclick="EditShow()">
                    <i class="fa-solid fa-user"></i>
                    <p>Edit Profile</p>
                </div>
                <div class="side_menu" id="password" onclick="PasswordShow()">
                    <i class="fa-solid fa-lock"></i>
                    <p>Change Password</p>
                </div>
                <div class="side_menu" id="appointment" onclick="AppointmentShow()">
                    <i class="fa-solid fa-calendar-check"></i>
                    <p>Appointments</p>
                </div>
                <div class="line_container">
                    <div class="line"></div>
                </div>
                <div class="side_menu">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <a href="logout.php">
                        <p>Logout</p>
                    </a>
                </div>
            </div>


            <!-- edit_section -->
            <div class="edit_wrapper ">
                <h2>Edit Profile</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="img_container">

                        <img class="profile_image" src="<?php echo $row_user['user_image'] ?>" id="profile_pic"
                            alt="User Image" name="profile_img">

                        <div class="upload_btn">
                            <label for="input_file">Upload Profile Image</label>
                            <input type="file" accept="image/jpeg, image/png, image/jpg" id="input_file"
                                name="profile_img">
                        </div>
                    </div>

                    <div class="field_conatiner">
                        <div class="field">
                            <label>Name</label><br>
                            <div class="name">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="user_name" value="<?php echo $row_user['user_name']; ?>">
                            </div>
                        </div>
                        <div class="field">
                            <label>Email</label><br>
                            <div class="name">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="text" name="user_email" value="<?php echo $row_user['user_email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="save_btn">
                        <button type="submit" name="update_btn">Save Changes</button>
                    </div>
                </form>

                <div class="success_msg">
                    <?php echo $success ?>
                </div>
                <div class="error_msg">
                    <?php echo $error ?>
                </div>
            </div>

            <!-- Appointments section -->
            <div class="appointment_container hide">
                <h3>Appointments</h3>
                <div class="all_appointments">
                    <button onclick="completeShow()">All appointments</button>
                </div>
                <?php
                $user_id = $row_user['uid'];
                //echo $user_id;
                $appointment_query = "SELECT * 
                FROM appointment as a
                INNER JOIN doctor as d ON a.doctor_id=d.did 
                INNER JOIN user as u ON a.user_id=u.uid 
                WHERE user_id=$user_id AND a.status='booked' ORDER BY date ASC";
                $appointment_data = mysqli_query($conn, $appointment_query);
                $total = mysqli_num_rows($appointment_data);
                //echo $total;
                if ($total > 0) {
                    while ($row_appointment = mysqli_fetch_assoc($appointment_data)) {
                        ?>
                        <div class="appointment_wrapper">
                            <div class="details_wrapper">
                                <div class="patient_appointment">

                                    <div class="doctor_details">
                                        <img src="<?php echo $row_appointment['doctor_image'] ?>">
                                        <div class="details">
                                            <?php echo $row_appointment['doctor_name'] ?><br>
                                            <p style="color:#454955;"><?php echo $row_appointment['speciality'] ?></p>
                                        </div>

                                    </div>
                                    <div class="appointment_details">
                                        <div class="details">
                                            <?php echo $row_appointment['date'] ?>
                                        </div>
                                        <div class="details">
                                            <?php echo $row_appointment['time'] ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="patient_details">
                                    <div class="details">
                                        <?php echo $row_appointment['clinic'] ?><br>
                                        <?php echo $row_appointment['clinic_address'] ?>
                                    </div>

                                </div>
                                <div class="cancel_btn">
                                    <form action="" method="post">
                                        <input type="hidden" name="app_id" value="<?php echo $row_appointment['id']; ?>">
                                        <input type="hidden" name="user_email"
                                            value="<?php echo $row_appointment['user_email'] ?>">
                                        <input type="hidden" name="doctor_email"
                                            value="<?php echo $row_appointment['doctor_email'] ?>">
                                        <button type="submit" name="cancel_appointment"
                                            onclick="return confirmCancel();">Cancel</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "no appointments is booked.";
                }


                ?>
            </div>

            <!-- completed appointments -->
            <div class="completed_appointments hide">
                <div class="back_btn">
                    <button id="back" onclick="hideComplete()"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
                <div class="complete_wrapper">
                    <?php
                    $user_id = $row_user['uid'];
                    //echo $user_id;
                    $appointment_query = "SELECT a.*, d.doctor_name, d.speciality, d.doctor_email,d.doctor_image, d.clinic, d.clinic_address
                    FROM appointment AS a
                    INNER JOIN doctor AS d ON a.doctor_id = d.did 
                    WHERE a.user_id = $user_id  
                    ORDER BY 
                    CASE 
                    WHEN a.status = 'booked' THEN 1 
                    ELSE 2 
                    END";
                    $appointment_data = mysqli_query($conn, $appointment_query);
                    $total = mysqli_num_rows($appointment_data);
                    //echo $total;
                    if ($total > 0) {
                        while ($row_appointment = mysqli_fetch_assoc($appointment_data)) {

                            ?>
                            <div class="appointment_wrapper_complete">
                                <div class="details_wrapper">
                                    <div class="patient_appointment">

                                        <div class="doctor_details">
                                        <img src="<?php echo $row_appointment['doctor_image'] ?>">

                                            <div class="details">
                                                <?php echo $row_appointment['doctor_name'] ?><br>
                                                <p> <?php echo $row_appointment['speciality'] ?></p>
                                            </div>
                                        </div>
                                        <div class="appointment_details">
                                            <div class="details">
                                                <?php echo $row_appointment['date'] ?>
                                            </div>
                                            <div class="details">
                                                <?php echo $row_appointment['time'] ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="patient_details">
                                        <div class="details">
                                            <?php echo $row_appointment['clinic'] ?><br>
                                            <?php echo $row_appointment['clinic_address'] ?>
                                        </div>
                                        
                                    </div>
                                    <div class="details" style="color:green;">
                                        <?php echo $row_appointment['status']; ?>
                                    </div>

                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "No completed appointments.";
                    }
                    ?>
                </div>
            </div>


            <!-- change Passfword section -->
            <div class="password hide">
                <h2>Change Password</h2>
                <div class="form_container">
                    <!-- Reset Password form -->
                    <div class="Reset_password">
                        <form action="" method="post">
                            <input type="hidden" name="uid" value="<?php echo $row_user['uid'] ?>">
                            <div class="input_field">
                                <i class="fa-solid fa-lock"></i>
                                <input type="text" name="new_password" placeholder="Create new password" required><br>
                            </div>
                            <div class="input_field">
                                <i class="fa-solid fa-lock"></i>
                                <input type="text" name="new_password_confirm" placeholder="Retype your password"
                                    required>
                            </div>
                            <button type="submit" name="save">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        //confiramation cancel appointment
        function confirmCancel() {
            return confirm('Are you sure, you want to cancel the booking ?');
        }
        //upload image
        let profilePic = document.getElementById("profile_pic");
        let inputFile = document.getElementById("input_file");

        inputFile.onchange = function () {
            profilePic.src = URL.createObjectURL(inputFile.files[0]);
        }

        //appointment popup
        function AppointmentShow() {
            document.querySelector('#appointment').classList.add("active");
            document.querySelector('#edit').classList.remove("active");
            document.querySelector('.edit_wrapper').classList.add("hide");
            document.querySelector('.appointment_container').classList.remove("hide");
            document.querySelector('.password').classList.add("hide");
            document.querySelector('#password').classList.remove("active");
        }
        //edit popup
        function EditShow() {
            document.querySelector('#appointment').classList.remove("active");
            document.querySelector('#edit').classList.add("active");
            document.querySelector('.edit_wrapper').classList.remove("hide");
            document.querySelector('.appointment_container').classList.add("hide");
            document.querySelector('.password').classList.add("hide");
            document.querySelector('#password').classList.remove("active");
        }
        //password popup
        function PasswordShow() {
            document.querySelector('#appointment').classList.remove("active");
            document.querySelector('#edit').classList.remove("active");
            document.querySelector('.edit_wrapper').classList.add("hide");
            document.querySelector('.appointment_container').classList.add("hide");
            document.querySelector('.password').classList.remove("hide");
            document.querySelector('#password').classList.add("active");
        }
        //completed appointment popup
        function completeShow() {
            document.querySelector('.appointment_container').classList.add('hide');
            document.querySelector('.completed_appointments').classList.remove('hide');
        }
        //back the complete appointment
        function hideComplete() {
            document.querySelector('.completed_appointments').classList.add("hide");
            document.querySelector('.appointment_container').classList.remove("hide");
        }
    </script>
</body>

</html>