<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Record</title>
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

        .details_wrapper {
            padding: 20px;

        }

        .details_container {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            /* background-color: var(--redColor); */
        }

        .details_container h2 {
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }

        .user_details {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .user_data img {
            width: 50px;
            height: 50px;
            border-radius: 100px;
        }

        .letter {
            background-color: var(--lightGreyColor);
            width: 50px;
            height: 50px;
            border-radius: 100px;
            font-size: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--primaryColor);
            box-shadow: rgba(1, 1, 1, 0.2) 0px 2px 10px 2px;
            font-weight: 500;
        }

        .user_data {
            display: flex;
            font-size: 18px;
            padding: 5px 10px;
            align-items: center;
        }

        .user_data p {
            font-size: 18px;
            color: var(--lightBlackColor);
            margin-left: 10px;
        }

        .action_btn {
            display: flex;
            font-size: 20px;
            align-items: center;
            justify-content: space-between;
            padding: 5px 10px;
            width: 100px;
        }

        a {
            text-decoration: none;
        }

        #edit_button {
            color: var(--lightBlue);
        }

        #delete_button {
            color: var(--redColor);
        }

        .search {
            background-color: var(--lightGreyColor);
            padding: 15px;
            border-radius: 15px;
            display: flex;
            justify-content: center;
            width: 600px;
        }

        .search input {
            font-size: 20px;
            border-radius: 5px;
            padding: 5px 10px;
            border: 1px solid var(--blackColor);
            width: 300px;
        }

        .search button {
            font-size: 20px;
            margin-left: 10px;
            border-radius: 5px;
            border: 1px solid var(--blackColor);
            padding: 5px 10px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
        }

        .search button i {
            margin-right: 10px;
        }

        .details_wrapper button {
            font-size: 25px;
            padding: 2px 10px;
        }

        .details_wrapper button a {
            color: var(--lightBlackColor);
        }
        table {
            border-collapse: collapse;
            width: 100%;

            td,
            th {
                border-bottom: 0.5px solid var(--lightBlackColor);
                padding: 8px;
            }
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>
    <div class="details_wrapper">
        <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <div class="details_container">
            <h2>User Record</h2>

            <div class="search">
                <input type="text" placeholder="search here">
                <button><i class="fa-solid fa-magnifying-glass"></i>Search</button>
            </div>
            <div class="user_details">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    include ('connection.php');

                    $select_users = "SELECT * FROM user";
                    $select_data = mysqli_query($conn, $select_users);
                    if (mysqli_num_rows($select_data)) {
                        while ($result_user = mysqli_fetch_assoc($select_data)) {
                            ?>
                            <tr>
                                <td>
                                    <div class="user_data">
                                        <?php
                                        if ($result_user['user_image'] == null || $result_user['user_image'] == '') {
                                            ?>
                                            <div class="letter">
                                                <?php echo substr($result_user['user_name'], 0, 1); ?>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <img src="<?php echo $result_user['user_image'] ?>">
                                            <?php
                                        }
                                        ?>
                                        <p><?php echo $result_user['user_name'] ?></p>

                                    </div>
                                </td>
                                <td>
                                    <div class="user_data">
                                        <?php echo $result_user['user_email'] ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action_btn">
                                        <a href="update_user.php?user_id=<?php echo $result_user['uid']?>"><i class="fa-solid fa-pen-to-square" id="edit_button"></i></a>
                                        <a href="delete_user.php?user_id=<?php echo $result_user['uid']?>"><i class="fa-solid fa-trash" id="delete_button" onclick='return confirmationUser()' name="delete_btn"></i></a>
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
//confirmation of user data delete
function confirmationUser(){
    return confirm('Are you sure, you want to delete user ?');
}
</script>
</body>

</html>