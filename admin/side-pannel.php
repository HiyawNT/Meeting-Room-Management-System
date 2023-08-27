<?php
include '../config/config.php';




// Check if the user is logged in as an admin
if (!isset($_SESSION['admin'])) {
  header('Location: ../login.php');
  exit();
}
?>

 
 
 <!-- sidebar left start-->
 <div class="sidebar-left">
        <div class="sidebar-left-info">
          <div class="user-box">
            <div class="d-flex justify-content-center">
              <img
                src="../assets/images/users/admin.svg"
                alt=""
                class="img-fluid rounded-circle"
              />
            </div>
            <?php 
              // Retrieve the admin name from the database
                  $admin = $_SESSION['admin']['id'];
                  $stmt = $pdo->prepare("SELECT username FROM admins WHERE id = ?");
                  $stmt->execute([$admin]);
                  $username = $stmt->fetchColumn(); 



 
           echo '<div class="text-center text-white mt-2">';
           echo '<h3>'.$username.'</h3>';

       
      
      echo '</div>';
         echo  '</div>';


         ?>

          <!--sidebar nav start-->
          <ul class="side-navigation" id="sidebar " >
            <li>
              <h3 class="navigation-title">Navigation</h3>
            </li>
            <li class="is_active()">
              <a href="dashboard.php"
                ><i class="mdi mdi-gauge"></i> <span>Dashboard</span></a
              >
            </li>
            </li>
            <li class="is_active('rooms.php')">
              <a href="rooms.php"
                ><i class="fa fa-building-o"></i> <span>Rooms</span></a
              >
            </li>
            </li>
            <li class="is_active('users.php')">
              <a href="users.php"
                ><i class="fa fa-users"></i> <span>Users</span></a
              >
            </li>
            </li>
            <li class="is_active('history.php')">
              <a href="history.php"
                ><i class="fa fa-history"></i> <span>Logs</span></a
              >
            </li>
            </li>
            <li class="is_active('request.php')">
              <a href="request.php"
                ><i class="mdi mdi-gauge"></i> <span>Request</span></a
              >
            </li>
        
        </div>
      </div>
      <!-- sidebar left end-->
      <script src="js/custom.js"></script>