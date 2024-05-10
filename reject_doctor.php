<?php
include ("connection.php");

// Check if the form is submitted and the appointment cancellation is confirmed
if (isset($_POST['reject_btn']) && isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];
    //echo $doctor_id;
    // SQL to delete the appointment
    $delete_query = "DELETE FROM doctor WHERE did = $doctor_id";
    $delete_data = mysqli_query($conn, $delete_query);

    // Execute the statement
    if ($delete_data) {
        //echo "successfully";
    } else {
        echo "Error canceling appointment: " . mysqli_error($conn);
    }


}
?>