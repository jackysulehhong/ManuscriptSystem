<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="./shared/css/bootstrap.min.css" rel="stylesheet">
 <link href="./shared/Datatables/dataTables.min.css" rel="stylesheet">
 <script src="./shared/script/jquery-3.5.1.js"></script>
 <style>
 .navbar.navbar-inverse {
  border: none;
 }

 .navbar .navbar-brand {
  padding-top: 0px;
 }

 .navbar .navbar-brand img {
  height: 50px;
 }
 </style>
</head>

<body>
 <nav class="navbar navbar-expand-md navbar-light bg-light" aria-label="Fourth navbar example">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">
    <img src="./assets/logo.png" class="rounded-circle">
   </a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
    aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
     <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#">JACYTECH</a>
     </li>
    </ul>
    <ul class="navbar-nav mb-2 mb-md-0">
     <?php
          if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {

            echo '
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"> <img
        src="./assets/avatar_placeholder.jpg" alt="mdo" width="32" height="32" class="rounded-circle"></a>
      <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdown04">
       <li><a class="dropdown-item" href="#">Action</a></li>
       <li><a class="dropdown-item" href="#">Another action</a></li>
       <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
     </li>
     ';
          } else {
            echo '
       <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="login.php">Login</a>
          </li>
     ';
          }
          ?>
    </ul>
   </div>
  </div>
 </nav>
 <!-- 
  https://dev.to/codeply/bootstrap-5-sidebar-examples-38pb
 -->
 <div class="container-fluid">
  <div class="row flex-nowrap">
   <?php
      //if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
      //if login
      if (true) {
      ?>
   <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light border border-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
     <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
      <li class="nav-item">
       <a href="#" class="nav-link px-0 align-middle">
        <i class="fas fa-home"></i><span class="ms-1 d-none d-sm-inline ">Home</span>
       </a>
      </li>

      <li>
       <a href="#" class="nav-link px-0 align-middle">
        <i class="fas fa-id-card"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
      </li>
      <?php
              //editor
              if (true) {
              ?>
      <li class="nav-item">
       <a href="#" class="nav-link align-middle px-0">
        <i class="far fa-star"></i>
        <span class="ms-1 d-none d-sm-inline">Manuscript Pending</span>
       </a>
      </li>

      <li class="nav-item">
       <a href="assignTask.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i>
        <span class="ms-1 d-none d-sm-inline">Assign Task Page</span>
       </a>
      </li>

      <li class="nav-item">
       <a href="manuscriptStatus.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i>
        <span class="ms-1 d-none d-sm-inline">Manuscript Status</span>
       </a>
      </li>

      <li class="nav-item">
       <a href="#" class="nav-link align-middle px-0">
        <i class="far fa-star"></i>
        <span class="ms-1 d-none d-sm-inline">Publication Status</span>
       </a>
      </li>

      <?php
                //reviewer  
              } else if (false) {
              ?>
      <li class="nav-item">
       <a href="pendingReviewList.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Pending List</span>
       </a>
      </li>

      <li class="nav-item">
       <a href="pendingReviewList.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Review List</span>
       </a>
      </li>
      <?php
                //author  
              } else if (false) {
              ?>
      <li class="nav-item">
       <a href="manscriptSubmission.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Manuscript Submission</span>
       </a>
      </li>

      <li class="nav-item">
       <a href="manuscriptStatus.php" class="nav-link align-middle px-0">
        <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Manuscript Status</span>
       </a>
      </li>
      <?php }
              ?>

      <!--    <li>
       <a href="#" class="nav-link px-0 align-middle"></a>
       <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
      </li>
              -->


      <!--
            <li>
              <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard<i class="fas fa-caret-down"></i></span> </a>
              <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                <li class="w-100">
                  <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1 </a>
                </li>
                <li>
                  <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                </li>
              </ul>
            </li>
-->


     </ul>
    </div>
   </div>
   <?php }
      ?>
   <div class="col py-3">
    Content area...
   </div>
  </div>
 </div>
 <?php
  include("shared/layout/script.php");
  include("shared/layout/footer.php");