<?php
include ("connection.php");

$doctor_id = $_GET['doctor_id'];

// Retrieve doctor data based on doctor_id
$doctor_details = "SELECT * FROM doctor WHERE did='$doctor_id'";
$doctor_data = mysqli_query($conn, $doctor_details);

if (mysqli_num_rows($doctor_data) > 0) {
    $result_doctor = mysqli_fetch_assoc($doctor_data);
}

//update doctor data
if (isset($_POST['edit_btn'])) {
    $doctor_id = $_POST['doctor_id'];
    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $degree = $_POST['degree'];
    $clinic = $_POST['clinic'];
    $clinic_address = $_POST['clinic_address'];

    // echo $doctor_id;
    // echo $name;

    $update_doctor = "UPDATE doctor SET doctor_name='$name', doctor_email='$email', degree='$degree', clinic='$clinic', clinic_address='$clinic_address' WHERE did='$doctor_id'";
    $update_data = mysqli_query($conn, $update_doctor);
    if ($update_data) {
        echo "<script>alert('successfully updated doctor details.')</script>";

    } else {
        echo "<script>alert('Failed to update.')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>update doctor details</title>
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
    <style>
        :root {
            --primaryColor: #1c5f5f;
            --secondaryColor: #d6e7d5;
            --bodyColor: #edeef3;
            --lightGreyColor: #f4f5fa;
            --whiteColor: #ffffff;
            --blackColor: #222;
            --lightBlackColor: #454955;
            --darkPurpleColor: #2c2f4e;
            --redColor: rgb(255, 55, 0);
            --greenColor: rgb(89, 183, 110);
            --lightBlue: rgb(52, 116, 245);
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: poppins;
            background-color: var(--whiteColor);
        }

        .edit_container {
            padding: 20px;
        }

        .edit_container h2 {
            display: flex;
            justify-content: center;
            color: var(--lightBlackColor);
        }

        .edit_container button {
            padding: 5px 10px;
            font-size: 20px;
        }

        .edit_container button a {
            color: var(--lightBlackColor);
        }

        .form_container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        form {
            background-color: var(--lightGreyColor);
            border-radius: 20px;
            padding: 20px;
        }

        .fields {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            width: 700px;
        }

        .input {
            border: 1px solid var(--blackColor);
            font-size: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            padding: 5px;
            width: 300px;
            margin: 10px;
        }

        .input input {
            border: none;
            outline: none;
            font-size: 18px;
            margin-left: 10px;
            background-color: transparent;
        }

        .edit_btn {
            display: flex;
            justify-content: center;
        }

        .edit_btn button {
            border: 1px solid var(--blackColor);
            border-radius: 5px;
            padding: 5px 10px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
        }
    </style>
</head>

<body>
    <div class="edit_container">
        <button><a href="doctors_record.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <h2>Edit Doctor Details</h2>
        <div class="form_container">
            <form action="" method="post">
                <input type="hidden" name="doctor_id" value="<?php echo $doctor_id ?>">
                <div class="fields">
                    <div class="input">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="doctor_name" value="<?php echo $result_doctor['doctor_name'] ?>">
                    </div>
                    <div class="input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="text" name="doctor_email" value="<?php echo $result_doctor['doctor_email'] ?>">
                    </div>

                    <div class="input">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <input type="text" name="degree" value="<?php echo $result_doctor['degree'] ?>">
                    </div>
                    <div class="input">
                        <i class="fa-solid fa-house-medical-circle-check"></i>
                        <input type="text" name="clinic" value="<?php echo $result_doctor['clinic'] ?>">
                    </div>
                    <div class="input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="clinic_address" value="<?php echo $result_doctor['clinic_address'] ?>">
                    </div>

                </div>
                <div class="edit_btn">
                    <button type="submit" name="edit_btn">Update Now</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>