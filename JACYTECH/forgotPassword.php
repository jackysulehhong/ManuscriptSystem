<?php
include("shared/connect.php");
//database connection, timeout counter and navbar
include("shared/layout/header.php");
include("MailFacade.php");
$success = 0;
//add new account

?>


<div class="container py-5">

 <div class="container bodyContainer p-5">
  <img class="img-fluid mx-auto d-block pt-5" style="height:20%;width:20%;" src="assets/forgot.png" alt="logo">
  <h1 class="text-center mb-5">Forgot Password</h1>
  <?php
        if (isset($_POST['submitBtn'])) {

            $email = $_POST['email'];
            $delQuery = "DELETE FROM `verification` WHERE lower(email)='" . strtolower($email) . "'";
            $result = query($conn, $delQuery);
            $result = query($conn, "SELECT * from  `user_account` WHERE lower(email)='" . strtolower($email) . "'");
            if (mysqli_num_rows($result) > 0) {
                $mailObj = new MailFacade();
                $mailObj->resetPass($email);
            }
            echo '<br><div class="alert alert-success">
                <div class="row">
                    <div class="col-auto align-self-center">
                    <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="col">
                    Email sent! Please check your email.
                    </div>
                </div>
            </div>';
        }
        ?>

  <form action='<?php echo basename($_SERVER['PHP_SELF']) ?>' method="POST" class="needs-validation" novalidate
   oninput='confirmemail.setCustomValidity(confirmemail.value != email.value ? "Emails do not match." : "")'>


   <div class="row">
    <div class="col-md-4 mb-3">
     <label for="Email">Email: </label>
    </div>
    <div class="col-md-8 mb-3">
     <input pattern="[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+" class="form-control" name="email" id="email" required>
     <div class="invalid-feedback">
      Please enter a valid email address.
     </div>
    </div>
   </div>


   <div class="row">
    <div class="col-md-4 mb-3">
     <label for="Confirm Email">Confirm Email: </label>
    </div>
    <div class="col-md-8 mb-3">
     <input pattern="[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+" class="form-control" name="confirmemail" id="confirmemail"
      required>
     <div class="invalid-feedback">
      Email does not match!
     </div>
    </div>
   </div>



   <div class="text-center">
    <button class="btn btn-primary" type="submit" name="submitBtn" value="submit">Submit</button>
   </div>
  </form>


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
</script>
<br><br>
<?php
include("shared/layout/footer.php");

?>