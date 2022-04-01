<?php
include("shared/connect.php");
include("shared/layout/header.php");
function getListUser($conn)
{
  return query($conn, "SELECT * FROM user");
}
?>
<div class="container my-5 min-vh-100">
 <div class="row">
  <div class="col-md">
   <h2> Driver List</h2>
  </div>
  <div class="col-md text-center">
   <a class="btn btn-primary" href="addAcc.php">Add User</a>
  </div>
 </div>

 <hr style="border-top:5px solid rgba(0,0,0,.1)">



 <?php

  $result = getListUser($conn);
  if (mysqli_num_rows($result) > 0) {
    while ($item = mysqli_fetch_assoc($result)) {

      echo '<div class="container-fluid">
 <div class="container pt-5">
  <div class="table-responsive">
   <table class="table" id="example">
    <thead>
     <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subscription Date</th>
     </tr>
    </thead>
    <tbody>' . $item['id'] . '</tbody>
    <tbody>' . $item['name'] . '</tbody>
    <tbody>' . $item['email'] . '</tbody>
    <tbody>' . $item['subscription_start_date'] . ' to ' . $item['subscription_end_date'] . '</tbody>
   </table>


  </div>
 </div>';
    }
  } else {
    echo "<div class='alert alert-light'>
    No user available.
    </div>";
  }
  ?>
</div>
<?php
include("shared/layout/script.php");
?>
<?php
include("shared/layout/footer.php");