<?php
include ("connection.php");

$admin_id = $_GET['admin_id'];

$delete_query = "DELETE FROM admin WHERE admin_id='$admin_id'";
$delete_data = mysqli_query($conn, $delete_query);
if ($delete_data) {
    echo "<script>alert('successfully deleted.')</script>";
    header("location:add_admin.php");
} else {
    echo "failed to delete." . mysqli_error($conn);
}
?>