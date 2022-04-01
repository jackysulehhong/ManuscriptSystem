<?php
//database connection, timeout counter and navbar
include_once("shared/connect.php");
include_once("MailFacade.php");
include_once("shared/layout/header.php");
$success = 0;
?>


<div class="container">
 <h1 class="text-center my-5">Reset Password</h1>
 <div class="card">
  <div class="card-body">
   <?php
            if (isset($_POST['submitBtn'])) {
                $email = $_POST['email'];
                $id = $_POST['id'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $updateQuery = "UPDATE `user_account` SET `password`='$password' WHERE lower(email)='" . strtolower($email) . "'";
                $result = query($conn, $updateQuery);
                $delQuery = "DELETE FROM `verification` WHERE `id`='$id'";
                $result = query($conn, $delQuery);
                $success = 1;
                echo '<br><div class="text-center my-5"><p>
                   Reset successful!
                   </p>
                  <p> Go To <a href="login.php">login Page</a></p>
                    </div><br>
                    ';
            } else if ($success != 1 && isset($_GET['token']) && isset($_GET['email'])) {

                $email = $_GET['email'];
                $token = $_GET['token'];

                $selQuery = "SELECT * FROM `verification` WHERE `token`='$token' AND `email`='$email' ORDER BY `createdAt` DESC LIMIT 0,1";
                $result = query($conn, $selQuery);

                if (mysqli_num_rows($result) > 0) {

                    $row = mysqli_fetch_assoc($result);
                    $id = $row['id'];
                    $interval = date_diff(new DateTime(date("Y-m-d H:i:s")), new DateTime($row['createdAt']));
                    if ($interval->i <= 10) {
            ?>

   <form action='<?php echo basename($_SERVER['PHP_SELF']) ?>' method="POST" class="needs-validation" novalidate
    oninput='confirmpassword.setCustomValidity(confirmpassword.value != password.value ? "Passwords do not match." : "")'
    enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $id ?>">
    <input type="hidden" name="email" value="<?php echo $email ?>">

    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Password">Enter a new Password: </label>
     </div>
     <div class="col-md-8 mb-3">
      <div class="input-group">
       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control pwd1" name="password"
        id="password" required>
       <div class="input-group-append">
        <button class="btn btn-outline-secondary reveal1" type="button"><i class="fas fa-eye-slash"></i></button>
       </div>
       <div class="invalid-feedback">
        Must contain at least one number and one uppercase and lowercase letter, and at least 8
        or more characters
       </div>
      </div>

     </div>
    </div>
    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Confirm Password">Confirm Password: </label>
     </div>

     <div class="col-md-8 mb-3">
      <div class="input-group">
       <input type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control pwd2"
        name="confirmpassword" id="confirmpassword" required>
       <div class="input-group-append">
        <button class="btn btn-outline-secondary reveal2" type="button"><i class="fas fa-eye-slash"></i></button>
       </div>
       <div class="invalid-feedback">
        Password does not match.
       </div>
      </div>
     </div>
    </div>

    <div class="text-center">
     <button class="btn btn-primary" type="submit" name="submitBtn" value="submit">Submit</button>
    </div>
   </form>
   <?php
                    } else {
                        $delQuery = "DELETE FROM `verification` WHERE `id`='$id'";
                        $result = query($conn, $delQuery);
                        $mailObj = new MailFacade();
                        $mailObj->resetPass($email);
                        /*
                        include('shared/sendMail.php');
                        $bytes = random_bytes(16);
                        $token = bin2hex($bytes);
                        query($conn, "INSERT INTO `verification`(`email`,`token`) VALUES('$email','$token')");
                        $selQuery = "SELECT `name` FROM `user_account` WHERE  `email`='$email'";
                        $result = query($conn, $selQuery);
                        $row = mysqli_fetch_assoc($result);

                        sendMail($email,  $row['name'], "Reset Password", "<p>
                       Please click the button below to reset your password. 
                       If it's not you, please ignore the email.
                      </p>", "http://" . $_SERVER['HTTP_HOST'] . substr($_SERVER['REQUEST_URI'], 0, strrpos($_SERVER['REQUEST_URI'], "/")) . "/resetPassword.php?email=" . $email . "&token=" . $token . "", "Reset Password");
                      */
                        echo '<br><div class="alert alert-danger">
                      <div class="row">
                          <div class="col-auto align-self-center">
                          <i class="fas fa-times-circle"></i>
                          </div>
                          <div class="col">
                          Verification fail due to exceeded 10 minutes. Another email is sent.
                          </div>
                      </div>
               ';
                    }
                }
            } else {
                echo '<br><div class="alert alert-danger">
                      <div class="row">
                          <div class="col-auto align-self-center">
                          <i class="fas fa-times-circle"></i>
                          </div>
                          <div class="col">
                          Verification fail, please try again. <a href="forgotPassword.php">Forgot Password</a>
                          </div>
                      </div>';
            }
            ?>
   <hr />
   <div class="text-center">
    <a href="login.php">Back to Login Page</a>

   </div>


  </div>
 </div>
</div>
<?php
include("shared/layout/script.php");
?>
<script>
(function() {
 'use strict';
 window.addEventListener('load', function() {
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.getElementsByClassName('needs-validation');
  // Loop over them and prevent submission
  var validation = Array.prototype.filter.call(forms, function(form) {
   form.addEventListener('submit', function(event) {
    if (form.checkValidity() === false) {
     event.preventDefault();
     event.stopPropagation();
    }
    form.classList.add('was-validated');
   }, false);
  });
 }, false);
})();
$(".reveal1").on('mousedown', function() {
 var $pwd = $(".pwd1");

 $pwd.attr('type', 'text');
 $(".reveal1").html(`<i class="fas fa-eye"></i>`);


}).on('mouseup', function() {
 var $pwd = $(".pwd1");
 $pwd.attr('type', 'password');
 $(".reveal1").html(`<i class="fas fa-eye-slash"></i>`);

});
$(".reveal2").on('mousedown', function() {
 var $pwd = $(".pwd2");

 $pwd.attr('type', 'text');
 $(".reveal2").html(`<i class="fas fa-eye"></i>`);


}).on('mouseup', function() {
 var $pwd = $(".pwd2");
 $pwd.attr('type', 'password');
 $(".reveal2").html(`<i class="fas fa-eye-slash"></i>`);

});
</script>
<br><br>
<?php
include("shared/layout/footer.php");

?>