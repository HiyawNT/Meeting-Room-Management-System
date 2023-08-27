<?php
// Include database connection
require_once "../config/config.php";

// Check if reservation ID is provided
if (!isset($_POST["reservation_id"])) {
    header("location: request.php");
    exit;
}

// Get reservation ID from POST data
$reservation_id = $_POST["reservation_id"];

// Update reservation status to "rejected"
$stmt = $pdo->prepare("UPDATE room_reservation SET status = 'rejected' WHERE id = :id");
$stmt->bindValue(":id", $reservation_id);
$stmt->execute();

// Redirect user to the request page
header("location: request.php");
exit;
?>