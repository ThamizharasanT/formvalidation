<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["password"])) {
            $pwdErr = "pleas enter password";
        } else {
            if (strlen($_POST["password"]) < 6) {

                $pwdErr = "password minimum six letter";
            }
        }
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {

            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {

                if (isset($_POST["login"])) {
                    include("config.php");
                    $email = $_POST["email"];
                    $pwd = $_POST["password"];

                    $sql = "SELECT `email`, `password` FROM `form` where email='$email' and password='$pwd'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {

                        $_SESSION["email"] = $email;


                        header("location:home.php");
                    } else {
                        $Err = "your account dosent exist kindly singnup";
                        header("refresh:2,url=signup.php");
                        $_SESSION["email"] = "please signup ";
                        if (!empty($_POST["password"])) {
                            if (strlen($_POST["password"]) > 6) {
                            } else {
                                $pwdErr = "password minimum six letter";
                            }
                        }
                    }
                }
            }
        }
    }

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    ?>

    <div class="form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

            <div class="form-control">
                <label for="">Email</label>
                <input type="text" name="email" placeholder="">
                <span><?php echo  $emailErr; ?></span>

            </div>

            <div class="form-control">
                <label for="">Password</label>
                <input type="password" name="password" placeholder="">
                <span><?php echo $pwdErr; ?></span>
            </div>
            <div>


                <button type="submit" name="login" value="login">Login</button>

                <span><?php echo $Err; ?></span>

            </div>
            <div> Create a new account?
                <a href="signup.php">signup </a>
            </div>
        </form>


    </div>


</body>

</html>