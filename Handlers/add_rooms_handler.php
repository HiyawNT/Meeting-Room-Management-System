<?php
// Start session
session_start();

// Check if the user is logged in as admin
if(!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit();
}

// Include database connection
require_once('../config/config.php');

// Get form data
$room_name = $_POST['room_name'];
$room_capacity = $_POST['room_capacity'];
$room_status = $_POST['room_status'];
$room_description = $_POST['room_description'];

// Prepare SQL statement to insert new room into database
$stmt = $pdo->prepare("INSERT INTO rooms (name, capacity, status, description) VALUES (?, ?, ?, ?)");
$stmt->execute([$room_name, $room_capacity, $room_status, $room_description]);

// Redirect to rooms.php after adding new room
echo '<script>alert("Room created Successfully")</script>';

header("Location: ../admin/rooms.php");
exit();
?>