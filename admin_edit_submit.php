<?php
include ("connection.php");

$AID = $_GET['admin_id'];
$success = "";
$error = "";
if (isset($_POST['update_btn'])) {

    //image upload field
    $filename = $_FILES["profile_img"]["name"];
    $tempname = $_FILES["profile_img"]["tmp_name"];
    $profile = "doctor/" . $filename;
    move_uploaded_file($tempname, $profile);

    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];



    if ($profile == 'doctor/') {

        $update_noimage = "UPDATE admin SET admin_name='$name', admin_email='$email' WHERE admin_id='$AID'";
        $update_data = mysqli_query($conn, $update_noimage);

        if ($update_data) {
            //$success = "successfully updated without image";
        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    } else {

        $update_image = "UPDATE admin SET  admin_image='$profile', admin_name='$name', admin_email='$email' WHERE admin_id='$AID'";
        $update_idata = mysqli_query($conn, $update_image);

        if ($update_idata) {
            // $success = "successfully updated with image";
        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    }

}
?>