<?php

    if(!isset($_SESSION))
    {
        session_start();
    }

$username = "";
$email   = "";
$Name = "";
$Category = "";
$Platform = "";

$errors = array();

$db = mysqli_connect('localhost', 'root', '', 'registration');


if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' ";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }
  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, email, password)
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    header('location: index.php');
  }
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $dbResults = mysqli_fetch_assoc($results);
      $_SESSION['username'] = $dbResults["username"];
      $_SESSION['id'] = $dbResults["id"];
      header('location: index.php');
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

if (isset($_POST['add'])) {
  $Name = mysqli_real_escape_string($db, $_POST['Name']);
  $Category = mysqli_real_escape_string($db, $_POST['Category']);
  $Platform = mysqli_real_escape_string($db, $_POST['Platform']);
  $id = $_SESSION["id"];


  $query1 = "INSERT INTO games (Name, Category, Platform, user_id)
        VALUES('$Name', '$Category', '$Platform', '$id')";
  mysqli_query($db, $query1);
  header('location: index.php');
}

  $user_id= mysqli_real_escape_string($db,  $_POST['id']);
  $result3 = mysqli_query($db,"SELECT * FROM games WHERE id =$user_id ");

  if (isset($_POST['delete'])) {

    $game_id = mysqli_real_escape_string($db,  $_POST['id']);


    $query2 = "DELETE FROM games WHERE id=$game_id";

    mysqli_query($db, $query2);
    header('location: index.php');
  }


?>
