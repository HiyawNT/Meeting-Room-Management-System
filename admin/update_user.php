<?php
session_start();
// Include config file
require_once "../config/config.php";


// Check if the user is logged in as an admin
if (!isset($_SESSION['admin'])) {
    // Redirect to the login page
    header('Location: ../login.php');
    exit();
}

// // Define variables and initialize with empty values
// $username = $email = $department = "";
// $username_err = $email_err = $department_err = "";

// // Processing form data when form is submitted
// if(isset($_POST["id"]) && !empty($_POST["id"])){
//     // Get hidden input value
//     $id = $_POST["id"];

//     // Validate username
//     $input_username = trim($_POST["username"]);
//     if(empty($input_username)){
//         $username_err = "Please enter a username.";
//     } else{
//         $username = $input_username;
//     }

//     // Validate email
//     $input_email = trim($_POST["email"]);
//     if(empty($input_email)){
//         $email_err = "Please enter an email address.";     
//     } else{
//         $email = $input_email;
//     }
    
//     // Validate department
//     $input_department = trim($_POST["department"]);
//     if(empty($input_department)){
//         $department_err = "Please enter the department.";     
//     } else{
//         $department = $input_department;
//     }

//     // Check input errors before inserting in database
//     if(empty($username_err) && empty($email_err) && empty($department_err)){
//         // Prepare an update statement
//         $sql = "UPDATE users SET username=?, email=?, department=? WHERE id=?";
         
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_email, $param_department, $param_id);
            
//             // Set parameters
//             $param_username = $username;
//             $param_email = $email;
//             $param_department = $department;
//             $param_id = $id;
            
//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 // Records updated successfully. Redirect to landing page
//                 header("location: users.php");
//                 exit();
//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }
         
//         // Close statement
//         mysqli_stmt_close($stmt);
//     }
    
//     // Close connection
//     mysqli_close($link);
//     // Check existence of id parameter before processing further
//     if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
//         // Get URL parameter
//         $id = trim($_GET["id"]);

//         // Prepare a select statement
//         $sql = "SELECT * FROM users WHERE id = ?";
//         if($stmt = mysqli_prepare($link, $sql)){
//             // Bind variables to the prepared statement as parameters
//             mysqli_stmt_bind_param($stmt, "i", $param_id);

//             // Set parameters
//             $param_id = $id;

//             // Attempt to execute the prepared statement
//             if(mysqli_stmt_execute($stmt)){
//                 $result = mysqli_stmt_get_result($stmt);

//                 if(mysqli_num_rows($result) == 1){
//                     /* Fetch result row as an associative array. Since the result set
//                     contains only one row, we don't need to use while loop */
//                     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

//                     // Retrieve individual field value
//                     $username = $row["username"];
//                     $email = $row["email"];
//                     $department = $row["department"];
//                 } else{
//                     // URL doesn't contain valid id. Redirect to error page
//                     header("location: error.php");
//                     exit();
//                 }

//             } else{
//                 echo "Oops! Something went wrong. Please try again later.";
//             }
//         }

//         // Close
//         // Retrieve user information from database
// try {
//   $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
//   $stmt->bindParam(":id", $id, PDO::PARAM_INT);
//   $stmt->execute();
//   $user = $stmt->fetch(PDO::FETCH_ASSOC);
//   } catch (PDOException $e) {
//   echo "Error: " . $e->getMessage();
//   }
// }
// }

// Check if user ID is specified in the URL

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

    <link href="../assets/plugins/morris-chart/morris.css"  rel="stylesheet" />
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
            <a href="dashboard.php">
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
                          <div class="user-img" >
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
            <h4 class="mt-2 mb-2">Edit Users</h4>
          </div>

<!-- HTML form for editing a user -->
<div class="card-body">
    
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    
    <?php if (isset($errors) && count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php 
            // Check if the user ID is set and is numeric
if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Check if the form was submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $department = trim($_POST["department"]);
        $password = trim($_POST["password"]);

        // Validate the form data
        $username_err = $email_err = $department_err = $password_err = "";
        if(empty($username)) {
            $username_err = "Please enter a username.";
        }
        if(empty($email)) {
            $email_err = "Please enter an email.";
        } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Please enter a valid email.";
        }
        if(empty($department)) {
            $department_err = "Please enter a department.";
        }
        if(!empty($password) && strlen($password) < 6) {
            $password_err = "Password must be at least 6 characters.";
        }

        // Check if there are any errors
        if(empty($username_err) && empty($email_err) && empty($department_err) && empty($password_err)) {
            // Check if the password is being updated
            if(!empty($password)) {
                $passwordHash = password_hash($password, PASSWORD_BCRYPT, array("cost" => 12));
                $sql = "ALTER TABLE users MODIFY password VARCHAR(255) NOT NULL";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                // Update the user data in the database with the new password hash
                $sql = "UPDATE users SET username = :username, email = :email, department = :department, password = :passwordHash WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":passwordHash", $passwordHash, PDO::PARAM_STR);
            } else {
                // Update the user data in the database without changing the password
                $sql = "UPDATE users SET username = :username, email = :email, department = :department WHERE id = :id";
                $stmt = $pdo->prepare($sql);
            }

            // Bind the parameters
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":department", $department, PDO::PARAM_STR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            // Attempt to execute the statement
            if($stmt->execute()) {
                // Redirect to the users page
                header("location: users.php");
                exit;
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    } else {
        // Retrieve the user data from the database
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$user){
                // User not found
                header("Location: users.php?error=user_not_found");
                exit();
            }
        } else {
            // Error executing query
            header("Location: users.php?error=database_error");
            exit();
        }
    }
}
            
            ?>

            <input type="hidden" name="id">
            <div>
            <label for="username">Username: <sup>*</sup></label>
            <input type="text" name="username" id="username" class="form-control" >
        </div>
        <div>
            <label for="email">Email: <sup>*</sup></label>
            <input type="email" name="email" id="email" class="form-control" >
        </div>
        <div>
            <label for="department">Department: <sup>*</sup></label>
            <input type="text" name="department" id="department" class="form-control" >
        </div>
        <div>
            <label for="password">Password: <sup>*</sup></label>
            <input type="password" name="password" id="password" class="form-control" >
        </div>
        <div>
            <input type="submit" value="submit" class="btn btn-primary">
        </div>
    </form>
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




    <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

    <!--app js-->
    <script src="../assets/js/jquery.app.js"></script>

    <script src="js/custom.js"></script>
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
         <!-- SweetAlert JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.5/dist/sweetalert2.all.min.js"></script>
    <script>
        // Submit form with confirmation
        document.querySelector("form").addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent the form from submitting

            Swal.fire({
                title: "Are you sure?",
                text: "You are about to update this user's information.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // Submit the form if the user confirmed
                }
            });
        });
    </script>

</body>
</html>
