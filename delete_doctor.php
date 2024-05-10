<?php
include ("connection.php");

$doctor_id = $_GET['doctor_id'];


//echo $doctor_id;
$delete_doctor = "DELETE FROM doctor WHERE did='$doctor_id'";
$delete_data = mysqli_query($conn, $delete_doctor);
if ($delete_data) {
    echo "<script>alert('Doctor is successfully deleted.')</script>";
    header('location:doctors_record.php');
} else {
    echo "failed to delete." . mysqli_error($conn);
}
?>