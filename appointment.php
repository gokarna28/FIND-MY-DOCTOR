<?php
require ("appointment_submit.php");
include ("connection.php");
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        //echo $user_data['user_name'];
        // echo $user_data['user_email'];

    }
}

include ("connection.php");

if (isset($_GET['doctor_id'])) {
    $DID = $_GET['doctor_id'];
    //doctor data
    $appointment = "SELECT * FROM doctor WHERE did='$DID'";
    $data = mysqli_query($conn, $appointment);
    $result_doctor = mysqli_fetch_assoc($data);
    // echo $result_doctor['doctor_name'];
} else {
    echo " doctor_id is not set";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor details</title>
    <link rel="stylesheet" href="css/view.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <div class="view_container">
        <a href="user_dashboard.php"><button style="font-size:25px; padding:5px 10px"><i
                    class="fa-solid fa-arrow-left"></i></button></a>
        <form action="" method="post" autocomplete="off">

            <div class="view_detail">
                <div class="doctor_details">
                    <div class="doctor_img">
                        <img src="<?php echo $result_doctor['doctor_image'] ?>">
                    </div>
                    <div class="doctor_info">
                        <div>
                            <p>NMC:</p>
                            <?php echo $result_doctor['nmc'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-user"></i>
                            <?php echo $result_doctor['doctor_name'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-building-user"></i>
                            <?php echo $result_doctor['speciality'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-user-graduate"></i>
                            <?php echo $result_doctor['degree'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-envelope">
                            </i><?php echo $result_doctor['doctor_email'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-house-medical-circle-check"></i>
                            <?php echo $result_doctor['clinic'] ?>
                        </div>
                        <div>
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo $result_doctor['clinic_address'] ?>
                        </div>
                    </div>
                </div>

                <div class="schedule_details">
                    <h2>Schedule</h2>
                    <div class="patient_details">
                        <div class="field">
                            <input type="hidden" name="doctor_id" value="<?php echo $result_doctor['did']; ?>" required>
                            <input type="hidden" name="user_id" value="<?php echo $user_data['uid']; ?>" required>
                            <div class="input">
                                <input type="text" name="patient_name" placeholder="Enter patient fullname"
                                    value="<?php echo $patient_name ?>" required>
                                <span style="color:red;font-size:12px"><?php echo $name_error ?></span>
                            </div>
                            <div class="input">
                                <input type="number" name="patient_age" placeholder="Enter patient age"
                                    value="<?php echo $patient_age ?>" required>
                                <span style="color:red;font-size:12px"><?php echo $age_error ?></span>
                            </div>
                            <div class="input">
                                <select name="patient_gender" value="<?php echo $patient_gender ?>" required>
                                    <option disabled selected>Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select><br>
                                <span style="color:red;font-size:12px"><?php echo $gender_error ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="time_schedule">
                        <table>
                            <?php
                            include ("connection.php");

                            $currentDate = date('Y/M/d l');

                            $query = "SELECT *
                             FROM doctor
                             INNER JOIN schedule ON doctor.did = schedule.doctor_id
                             WHERE did = $DID
                             AND date >= '$currentDate'
                             ORDER BY date ASC";
                            $data = mysqli_query($conn, $query);
                            if (mysqli_num_rows($data) > 0) {

                                while ($result = mysqli_fetch_assoc($data)) {
                                    ?>
                                    <tr>
                                        <td style="border:1px solid black; padding:5px 10px;font-weight:500"><input type='text'
                                                name='date' value="<?php echo $result['date'] ?>" readonly></td>
                                        <?php
                                        $available_slots = array($result['slot1'], $result['slot2'], $result['slot3'], $result['slot4'], $result['slot5']);
                                        foreach ($available_slots as $slot) {
                                            if (!empty($slot)) {
                                                $is_available = true;
                                                $check_query = "SELECT * FROM appointment WHERE date='" . $result['date'] . "' AND time='$slot'";
                                                $check_result = mysqli_query($conn, $check_query);
                                                if (mysqli_num_rows($check_result) > 0) {
                                                    $is_available = false;
                                                }
                                                $button_color = $is_available ? 'rgb(0, 148, 0)' : 'rgb(255, 55, 0)';
                                                $disabled_attribute = $is_available ? '' : 'disabled';
                                                echo "
                                                    <td>
                                                        <button type='submit' class='time_btn' name='book_btn' value='$slot' style='background-color: $button_color; color:#fff; font-size:20px; padding:5px;width:100px;' $disabled_attribute>
                                                            $slot
                                                        </button>
                                                    </td>
                                                ";
                                            }
                                        }
                                        ?>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "no schedule is set.";
                            }

                            ?>
                        </table>
                        <div class="message">
                            <?php echo $success ?>
                        </div>
                        <div class="error">
                            <?php echo $error ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hidden fields to store the selected date and time slot -->
            <input type="hidden" name="selected_date" id="selected_date" value="">
            <input type="hidden" name="selected_time_slot" id="selected_time_slot" value="">
        </form>
    </div>

    <script>
        // Function to set the selected date and time slot
        function setTimeSlot(date, slot) {
            document.getElementById('selected_date').value = date;
            document.getElementById('selected_time_slot').value = slot;
        }

        // Attach click event handlers to all buttons dynamically
        const buttons = document.querySelectorAll('button[name="book_btn"]');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                const date = this.parentNode.parentNode.querySelector('input[name="date"]').value;
                const slot = this.value;
                setTimeSlot(date, slot);
            });
        });
    </script>
</body>

</html>