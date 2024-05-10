<?php
include ("connection.php");

$admin_id = $_GET['admin_id'];

$admin_data = "SELECT * FROM admin WHERE admin_id=$admin_id";
$data = mysqli_query($conn, $admin_data);
if (mysqli_num_rows($data) == 1) {
    $result = mysqli_fetch_assoc($data);
}

//upadate admin table

$error_msg = "";
$name_error = "";
$email_error = "";

if (isset($_POST['add_btn'])) {

    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];

    if (empty(trim($name)) || empty(trim($email))) {
        $error_msg = "Fill all the fields";
    } else {
        // Name validation
        if (empty($name)) {
            $name_error = "Name is required*";
        } elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $name_error = "Name can only contain letters and spaces.";
        } elseif (strlen($name) > 40) {
            $name_error = "Full name exceeds 40 characters.";
        }

        // Email validation
        if (empty($email)) {
            $email_error = "Email is required*";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Invalid email format";
        } 


        // If no validation errors, proceed to send email
        if (empty($name_error) && empty($email_error)) {


            $add_query = "UPDATE admin set admin_name='$name', admin_email='$email' WHERE admin_id='$admin_id'";
            $add_data = mysqli_query($conn, $add_query);
            if ($add_data) {
                echo "<script>
                alert('admin details is successfully updated.');
                </script>";

            } else {
                echo "failed to add" . mysqli_error($conn);
            }
        }

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>edit admin user</title>
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

        /* add form */
        .add_admin {
            background-color: var(--lightGreyColor);
            padding: 20px;
            border-radius: 15px;
            width: 700px;
            height: 200px;
            margin-left: 50px;
            margin-left: 30%;
            margin-top: 10%;
        }

        .add_admin h2 {
            color: var(--lightBlackColor);
            display: flex;
            justify-content: center;
        }

        .fields {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .field_input {
            /* background-color: yellow; */
            margin-top: 20px;
        }

        .input {
            border: 1px solid black;
            display: flex;
            align-items: center;
            padding: 5px 10px;
            font-size: 18px;
            width: 300px;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .input input {
            font-size: 18px;
            border: none;
            background-color: transparent;
            outline: none;
            padding: 0 10px;
            margin-left: 10px;
        }

        .add_btn {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .add_btn button {
            font-size: 20px;
            border-radius: 5px;
            padding: 5px 10px;
            background-color: var(--primaryColor);
            color: var(--whiteColor);
            border: 1px solid black;
        }



        .message {
            font-size: 20px;
            background-color: var(--redColor);
            border-radius: 5px;
            padding: 0 10px;
        }

        .admin_section button a {
            font-size: 30px;
            color: var(--lightBlackColor);
            padding: 5px 10px;
        }

        .close_btn {
            margin-left: 30px;
            padding: 5px 10px;
        }

        .close_btn a {
            font-size: 25px;
            color: var(--lightBlackColor);
        }
    </style>
</head>

<body>

    <button class="close_btn"><a href="add_admin.php"><i class="fa-solid fa-arrow-left"></i></a></button>
    <div class="add_admin">
        <h2>Edit admin Details</h2>
        <form action="" method="post" autocomplete="off">
            <div class="message">
                <span><?php echo $error_msg ?></span>
            </div>

            <div class="fields">
                <div class="field_input">
                    <div class="input">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="admin_name" placeholder="Enter fullname"
                            value="<?php echo $result['admin_name'] ?>">
                    </div>
                    <span style="font-size:10px; color: red;"><?php echo $name_error ?></span>
                </div>
                <div class="field_input">
                    <div class="input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="admin_email" placeholder="Enter email"
                            value="<?php echo $result['admin_email'] ?>">
                    </div>
                    <span style="font-size:10px; color: red;"><?php echo $email_error ?></span>
                </div>

            </div>
            <div class="add_btn">
                <button type="submit" name="add_btn">Update Now</button>
            </div>
        </form>
    </div>

</body>

</html>