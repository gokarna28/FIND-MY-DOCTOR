<?php
require ("reject_doctor.php");
require ("doctor_approve.php");
include ("connection.php");

session_start();
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    // Query to retrieve user data based on user ID
    $query = "SELECT * FROM admin WHERE admin_id = $admin_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $admin_data = mysqli_fetch_assoc($result);

        // echo $admin_data['admin_name'];
        // echo $user_data['user_email'];

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
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="css/admin.css" />
    <!-- Link to Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <!-- Import Google font - Poppins  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body>
    <div class="sidebar">
        <div class="logo_img">
            <img src="image/logo.png">
        </div>

        <div class="menu_container">
            <div class="menu active" id="dashboard" onclick="dashboardShow()">
                <i class="fa-solid fa-house"></i>
                <p>Dashboard</p>
            </div>
            <div class="menu" id="appointment" onclick="appointmentShow()">
                <i class="fa-solid fa-briefcase"></i>
                <p>Appointments</p>
            </div>
            <a href="doctors_record.php">
                <div class="menu">
                    <i class="fa-solid fa-user-doctor"></i>
                    <p>Doctors</p>
                </div>
            </a>
            <a href="users_record.php">
                <div class="menu">
                    <i class="fa-solid fa-users"></i>
                    <p>Users</p>
                </div>
            </a>
            <a href="add_admin.php">
                <div class="menu">
                    <i class="fa-solid fa-user-tie"></i>
                    <p>Admin User</p>
                </div>
            </a>
        </div>
        <div class="line"></div>

        <div class="logout_btn">
            <a href="logout.php">
                <div class="menu">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Logout</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Main section -->
    <div class="main_section">

        <div class="header">
            <div class="search">
                <input type="text" placeholder="search here">
                <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
            </div>
            <div class="profile_btn">
                <?php
                if ($admin_data['admin_image'] == null || $admin_data['admin_image'] == '') {
                    ?>
                    <div class="letter">
                        <?php echo substr($admin_data['admin_name'], 0, 1); ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <img src="<?php echo $admin_data['admin_image'] ?>">
                    <?php
                }
                ?>
                <p><?php echo $admin_data['admin_name'] ?></p>
            </div>

        </div>

        <!-- analysis and request section -->
        <div class="dashboard">
            <!-- analysis section -->
            <?php
            include ("connection.php");

            //retrive user 
            $user_query = "SELECT * FROM user";
            $user_data = mysqli_query($conn, $user_query);
            $user_total = mysqli_num_rows($user_data);
            // echo $user_total;
            //retrive doctor 
            $doctor_query = "SELECT * FROM doctor WHERE status='approved'";
            $doctor_data = mysqli_query($conn, $doctor_query);
            $doctor_total = mysqli_num_rows($doctor_data);
            // echo $doctor_total;
            //retrive appointment 
            $appointment_query = "SELECT * FROM appointment";
            $appointment_data = mysqli_query($conn, $appointment_query);
            $appointment_total = mysqli_num_rows($appointment_data);
            //echo $appointment_total;
            //retrive appointment 
            $admin_query = "SELECT * FROM admin";
            $admin_data = mysqli_query($conn, $admin_query);
            $admin_total = mysqli_num_rows($admin_data);
            // echo $admin_total;
            ?>
            <div class="analysis_container">
                <div class="details">
                    <div class="icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="user_total">
                        <p>Total Users</p>
                        <?php echo $user_total ?>
                    </div>
                </div>
                <div class="details">
                    <div class="icon color_1">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div class="user_total">
                        <p>Total Doctors</p>
                        <?php echo $doctor_total ?>
                    </div>
                </div>
                <div class="details">
                    <div class="icon color_3">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="user_total">
                        <p>Admin Users</p>
                        <?php echo $admin_total ?>
                    </div>
                </div>
                <div class="details">
                    <div class="icon color_2">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div class="user_total">
                        <p>Appointments</p>
                        <?php echo $appointment_total ?>
                    </div>
                </div>
            </div>

            <!-- request section -->
            <div class="request_bar">
                <div class="request_container">
                    <h3>Doctor Request</h3>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>NMC</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $request_query = "SELECT * FROM doctor WHERE status='pending'";
                        $request_data = mysqli_query($conn, $request_query);
                        $request_total = mysqli_num_rows($request_data);
                        //echo $request_total;
                        if ($request_total > 0) {
                            while ($row_doctor = mysqli_fetch_assoc($request_data)) {
                                //echo $row_doctor['did'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="doctor_details">
                                            <img src="<?php echo $row_doctor['doctor_image'] ?>">
                                            <div class="doctor_name">
                                                <?php echo $row_doctor['doctor_name'] ?>
                                                <p><?php echo $row_doctor['speciality'] ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="doctor_nmc">
                                            <?php echo $row_doctor['nmc'] ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action_btn">
                                            <div class="reject_btn">
                                                <form action="" method="post">
                                                    <input type="hidden" name="doctor_id"
                                                        value="<?php echo $row_doctor['did'] ?>">
                                                    <button type="submit" name="reject_btn"
                                                        onclick="return confirmReject()">Reject</button>
                                                </form>
                                            </div>
                                            <div class="approve_btn">
                                                <form action="" method="post">
                                                    <input type="hidden" name="doctor_id"
                                                        value="<?php echo $row_doctor['did'] ?>">
                                                    <button type="submit" name="approve_btn"
                                                        onclick="return confirmApprove()">Accept</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "no request.";
                        }
                        ?>
                    </table>
                </div>

                <!-- bar chart -->
                <div class="bar_container">
                    <div style="width: 500px;">
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                         const userTotal = <?php echo $user_total; ?>;
                         const doctorTotal = <?php echo $doctor_total; ?>;
                         const appointmentTotal = <?php echo  $appointment_total; ?>;
                         const adminTotal = <?php echo  $admin_total; ?>;
                        const labels = ['Members', 'Doctors', 'Appointments', 'Admin users'];
                        const data = {
                            labels: labels,
                            datasets: [{
                                label: 'Data analysis',
                                data: [userTotal, doctorTotal, appointmentTotal, adminTotal],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'
                                ],
                                borderColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                borderWidth: 1
                            }]
                        };
                        const config = {
                            type: 'bar',
                            data: data,
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            },
                        };
                        var myChart = new Chart(
                            document.getElementById('myChart'),
                            config
                        );
                    </script>
                </div>
            </div>
        </div>


        <!-- appointment section -->
        <div class="appointment_container hide">
            <h2>Appointments</h2>
            <div class="appointment_wrapper">
                <?php
                $appointment_query = "SELECT * 
                FROM doctor as d
                INNER JOIN appointment as a ON d.did=a.doctor_id
                ORDER BY  CASE 
                    WHEN a.status = 'booked' THEN 1 
                    ELSE 2 
                    END";
                $appointment_data = mysqli_query($conn, $appointment_query);
                if (mysqli_num_rows($appointment_data) > 0) {
                    while ($result_appointment = mysqli_fetch_assoc($appointment_data)) {

                        ?>
                        <div class="appointment_details">
                            <div class="doctor_details">
                                <div class="doctor_image">
                                    <img src="<?php echo $result_appointment['doctor_image'] ?>">
                                    <div class="doctor_data">
                                        <p><?php echo $result_appointment['doctor_name']; ?></p>
                                        <p><?php echo $result_appointment['speciality']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="patient_details">
                                <div class="data">
                                    Name:
                                    <p><?php echo $result_appointment['patient_name']; ?></p>
                                </div>
                                <div class="data">
                                    Age:
                                    <p><?php echo $result_appointment['patient_age']; ?></p>
                                </div>
                                <div class="data">
                                    Gender:
                                    <p><?php echo $result_appointment['patient_gender']; ?></p>
                                </div>

                            </div>
                            <div class="date_time">
                                <div class="data">
                                    Date:
                                    <p><?php echo $result_appointment['date']; ?></p>
                                </div>
                                <div class="data">
                                    Time:
                                    <p><?php echo $result_appointment['time']; ?></p>
                                </div>
                            </div>
                            <div class="status">
                                <p><?php echo $result_appointment['status'] ?></p>
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
        //confirmation of rejection request
        function confirmReject() {
            return confirm('Are you sure, you want to reject the request ?');
        }
        //confirmation approve request
        function confirmApprove() {
            return confirm('Are you sure, you want to accept the request ?');
        }

        //dashboard and appointment popup sidebar
        function appointmentShow() {
            document.querySelector('#dashboard').classList.remove("active");
            document.querySelector('#appointment').classList.add("active");
            document.querySelector('.dashboard').classList.add("hide");
            document.querySelector('.appointment_container').classList.remove("hide");
        }
        function dashboardShow() {
            document.querySelector('#dashboard').classList.add("active");
            document.querySelector('#appointment').classList.remove("active");
            document.querySelector('.dashboard').classList.remove("hide");
            document.querySelector('.appointment_container').classList.add("hide");
        }
    </script>
</body>

</!DOCTYPE>