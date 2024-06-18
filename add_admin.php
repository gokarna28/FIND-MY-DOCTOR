<?php
include ("connection.php");

$error_msg = "";
$name_error = "";
$email_error = "";
$pass_error = "";
$cpass_error = "";
$name = "";
$email = "";
$password = "";
$cpassword = "";

if (isset($_POST['add_btn'])) {

    $name = $_POST['admin_name'];
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];
    $cpassword = $_POST['admin_cpassword'];

    if (empty(trim($name)) || empty(trim($email)) || empty(trim($password)) || empty(trim($cpassword))) {
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
        } else {
            // Check if email already exists in the database
            $query = "SELECT * FROM admin WHERE admin_email = '$email'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $email_error = "User with this email already exists.";
            }
        }

        // Password validation
        if (empty($password)) {
            $pass_error = "Password is required*";
        } elseif (strlen($password) < 8) {
            $pass_error = "Password must be at least 8 characters long";
        }

        // Confirm Password validation
        if (empty($cpassword)) {
            $cpass_error = "Confirm Password is required*";
        } elseif ($cpassword != $password) {
            $cpass_error = "Passwords do not match";
        }

        // If no validation errors, proceed to send email
        if (empty($name_error) && empty($email_error) && empty($pass_error) && empty($cpass_error)) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $add_query = "INSERT INTO admin (admin_name, admin_email, admin_password) VALUES('$name', '$email', '$hashed_password')";
            $add_data = mysqli_query($conn, $add_query);
            if ($add_data) {
                echo "<script>
                alert('admin user is successfully added to system.');
                </script>";
                // Reset form input values
                $name = "";
                $email = "";
                $password = "";
                $cpassword = "";
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
    <title>doctor dashboard</title>
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
            background-color: var(--bodyColor);
        }

        .admin_section {
            background-color: var(--whiteColor);
            padding: 20px;
            width: 100%;
            height: 100vh;
        }

        .admin_wrapper {
            display: flex;
            justify-content: center;
        }

        .admin_details {
            /* background-color: yellow; */
            padding: 20px;
        }

        .admin_details h2 {
            display: flex;
            justify-content: center;
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

        .admin_image {
            display: flex;
            align-items: center;
        }

        .letter {
            background-color: var(--lightGreyColor);
            display: flex;
            justify-content: center;
            font-size: 40px;
            border-radius: 100px;
            width: 50px;
            height: 50px;
            align-items: center;
            font-weight: 500;
            color: var(--primaryColor);
        }

        .admin_image p {
            margin-left: 10px;
        }

        .admin_image img {
            width: 50px;
            height: 50px;
            border-radius: 100px;
        }

        .action_btn {
            display: flex;
            align-items: center;
        }

        .edit_btn a i {
            font-size: 20px;
            color: var(--lightBlue);
            display: flex;
            align-items: center;
            margin-right: 10px;
        }

        a {
            text-decoration: none;
        }

        .delete_btn a i {
            font-size: 20px;
            color: var(--redColor);
            display: flex;
            align-items: center;
            margin-left: 20px;
        }

        /* add form */
        .add_admin {
            background-color: var(--lightGreyColor);
            padding: 20px;
            border-radius: 15px;
            width: 650px;
            height: 300px;
            margin-top: 10%;
            position: absolute;
            margin-left: 20px;
            i{
                font-size: 30px;
            }
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

        lavel {
            font-size: 15px;
            font-weight: 500;
        }

        .input {
            border: 1px solid black;
            border-radius: 5px;
            display: flex;
            align-items: center;
            padding: 5px 10px;
            font-size: 18px;
            width: 280px;
        }

        .input input {
            font-size: 16px;
            border: none;
            background-color: transparent;
            outline: none;
            padding: 0 10px;
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
            border: none;
            cursor: pointer;
            transition: background 0.5s;
        }

        .add_btn button:hover {
            background-color: var(--greenColor);
        }

        .hide {
            display: none;
        }

        .message {
            font-size: 20px;
            background-color: var(--redColor);
            border-radius: 5px;
            padding: 0 10px;
        }

        .admin_section button a {
            font-size: 25px;
            color: var(--lightBlackColor);
            padding: 5px 10px;
        }
        .add{
            font-size: 30px;
            display: flex;
            justify-content: right;
            margin-bottom: 10px
        }
    </style>
</head>

<body>

    <!-- admin user section -->
    <div class="admin_section">
        <button><a href="admin_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></button>
        <div class="admin_wrapper">

            <!-- admin_details -->
            <div class="admin_details">
                <h2>Admin Users</h2>
                <div class="add"><i class="fa-solid fa-plus" onclick="addForm()"></i></div>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $admain_details = "SELECT * FROM admin";
                    $details_data = mysqli_query($conn, $admain_details);
                    if (mysqli_num_rows($details_data) > 0) {
                        while ($row_admin = mysqli_fetch_assoc($details_data)) {

                            ?>
                            <tr>

                                <td>
                                    <?php
                                    if ($row_admin['admin_image'] == null || $row_admin['admin_image'] == '') {
                                        //echo "no image";
                                        ?>
                                        <div class="admin_image">
                                            <div class="letter"><?php echo substr($row_admin['admin_name'], 0, 1); ?></div>
                                            <p><?php echo $row_admin['admin_name'] ?></p>
                                        </div>
                                        <?php
                                    } else {
                                        //echo "image";
                                        ?>
                                        <div class="admin_image">
                                            <img src="<?php echo $row_admin['admin_image']; ?>">
                                            <p><?php echo $row_admin['admin_name'] ?></p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $row_admin['admin_email'] ?>
                                </td>
                                <td>
                                    <div class="action_btn">
                                        <div class="edit_btn">
                                            <a href="edit_admin.php?admin_id=<?php echo $row_admin['admin_id'] ?>"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                        <div class="delete_btn">
                                            <a href="delete_admin.php?admin_id=<?php echo $row_admin['admin_id'] ?>"><i
                                                    class="fa-solid fa-trash" onclick="return confirmDelete()"></i></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>



                </table>

            </div>


            <!-- add admin form -->
            <div class="add_admin hide">
            <i class="fa-solid fa-xmark" onclick="hideForm()"></i>
                <h2>Add Admin User</h2>
                <form action="" method="post" autocomplete="off">
                    <div class="message">
                        <span><?php echo $error_msg ?></span>
                    </div>

                    <div class="fields">
                        <div class="field_input">
                            <label>Fullname:</label>
                            <div class="input">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" name="admin_name" placeholder="Enter fullname"
                                    value="<?php echo $name ?>">
                            </div>
                            <span style="font-size:10px; color: red;"><?php echo $name_error ?></span>
                        </div>
                        <div class="field_input">
                            <label>Email:</label>
                            <div class="input">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" name="admin_email" placeholder="Enter email"
                                    value="<?php echo $email ?>">
                            </div>
                            <span style="font-size:10px; color: red;"><?php echo $email_error ?></span>
                        </div>
                        <div class="field_input">
                            <label>Password:</label>
                            <div class="input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="admin_password" placeholder="Enter password" id='password'
                                    value="<?php echo $password ?>">
                                <i class="fa-solid fa-eye hide" onclick="hidePass()" id="eyeopen"></i>
                                <i class="fa-solid fa-eye-slash " onclick="showPass()" id="eyeclose"></i>
                            </div>
                            <span style="font-size:10px; color: red;"><?php echo $pass_error ?></span>
                        </div>
                        <div class="field_input">
                            <label>Confirm Password:</label>
                            <div class="input">
                                <i class="fa-solid fa-lock"></i>
                                <input type="password" name="admin_cpassword" placeholder="Retype password"
                                    id="cpassword" value="<?php echo $cpassword ?>">
                                <i class="fa-solid fa-eye hide" onclick="hidecPass()" id="ceyeopen"></i>
                                <i class="fa-solid fa-eye-slash " onclick="showcPass()" id="ceyeclose"></i>
                            </div>
                            <span style="font-size:10px; color: red;"><?php echo $cpass_error ?></span>
                        </div>
                    </div>
                    <div class="add_btn">
                        <button type="submit" name="add_btn">Add Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
function addForm(){
    document.querySelector(".add_admin").classList.remove("hide");
}
function hideForm(){
    document.querySelector(".add_admin").classList.add("hide");
}
        //confirmation delte admin user
        function confirmDelete() {
            return confirm("Are you sure, you want to delete the user.");
        }
        //hide show password
        function showPass() {
            document.querySelector("#eyeclose").classList.add("hide");
            document.querySelector("#eyeopen").classList.remove("hide");
            document.querySelector("#password").type = 'text';
        }
        function hidePass() {
            document.querySelector("#eyeclose").classList.remove("hide");
            document.querySelector("#eyeopen").classList.add("hide");
            document.querySelector("#password").type = 'password';
        }
        //hide show confirm password
        function showcPass() {
            document.querySelector("#ceyeclose").classList.add("hide");
            document.querySelector("#ceyeopen").classList.remove("hide");
            document.querySelector("#cpassword").type = 'text';
        }
        function hidecPass() {
            document.querySelector("#ceyeclose").classList.remove("hide");
            document.querySelector("#ceyeopen").classList.add("hide");
            document.querySelector("#cpassword").type = 'password';
        }
    </script>
</body>

</html>