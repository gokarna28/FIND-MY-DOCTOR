<?php
include ("connection.php");

// Check if the form is submitted and the appointment cancellation is confirmed
if (isset($_POST['cancel_appointment']) && isset($_POST['app_id'])) {
    $appointment_id = $_POST['app_id'];
    $user_email = $_POST['user_email'];
    $doctor_email = $_POST['doctor_email'];

    // SQL to delete the appointment
    $delete_query = "DELETE FROM appointment WHERE id = ?";

    // Prepare a parameterized statement for deletion
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $appointment_id);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Appointment canceled successfully.')</script>";

        //mail to the doctor email 
        $to = $doctor_email;
        $subject = "Appointment Canceled";
        $message = 'Appointment is canceled form ' . $user_email . ' for some reasons.';
        $headers = "From: gokarnachy28@gmail.com\r\n";

        $check = mail($to, $subject, $message, $headers);

        if ($check) {
           // echo "successfully mail sent";
        } else {
            echo "Failed to send the email";
        }
    } else {
        echo "Error canceling appointment: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>