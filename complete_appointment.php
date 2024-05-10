<?php
include ("connection.php");
if (isset($_POST['complete_btn'])) {
    if (isset($_POST['app_id'])) {
        $appointment_id = $_POST['app_id'];

        // SQL to delete the appointment
        $delete_query = "UPDATE appointment SET status='completed' WHERE id = $appointment_id";

        if (mysqli_query($conn, $delete_query)) {
            echo "<script>alert('Appointment is completed.')</script>";
        } else {
            echo "Error canceling appointment: " . mysqli_error($conn);
        }
    }
}
?>