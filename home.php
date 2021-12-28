<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("location:login.php");
}
include("config.php");
$servername = 'localhost';
$dbname = 'myproject1';
$username = 'root';
$password = 'root';
$url = "./image/";

$conn = new mysqli($servername, $username, $password, $dbname);
if (!$conn) {
    die('failed' . $conn->mysqli_error);
}

$sql = "Select * from moviestable";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    button {
        float: right;
    }
    </style>
</head>

<body>
    <form action="logout.php" method="POST">

        <button>logout</button>

    </form>

    <table align="center" border="2px" style="width: 600px; line-height:auto">
        <th align='center' colspan="5">Movie Details</th>
        <tr>
            <t>
                <th>movie_name</th>
                <th>movie_year</th>
                <th>Actor</th>
                <th>Actress</th>
                <th>banner_image</th>
            </t>
            <?php
            while ($row = $result->fetch_assoc()) {
            ?>
        <tr>
            <td><?php echo $row['movie_name']; ?></td>
            <td><?php echo $row['movie_year']; ?></td>
            <td><?php echo $row['actor']; ?></td>
            <td><?php echo $row['actress']; ?></td>
            <td> <img height="150" width="300" src=" <?php echo $url . $row["banner_image"]; ?>"></img></td>
        </tr>

        <?php
            }
    ?>

    </table>
</body>

</html>