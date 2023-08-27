<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
        <!-- Theme icon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico" />

<!-- <link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet" /> -->
<!-- Theme Css -->
<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />

<link href="../assets/css/style.css" rel="stylesheet" />
</head>
<body> 
<div class="container-fluid">
  <div class="mt-4"></div>
  <div class="row">
    <?php
    require_once "../config/config.php";
      // Fetch room information from the database
      $stmt = $pdo->prepare("SELECT * FROM rooms");
      $stmt->execute();
      $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($rooms as $room){
    ?>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $room['name']; ?></h5>
        <h6 class="card-text"><?php echo'Capacity: '. $room['capacity']; ?></h6>
        <?php switch($room['status']){
          case 'available': ?>
            <h6 class="card-text"><span class="badge bg-success"><?php echo 'Status: '. $room['status']; ?></span></h6>
            <?php break;
          case 'unavailable': ?>
            <h6 class="card-text"><span class="badge bg-danger"><?php echo 'Status: '. $room['status']; ?></span></h6>
            <?php break;
          default: ?>
            <h3 class="card-text"><?php echo 'Status: '. $room['status']; ?></h3>
            <?php break;
        } ?>
        <h6 class="card-text"><?php echo'Location: '.  $room['description']; ?></h6>

        <a href="reservation-history.php?room_id=<?php echo $room['id']; ?>" class="btn btn-primary card-link">Reservation History</a>
      </div>
    </div>
  </div>
<?php
}
?>
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