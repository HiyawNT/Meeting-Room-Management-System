<?php
session_start();
// Include config file
require_once '../config/config.php';

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); // Method not allowed
    exit;
}

// Validate user authentication
if (!isset($_SESSION['users']) || empty($_SESSION['users'])) {
    header('Location: ../login.php');
    exit;
}

// Validate reservation ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: history.php');
    exit;
}

$reservation_id = $_GET['id'];

// Retrieve reservation from the database
$stmt = $pdo->prepare("SELECT * FROM room_reservation WHERE id = :id AND user_id = :user_id LIMIT 1");
$stmt->execute(['id' => $reservation_id, 'user_id' => $_SESSION['users']['id']]);
$reservation = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if reservation exists and has a pending status
if (!$reservation || $reservation['status'] !== 'pending') {
    header('Location: history.php');
    exit;
}

// Cancel reservation
$stmt = $pdo->prepare("UPDATE room_reservation SET status = 'cancelled' WHERE id = :id");
$stmt->execute(['id' => $reservation_id]);

// Redirect to history page with success message
$_SESSION['success'] = 'Reservation cancelled successfully';
header('Location: history.php');
exit;
