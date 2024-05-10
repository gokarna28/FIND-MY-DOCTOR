<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doctor Records</title>
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

        .doctor_details_container {
            padding: 20px;
        }

        .back_btn button {
            padding: 5px 10px;
            font-size: 20px;
        }

        a {
            text-decoration: none;
            color: var(--lightBlackColor);
        }

        .doctor_details_wrapper {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        td {
            padding: 10px;
        }

        .data {
            display: flex;
            align-items: center;
        }

        .data img {
            width: 50px;
            height: 50px;
            border-radius: 100px;
        }

        .data p {
            font-size: 18px;
            margin-left: 10px;
            color: var(--lightBlackColor);
            display: flex;
            flex-direction: column;
        }

        .color {
            color: var(--greenColor);
        }

        .action_btn {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            width: 200px;
            font-size: 25px;
        }

        .search {
            background-color: var(--lightGreyColor);
            display: flex;
            width: 500px;
            padding: 5px;
            justify-content: center;
            border-radius: 10px;

        }

        .search input {
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
        }

        .search button {
            font-size: 20px;
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
            margin-left: 10px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
        }

        .search button i {
            margin-right: 5px;
        }

        table {
            margin-top: 20px;
        }

        .blue {
            color: var(--lightBlue);
        }

        .red {
            color: var(--redColor);
        }

        .lightgreen {
            color: rgb(0, 153, 255);
        }
    </style>
</head>

<body>
    <div class="doctor_details_container ">
        <div class="back_btn">
            <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        </div>

        <div class="doctor_details_wrapper">
            <div class="search">
                <input type="text" placeholder="search here">
                <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
            </div>
            <div class="doctor_details">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    //retrive data from doctor table
                    include ("connection.php");

                    $doctor_detail = "SELECT * FROM doctor";
                    $doctor_data = mysqli_query($conn, $doctor_detail);
                    if (mysqli_num_rows($doctor_data) > 0) {
                        while ($result_doctor = mysqli_fetch_assoc($doctor_data)) {
                            //echo $result_doctor['doctor_name'];
                            //echo $result_doctor['doctor_image'];
                            ?>
                            <tr>
                                <td>
                                    <div class="data">
                                        <img src="<?php echo $result_doctor['doctor_image'] ?>">
                                        <div class="name">
                                            <p style="color:black;"><?php echo $result_doctor['doctor_name'] ?></p>
                                            <p> <?php echo $result_doctor['speciality'] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="data">
                                        <?php echo $result_doctor['doctor_email'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="data color">
                                        <?php echo $result_doctor['status'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action_btn">
                                        <a href="view_doctor.php?doctor_id=<?php echo $result_doctor['did']?>" class="lightgreen"><i class="fa-solid fa-eye"></i></a>
                                        <a href="update_doctor.php?doctor_id=<?php echo $result_doctor['did']?>" class="blue"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="delete_doctor.php?doctor_id=<?php echo $result_doctor['did']?>" class="red" name="doctor_delete" onclick="return confirmDelete()"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script>
        //confirmation of doctor record delete
        function confirmDelete(){
            return confirm('Are you sure, you want to delete the doctor ?');
        }
    </script>
</body>

</html>