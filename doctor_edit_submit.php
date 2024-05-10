<?php
include ("connection.php");

$DID = $_GET['did'];
$success = "";
$error = "";
if (isset($_POST['update_btn'])) {

    //image upload field
    $filename = $_FILES["profile_img"]["name"];
    $tempname = $_FILES["profile_img"]["tmp_name"];
    $profile = "doctor/" . $filename;
    move_uploaded_file($tempname, $profile);

    $name = $_POST['doctor_name'];
    $email = $_POST['doctor_email'];
    $clinic = $_POST['clinic'];
    $location = $_POST['clinic_address'];


    if ($profile == 'doctor/') {

        $update_noimage = "UPDATE doctor SET doctor_name='$name', doctor_email='$email', clinic='$clinic', clinic_address='$location' WHERE did='$DID'";
        $update_data = mysqli_query($conn, $update_noimage);

        if ($update_data) {
            //$success = "successfully updated without image";
        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    } else {

        $update_image = "UPDATE doctor SET  doctor_image='$profile', doctor_name='$name', doctor_email='$email', clinic='$clinic', clinic_address='$location' WHERE did='$DID'";
        $update_idata = mysqli_query($conn, $update_image);

        if ($update_idata) {
           // $success = "successfully updated with image";
        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    }

}
?>