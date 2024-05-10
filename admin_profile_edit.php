<?php
include ("connection.php");
require("admin_edit_submit.php");
$AID = $_GET['admin_id'];

$admin_query = "SELECT * FROM admin WHERE admin_id='$AID'";
$id_data = mysqli_query($conn, $admin_query);
$row_admin = mysqli_fetch_assoc($id_data);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>admin formile edit page</title>
    <link rel="stylesheet" href="css/admin_edits.css" />
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
        <a href="admin_dashboard.php"><button style="padding:2px 10px;"><i
                    class="fa-solid fa-arrow-left"></i></button></a>

        <div class="profile_wrapper">
            <div class="sidebar">
                <div class="side_menu active">
                    <i class="fa-solid fa-user"></i>
                    <p>Edit Profile</p>
                </div>
                <div class="side_menu">
                    <i class="fa-solid fa-lock"></i>
                    <p>Change Password</p>
                </div>
                <div class="side_menu">
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
            <div class="edit_wrapper">
                <h2>Edit Profile</h2>

                <form method="post" enctype="multipart/form-data">

                    <div class="field_wrapper">
                        <div class="img_container">
                            <div class="img">
                                <img class="img" src="<?php echo $row_admin['admin_image'] ?>" id="profile_pic">
                            </div>
                            <div class="upload_btn">
                                <label for="input_file">Upload Profile Image</label>
                                <input type="file" accept="image/jpeg, image/png, image/jpg" id="input_file"
                                    name="profile_img">
                            </div>
                        </div>
                        <div class="save_field">
                            <div class="field_conatiner">
                                <div class="field">
                                    <label>Name</label><br>
                                    <div class="name">
                                        <i class="fa-solid fa-user"></i>
                                        <input type="text" name="admin_name"
                                            value="<?php echo $row_admin['admin_name']; ?>" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label>Email</label><br>
                                    <div class="name">
                                        <i class="fa-solid fa-envelope"></i>
                                        <input type="text" name="admin_email"
                                            value="<?php echo $row_admin['admin_email']; ?>" required>
                                    </div>
                                </div>

                                
                            </div>
                            <div class="save_btn">
                                <button type="submit" name="update_btn">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="success_msg">
                    <?php echo $success ?>
                </div>
                <div class="error_msg">
                    <?php echo $error ?>
                </div>

            </div>


        </div>
    </div>
    <script>
        let profilePic = document.getElementById("profile_pic");
        let inputFile = document.getElementById("input_file");

        inputFile.onchange = function () {
            profilePic.src = URL.createObjectURL(inputFile.files[0]);
        }
    </script>
</body>

</html>