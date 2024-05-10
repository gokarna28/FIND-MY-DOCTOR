<?php
include ("connection.php");

$doctor_id = $_GET['doctor_id'];
$view_query = "SELECT * FROM doctor WHERE did='$doctor_id'";
$data = mysqli_query($conn, $view_query);
if (mysqli_num_rows($data) > 0) {
    $result_doctor = mysqli_fetch_assoc($data);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Doctor Records</title>
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
    <style>
        :root {
            --primaryColor: #1c5f5f;
            --secondaryColor: #d6e7d5;
            --bodyColor: #edeef3;
            --lightGreyColor: #f4f5fa;
            --whiteColor: #ffffff;
            --blackColor: #222;
            --lightBlackColor: #454955;
            --darkPurpleColor: #2c2f4e;
            --redColor: rgb(255, 55, 0);
            --greenColor: rgb(89, 183, 110);
            --lightBlue: rgb(52, 116, 245);
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: poppins;
            background-color: var(--whiteColor);
        }

        .doctor_details {
            display: flex;
            flex-direction: column;
            padding: 20px;
            background-color: var(--lightGreyColor);
            border-radius: 5px;
            width: 600px;
            height: 100%;
        }

        .image img {
            width: 100px;
            height: 100px;
            border-radius: 100px;
        }

        .details {
            display: flex;
            flex-direction: column;
        }

        .details p {
            font-size: 20px;
            margin-top: 5px;
        }

        .details i {
            margin-right: 10px;
        }

        .details_container {
            display: flex;
            padding: 20px;
            /* background-color: yellow; */
            width: 100%;
        }

        .details_wrapper {
            padding: 20px;
            width: 100%;
            height: 100vh;
        }

        .schedule_info {
            /* background-color: yellow; */
            margin-left: 50px;
            width: 800px;
        }
        .schedule_info h3{
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--lightBlackColor);
            margin: 10px 0;
        }

        .search {
            background-color: var(--lightGreyColor);
            padding: 10px 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
        }

        .search input {
            font-size: 20px;
            border: 1px solid var(--blackColor);
            border-radius: 5px;
            padding: 5px 10px;
            width: 300px;
            align-items: center;
        }

        .search button {
            font-size: 20px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
            padding: 5px 10px;
            border: 1px solid var(--blackColor);
            border-radius: 5px;
            margin-left: 10px;
        }
        .schedule_container{
            /* background-color: red; */
            padding: 20px;
            height: 500px;
            overflow: hidden;
            overflow-y: scroll;
        }
        .back_btn button{
            font-size: 20px;
            padding: 5px 10px;
        }
    </style>
</head>

<body>
    <div class="details_wrapper">
        <div class="back_btn">
            <button><a href="doctors_record.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>
        <div class="details_container">

            <div class="doctor_details">
                <div class="image">
                    <img src="<?php echo $result_doctor['doctor_image'] ?>">
                </div>
                <div class="details">
                    <p><i class="fa-solid fa-user"></i><?php echo $result_doctor['doctor_name'] ?></p>
                    <p><i class="fa-solid fa-envelope"></i><?php echo $result_doctor['doctor_email'] ?></p>
                    <p><i class="fa-solid fa-building-user"></i><?php echo $result_doctor['speciality'] ?></p>
                    <p><i class="fa-solid fa-graduation-cap"></i><?php echo $result_doctor['degree'] ?></p>
                    <p><i class="fa-solid fa-house-medical-circle-check"></i><?php echo $result_doctor['clinic'] ?></p>
                    <p><i class="fa-solid fa-location-dot"></i><?php echo $result_doctor['clinic_address'] ?></p>
                </div>
            </div>

            <div class="schedule_info">
                <h3>All Schedule Records</h3>
                <div class="search">
                    <input type="text" placeholder="search here">
                    <button>Search</button>
                </div>
                <div class="schedule_container">
                    <table>
                        <?php
                        include ("connection.php");

                        $query = "SELECT *
                      FROM doctor INNER JOIN schedule ON doctor.did = schedule.doctor_id WHERE  did=$doctor_id 
                               ORDER BY date DESC";
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
                                                        <button class='time_btn' name='book_btn' value='$slot' style='background-color: $button_color; color:#fff; font-size:20px; padding:5px;width:100px;' $disabled_attribute>
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
        </div>
    </div>
</body>

</html>