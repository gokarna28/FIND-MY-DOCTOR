<?php
include ("connection.php");

$UID = $_GET['uid'];
$success = "";
$error = "";
if (isset($_POST['update_btn'])) {

    //image upload field
    $filename = $_FILES["profile_img"]["name"];
    $tempname = $_FILES["profile_img"]["tmp_name"];
    $profile = "user/" . $filename;
    move_uploaded_file($tempname, $profile);

    $name = $_POST['user_name'];
    $email = $_POST['user_email'];


    if ($profile == 'user/') {

        $update_noimage = "UPDATE user SET user_name='$name', user_email='$email' WHERE uid='$UID'";
        $update_data = mysqli_query($conn, $update_noimage);

        if ($update_data) {
            echo "<script>alert('Changes saved successfully')</script>";
        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    } else {

        $update_image = "UPDATE user SET  user_image='$profile', user_name='$name', user_email='$email' WHERE uid='$UID'";
        $update_idata = mysqli_query($conn, $update_image);

        if ($update_idata) {
            echo "<script>alert('Changes saved successfully')</script>";

        } else {
            $error = "failed to update" . mysqli_error($conn);
        }

    }
}
?>