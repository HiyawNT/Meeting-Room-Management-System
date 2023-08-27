<?php
session_start();

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
              <span class="brand-name">Dashboard</span>
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
            <h4 class="mt-2 mb-2">Dashboard</h4>
          </div>
          <div class="row">                  
                    
                    <div class="col-lg-3 col-sm-6 bg-gradient">
                  
                        <div class="widget-box bg-grad-1 m-b-30">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class=""><i class="fa fa-building "></i></div>
                                </div>
                                
                                <div class="col-4 align-items-center">
                                    <p class="m-0 text-white text-center">List of Rooms</p>
                                </div>                                    
                                <div class="col-4 align-self-end">
                                <?php
                                    $stmt = $pdo->query("SELECT COUNT(*) FROM rooms");
                                    $room_count = $stmt->fetchColumn();
                                    ?>
                                    <h2 class="m-0 counter text-right"><?php echo $room_count; ?></h2>                                         
                                </div>
                            </div>
                       </div> 
                    </div>
                    <div class="col-lg-3 col-sm-6 bg-gradient">
                       <div class="widget-box bg-grad-2 m-b-30">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class=""><i class="fa fa-users"></i></div>
                                </div>
                                <div class="col-4 align-items-center">
                                    <p class="m-0 text-white text-center">Number of Users</p>
                                </div>                                    
                                <div class="col-4 align-self-end">
                                      <?php
                                          $stmt = $pdo->query("SELECT COUNT(*) FROM users");
                                          $users_count = $stmt->fetchColumn();
                                      ?>
                                    <h2 class="m-0 counter text-right"><?php echo $users_count; ?></h2>                                         
                                </div>
                            </div>
                       </div> 
                    </div>
                    <div class="col-lg-3 col-sm-6 bg-gradient">
                       <div class="widget-box bg-grad-3 m-b-30">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class=""><i class="fa fa-spin fa fa-spinner"></i></div>
                                </div>
                                <div class="col-4 align-items-center">
                                    <p class="m-0 text-white text-center">Request Pending</p>
                                </div>                                    
                                <div class="col-4 align-self-end">
                                <?php
                                  $stmt = $pdo->query("SELECT COUNT(*) FROM room_reservation WHERE status='pending'");
                                  $pending_count = $stmt->fetchColumn();
                                  ?>
                                    <h2 class="m-0 counter text-right"><?php echo $pending_count; ?></h2>                                         
                                </div>
                            </div>
                       </div> 
                    </div>
                    <div class="col-lg-3 col-sm-6 bg-gradient">
                        <div class="widget-box bg-grad-2 m-b-30 ">
                            <div class="row d-flex align-items-center">
                                <div class="col-4">
                                    <div class=""><i class="fa  fa-check-square-o"></i></div>
                                </div>
                                <div class="col-4 align-items-center">
                                   <p class="m-0 text-white text-center">Request Approved</p> 
                                </div>                                    
                                <div class="col-4 align-self-end">
                                <?php
                                    $stmt = $pdo->query("SELECT COUNT(*) FROM room_reservation WHERE status='approved'");
                                    $approved_count = $stmt->fetchColumn();
                                    ?>
                                    <h2 class="m-0 counter text-right"><?php echo $approved_count; ?></h2></h2>
                                </div>
                            </div>
                       </div> 
                    </div>
                   
                </div><!--end row-->
          <!--end row-->
        
          <!-- <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30">
                  <div class="card-body table-responsive">
                    <h5 class="header-title">Reservation Log</h5>
                    <p class="text-muted">
                      DataTables has most features enabled by default, so all
                      you need to do to use it with your own ables is to call
                      the construction function:
                      <code>$().DataTable();</code> and border bottom.
                    </p>
                    <div class="">
                      <table id="datatable2" class="table">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                          </tr>
                          <tr>
                            <td>Garrett Winters</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>63</td>
                            <td>2011/07/25</td>
                            <td>$170,750</td>
                          </tr>
                          <tr>
                            <td>Ashton Cox</td>
                            <td>Junior Technical Author</td>
                            <td>San Francisco</td>
                            <td>66</td>
                            <td>2009/01/12</td>
                            <td>$86,000</td>
                          </tr>
                          <tr>
                            <td>Cedric Kelly</td>
                            <td>Senior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2012/03/29</td>
                            <td>$433,060</td>
                          </tr>
                          <tr>
                            <td>Airi Satou</td>
                            <td>Accountant</td>
                            <td>Tokyo</td>
                            <td>33</td>
                            <td>2008/11/28</td>
                            <td>$162,700</td>
                          </tr>
                          <tr>
                            <td>Brielle Williamson</td>
                            <td>Integration Specialist</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2012/12/02</td>
                            <td>$372,000</td>
                          </tr>
                          <tr>
                            <td>Herrod Chandler</td>
                            <td>Sales Assistant</td>
                            <td>San Francisco</td>
                            <td>59</td>
                            <td>2012/08/06</td>
                            <td>$137,500</td>
                          </tr>
                          <tr>
                            <td>Rhona Davidson</td>
                            <td>Integration Specialist</td>
                            <td>Tokyo</td>
                            <td>55</td>
                            <td>2010/10/14</td>
                            <td>$327,900</td>
                          </tr>
                          <tr>
                            <td>Colleen Hurst</td>
                            <td>Javascript Developer</td>
                            <td>San Francisco</td>
                            <td>39</td>
                            <td>2009/09/15</td>
                            <td>$205,500</td>
                          </tr>
                          <tr>
                            <td>Sonya Frost</td>
                            <td>Software Engineer</td>
                            <td>Edinburgh</td>
                            <td>23</td>
                            <td>2008/12/13</td>
                            <td>$103,600</td>
                          </tr>
                          <tr>
                            <td>Jena Gaines</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>30</td>
                            <td>2008/12/19</td>
                            <td>$90,560</td>
                          </tr>
                          <tr>
                            <td>Quinn Flynn</td>
                            <td>Support Lead</td>
                            <td>Edinburgh</td>
                            <td>22</td>
                            <td>2013/03/03</td>
                            <td>$342,000</td>
                          </tr>
                          <tr>
                            <td>Charde Marshall</td>
                            <td>Regional Director</td>
                            <td>San Francisco</td>
                            <td>36</td>
                            <td>2008/10/16</td>
                            <td>$470,600</td>
                          </tr>
                          <tr>
                            <td>Haley Kennedy</td>
                            <td>Senior Marketing Designer</td>
                            <td>London</td>
                            <td>43</td>
                            <td>2012/12/18</td>
                            <td>$313,500</td>
                          </tr>
                          <tr>
                            <td>Tatyana Fitzpatrick</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>19</td>
                            <td>2010/03/17</td>
                            <td>$385,750</td>
                          </tr>
                          <tr>
                            <td>Michael Silva</td>
                            <td>Marketing Designer</td>
                            <td>London</td>
                            <td>66</td>
                            <td>2012/11/27</td>
                            <td>$198,500</td>
                          </tr>
                          <tr>
                            <td>Paul Byrd</td>
                            <td>Chief Financial Officer (CFO)</td>
                            <td>New York</td>
                            <td>64</td>
                            <td>2010/06/09</td>
                            <td>$725,000</td>
                          </tr>
                          <tr>
                            <td>Gloria Little</td>
                            <td>Systems Administrator</td>
                            <td>New York</td>
                            <td>59</td>
                            <td>2009/04/10</td>
                            <td>$237,500</td>
                          </tr>
                          <tr>
                            <td>Bradley Greer</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>41</td>
                            <td>2012/10/13</td>
                            <td>$132,000</td>
                          </tr>
                          <tr>
                            <td>Dai Rios</td>
                            <td>Personnel Lead</td>
                            <td>Edinburgh</td>
                            <td>35</td>
                            <td>2012/09/26</td>
                            <td>$217,500</td>
                          </tr>
                          <tr>
                            <td>Jenette Caldwell</td>
                            <td>Development Lead</td>
                            <td>New York</td>
                            <td>30</td>
                            <td>2011/09/03</td>
                            <td>$345,000</td>
                          </tr>
                          <tr>
                            <td>Yuri Berry</td>
                            <td>Chief Marketing Officer (CMO)</td>
                            <td>New York</td>
                            <td>40</td>
                            <td>2009/06/25</td>
                            <td>$675,000</td>
                          </tr>
                          <tr>
                            <td>Caesar Vance</td>
                            <td>Pre-Sales Support</td>
                            <td>New York</td>
                            <td>21</td>
                            <td>2011/12/12</td>
                            <td>$106,450</td>
                          </tr>
                          <tr>
                            <td>Doris Wilder</td>
                            <td>Sales Assistant</td>
                            <td>Sidney</td>
                            <td>23</td>
                            <td>2010/09/20</td>
                            <td>$85,600</td>
                          </tr>
                          <tr>
                            <td>Angelica Ramos</td>
                            <td>Chief Executive Officer (CEO)</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2009/10/09</td>
                            <td>$1,200,000</td>
                          </tr>
                          <tr>
                            <td>Gavin Joyce</td>
                            <td>Developer</td>
                            <td>Edinburgh</td>
                            <td>42</td>
                            <td>2010/12/22</td>
                            <td>$92,575</td>
                          </tr>
                          <tr>
                            <td>Jennifer Chang</td>
                            <td>Regional Director</td>
                            <td>Singapore</td>
                            <td>28</td>
                            <td>2010/11/14</td>
                            <td>$357,650</td>
                          </tr>
                          <tr>
                            <td>Brenden Wagner</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>28</td>
                            <td>2011/06/07</td>
                            <td>$206,850</td>
                          </tr>
                          <tr>
                            <td>Fiona Green</td>
                            <td>Chief Operating Officer (COO)</td>
                            <td>San Francisco</td>
                            <td>48</td>
                            <td>2010/03/11</td>
                            <td>$850,000</td>
                          </tr>
                          <tr>
                            <td>Shou Itou</td>
                            <td>Regional Marketing</td>
                            <td>Tokyo</td>
                            <td>20</td>
                            <td>2011/08/14</td>
                            <td>$163,000</td>
                          </tr>
                          <tr>
                            <td>Michelle House</td>
                            <td>Integration Specialist</td>
                            <td>Sidney</td>
                            <td>37</td>
                            <td>2011/06/02</td>
                            <td>$95,400</td>
                          </tr>
                          <tr>
                            <td>Suki Burks</td>
                            <td>Developer</td>
                            <td>London</td>
                            <td>53</td>
                            <td>2009/10/22</td>
                            <td>$114,500</td>
                          </tr>
                          <tr>
                            <td>Prescott Bartlett</td>
                            <td>Technical Author</td>
                            <td>London</td>
                            <td>27</td>
                            <td>2011/05/07</td>
                            <td>$145,000</td>
                          </tr>
                          <tr>
                            <td>Gavin Cortez</td>
                            <td>Team Leader</td>
                            <td>San Francisco</td>
                            <td>22</td>
                            <td>2008/10/26</td>
                            <td>$235,500</td>
                          </tr>
                          <tr>
                            <td>Martena Mccray</td>
                            <td>Post-Sales support</td>
                            <td>Edinburgh</td>
                            <td>46</td>
                            <td>2011/03/09</td>
                            <td>$324,050</td>
                          </tr>
                          <tr>
                            <td>Unity Butler</td>
                            <td>Marketing Designer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/12/09</td>
                            <td>$85,675</td>
                          </tr>
                          <tr>
                            <td>Howard Hatfield</td>
                            <td>Office Manager</td>
                            <td>San Francisco</td>
                            <td>51</td>
                            <td>2008/12/16</td>
                            <td>$164,500</td>
                          </tr>
                          <tr>
                            <td>Hope Fuentes</td>
                            <td>Secretary</td>
                            <td>San Francisco</td>
                            <td>41</td>
                            <td>2010/02/12</td>
                            <td>$109,850</td>
                          </tr>
                          <tr>
                            <td>Vivian Harrell</td>
                            <td>Financial Controller</td>
                            <td>San Francisco</td>
                            <td>62</td>
                            <td>2009/02/14</td>
                            <td>$452,500</td>
                          </tr>
                          <tr>
                            <td>Timothy Mooney</td>
                            <td>Office Manager</td>
                            <td>London</td>
                            <td>37</td>
                            <td>2008/12/11</td>
                            <td>$136,200</td>
                          </tr>
                          <tr>
                            <td>Jackson Bradshaw</td>
                            <td>Director</td>
                            <td>New York</td>
                            <td>65</td>
                            <td>2008/09/26</td>
                            <td>$645,750</td>
                          </tr>
                          <tr>
                            <td>Olivia Liang</td>
                            <td>Support Engineer</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2011/02/03</td>
                            <td>$234,500</td>
                          </tr>
                          <tr>
                            <td>Bruno Nash</td>
                            <td>Software Engineer</td>
                            <td>London</td>
                            <td>38</td>
                            <td>2011/05/03</td>
                            <td>$163,500</td>
                          </tr>
                          <tr>
                            <td>Sakura Yamamoto</td>
                            <td>Support Engineer</td>
                            <td>Tokyo</td>
                            <td>37</td>
                            <td>2009/08/19</td>
                            <td>$139,575</td>
                          </tr>
                          <tr>
                            <td>Thor Walton</td>
                            <td>Developer</td>
                            <td>New York</td>
                            <td>61</td>
                            <td>2013/08/11</td>
                            <td>$98,540</td>
                          </tr>
                          <tr>
                            <td>Finn Camacho</td>
                            <td>Support Engineer</td>
                            <td>San Francisco</td>
                            <td>47</td>
                            <td>2009/07/07</td>
                            <td>$87,500</td>
                          </tr>
                          <tr>
                            <td>Serge Baldwin</td>
                            <td>Data Coordinator</td>
                            <td>Singapore</td>
                            <td>64</td>
                            <td>2012/04/09</td>
                            <td>$138,575</td>
                          </tr>
                          <tr>
                            <td>Zenaida Frank</td>
                            <td>Software Engineer</td>
                            <td>New York</td>
                            <td>63</td>
                            <td>2010/01/04</td>
                            <td>$125,250</td>
                          </tr>
                          <tr>
                            <td>Zorita Serrano</td>
                            <td>Software Engineer</td>
                            <td>San Francisco</td>
                            <td>56</td>
                            <td>2012/06/01</td>
                            <td>$115,000</td>
                          </tr>
                          <tr>
                            <td>Jennifer Acosta</td>
                            <td>Junior Javascript Developer</td>
                            <td>Edinburgh</td>
                            <td>43</td>
                            <td>2013/02/01</td>
                            <td>$75,650</td>
                          </tr>
                          <tr>
                            <td>Cara Stevens</td>
                            <td>Sales Assistant</td>
                            <td>New York</td>
                            <td>46</td>
                            <td>2011/12/06</td>
                            <td>$145,600</td>
                          </tr>
                          <tr>
                            <td>Hermione Butler</td>
                            <td>Regional Director</td>
                            <td>London</td>
                            <td>47</td>
                            <td>2011/03/21</td>
                            <td>$356,250</td>
                          </tr>
                          <tr>
                            <td>Lael Greer</td>
                            <td>Systems Administrator</td>
                            <td>London</td>
                            <td>21</td>
                            <td>2009/02/27</td>
                            <td>$103,500</td>
                          </tr>
                          <tr>
                            <td>Jonas Alexander</td>
                            <td>Developer</td>
                            <td>San Francisco</td>
                            <td>30</td>
                            <td>2010/07/14</td>
                            <td>$86,500</td>
                          </tr>
                          <tr>
                            <td>Shad Decker</td>
                            <td>Regional Director</td>
                            <td>Edinburgh</td>
                            <td>51</td>
                            <td>2008/11/13</td>
                            <td>$183,000</td>
                          </tr>
                          <tr>
                            <td>Michael Bruce</td>
                            <td>Javascript Developer</td>
                            <td>Singapore</td>
                            <td>29</td>
                            <td>2011/06/27</td>
                            <td>$183,000</td>
                          </tr>
                          <tr>
                            <td>Donna Snider</td>
                            <td>Customer Support</td>
                            <td>New York</td>
                            <td>27</td>
                            <td>2011/01/25</td>
                            <td>$112,000</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
        <!--end container-->



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
  </body>
</html>
