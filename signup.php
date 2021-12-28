<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">


</head>

<body background="./assets/OTT Welcom and login screen images/02/1@2x.png" style="background-repeat:no-repeat">
    <?php


    // define variables and set to empty values

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameerr = "name is required";
        }
        if (empty($_POST["city"])) {
            $cityerr = "city is required";
        }



        if (empty($_POST["password"])) {
            $pwdErr = "pleas enter password";
        } else {
            if (strlen($_POST["password"]) > 6) {
            } else {
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
                if (isset($_POST["signup"])) {
                    include("config.php");
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $pwd = $_POST["password"];
                    $city = $_POST["city"];

                    $sql1  = "SELECT `email` FROM `form` WHERE email='$email'";
                    $sql = "INSERT INTO `form`( `name`, `email`, `password`, `city`) VALUES ('$name','$email','$pwd','$city')";
                    $result = $conn->query($sql1);
                    if ($result->num_rows > 0 || $conn->query($sql) === true) {
                        $Err1 = "You already have an account try to login!";
                        header("refresh:3,url=login.php");
                    } else {

                        if (!empty($_POST["password"])) {
                            if (strlen($_POST["password"]) > 6) {
                            } else {
                                $pwdErr = "password minimum six letter";
                            }
                        }
                        //header("location:login.php");
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
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-control">
                <label form="">Name</label>
                <input type="text" name="name" placeholder="">
                <span><?php echo $nameerr; ?></span>
            </div>
            <div class="form-control">
                <label form="">Email</label>
                <input type="email" name="email" placeholder="">
                <span><?php echo  $emailErr; ?></span>
            </div>

            <div class="form-control">
                <label form="">Password</label>
                <input type="password" name="password" placeholder="">
                <span><?php echo $pwdErr; ?></span>
            </div>

            <div class="form-control">
                <label form="">City</label>
                <input type="text" name="city" placeholder="">
                <span><?php echo $cityerr; ?></span>
            </div>

            <div>
                <span><?php echo $Err; ?></span>

                <button type="submit" name="signup">Sign up</button>
                <div>
                    <span><?php echo $Err1; ?></span>
                </div>
            </div><br><br>
            <div>
                Already Have Account ?
                <a href="login.php">Login</a>
            </div>
        </form>





















    </div>





























</body>

</html>