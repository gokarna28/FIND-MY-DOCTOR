<?php
include ("connection.php");

$user_id = $_GET['user_id'];


$delete_user = "DELETE FROM user WHERE uid='$user_id'";
$delete_data = mysqli_query($conn, $delete_user);
if ($delete_data) {
    echo "<script>alert('Successfully Deleted.')</script>";
    header("location:users_record.php");
} else {
    echo "failed to delete." . mysqli_error($conn);
}
?>