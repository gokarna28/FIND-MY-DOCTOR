<?php
require ("set_schedule.php");
require ("doctor_cancel_appointment.php");
require ("complete_appointment.php");
include ("connection.php");
session_start();
if (isset($_SESSION['doctor_id'])) {
    $doctor_id = $_SESSION['doctor_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM doctor WHERE did = $doctor_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $doctor_data = mysqli_fetch_assoc($result);

        // echo $doctor_data['doctor_name'];
        // echo $doctor_data['doctor_email'];


    }
} else {
    // Redirect to login page or handle unauthorized access
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>doctor dashboard</title>
    <link rel="stylesheet" href="css/doctors.css" />
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
    <!-- sidebar section -->
    <div class="sidebar ">
        <div class="logo_img">
            <img src="image/logo.png">
        </div>
        <div class="side_menu">
            <div class="menu active" id="home" onclick="homeShow()">
                <i class="fa-solid fa-house"></i>
                <p>Home</p>
            </div>
            <div class="menu" id="appointment" onclick="appointmentShow()">
                <i class="fa-solid fa-calendar-check"></i>
                <p>Appointments</p>
            </div>
            <div class="menu">
                <i class="fa-solid fa-clock"></i>
                <p>Time Schedule</p>
            </div>
            <div class="line"></div>
            <a href="logout.php">
                <div class="menu">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Logout</p>
                </div>
            </a>
        </div>
    </div>

    <!-- main section -->
    <div class="main_section">

        <!-- header section -->
        <div class="header">
            <div class="search">
                <input type="text" placeholder="search here..">
                <button>Search</button>
            </div>
            <a href="doctor_edit_profile.php? did=<?php echo $doctor_data['did'] ?>">
                <div class="profile_btn">
                    <img src="<?php echo $doctor_data['doctor_image']; ?>">
                    <div class="profile_name">
                        <?php echo $doctor_data['doctor_name'] ?>
                    </div>
                </div>
            </a>
        </div>

        <!-- sechedule and booked appointment -->
        <div class="schedule_appointment ">

            <!-- schedule section -->
            <div class="schedule_container">
                <h2>Set Schedule</h2>
                <form action="" method="post">

                    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id = $_SESSION['doctor_id']; ?>">
                    <div class="schedule_wrapper">
                        <div class="date">
                            <label for="date">Date</label><br>
                            <input type="date" id="futureDate" name="date" required>
                        </div>
                        <div class="time_wrapper">
                            <div class="time_container">
                                <div class="time">
                                    <input type="time" name="slot1">
                                </div>
                                <div class="time">
                                    <input type="time" name="slot2">
                                </div>
                                <div class="time">
                                    <input type="time" name="slot3">
                                </div>
                                <div class="time">
                                    <input type="time" name="slot4">
                                </div>
                                <div class="time">
                                    <input type="time" name="slot5">
                                </div>
                            </div>
                            <div class="set_btn">
                                <button type="submit" name="set_btn">SET</button>
                            </div>
                        </div>

                    </div>
                </form>
                <div class="success_msg">
                    <?php echo $success_msg ?>
                </div>
                <div class="error_msg">
                    <?php echo $error_msg ?>
                </div>



                <!-- Schedule Info -->
                <div class="schedule_info">
                    <table>
                        <?php
                        include ("connection.php");
                        $currentDate = date('Y/M/d l');

                        $query = "SELECT *
                      FROM doctor INNER JOIN schedule ON doctor.did = schedule.doctor_id WHERE  did=$doctor_id AND
                                date >= '$currentDate'
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
                </div>
            </div>

            <!--booked Appointment section -->
            <div class="appointment_section">
                <h2>Appointments</h2>
                <div class="appointment_wrapper">

                    <!-- retrive data from appointment table -->
                    <?php

                    $doctor_id = $doctor_data['did'];

                    $appointment_query = "SELECT * 
                    FROM appointment as a
                    INNER JOIN doctor as d ON a.doctor_id=d.did
                    INNER join user as u ON a.user_id=u.uid
                     WHERE doctor_id='$doctor_id' AND a.status='booked'";
                    $app_data = mysqli_query($conn, $appointment_query);
                    $total = mysqli_num_rows($app_data);
                    //echo $total;
                    
                    if ($total > 0) {
                        while ($row_appointment = mysqli_fetch_assoc($app_data)) {

                            ?>
                            <div class="details_container">
                                <div class="patient_details">
                                    <h3>Patient Details</h3>
                                    <div class="detils">
                                        <p>Name:</p>
                                        <?php echo $row_appointment['patient_name'] ?>
                                    </div>
                                    <div class="detils">
                                        <p>Age:</p>
                                        <?php echo $row_appointment['patient_age'] ?>
                                    </div>
                                    <div class="detils">
                                        <p>Gender:</p>
                                        <?php echo $row_appointment['patient_gender'] ?>
                                    </div>
                                </div>
                                <div class="appointment_details">
                                    <h3>Appointment Details</h3>

                                    <div class="detils">
                                        <p>Date:</p>
                                        <?php echo $row_appointment['date'] ?>
                                    </div>
                                    <div class="detils">
                                        <p>Time:</p>
                                        <?php echo $row_appointment['time'] ?>
                                    </div>
                                </div>
                                <div class="cancel_complete">
                                    <div class="cancel_btn">
                                        <form action="" method="post">
                                            <input type="hidden" name="app_id" value="<?php echo $row_appointment['id']; ?>">
                                            <input type="hidden" name="user_email"
                                                value="<?php echo $row_appointment['user_email'] ?>">
                                            <input type="hidden" name="doctor_email"
                                                value="<?php echo $row_appointment['doctor_email'] ?>">
                                            <button type="submit" name="cancel_appointment"
                                                onclick="return confirmCancel();">Cancel</button>
                                        </form>
                                    </div>
                                    <div class="complete_btn">
                                        <form action="" method="post">
                                            <input type="hidden" name="app_id" value="<?php echo $row_appointment['id'] ?>">
                                            <button type="submit" name="complete_btn">Complete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "no appointment is booked.";
                    }

                    ?>

                </div>

            </div>
        </div>


        <!-- complete appointment -->
        <div class="appointment_section hide" id="complete">
            <h2>Appointments</h2>
            <div class="appointment_container">

                <!-- retrive data from appointment table -->
                <?php

                $doctor_id = $doctor_data['did'];

                $appointment_query = "SELECT * FROM appointment WHERE doctor_id='$doctor_id' AND status='completed'";
                $app_data = mysqli_query($conn, $appointment_query);
                $total = mysqli_num_rows($app_data);
                //echo $total;
                
                if ($total > 0) {
                    while ($row_appointment = mysqli_fetch_assoc($app_data)) {

                        ?>
                        <div class="details_container">
                            <div class="patient_details">
                                <h3>Patient Details</h3>
                                <div class="detils">
                                    <p>Name:</p>
                                    <?php echo $row_appointment['patient_name'] ?>
                                </div>
                                <div class="detils">
                                    <p>Age:</p>
                                    <?php echo $row_appointment['patient_age'] ?>
                                </div>
                                <div class="detils">
                                    <p>Gender:</p>
                                    <?php echo $row_appointment['patient_gender'] ?>
                                </div>
                            </div>
                            <div class="appointment_details">
                                <h3>Appointment Details</h3>

                                <div class="detils">
                                    <p>Date:</p>
                                    <?php echo $row_appointment['date'] ?>
                                </div>
                                <div class="detils">
                                    <p>Time:</p>
                                    <?php echo $row_appointment['time'] ?>
                                </div>
                            </div>
                            <div class="status">
                                <p>Status:</p>
                                <?php echo $row_appointment['status'] ?>
                            </div>
                        </div>
                        <?php
                    }
                }

                ?>

            </div>

        </div>

    </div>
    <script>
        //appointment record popup
        function appointmentShow() {
            document.querySelector("#appointment").classList.add("active");
            document.querySelector("#home").classList.remove("active");
            document.querySelector(".schedule_appointment").classList.add("hide");
            document.querySelector("#complete").classList.remove("hide");
        }
        //home popup
        function homeShow() {
            document.querySelector("#appointment").classList.remove("active");
            document.querySelector("#home").classList.add("active");
            document.querySelector(".schedule_appointment").classList.remove("hide");
            document.querySelector("#complete").classList.add("hide");
        }

    </script>
    <script>
        //confirmation for cancel appointment
        function confirmCancel() {
            return confirm('Are you sure, you want to cancel the booking ?');
        }
        // Get today's date
        var today = new Date();

        // Calculate the first day of the current year
        var currentYearFirstDay = new Date(today.getFullYear(), 0, 1);

        // Set the minimum date to tomorrow's date (next day)
        var minDate = new Date(today);
        minDate.setDate(today.getDate() + 1); // Add 1 day

        // Set the maximum date to the last day of the current year
        var maxDate = new Date(today.getFullYear(), 11, 31);

        // Format the dates as YYYY-MM-DD (required format for input type="date")
        var minDateFormatted = minDate.toISOString().split('T')[0];
        var maxDateFormatted = maxDate.toISOString().split('T')[0];

        // Set the min and max attributes for the input field
        var futureDateInput = document.getElementById('futureDate');
        futureDateInput.min = minDateFormatted;
        futureDateInput.max = maxDateFormatted;
    </script>

</body>

</html>