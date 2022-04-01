<?php
//database connection, timeout counter and navbar
include_once("shared/connect.php");
$message = "";

function insertAcc($conn)
{
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = $_POST['email'];
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password = password_hash($password, PASSWORD_DEFAULT);
  $contact = $_POST['contact'];
  $position = $_POST['position'];
  $result = query($conn, "SELECT * FROM `user_account` WHERE `email`='$email' LIMIT 0,1");
  if (mysqli_num_rows($result) != 0) {
    $GLOBALS['message'] = "<div class='alert alert-danger'>
   There's an existing account with this email.
</div>";
    return;
  }
  if ($position == "author") {
    query($conn, "INSERT INTO  `user_account` (`name`,`email`,`password`,`contact`,`position`) VALUES('$name','$email','$password','$contact','$position')");
  } else if ($position == "reviewer") {
    $expertise = $_POST['expertise'];
    //$expertise = implode("|", $_POST['expertise']);
    query($conn, "INSERT INTO  `user_account` (`name`,`email`,`password`,`contact`,`position`,`expertise`) VALUES('$name','$email','$password','$contact','$position','$expertise')");
  }
  $GLOBALS['message']  = "<div class='alert alert-success'>
   Successfully registered
</div>";
  //$last_id = mysqli_insert_id($conn);
  // header("Location:driverDetails.php?id=$last_id");
  //exit();
}
if (isset($_POST['register'])) {
  insertAcc($conn);
}
include("shared/layout/header.php");
?>

<div class="container py-5 my-5">

 <div class="card bodyContainer">

  <div class="card-body">
   <h2 class="text-center py-2">New Account Registration</h2>
   <hr />
   <p class="text-center pt-2 pb-5">Already have an account? <a href='login.php'>Log in</a></p>
   <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="POST" novalidate class="needs-validation"
    oninput="confirmPassword.setCustomValidity(confirmPassword.value == password.value ? '' : 'Password does not match' )">
    <div class="row" id="passwordrow">
     <div class="col-md-4 mb-3">
      <label for="Name">Name: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
      <div class="invalid-feedback">
       Invalid name
      </div>
     </div>
    </div>



    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Password">Password: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="password" class="form-control" name="password" id="password" placeholder="Enter password"
       pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" required>
      <div class="invalid-feedback">
       Password must have minimum eight characters, at least one upper case English letter, one lower case English
       letter and one number
      </div>
     </div>
    </div>

    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Confirm Password">Confirm Password: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
       placeholder="Enter confirm password" required>
      <div class="invalid-feedback">
       Password does not match
      </div>

     </div>
    </div>

    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Email">Email: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
      <div class="invalid-feedback">
       Invalid email
      </div>
     </div>
    </div>


    <div class="row">
     <div class="col-md-4 mb-3 ">
      <label for="Contact">Contact</label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="text" class="form-control" pattern="^[0-9]*$" name="contact" id="contact" placeholder="Enter contact"
       required>
      <div class="invalid-feedback">
       Invalid phone number
      </div>
     </div>
    </div>

    <div class="row">
     <div class="col-md-4 mb-3 ">
      <label for="Position">Position</label>
     </div>
     <div class="col-md-8 mb-3">
      <select class="form-select" id="position" name="position">
       <option value="author" selected>Author</option>
       <option value="reviewer">Reviewer</option>
      </select>
      <div class="invalid-feedback">
       Invalid position
      </div>
     </div>
    </div>


    <!--
        <div class="row">
          <div class="col-md-4 mb-3">
            <label for="Country">Country</label>
          </div>
          <div class="col-md-8 mb-3">
            <input type="text" class="form-control" name="country" id="country" placeholder="Enter country" required>

          </div>
          <div class="invalid-feedback">
            Field is required
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3 ">
            <label for="State">State</label>
          </div>
          <div class="col-md-8 mb-3">
            <input type="text" class="form-control" name="state" id="state" placeholder="Enter state" required>
            <div class="invalid-feedback">
              Field is required
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3 ">
            <label for="City">City</label>
          </div>
          <div class="col-md-8 mb-3">
            <input type="text" class="form-control" name="city" id="city" placeholder="Enter city" required>
            <div class="invalid-feedback">
              Field is required
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 mb-3 ">
            <label for="Postcode">Postcode</label>
          </div>
          <div class="col-md-8 mb-3">
            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="Enter postcode" required>
            <div class="invalid-feedback">
              Field is required
            </div>
          </div>
        </div>
        
   
-->
    <div class="row" id="reviewerField">
     <div class="col-md-4 mb-3 ">
      <label for="Area of Expertise">Area of Expertise:</label>
     </div>
     <div class="col-md-8 mb-3">
      <select class="form-select" name="expertise" id="expertise" required>
       <?php
              $categoryResult = query($conn, "SELECT `name` FROM `category`");
              while ($row = mysqli_fetch_assoc($categoryResult)) {
                echo ' <option value="' . $row['name'] . '">' . $row['name'] . '</option>';
              }
              ?>
      </select>
      <div class="invalid-feedback">
       expertise is required
      </div>
     </div>
    </div>

    <?php echo $message ?>

    <div class="text-center">
     <button class="btn roundedPrimaryBtn" type="submit" name="register" value="register">Create
      Account</button>
    </div>
   </form>
   <br />
   <br />
   <br />

  </div>
 </div>
</div>
<?php
include("shared/layout/script.php");
?>
<script>
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

 $("#password, #confirmPassword ").keyup(function() {
  if ($("#confirmPassword").val() != $('#password').val()) {
   $("#confirmPassword").get(0).setCustomValidity('Password must be matched');
  } else {
   $("#confirmPassword").get(0).setCustomValidity('');
  }
 });

 $('#reviewerField').hide();
 $("#expertise").removeAttr("required");
 $('#expertise').removeAttr('data-error');
 $("#position").change(function() {
  if ($(this).val() == "reviewer") {

   $('#reviewerField').show();
   $("#expertise").attr("required", '');
   $('#expertise').attr('data-error', 'This field is required.');
  } else {
   $('#reviewerField').hide();
   $("#expertise").removeAttr("required");
   $('#expertise').removeAttr('data-error');

  }
 })

}, false);
</script>
<br><br>
<?php
include("shared/layout/footer.php");

?>