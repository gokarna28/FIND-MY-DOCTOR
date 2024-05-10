<?php
include ("connection.php");
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $query);
    if ($result && $total = mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);
        //  echo $user_data['user_name'];
        // echo $user_data['user_email'];

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user register</title>
    <link rel="stylesheet" href="css/user.css" />
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
    <!-- landing section -->
    <div class="land_container">
        <div class="navbar">
            <div class="logo">
                <img class="logo_img" src="image/logo.png">
            </div>
            <div class="nav_list">
                <a href="#doctor">Doctor</a>
                <a href="#about">About Us</a>
                <a href="#footer">Contact Us</a>
            </div>
            <div class="login_btn">
                <button><a href="login.php">LOGIN</a></button>
            </div>

        </div>
        <div class="background_img">
            <img class="background" src="image/male_doctor.png">
        </div>

        <div class="slogan">
            <p class="main_text">Your Health, Your Time:Book your appointment with <span class="title"> FIND MY
                    DOCTOR</span></p><br>
            <p class="sub_text">Book Smarter, Better Healthcare on Your Schedule.</p>

            <div class="search_btn">
                <input type="text" placeholder="search here...">
                <button>Search</button>
            </div>
        </div>
    </div>

    <!-- Information -->
    <?php
    $check_user = "SELECT * FROM user";
    $user_data = mysqli_query($conn, $check_user);
    $total_user = mysqli_num_rows($user_data);

    $check_doctor = "SELECT * FROM doctor";
    $doctor_data = mysqli_query($conn, $check_doctor);
    $total_doctor = mysqli_num_rows($doctor_data);

    $check_user = "SELECT * FROM user";
    $user_data = mysqli_query($conn, $check_user);
    $total_user = mysqli_num_rows($user_data);

    ?>
    <div class="info_container">
        <div class="info">
            <div class="info_wrapper">
                <div class="total"><?php echo $total_user ?></div>
                <p>
                    <i class="fa-solid fa-users"></i>
                    Happy Customers
                </p>
            </div>
            <div class="info_wrapper">
                <div class="total"><?php echo $total_doctor ?></div>
                <p>
                    <i class="fa-solid fa-users"></i>
                    Our Team
                </p>
            </div>
        </div>

    </div>

    <!-- Doctor section -->
    <div class="doctor_section" id="doctor">
        <h2>Make appointment with</h2>
        <div class="card_wrapper">

            <?php
            $doctor_query = "SELECT * FROM doctor";
            $doctor_data = mysqli_query($conn, $doctor_query);
            if ($total_doctor = mysqli_num_rows($doctor_data) > 0) {
                while ($row_doctor = mysqli_fetch_assoc($doctor_data)) {
                    ?>
                    <div class="doctor_card">
                        <div class="card_img">
                            <img class="card_img" src="<?php echo $row_doctor['doctor_image'] ?>">
                        </div>
                        <div class="details">
                            <b>
                                <?php echo $row_doctor['doctor_name']; ?>
                            </b><br>
                            <p style="color:#454955;">
                                <?php echo $row_doctor['speciality']; ?>
                            </p>
                        </div>
                        <div class="appointment_btn">
                            <a href="login.php?doctor_id=<?php echo $row_doctor['did'] ?>">
                                <button>Appointment</button></a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div class="showall_btn">
            <button id="showall" onclick="showAll()">Show All</button>
            <button id="showless" onclick="showLess()" class="hide">Show Less</button>
        </div>

    </div>


    <!-- aboutus section -->
    <div class="aboutus_wrapper" id="about">
        <h2>About US</h2>
        <div class="aboutus_section">
            <div class="logo_image_container">
                <img src="image/logo.png">
            </div>
            <div class="about_details">
                <p>A doctor appointment system is a digital platform designed to streamline and manage the process of
                    scheduling and managing patient appointments with healthcare providers. This system offers numerous
                    benefits for both patients and medical practices by enhancing efficiency, improving communication,
                    and reducing administrative burdens. Here are key aspects typically included in such a system:</p>
            </div>
        </div>
    </div>

    <div class="image_slider hide">
        <div class="slider-sec">
            <img src="image/stetho.jpg" id="img1" class="visible">
            <img src="image/online-marketing-hIgeoQjS_iE-unsplash.jpg" id="img2" class="hidden">
            <img src="image/doctor.jpg" id="img3" class="hidden">
            <img src="image/pexels-algrey-9054999.jpg" id="img4" class="hidden">
            <img src="image/pexels-shvets-production-8413162.jpg" id="img5" class="hidden">
            <img src="image/pexels-cottonbro-7579831.jpg" id="img6" class="hidden">
            <img src="image/pexels-cristian-rojas-8460125.jpg" id="img7" class="hidden">
            <img src="image/pexels-cristian-rojas-8460124.jpg" id="img8" class="hidden">
        </div>
    </div>


    <!-- footer section -->
    <div class="footer_section" id="footer">
        <div class="footer_items">
            <div class="footer_img">
                <img src="image/logo.png">
                <p>The FIND MY DOCTOR is the quickest and easiest way to book appointment on your available time.</p>
            </div>
            <div class="items">
                <h3>QUICK LOGIN</h3>
                <a href="#">User</a>
                <a href="#">Doctor</a>
            </div>
            <div class="items">
                <h3>SERVICES</h3>
                <p>Book Appointment</p>
            </div>
            <div class="items">
                <h3>GET IN TOUCH</h3>
                <p><i class="fa-solid fa-location-dot"></i>Ekantakuna, Lalitpur</p>
                <p><i class="fa-solid fa-envelope"></i>gokarnachy28@gmail.com</p>
            </div>
        </div>
        <div class="footer_line">
            <p>Terms & Conditions | Privacy Policy</p>
            <p>2024</p>
        </div>
    </div>

    <script>

        //doctor section show all btn
        function showAll() {
            document.querySelector(".doctor_section").style.height = '100%';
            document.querySelector("#showall").classList.add("hide");
            document.querySelector("#showless").classList.remove("hide");
        }
        function showLess() {
            document.querySelector(".doctor_section").style.height = '550px';
            document.querySelector("#showall").classList.remove("hide");
            document.querySelector("#showless").classList.add("hide");
        }
        //image slider
        var activeimage = 1;
        var nextimage = 1;
        setInterval(function () {
            nextimage = nextimage + 1;
            if (nextimage < 8) {
                document.getElementById("img" + activeimage).classList.replace("visible", "hidden");
                document.getElementById("img" + nextimage).classList.replace("hidden", "visible");
                activeimage = nextimage;
            }
            else {
                document.getElementById("img" + activeimage).classList.replace("visible", "hidden");
                document.getElementById("img" + nextimage).classList.replace("hidden", "visible");
                activeimage = 8;
                nextimage = 0;
            }
        }, 1000)
    </script>
</body>

</html>