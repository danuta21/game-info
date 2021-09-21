<?php
include 'server.php';
$category_id = $_GET["category_id"];
$user_check_query = "SELECT Name FROM games WHERE category_id=$category_id ";
$result = mysqli_query($db, $user_check_query);

var_dump(mysqli_fetch_all($result));
?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="style.css">
</head>
</html>
