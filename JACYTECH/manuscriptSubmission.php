<?php
//database connection, timeout counter and navbar
include_once("shared/connect.php");
$message = "";

function insertManuscript($conn)
{
   $authorID = $_SESSION['curUser']['id'];
   $title = mysqli_real_escape_string($conn, $_POST['title']);
   $abstract = mysqli_real_escape_string($conn, $_POST['abstract']);
   $type = $_POST['type'];
   if (isset($_FILES) && !empty($_FILES['manuscript']['tmp_name'])) {
      $targetDir = "uploads/manuscript/";
      if (!file_exists($targetDir)) {
         mkdir($targetDir, 0700, true);
      }
      $fileName  = date('d-m-Y_H-i-s') . preg_replace('/[^a-zA-Z0-9_-]+/', '-', strtolower($_FILES['manuscript']['name'])) . '.' . pathinfo($_FILES['manuscript']['name'], PATHINFO_EXTENSION);
      $docTempPath = $_FILES['manuscript']['tmp_name'];
      $newFilePath = $targetDir . $fileName;
      $uploadResult = move_uploaded_file($docTempPath, $newFilePath);
      if (!$uploadResult) {
         echo '<br><div class="alert alert-danger">
            Something went wrong! Cannot upload file!
            </div>';
         return;
      } else {
         $result = query($conn, "INSERT INTO  `manuscript` (`title`,`abstract`,`type`,`file`,`authorID`) VALUES('$title','$abstract','$type','$fileName','$authorID')");
         if ($result) {
            $GLOBALS['message']  = "<div class='alert alert-success'>
   Successfully submitted. Please wait for approval
</div>";
         } else {
            $GLOBALS['message']  = "<div class='alert alert-danger'>
  Something went wwrong
</div>";
         }
      }
   }



   //$last_id = mysqli_insert_id($conn);
   // header("Location:driverDetails.php?id=$last_id");
   //exit();
}
if (isset($_POST['submit'])) {
   insertManuscript($conn);
}
include("shared/layout/header.php");
?>

<div class="container py-5 my-5">

 <div class="card bodyContainer">

  <div class="card-body">
   <h2 class="text-center py-2">Manuscript Details</h2>
   <hr />
   <form action="<?php echo basename($_SERVER['PHP_SELF']) ?>" method="POST" novalidate class="needs-validation"
    enctype="multipart/form-data">
    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Title">Title: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
      <div class="invalid-feedback">
       Invalid title
      </div>
     </div>
    </div>

    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="Abstract">Abstract: </label>
     </div>
     <div class="col-md-8 mb-3">
      <input type="text" class="form-control" name="abstract" id="abstract" placeholder="Enter abstract" required>
      <div class="invalid-feedback">
       Invalid abstract
      </div>
     </div>
    </div>


    <div class="row">
     <div class="col-md-4 mb-3 ">
      <label for="Artitcle Type">Artitcle Type: </label>
     </div>
     <div class="col-md-8 mb-3">
      <select class="form-select" name="type" id="type" required>
       <?php
                     $categoryResult = query($conn, "SELECT `name` FROM `category`");
                     while ($row = mysqli_fetch_assoc($categoryResult)) {
                        echo ' <option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                     }
                     ?>
      </select>
      <div class="invalid-feedback">
       Invalid article type
      </div>
     </div>
    </div>
    <div class="row">
     <div class="col-md-4 mb-3">
      <label for="formFile" class="form-label">Manuscript</label>
     </div>
     <div class="col-md-8 mb-3">
      <input class="form-control" type="file" id="manuscript" name="manuscript" required>
      <div class="invalid-feedback">
       Please select a file
      </div>
     </div>
    </div>

    <?php echo $message ?>

    <div class="text-center">
     <button class="btn roundedPrimaryBtn" type="submit" name="submit" value="Submit">Submit</button>
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