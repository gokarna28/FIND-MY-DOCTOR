<?php
include ("connection.php");

$user_id = $_GET['user_id'];

//retrive data from user table
$user_data = "SELECT * FROM user WHERE uid=$user_id";
$user = mysqli_query($conn, $user_data);

if (mysqli_num_rows($user) > 0) {
    $row_user = mysqli_fetch_assoc($user);
    //echo $row_user['user_name'];
}

//update the data
if (isset($_POST['save_btn'])) {
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];

    $update_query = "UPDATE user SET user_name='$name', user_email='$email' WHERE uid='$user_id'";
    $update_data = mysqli_query($conn, $update_query);
    if ($update_data) {
        echo "<script>alert('User data is successfully updated.');</script>";
    } else {
        echo "failed to update" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<htm lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>edit user details</title>
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

            .edit_wrapper {
                /* background-color: red; */
                padding: 20px;
            }

            .edit_wrapper button {
                padding: 5px 10px;
                font-size: 20px;
            }

            /* .user_data {
                background-color: yellow;
            } */
            a {
                text-decoration: none;
                color: var(--lightBlackColor);
            }

            .user_data h2 {
                color: var(--lightBlackColor);
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }

            .fields {
                /* background-color: yellowgreen; */
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .input {
                border: 1px solid var(--blackColor);
                border-radius: 5px;
                padding: 5px;
                margin-top: 10px;
                width: 350px;
                font-size: 20px;
            }

            .input input {
                border: none;
                outline: none;
                background-color: transparent;
                font-size: 20px;
                margin-left: 10px;
            }

            .save_btn {
                display: flex;
                justify-content: center;
                padding: 20px 0;
            }

            .save_btn button {
                border: 1px solid var(--blackColor);
                border-radius: 5px;
                background-color: var(--primaryColor);
                color: var(--whiteColor);
            }
        </style>
    </head>

    <body>
        <div class="edit_wrapper">
            <button><a href="users_record.php"><i class="fa-solid fa-arrow-left"></i></a></button>
            <div class="user_data">
                <h2>Edit User Details</h2>
                <form action="" method="post">
                    <div class="fields">
                        <div class="input">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" name="user_name" value="<?php echo $row_user['user_name'] ?>">
                        </div>
                        <div class="input">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="text" name="user_email" value="<?php echo $row_user['user_email'] ?>">
                        </div>
                    </div>
                    <div class="save_btn">
                        <button type="submit" name="save_btn">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</htm>