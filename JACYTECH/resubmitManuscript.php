<?php
include_once("shared/connect.php");
$message = "";
function getManuscript($conn, $id)
{
   return query($conn, "SELECT * FROM `manuscript` WHERE `id`='$id' ");
}



function resubmitManuscript($conn, $oldFile)
{

   $authorID = $_SESSION['curUser']['id'];
   $id = $_POST['id'];
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
      $rootDir = realpath($_SERVER["DOCUMENT_ROOT"]);
      if (isset($oldFile) && !empty($oldFile)) {
         unlink($targetDir . $oldFile);
      }
      $uploadResult = move_uploaded_file($docTempPath, $newFilePath);
      if (!$uploadResult) {
         echo '<br><div class="alert alert-danger">
            Something went wrong! Cannot upload file!
            </div>';
         return;
      } else {
         $result = query($conn, "UPDATE `manuscript` SET `title`='$title',`abstract`='$abstract',`type`='$type',`file`='$fileName',`status`='pendingResubmitApproval' WHERE `id`='$id'");

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
$result = getManuscript($conn, $_GET['id']);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
   resubmitManuscript($conn, $row['file']);
}



include("shared/layout/header.php");

?>
<div class="container my-5 p-5">
 <h2 class="text-center py-2 border-end">Manuscript Status</h2>
 <form action="<?php echo basename($_SERVER['PHP_SELF']) . '?id=' . $row['id']  ?>" method="POST" novalidate
  class="needs-validation" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
  <div class="row">
   <div class="col-md-4 mb-3 border-end">
    <label for="Title">Title: </label>
   </div>
   <div class="col-md-8 mb-3">
    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title"
     value="<?php echo $row['title'] ?>" required>
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
    <input type="text" class="form-control" name="abstract" id="abstract" placeholder="Enter abstract"
     value="<?php echo $row['abstract'] ?>" required>
    <div class="invalid-feedback">
     Invalid abstract
    </div>
   </div>
  </div>

  <div class="row">
   <div class="col-md-4 mb-3">
    <label for="Artitcle Type">Artitcle Type: </label>
   </div>
   <div class="col-md-8 mb-3">
    <input type="text" class="form-control" name="type" id="type" placeholder="Enter article type"
     value="<?php echo $row['type'] ?>" required>
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
   <button class="btn roundedPrimaryBtn" type="submit" name="submit" value="Submit">Resubmit</button>
  </div>
 </form>
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
<?php


include("shared/layout/footer.php");