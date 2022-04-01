<?php
//database connection, timeout counter and navbar
include_once("shared/connect.php");
$message = "";

function insertCategory($conn)
{
   $name = mysqli_real_escape_string($conn, $_POST['name']);

   $result = query($conn, "INSERT INTO `category` (`name`) VALUES('$name')");
   if ($result) {
      $GLOBALS['message']  = "<div class='alert alert-success'>
   Successfully added
</div>";
   } else {
      $GLOBALS['message']  = "<div class='alert alert-danger'>
   Something went wrong
</div>";
   }
   //$last_id = mysqli_insert_id($conn);
   // header("Location:driverDetails.php?id=$last_id");
   //exit();
}
if (isset($_POST['submit'])) {
   insertCategory($conn);
}
include("shared/layout/header.php");
?>

<div class="container py-5 my-5">

 <div class="card bodyContainer">

  <div class="card-body">
   <h2 class="text-center py-2">Add New Category</h2>

   <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="POST" novalidate class="needs-validation">
    <div class="row" id="passwordrow">
     <div class="col-md-4 mb-3">
      <label for="Category name">Category name: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
      <div class="invalid-feedback">
       Invalid category name
      </div>
     </div>
    </div>


    <?php echo $message ?>

    <div class="text-center">
     <a href="listCategory.php" class="btn roundedSecondaryBtn">Back</a>
     <button class="btn roundedPrimaryBtn" type="submit" name="submit" value="submit">Submit</button>
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

}, false);
</script>
<br><br>
<?php
include("shared/layout/footer.php");

?>