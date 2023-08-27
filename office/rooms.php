<?php
session_start();
 require_once "../config/config.php";

// Check if the user is logged in as an admin

if (!isset($_SESSION['users'])) {
    // Redirect to the login page
    header('Location: ../login.php');
    exit();
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
            <h4 class="mt-2 mb-2">Rooms</h4>
          </div>
          <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="row">                  
            
            
            
            <?php
// Fetch all rooms from database
$sql = "SELECT * FROM rooms";
$stmt = $pdo->query($sql);

// Check if there are any rooms in the database
if ($stmt->rowCount() > 0) {
    // Loop through each room and display it as a card
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Extract room data from the current row
        $room_id = $row['id'];
        $room_name = $row['name'];
        $room_capacity = $row['capacity'];
        $room_status = $row['status'];
        $room_description = $row['description'];
        
        // Display room as a card
        echo '<div class="col-lg-4 col-sm-12">';
        echo '<div class="card bg-white m-b-30">';
    
        echo '<div class="card-body">';
        echo '<div class="card-title mb-4">';
        echo '<h5>' . $room_name . '</h5>';
        echo '</div>';
        echo ' <p class=card-text>Capacity: '.$room_capacity. '</p>';
        echo '<p class="card-text">' . $room_description . '</p>';
        echo '<a href="reserve.php?id=' . $room_id . '" class="btn btn-primary" role="button">Reserve</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No rooms found in the database.";
}

// Close database connection
$pdo = null;
?>
<!-- Reserve Modal -->
<!-- <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="reserveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="../Handlers/reserve_handler.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="reserveModalLabel">Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="room_id" name="room_id">
                    <div class="form-group">
                        <label for="date_from">Date From:</label>
                        <input type="datetime-local" class="form-control" id="date_from" name="start_date" required>
                    </div>
                    <div class="form-group">
                        <label for="date_to">Date To:</label>
                        <input type="datetime-local" class="form-control" id="date_to" name="end_date" required>
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason:</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reserve</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

<script>
    $('#reserveModal').on('show.bs.modal', function (event) {
        // Get the button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract room ID from the button's data-id attribute
        var room_id = button.data('id');

        // Update the form action to include the room ID
        var form = $('#reserveForm');
        var action = form.attr('action');
        form.attr('action', action + '?id=' + room_id);

        // Update the modal title with the room name
        var room_name = button.data('name');
        var modal = $(this);
        modal.find('.modal-title').text('Reserve ' + room_name);

        // Clear any previous form data
        form.trigger("reset");
        $('.error').hide();
    });

    // Handle form submission
    $('#reserveForm').submit(function (event) {
        event.preventDefault();

        // Get form data
        var form = $(this);
        var data = form.serialize();

        // Submit form data via AJAX
        $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: data,
            dataType: 'json',
            success: function (response) {
                if (response.status == 'success') {
                    // Display success message
                    $('#reserveModal').modal('hide');
                    $('#successModal').modal('show');
                } else if (response.status == 'error') {
                    // Display error message
                    $('.error').html(response.message);
                    $('.error').show();
                }
            },
            error: function () {
                // Display error message
                $('.error').html('An error occurred while processing your request. Please try again later.');
                $('.error').show();
            }
        });
    });
</script>
            



      </div>
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
