<?php
include ("connection.php");

$name_error = "";
$age_error = "";
$gender_error = "";
$success = "";
$error = "";
$patient_name="";
$patient_age="";
$patient_gender="";

if (isset($_POST['book_btn'])) {
    $doctor_id = $_POST['doctor_id'];
    $user_id = $_POST['user_id'];
    $date = $_POST['selected_date'];
    $time = $_POST['selected_time_slot'];
    $patient_name = $_POST['patient_name'];
    $patient_age = $_POST['patient_age'];
    $patient_gender = isset($_POST['patient_gender']) ? $_POST['patient_gender'] : '';


    // Name validation
    if (empty($patient_name)) {
        $name_error = "Name is required*";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $patient_name)) {
        $name_error = "Name can only contain letters and spaces.";
    } elseif (strlen($patient_name) > 40) {
        $name_error = "Full name exceeds 40 characters.";
    }
    // Age validation
    if (empty($patient_age)) {
        $age_error = "Age is required*";
    } elseif (!is_numeric($patient_age)) {
        $age_error = "Age must be a number.";
    } elseif ($patient_age < 0 || $patient_age > 100) {
        $age_error = "Invalid age. Please enter a valid age between 0 and 100.";
    }
    // Gender validation
    if (empty($patient_gender)) {
        $gender_error = "Gender is required*";
    } elseif (!in_array($patient_gender, ['Male', 'Female', 'Other'])) {
        $gender_error = "Invalid gender selected.";
    }

    if (empty($name_error) && empty($age_error) && empty($gender_error)) {
        // Check if an appointment already exists for the same doctor, user, date, and time
        $check_query = "SELECT * FROM appointment WHERE doctor_id = '$doctor_id' AND user_id = '$user_id' AND date = '$date' AND time = '$time'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "An appointment for this doctor, user, date, and time already exists.";
        } else {
            // Insert new appointment if no duplicate found
            $insert_query = "INSERT INTO appointment (doctor_id, user_id, date, time, patient_name, patient_age, patient_gender) VALUES ('$doctor_id', '$user_id', '$date', '$time', '$patient_name', '$patient_age', '$patient_gender')";
            $insert_data = mysqli_query($conn, $insert_query);

            if ($insert_data) {
                $success = "Appointment successfully inserted";
                // reset the form
                $patient_name="";
                $patient_age="";
                $patient_gender="";
            } else {
                $error = "Failed to insert appointment: " . mysqli_error($conn);
            }
        }
    }
}
?>