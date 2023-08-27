<?php
require_once '../vendor/autoload.php';
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\SmtpTransport;
use Symfony\Component\Mime\Email;
// Start a session
session_start();
define('BASEPATH', true);
require "../config/config.php";
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['users'])) {
  // Redirect to login page if user is not logged in
  header('Location: ../login.php');
  exit();
}

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

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate form inputs
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $start_date = date('Y-m-d', strtotime($start_date));
  $end_date = date('Y-m-d', strtotime($end_date));


  $start_time = filter_var($_POST['start_time'], FILTER_SANITIZE_STRING);
  $end_time = filter_var($_POST['end_time'], FILTER_SANITIZE_STRING);



  $start_time = date('H:i:s', strtotime($start_time));
  $end_time = date('H:i:s', strtotime($end_time));



  // Calculate duration
  $datetime1 = new DateTime($start_date);
  $datetime2 = new DateTime($end_date);
  $interval = $datetime1->diff($datetime2);
  $duration = $interval->format('%a');

     // Check if room is already reserved on start or end date
     $sql = "SELECT * FROM room_reservation WHERE room_id = :room_id AND ((start_date <= :start_date AND end_date >= :start_date) OR (start_date <= :end_date AND end_date >= :end_date))";
     $stmt = $pdo->prepare($sql);
     $stmt->execute(['room_id' => $room_id, 'start_date' => $start_date, 'end_date' => $end_date]);
     $result = $stmt->fetch();
 
    
    
    
    
     
     if ($result) {
       // Room is already reserved on start or end date
       echo '<div class="alert alert-danger fixed-bottom" role="alert">The room is already reserved on the selected dates. Please select different dates.</div>';
     } else {
      echo '<div class="alert alert-success fixed-bottom" role="alert">Reservation successfully created.</div>';

       // Insert new reservation into database





  $requested_by = $_SESSION['users']['id'];
  $reason = $_POST['reason'];

  if (empty($room_id) || empty($start_date) || empty($end_date) ||empty($start_time) || empty($end_time) || empty($reason)) {
    $error_msg = "Please fill out all required fields.";
  } else {
    // Prepare SQL statement to insert new reservation into database
    $sql = "INSERT INTO room_reservation (room_id, start_date, end_date, duration,  start_time, end_time, user_id, reason, status)
            VALUES (:room_id, :start_date, :end_date, :duration, :start_time, :end_time, :requested_by, :reason, 'pending')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':room_id', $room_id);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':duration', $duration);

    $stmt->bindParam(':start_time', $start_time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':requested_by', $requested_by);
    $stmt->bindParam(':reason', $reason);

    // Execute SQL statement
    if ($stmt->execute()) {
      $success_msg = "Reservation successfully submitted.";
    } else {
      $error_msg = "Failed to submit reservation. Please try again later.";
    }


          // Update room status to unavailable
          $sql = "UPDATE rooms SET status = 'unavailable' WHERE id = :room_id";
          $stmt = $pdo->prepare($sql);
          $stmt->execute(['room_id' => $room_id]);

    // Close database connection
    $pdo = null;
  }
}
}

// Prepare SQL statement to fetch room details
$stmt = $pdo->prepare('SELECT * FROM rooms WHERE id = :room_id');
$stmt->bindParam(':room_id', $room_id);

// Execute SQL statement
if ($stmt->execute()) {
  // Fetch room details
  $room = $stmt->fetch();
  
  // Check if room was found
  if (!$room) {
    $error_msg = "Room not found.";
  }
} else {
  header("Location: ../office/history.php");
  $error_msg = "Failed to fetch room details. Please try again later.";
}

// the Email Authentication with the SMTP protocol


