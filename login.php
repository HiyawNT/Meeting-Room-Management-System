





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mannat Themes">
        <meta name="keyword" content="">

        <title>Login</title>

        <!-- Theme icon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Theme Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/css/slidebars.min.css" rel="stylesheet">
        <link href="assets/css/icons.css" rel="stylesheet">
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet">
    </head>

    <body class="sticky-header">
        <section class="bg-login">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="wrapper-page">
                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="card m-b-30">
                                        <div class="card-body">
                                            <div class="card-title text-center">
                                            <?php
                                                require_once "./config/config.php";

                                                session_start();
                                                if(isset($_SESSION['users'])){
                                                  // User is logged in, show the room ID
                                                  if(isset($_GET['room_id'])){
                                                    // Get the room ID from the URL parameter
                                                    $room_id = $_GET['room_id'];
                                                    // echo $room_id;
                                                  }
                                                }
                                                ?>

                                  
                                                <h3 class="mt-3"><b>Welcome</b></h3>
                                            </div>  
                                            <form id="login-form" class="form mt-5 contact-form"  method="post" >
                                            <div class="form-group">
                                                <label for="user-type">Select user type:</label>
                                                <select class="form-control" id="user-type" name="user-type">
                                                <option value="user">User</option>
                                                <option value="admin">Admin</option>
                                            </select>   
                                        </div>
                     
                                                        
    
                                            <div class="form-group ">
                                                    <div class="col-sm-12">
                                                        <input class="form-control form-control-line" type="text" name="username" placeholder="Username" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="col-sm-12">
                                                        <input class="form-control form-control-line" type="password" name="password" placeholder="Password" required="required">
                                                    </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                    <div class="col-sm-12 mt-4">
                                                        <button class="btn btn-primary btn-block" type="submit">Log In</button>
                                                    </div>
                                                </div>



                                                
                                            </form>
    <!-- ROUTER FOR THE USER/ADMIN -->

    <script>
  // Get the form element
  const form = document.querySelector('#login-form');

  // Listen for form submission
  form.addEventListener('submit', (event) => {
    event.preventDefault(); // Prevent form submission

    // Get the user type value
    const userType = document.querySelector('#user-type').value;

    // Set the form action based on the user type value and room_id URL parameter
    if (userType === 'user') {
      let url = './Handlers/user_login_handler.php';
      const roomId = '<?php echo $_GET["room_id"] ?? ""; ?>'; // Use optional chaining to handle missing parameter
      if (roomId) {
        url += `?room_id=${roomId}`;
      }
      form.action = url;
    } else if (userType === 'admin') {
      form.action = './Handlers/admin_login_handler.php';
    }

    // Submit the form
    form.submit();
  });
</script>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-migrate.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.slimscroll.min.js"></script>
        <script src="assets/js/slidebars.min.js"></script>
        

        <!--app js-->
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>
