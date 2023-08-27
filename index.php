<?php           
          session_start();
          require_once "./config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ECDSWC</title>
        <!-- Theme icon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />

<!-- <link href="./assets/plugins/morris-chart/morris.css" rel="stylesheet" /> -->
<!-- Theme Css -->
<link href="./assets/css/bootstrap.min.css" rel="stylesheet" />

<link href="assets/css/style.css" rel="stylesheet" />
</head>
<body> 
<nav class="navbar navbar-expand-lg navbar-dark bg-white fixed-top">
<img class="navbar-brand" src="assets/images/ecd_logo.png" height="60px" alt="Logo">
    </a>
    <style>
    .welcome-message {
        font-family: Arial, sans-serif;
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }
</style>

<?php 
 if (isset($_SESSION['users'])) {
    // Retrieve the user name from the database
    $user = $_SESSION['users']['id'];
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->execute([$user]);
    $username = $stmt->fetchColumn(); 

    echo '<div class="welcome-message">Welcome Back, '.$username.'</div>';
 }
 else {
  echo '<div class="welcome-message">ECDSWC</div>';

 }
?>

  
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <?php 

          if (!isset($_SESSION['users'])) {
            // If user is not logged in, show login button
            echo '<li class="nav-item">';
            echo ' <div class="text-center mt-0">';
            echo '<a class="btn btn-primary" href="login.php">Log In</a>';
            echo '</div>';
            echo '</li>';
          } else {
            // If user is logged in, show dashboard button
            echo '<li class="nav-item">';
            echo ' <div class="text-center mt-0">';
            echo '<a class="btn btn-primary" href="office/dashboard.php">Dashboard</a>';
            echo '<a class="btn btn-danger" href="office/logout.php">Logout</a>';

            echo '</div>';
            echo '</li>';
          }
          



          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get date and time from form data
            $search_date = isset($_POST['search_date']) ? $_POST['search_date'] : '';
            $search_time = isset($_POST['search_time']) ? $_POST['search_time'] : '';
            $search_date = date('Y-m-d', strtotime($search_date));

            
            // Validate start time
            $errors = [];
            // if (empty($start_time)) {
            //   $errors[] = 'Start time is required';
            // }
            
            // If there are no errors, search the room_reservation and rooms tables in the database
            if (empty($errors)) {
              try {
                $stmt = $pdo->prepare("SELECT room_reservation.*, rooms.name, rooms.capacity, rooms.description, rooms.status 
                FROM room_reservation 
                INNER JOIN rooms ON room_reservation.room_id = rooms.id 
                WHERE room_reservation.start_date = :search_date 
                AND ((room_reservation.start_time >= :search_start_time AND room_reservation.start_time < ADDTIME(:search_start_time, '01:00:00'))
                OR (room_reservation.start_time <= :search_start_time AND room_reservation.end_time >= ADDTIME(:search_start_time, '01:00:00')))");
          $stmt->execute([
            'search_date' => $search_date,
            'search_start_time' => $search_time
          ]);
          $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
              } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
              }
            }
          }
          ?>

        </ul>
        <form class="form-inline ml-auto" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST">
  <div class="form-group row">
    <div class="col-6">
    <input class="form-control" type="date" id="search_date" name="search_date">
    </div>
    <div class="col-4 ml-3">
    <?php if (!empty($errors)): ?>
    <div class="text-danger">
      <?php echo $errors[0]; ?>
    </div>
  <?php endif; ?>
  <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </div>

</form>

    </div>
</nav>

<!-- <div class="mt-4 mb-4"></div> --><br><br><br><br><br>  

<div class="container-fluid">
  <div class="mt-4"></div>
  <div class="row">
    <?php

    // Check if the search form has been submitted
