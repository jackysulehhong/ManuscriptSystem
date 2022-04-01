<?php

//database connection, timeout counter and navbar
include("shared/connect.php");
include("shared/layout/header.php");
function getUser($conn, $email)
{
    return query($conn, "SELECT * FROM `user_account` WHERE `email`='$email'");
}
$result = getUser($conn, $_SESSION['curUser']['email']);
$row = mysqli_fetch_assoc($result);
?>


<div class="container py-5">

 <div class="card bodyContainer">
  <div class="card-body">
   <h2 class="text-center py-2">Profile</h2>
   <div class="row py-5">
    <div class="col-md-4 d-flex align-items-center my-5">
     <img id="output" src="./assets/avatar_placeholder.jpg" class="img-fluid mx-auto d-block"
      style="width:auto;height:10rem;" />
    </div>
    <div class="col">
     <div class="container p-5" style="border:1px solid black;border-radius:25px;">
      <?php


                        echo '
      

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="Name">Name: </label>
                    </div>
                    <div class="col-md-8 mb-3">
                        <input type="text" class="form-control" name="name" id="name" value="' . $row['name'] . '" readonly>
                    </div>
                </div>


            <div class="row">
            <div class="col-md-4 mb-3">
                <label for="Contact">Contact: </label>
            </div>
            <div class="col-md-8 mb-3">
                <input type="text" class="form-control" name="contact" id="contact" value="' . $row['contact'] . '" readonly>
            </div>
        </div>
                    <div class="row">
            <div class="col-md-4 mb-3">
                <label for="email">Email: </label>
            </div>
            <div class="col-md-8 mb-3">
                <input type="text" class="form-control" name="email" id="class" value="' . $row['email'] . '" readonly>
            </div>
        </div>
                    <div class="row">
            <div class="col-md-4 mb-3">
                <label for="Position">Position: </label>
            </div>
            <div class="col-md-8 mb-3">
                <input type="text" class="form-control" name="position" id="class" value="' . $row['position'] . '" readonly>
            </div>
        </div>
        ';
                        if ($row['position'] == 'reviewer') {
                            echo '             
                            <div class="row">
            <div class="col-md-4 mb-3">
                <label for="Area of Expertise">Area of Expertise: </label>
            </div>
            <div class="col-md-8 mb-3">
                <input type="text" class="form-control" name="expertise" id="class" value="' . $row['expertise'] . '" readonly>
            </div>
        </div>';
                        }

                        echo '
</form>
        ' ?>

     </div>
    </div>
   </div>
  </div>
 </div>
</div>
<?php
include("shared/layout/script.php");
?>
<?php
include("shared/layout/footer.php");

?>