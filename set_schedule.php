<?php
include ("connection.php");
$success_msg = "";
$error_msg = "";
$date = "";
if (isset($_POST['set_btn'])) {
    $date = date("Y/M/d l", strtotime($_POST['date']));
    $doctor_id = $_POST['doctor_id'];

    // Initialize an array to store valid time slots
    $timeSlots = array();

    // Check each time slot field and add non-empty values to the $timeSlots array
    if (!empty($_POST['slot1'])) {
        $timeSlots[] = date("g:i A", strtotime($_POST['slot1']));
    }
    if (!empty($_POST['slot2'])) {
        $timeSlots[] = date("g:i A", strtotime($_POST['slot2']));
    }
    if (!empty($_POST['slot3'])) {
        $timeSlots[] = date("g:i A", strtotime($_POST['slot3']));
    }
    if (!empty($_POST['slot4'])) {
        $timeSlots[] = date("g:i A", strtotime($_POST['slot4']));
    }
    if (!empty($_POST['slot5'])) {
        $timeSlots[] = date("g:i A", strtotime($_POST['slot5']));
    }

    // Count the number of valid time slots
    $numTimeSlots = count($timeSlots);

    // Prepare the INSERT query based on the number of time slots
    if ($numTimeSlots > 0) {
        // Build column names for time slots (slot1, slot2, ..., slotN)
        $slotColumns = 'slot1';
        for ($i = 2; $i <= $numTimeSlots; $i++) {
            $slotColumns .= ', slot' . $i;
        }

        // Build values string for time slots
        $timeSlotsString = "'" . implode("', '", $timeSlots) . "'";
        $check = "SELECT * FROM schedule WHERE date='$date'";
        $data = mysqli_query($conn, $check);
        if (mysqli_num_rows($data) == 1) {
            echo "<script>alert('shcedule is already set on this date')</script>";
        } else {
            // Construct the INSERT query with dynamic columns and values
            $schedule_query = "INSERT INTO schedule (doctor_id, date, $slotColumns) 
                           VALUES ('$doctor_id', '$date', $timeSlotsString)";

            // Execute the INSERT query
            $set_date = mysqli_query($conn, $schedule_query);
            if ($set_date) {
                $success_msg = "Successfully set";
            } else {
                echo "Insertion failed: " . mysqli_error($conn);
            }

        }
    } else {
        $error_msg = "Error: No time slots selected";
    }
}
?>