<?php

session_start();
// Check how the user accessed the page and set $room_id accordingly
if (isset($_GET['id'])) {
    // If a room ID was provided in the URL, use that
    $room_id = $_GET['id'];
    // Store the room_id in the session
    $_SESSION['room_id'] = $room_id;
  } elseif (isset($_SESSION['room_id'])) {
    // If a room ID was stored in the session, use that
    $room_id = $_SESSION['room_id'];
  } else {
    // Otherwise, redirect to a default page or show an error message
    header('Location: ../dashboard.php');
    exit();
    
  }
  

$room_id = $_POST['room_id'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$user_id = $_SESSION['users']['username'];
$reason =  $_POST['reason'];
require_once "../config/config.php";
$insert_reservation = $pdo->prepare('INSERT INTO room_reservation (room_id, start_time, end_time  user_id,) VALUES (:room_id,  :start_time, :end_time, :user_id,)');

$insert_reservation->bindParam(':room_id', $room_id);
$insert_reservation->bindParam(':start_time', $start_time);
$insert_reservation->bindParam(':end_time', $end_time);
$insert_reservation->bindParam(':user_id', $user_id);
$insert_reservation->execute();

echo "Reservation successful.";

?>
