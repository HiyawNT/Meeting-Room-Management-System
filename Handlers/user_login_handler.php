<?php

// Start a session
session_start();
define('BASEPATH', true); //access connection script if you omit this line file will be blank
require "../config/config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

 


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    

    



  // Get the form data
  $username = $_POST['username'];
  $password = $_POST['password'];


  // Check if the username and password are empty
  if (empty($username) || empty($password)) {
    echo '<script>alert("Please enter a username and password")</script>';
    exit;
  }

  // Get the admin user from the database
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
  $stmt->execute(['username' => $username]);
  $user = $stmt->fetch();

  // Check if the user exists
  if (!$user) {
    echo '<script>alert("Invalid username or password")</script>';
  
    exit;
  }

  // Check if the password is correct
  if (!password_verify($password, $user['password'])) {
    echo '<script>alert("Invalid username or password")</script>';
    exit;
  }

  // Set the user in the session
  $_SESSION['users'] = $user;

  
  // Redirect to the dashboard
  if(isset($_GET['room_id'])){
    // Get the room ID from the URL parameter
    $room_id = $_GET['id'];
        // Get the room_id from the session
        $_SESSION['room_id'] = $room_id;
        // var_dump($room_id);
      
        // Redirect to the reserve.php page with the room_id
        // echo '<script>alert("success")</script>';
        header("Location: ../office/reserve.php?id=" . $_GET["room_id"]);
        exit;
} 
  elseif(!isset($_GET['room_id'])){
     header('Location: ../index.php');
  }



  else{
    echo "NO Session Found" ;
    // var_dump($room_id);

  }

  exit;
}


?>
