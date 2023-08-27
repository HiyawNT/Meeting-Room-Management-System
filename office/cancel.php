<?php
session_start();
if (!isset($_SESSION['users'])) {
    // Redirect to login page if user is not logged in
    header('Location: ../login.php');
    exit();
}
require_once '../config/config.php';
// Check if the user is logged in
// if (!isset($_SESSION['users'])) {
//   // Redirect to login page if user is not logged in
//   header('Location: ../login.php');
//   exit();
// }

// Check how the user accessed the page and set $status accordingly
if (isset($_GET['status'])) {
  // If a status was provided in the URL, use that
  $status = $_GET['status'];
} else {
  // Otherwise, default to pending reservations
  $status = 'pending';
}

// Prepare SQL statement to fetch reservations for the specified status
$stmt = $pdo->prepare('SELECT * FROM room_reservation WHERE status = :status');
$stmt->bindParam(':status', $status);

// Execute SQL statement
if ($stmt->execute()) {
  // Fetch reservations
  $reservations = $stmt->fetchAll();
  
  // Check if reservations were found
  if (!$reservations) {
    $error_msg = "No reservations found.";
  }
} else {
  $error_msg = "Failed to fetch reservations. Please try again later.";
}
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
            <form class="search-content" action="index.html" method="post">
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
        <h4 class="mt-2 mb-2">Cancel Reservation</h4>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-body table-responsive">
                            <p class="text-muted"></p>
                            <div class="">
                                <table id="datatable2" class="table">
                                    <thead>
                                        <tr>
                                            <th>Room</th>
                                            <th>Date From</th>
                                            <th>Date To</th>
                                            <th>Duration</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Cancel Reservation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include config file
                                        require_once '../config/config.php';

                                        // Retrieve all reservations from the database
                                        $stmt = $pdo->prepare("SELECT rr.id, r.name AS room_name, rr.start_date, rr.end_date, rr.duration, rr.start_time, rr.end_time, rr.reason, rr.status 
                                                            FROM room_reservation rr 
                                                            INNER JOIN rooms r ON rr.room_id = r.id 
                                                            WHERE rr.user_id = :user_id 
                                                            ORDER BY rr.id DESC");
                                        $stmt->execute(['user_id' => $_SESSION['users']['id']]);
                                        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        // Close database connection
                                        $pdo = null;

                                        if (!empty($reservations)) {
                                            foreach ($reservations as $reservation) {
                                              if ($reservation['status'] == 'cancelled' && $reservation['status'] == 'approved') {
                                                continue; // skip this row
                                            }
                                                echo "<tr>";
                                                echo "<td>" . $reservation['room_name'] . "</td>";
                                                echo "<td>" . $reservation['start_date'] . "</td>";
                                                echo "<td>" . $reservation['end_date'] . "</td>";
                                                echo "<td>" . $reservation['duration'] . ($reservation['duration'] == 1 ? " Day" : " Days") . "</td>";
                                                echo "<td>" . $reservation['start_time'] . "</td>";
                                                echo "<td>" . $reservation['end_time'] . "</td>";
                                                echo "<td>" . $reservation['reason'] . "</td>";
                                                echo "<td>";
                                                switch ($reservation['status']) {
                                                    case 'pending':
                                                        echo '<span class="badge badge-warning">Pending</span>';
                                                        break;
                                                    case 'approved':
                                                        echo '<span class="badge badge-success">Approved</span>';
                                                        break;
                                                    case 'rejected':
                                                        echo '<span class="badge badge-danger">Rejected</span>';
                                                        break;
                                                    default:
                                                        echo $reservation['status'];
                                                        break;
                                                }
                                                echo "</td>";
                                                echo "<td>";
                                                if ($reservation['status'] == 'pending') {
                                                    echo "<a href='cancelReservation.php?id=" . $reservation['id'] . "' class='btn btn-danger'>Cancel</a>";
                                                }
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='7'>No reservations found</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>















  
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
