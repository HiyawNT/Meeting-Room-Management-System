<?php
session_start();
 require_once "../config/config.php";


// Check if the user is logged in as an admin

if (!isset($_SESSION['admin'])) {
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
                    <img src="../assets/images/users/admin-black.svg" alt="" />
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
            <h4 class="mt-2 mb-2">Edit Rooms</h4>
          </div>
          <div class="row">
            <div class="col-lg-12 col-sm-12">
            <div class="row">                  

            <div class="col-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                  <?php 
                                  
                                  if (isset($_GET['id'])) {
                                    $room_id = $_GET['id'];
                                    
                                    // Include database connection
                                  
                                    // Prepare a SELECT statement to retrieve the details of the room with the specified id
                                    $sql = "SELECT * FROM rooms WHERE id = ?";
                                    $stmt = $pdo->prepare($sql);
                                  
                                    // Execute the prepared statement with the id parameter
                                    $stmt->execute([$room_id]);
                                  
                                    // Check if the SELECT statement returned a row
                                    if ($stmt->rowCount() > 0) {
                                        // Fetch the details of the room
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $room_id = $row['id'];
                                        $room_name = $row['name'];
                                        $room_capacity = $row['capacity'];
                                        $room_status = $row['status'];
                                        $room_description = $row['description'];
                                    } else {
                                        // No room was found with the specified id
                                        die("Room not found.");
                                    }
                                  
                                    // Close database connection
                                    $pdo = null;
                                  } else {
                                    // No id parameter was set in the URL
                                    die("No room id specified.");
                                  }
                                  
                                  
                                  
                                  ?>
                                    <!-- <h5 class="header-title pb-3">Basic horizontal xample</h5> -->
                                    <div class="general-label">
                                        <form role="form" method="post" action="../Handlers/edit_rooms_handler.php?id=<?php echo $_GET['id']; ?>">  
                                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                                          
                                            <div class="form-group row">
                                                <label for="Room Name" class="col-2 col-form-label">Room Name </label>
                                                <div class="col-10">
                                                    <input class="form-control" type="text" name="name" id="room_name" value="<?php echo $room_name; ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="Room Capacity" class="col-2 col-form-label">Room Capacity</label>
                                                <div class="col-10">
                                                    <input class="form-control" type="number"  name="capacity" id="room_capacity" value="<?php echo $room_capacity; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="Room Status" class="col-2 col-form-label">Room Status</label>
                                                <div class="col-10">
                                                <select class="select2 form-control mb-3 custom-select" name="status" id="room_status" style="width: 100%; height:36px;" value="<?php echo $room_status; ?>">>
                                        
                                            <option value="available">Available</option>
                                            <option value="unavailable">Unavailable</option>

                                    </select>
                                        </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label for="Discription" class="col-2 col-form-label">Location</label>
                                                <div class="col-10">
                                                <textarea class="form-control" placeholder="Write Description" name="description" id="room_description" style="margin-top: 0px; margin-bottom: 0px; height: 137px;" <?php echo $room_description; ?> ></textarea>
                                                </div>
                                            </div>
                                           
                                            <button type="submit" class="btn btn-primary"  data-toggle="modal" >
                                    Finish Editing
                                    </button>                 
                                        </form>                                    
                                    </div>                            
                                </div>
                            </div>
                        </div>


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
