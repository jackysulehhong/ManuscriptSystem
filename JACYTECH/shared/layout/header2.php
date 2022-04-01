<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link href="./shared/css/bootstrap.min.css" rel="stylesheet">
 <link href="./shared/Datatables/datatables.min.css" rel="stylesheet">
 <script src="./shared/script/jquery-3.5.1.js"></script>


 <title>JACYTECH</title>
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
 </style>
</head>

<body>


 <nav class="navbar navbar-expand-md navbar-light bg-light" aria-label="Fourth navbar example">
  <div class="container-fluid">
   <a class="navbar-brand" href="#">Expand at md</a>
   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04"
    aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarsExample04">
    <ul class="navbar-nav me-auto mb-2 mb-md-0">
     <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="#">Home</a>
     </li>
    </ul>
    <ul class="navbar-nav mb-2 mb-md-0">
     <?php
                         if (isset($_SESSION['curUser']) && !empty($_SESSION['curUser'])) {

                              echo '
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="dropdownmenuuser" data-bs-toggle="dropdown" aria-expanded="false"> <img
        src="./assets/avatar_placeholder.jpg" alt="mdo" width="32" height="32" class="rounded-circle" /> ' . $_SESSION['curUser']['name'] . '</a>
      <ul class="dropdown-menu dropdown-menu-end " aria-labelledby="dropdownmenuuser">
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