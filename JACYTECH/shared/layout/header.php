<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>JACYTECH</title>
 <link href="./shared/css/bootstrap.min.css" rel="stylesheet">
 <link href="./shared/Datatables/dataTables.min.css" rel="stylesheet">
 <script src="./shared/script/jquery-3.5.1.js"></script>

 <style>
  html {
   height: 100%;
  }

  body {
   /**https://stackoverflow.com/questions/2869212/css3-gradient-background-set-on-body-doesnt-stretch-but-instead-repeats
              */
   background: rgb(121, 121, 126);
   background: linear-gradient(180deg, rgba(72, 79, 79, 1) 0%, rgba(255, 255, 255, 1) 100%) fixed;
  }

  .bodyContainer {
   border: 1px solid black;
   border-radius: 25px;
   background: rgba(255, 255, 255, 0.7);
  }

  .roundedPrimaryBtn {
   border-radius: 25px;
   color: white;
   background-color: red;
  }

  .roundedSecondaryBtn {
   border-radius: 25px;
   color: white;
   background-color: blue;
  }

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
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
     <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="profile.php">JACYTECH</a>
     </li>
    </ul>
    <ul class="navbar-nav mb-2 mb-md-0">
     <?php
     if (isset($_SESSION['curUser']) && !empty($_SESSION['curUser'])) {

      echo '
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-bs-toggle="dropdown" aria-expanded="false"> <img
        src="./assets/avatar_placeholder.jpg" alt="mdo" width="32" height="32" class="rounded-circle">&nbsp;' . $_SESSION['curUser']['name'] . '</a>
      <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdown04">
       <li><a class="dropdown-item" href="profile.php">Profile</a></li>
       <li class="dropdown-divider"></li>
       <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
   if (isset($_SESSION['curUser']) && !empty($_SESSION['curUser'])) {
   ?>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light border border-dark">
     <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 min-vh-100">
      <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

       <?php
       //editor
       if ($_SESSION['curUser']['position'] == 'editor') {
       ?>



        <li class="nav-item">
         <a href="listCategory.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-sm-none">Category</span>
          <span class="ms-1 d-none d-sm-inline">Category List</span>
         </a>
        </li>
        <li class="nav-item">
         <a href="listManuscript.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-sm-none">Manuscript</span>
          <span class="ms-1 d-none d-sm-inline">Manuscript List</span>
         </a>
        </li>
        <li class="nav-item">
         <a href="listPublication.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-sm-none">Publication</span>
          <span class="ms-1 d-none d-sm-inline">Publication Status</span>
         </a>
        </li>
        <li class="nav-item">
         <a href="listHardcopy.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-sm-none">Hardcopy</span>
          <span class="ms-1 d-none d-sm-inline">Hardcopy Status</span>
         </a>
        </li>
        <li class="nav-item">
         <a href="listReviewer.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-sm-none">Reviewer</span>
          <span class="ms-1 d-none d-sm-inline">Reviewer List</span>
         </a>
        </li>

       <?php
        //reviewer  
       } else if ($_SESSION['curUser']['position'] == 'reviewer') {
       ?>
        <li class="nav-item">
         <a href="pendingReviewList.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Pending List</span>
         </a>
        </li>

        <li class="nav-item">
         <a href="listReview.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Review List</span>
         </a>
        </li>
       <?php
        //author  
       } else if ($_SESSION['curUser']['position'] == 'author') {
       ?>
        <li class="nav-item">
         <a href="manuscriptSubmission.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Manuscript Submission</span>
         </a>
        </li>

        <li class="nav-item">
         <a href="listManuscript.php" class="nav-link align-middle px-0">
          <i class="far fa-star"></i><span class="ms-1 d-none d-sm-inline">Manuscript List</span>
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
   <div class="col py-3 ">