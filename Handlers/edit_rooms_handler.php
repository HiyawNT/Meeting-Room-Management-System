<?php

require_once '../config/config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Retrieve the room ID from the query string
if (!isset($_GET['id'])) {
  header('Location: ../admin/rooms.php');
  exit;
}
$room_id = $_GET['id'];
echo $room_id;
// Retrieve the room details from the database
$stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = :id");
$stmt->bindParam(':id', $room_id);
$stmt->execute();
$room = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$room) {
    echo '<script>alert("already Exists");</script>';
  header('Location: ../admin/rooms.php');
  exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  // Retrieve the form data
  $room_name = $_POST['name'];
  $room_capacity = $_POST['capacity'];
  $room_status = $_POST['status'];
  $room_description = $_POST['description'];
  

  echo $room_name. "  ". $room_capacity." ". $room_status. " ". $room_description;
  // Update the room details in the database
  $stmt = $pdo->prepare("UPDATE rooms SET name = ?, capacity = ?, status = ?, description = ? WHERE id = ?");
  $stmt->execute([$room_name, $room_capacity, $room_status, $room_description, $room_id]);

  // Redirect to the rooms page
  header('Location: ../admin/rooms.php');
  exit;
}
else {
  echo "Room Not Found";
}


// test2
// Include database connection
// include_once '../config/config.php';

// // Check if the edit_room form was submitted
// if (isset($_POST['edit_room'])) {
//   // Retrieve form data
//   $room_id = $_POST['room_id'];
//   $room_name = $_POST['name'];
//   $room_capacity = $_POST['capacity'];
//   $room_status = $_POST['status'];
//   $room_description = $_POST['description'];

//   // Update the room in the database
//   $sql = "UPDATE rooms SET name = ?, capacity = ?, status = ?, description = ? WHERE id = ?";
//   $stmt = $pdo->prepare($sql);
//   $result = $stmt->execute([$room_name, $room_capacity, $room_status, $room_description, $room_id]);

//   // Check if the update was successful
//   if ($result) {
//       // Redirect back to the rooms page with a success message
//       header('Location: ../admin/rooms.php?success=Room updated successfully');
//       exit();
//   } else {
//       // Redirect back to the edit room page with an error message
//       header('Location: ../admin/edit_room.php?id=' . $room_id . '&error=Failed to update room');
//       exit();
//   }
// } else {
//   // Redirect back to the edit room page with an error message
//   header('Location: ../admin/edit_room.php?id=' . $room_id . '&error=Invalid request');
//   exit();
// }

?>
