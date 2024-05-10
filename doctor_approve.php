<?php
include ("connection.php");

if (isset($_POST['approve_btn']) && isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];
    //echo $doctor_id;

    // SQL to delete the appointment
    $update_query = "UPDATE doctor SET status='approved' WHERE did = $doctor_id";
    $update_data = mysqli_query($conn, $update_query);

    // Execute the statement
    if ($update_data) {
        //echo "successfully";
    } else {
        echo "Error canceling appointment: " . mysqli_error($conn);
    }


}
?>