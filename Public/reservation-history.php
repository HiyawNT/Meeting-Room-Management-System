<?php
require_once "../config/config.php";

// Check if a room ID has been specified
if(isset($_GET['room_id'])){
  // Get the room ID from the URL parameter
  $room_id = $_GET['room_id'];
  
  // Get the room information from the database
  $stmt = $pdo->prepare("SELECT * FROM rooms WHERE id = ?");
  $stmt->execute([$room_id]);
  $room = $stmt->fetch(PDO::FETCH_ASSOC);
  
  // Get the reservation history for the room from the database
  $stmt = $pdo->prepare("SELECT rr.id, u.username, rr.date, rr.start_time, rr.end_time, rr.reason, rr.status 
                          FROM room_reservation rr 
                          INNER JOIN users u ON rr.user_id = u.id 
                          WHERE rr.room_id = ?
                          ORDER BY rr.date DESC, rr.start_time DESC");
  $stmt->execute([$room_id]);
  $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
  // Redirect back to the room listing page if no room ID was specified
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Reservation History for <?php echo $room['name']; ?></title>
<!-- Theme icon -->
<link rel="shortcut icon" href="../assets/images/favicon.ico" />

<link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet" />
<link href="../assets/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
    <link href="../assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
<link href="../assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">


<!-- Theme Css -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" /></head>
<body>
  <div class="container-fluid">
    <h1 class="my-4"><?php echo $room['name']; ?></h1>
    
    <h2>Reservation History</h2>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>User</th>
          <th>Date</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Reason</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($reservations as $reservation){ ?>
        <tr>
          <td><?php echo $reservation['id']; ?></td>
          <td><?php echo $reservation['username']; ?></td>
          <td><?php echo $reservation['date']; ?></td>
          <td><?php echo $reservation['start_time']; ?></td>
          <td><?php echo $reservation['end_time']; ?></td>
          <td><?php echo $reservation['reason']; ?></td>
          <td><?php echo $reservation['status']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
