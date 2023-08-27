<?php
require_once('../config/config.php');

// Check if the reservation ID was submitted
if(!isset($_POST['reservation_id'])){
    header('Location: request.php');
    exit();
  }
  // Connect to the database
// Check if the user is logged in as an admin

// Get the reservation ID from the submitted form
$reservation_id = $_POST['reservation_id'];

// Get the reservation details from the database
$stmt = $pdo->prepare("SELECT * FROM room_reservation WHERE id = ?");
$stmt->execute([$reservation_id]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the reservation exists
if(!$reservation){
header('Location: request.php');
exit();
}

// Update the reservation status to approved
$stmt = $pdo->prepare("UPDATE room_reservation SET status = 'approved' WHERE id = ?");
$stmt->execute([$reservation_id]);

// Update the room status to unavailable
$stmt = $pdo->prepare("UPDATE rooms SET status = 'unavailable' WHERE id = ?");
$stmt->execute([$reservation['room_id']]);

// Redirect back to the reservation table
header('Location: request.php');
exit();
?>