// Close database connection
$pdo = null;
?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    />
    <meta name="description" content="" />
    <meta name="author" content="Mannat Themes" />
    <meta name="keyword" content="" />

    <title>MRM</title>

    <!-- Theme icon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />

    <link href="../assets/plugins/morris-chart/morris.css" rel="stylesheet" />
    <link href="../assets/plugins/timepicker/tempusdominus-bootstrap-4.css" rel="stylesheet" />
        <link href="../assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="../assets/plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">


    <!-- Theme Css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/slidebars.min.css" rel="stylesheet" />
    <link href="../assets/css/icons.css" rel="stylesheet" />
    <link href="../assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.css" rel="stylesheet" />
  </head>

  <body class="sticky-header">
    <section>

    <!-- Left side Pannel -->
    
    <?php include('side-pannel.php'); ?>

      <!-- body content start-->
      <div class="body-content">
        <!-- header section start-->
        <div class="header-section">
          <!--logo and logo icon start-->
          <div class="logo">
            <a href="rooms.php">

              <!--<i class="fa fa-maxcdn"></i>-->
              <span class="brand-name">Meeting Rooms</span>
            </a>
          </div>

          <!--toggle button start-->
          <a class="toggle-btn"><i class="ti ti-menu"></i></a>
          <!--toggle button end-->

          <!--mega menu start-->
          <div
            id="navbar-collapse-1"
            class="navbar-collapse collapse mega-menu"
          >
            <ul class="nav navbar-nav">
              <!-- Classic dropdown -->
            
              <!-- Classic list -->
              <li>
                <form class="search-content" action="#" method="post">
                  <input
                    type="text"
                    class="form-control mt-3"
                    name="keyword"
                    placeholder="Search..."
                  />
                  <span class="search-button"
                    ><i class="ti ti-search"></i
                  ></span>
                </form>
              </li>
            </ul>
          </div>
          <!--mega menu end-->

          <div class="notification-wrap">
            <!--right notification start-->
            <div class="right-notification">
              <ul class="notification-menu">
                <li>
                  <a
                    href="javascript:;"
                    class="notification"
                    data-toggle="dropdown"
                  >
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge badge-success">4</span>
                  </a>
                  <ul class="dropdown-menu mailbox dropdown-menu-right">
                    <li>
                      <div class="drop-title">Notifications</div>
                    </li>
                    <li class="notification-scroll">
                      <div class="message-center">
                        <a href="#">
                          <div class="user-img">
                            <i class="ti ti-star"></i>
                          </div>
                          <div class="mail-contnet">
                            <h6>Jane A. Seward</h6>
                            <span class="mail-desc">Iwon meddle and...</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="user-img">
                            <i class="ti ti-heart"></i>
                          </div>
                          <div class="mail-contnet">
                            <h6>Michael W. Salazar</h6>
                            <span class="mail-desc"
                              >Lovely gide learn for you...</span
                            >
                          </div>
                        </a>
                        <a href="#">
                          <div class="user-img">
                            <i class="ti ti-image"></i>
                          </div>
                          <div class="mail-contnet">
                            <h6>David D. Chen</h6>
                            <span class="mail-desc">Send his new photo...</span>
                          </div>
                        </a>
                        <a href="#">
                          <div class="user-img">
                            <i class="ti ti-bell"></i>
                          </div>
                          <div class="mail-contnet">
                            <h6>Irma J. Hendren</h6>
                            <span class="mail-desc"
                              >6:00 pm our meeting so...</span
                            >
                          </div>
                        </a>
                      </div>
                    </li>
                    <li>
                      <a
                        class="text-center bg-light"
                        href="javascript:void(0);"
                      >
                        <strong>See all notifications</strong>
                      </a>
                    </li>
                  </ul>
                </li>

            
                <li>
                <a href="javascript:;" data-toggle="dropdown">
                    <img src="../assets/images/users/user-circle-black.svg" alt="" />
                  </a>
                  <div class="dropdown-menu dropdown-menu-right profile-menu">
                    <a class="dropdown-item" href="#"
                      ><i class="mdi mdi-account-circle m-r-5 text-muted"></i>
                      Profile</a
                    >
                    <a class="dropdown-item" href="#"
                      ><span class="badge badge-success pull-right">5</span
                      ><i class="mdi mdi-settings m-r-5 text-muted"></i>
                      Settings</a
                    >
                    <a class="dropdown-item" href="#"
                      ><i
                        class="mdi mdi-lock-open-outline m-r-5 text-muted"
                      ></i>
                      Lock screen</a
                    >
                    <a class="dropdown-item" href="logout.php"
                      ><i class="mdi mdi-logout m-r-5 text-muted"></i> Logout</a
                    >
                  </div>
                </li>

              </ul>
            </div>
            <!--right notification end-->
          </div>
        </div>
        <!-- header section end-->

        <div class="container-fluid">
          <div class="page-head">
            <h4 class="mt-2 mb-2">Reserve Room</h4>
          </div>
          <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="row">
                        <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <div class="general-label">
                                        <form  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">                                            
                                            <div class="form-group row">
                                                <label for="room id" class="col-2 col-form-label">ID</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="hidden" id="id" name="room_id" value="<?php echo $room_id; ?>">
                                                </div>
                                            </div>
                                            

                                            <!-- <div class="form-group row">
                                                <label for="reserved date" class="col-2 col-form-label">Reserved Date</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="date" id="example-tel-input" placeholder="1234">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="example-number-input" class="col-2 col-form-label">Number</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="number" id="example-number-input" placeholder="1234">
                                                </div>
                                            </div> -->
                                            <div class="form-group row">
                                                <label for="example-date-input" class="col-2 col-form-label">Start-Date</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="date" id="start_date" name="start_date">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="example-date-input" class="col-2 col-form-label">End-Date</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="date" id="start_date" name="end_date">
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label for="date from" class="col-2 col-form-label">Start-Time</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="time" id="start_time" name="start_time">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-datetime-local-input" class="col-2 col-form-label">End-Time</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="time" id="end_time" name="end_time">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="example-month-input" class="col-2 col-form-label">Reason</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="text" id="reason" name="reason">
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary">Reserve</button>
                                            </div>

                                        </form>                                    
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

      <!--end body content-->
    </section>

    <!-- jQuery -->
    <script src="../assets/js/jquery-3.2.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-migrate.js"></script>
    <script src="../assets/js/modernizr.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/slidebars.min.js"></script>

    <!--plugins js-->
    <script src="../assets/plugins/counter/jquery.counterup.min.js"></script>
    <script src="../assets/plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="../assets/pages/jquery.sparkline.init.js"></script>



  <!-- DataPicker  -->
  <script src="../assets/plugins/timepicker/moment.js"></script>
  <script src="../assets/plugins/timepicker/tempusdominus-bootstrap-4.js"></script>

  <script src="../assets/plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
  


    <!--app js-->
    <script src="../assets/js/jquery.app.js"></script>
    <script>
      jQuery(document).ready(function ($) {
        $(".counter").counterUp({
          delay: 100,
          time: 1200,
        });
      });
    </script>
            <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable(),
                $('#datatable2').DataTable();  
            } );
        </script>
  </body>
</html>
