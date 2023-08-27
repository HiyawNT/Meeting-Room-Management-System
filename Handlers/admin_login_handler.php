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
  $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
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
  $_SESSION['admin'] = $user;

  // Redirect to the dashboard
  echo '<script>alert("success")</script>';

  header('Location: ../admin/dashboard.php');
  exit;
}

?>
