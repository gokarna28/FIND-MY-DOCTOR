<?php
include ('connection.php');
$error = "";

if (isset($_POST['save'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['new_password_confirm'];
    $uid = $_POST['uid'];

    if (strlen($new_password) < 8) {
        echo "<script>alert('password should be at least 8 char long')</script>";
    } elseif ($new_password != $confirm_password) {
        echo "<script>alert('password do not matched')</script>";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_pass = "UPDATE user SET user_password='$hashed_password'
WHERE uid='$uid'";
        $update_data = mysqli_query($conn, $update_pass);
        if ($update_data) {
            echo "<script>alert('Password is scuccessfully changed')</script>";
        }
    }


}
?>