// Check if the search form has been submitted and the search date is not empty
// Check if the search form has been submitted and the search date is not empty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['search_date'])) {
  $search_date = $_POST['search_date'];

  // Fetch room reservation information from the database based on the selected date and time
  $stmt = $pdo->prepare("SELECT room_reservation.*, rooms.name, rooms.capacity, rooms.description, rooms.status 
                          FROM room_reservation 
                          INNER JOIN rooms ON room_reservation.room_id = rooms.id 
                          WHERE room_reservation.start_date = :search_date");
  $stmt->execute(['search_date' => $search_date]);
  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // If there are no room reservations for the selected date, fetch all available room information from the database
  if (empty($rooms)) {
    $stmt = $pdo->prepare("SELECT * FROM rooms WHERE status = 'available'");
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
} else {
  // Fetch all available room information from the database
  $stmt = $pdo->prepare("SELECT * FROM rooms WHERE status = 'available' OR status = 'unavailable'");
  $stmt->execute();
  $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 foreach($rooms as $room):
 ?>
  <div class="col-md-4">
    <div class="card gcard">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title"><?php echo $room['name']; ?></h5>
        <h6 class="card-text"><?php echo'Capacity: '. $room['capacity']; ?></h6>
        <h6 class="card-text"><?php echo'Location: '.  $room['description']; ?></h6>
        <?php if (isset($search_date) && $room['status'] !== 'available'): ?>
    <h6 class="card-text"><?php echo' From: '.  $room['start_time']; ?></h6>
    <h6 class="card-text"><?php echo'To: '.  $room['end_time']; ?></h6>
<?php endif; ?>

        <?php switch($room['status']):
          case 'available': ?>
            <h6 class="card-text"><span class="badge bg-success"><?php echo 'Status: '. $room['status']; ?></span></h6>
            <?php if ($room['status'] === 'available'): ?>
              <div class="mt-auto">
                <a href="login.php?room_id=<?php echo $room['id']; ?>" class="btn btn-primary card-link">Reserve This Room</a>
              </div>
              <div class="mt-auto">
                <a href="reservation-history.php?room_id=<?php echo $room['id']; ?>" class="btn btn-primary card-link">Reservation History</a>
              </div>
            <?php endif; ?>
            <?php break;
          case 'unavailable': ?>
            <h6 class="card-text"><span class="badge bg-danger"><?php echo 'Status: '. $room['status']; ?></span></h6>
            <?php if ($room['status'] === 'unavailable'): ?>
              <div class="mt-auto">
                <a href="reservation-history.php?room_id=<?php echo $room['id']; ?>" class="btn btn-primary card-link">Reservation History</a>
              </div>
            <?php endif; ?>
            <?php break;
          default: ?>
            <h3 class="card-text"><?php echo 'Status: '. $room['status']; ?></h3>
            <?php break;
        endswitch; ?>

      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
</div>











<!-- <section class="page-contain">
  <a href="#" class="data-card">
    <h3>270</h3>
    <h4>Care Facilities</h4>
    <p>Aenean lacinia bibendum nulla sed consectetur.</p>
    <span class="link-text">
      View All Providers
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
</svg>
    </span>
  </a>
  <a href="#" class="data-card">
    <h3>270</h3>
    <h4>Care Facilities</h4>
    <p>Aenean lacinia bibendum nulla sed consectetur.</p>
    <span class="link-text">
      View All Providers
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
</svg>
    </span>
  </a>
  
  <a href="#" class="data-card">
    <h3>12,000</h3>
    <h4>Employees</h4>
    <p>Etiam porta sem malesuada.</p>
    <span class="link-text">
      View Information
      <svg width="25" height="16" viewBox="0 0 25 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.8631 0.929124L24.2271 7.29308C24.6176 7.68361 24.6176 8.31677 24.2271 8.7073L17.8631 15.0713C17.4726 15.4618 16.8394 15.4618 16.4489 15.0713C16.0584 14.6807 16.0584 14.0476 16.4489 13.657L21.1058 9.00019H0.47998V7.00019H21.1058L16.4489 2.34334C16.0584 1.95281 16.0584 1.31965 16.4489 0.929124C16.8394 0.538599 17.4726 0.538599 17.8631 0.929124Z" fill="#753BBD"/>
</svg>
    </span>
  </a>
</section>





 -->

    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!--app js-->
    <script src="../assets/js/jquery.app.js"></script>

    <script src="js/custom.js"></script>
</body>
</html>