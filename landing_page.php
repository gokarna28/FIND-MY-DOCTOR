<?php
include ("connection.php");
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

         echo $user_data['user_name'];
         echo $user_data['user_email'];

    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>user register</title>
    <link rel="stylesheet" href="css/user1.css" />
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
    <div class="land_container">
        <div class="navbar">
            <div class="logo">Logo</div>
            <div class="login_btn">
                <button><a href="login.php">Login</a></button>
            </div>
        </div>
        <div class="background_img">
            <img class="background" src="image/stethoscope-4280497_1920.jpg">
            <button><a href="logout.php">Logout</a></button>

        </div>
    </div>
    

    <!-- Doctor section -->
    <div class="doctor_section">

    </div>
</body>

</html>