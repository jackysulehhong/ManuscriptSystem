<?php
include_once("shared/connect.php");
$message = "";

function updateReview($conn)
{
  $reviewerID = $_SESSION['curUser']['id'];
  $manuscriptID = $_POST['id'];
  $reviewID = $_GET['id'];
  $rating = $_POST['rating'];
  $comment = mysqli_real_escape_string($conn, $_POST['comment']);


  $result = query($conn, "UPDATE `review` SET `rating`='$rating',`comment`='$comment',`status`='complete' WHERE `id`='$reviewID'");
  if ($result) {
    $totalCount = mysqli_fetch_assoc(query($conn, "SELECT COUNT(id) as 'count' FROM `review` WHERE manuscriptID='$manuscriptID'"))['count'];
    $completeCount = mysqli_fetch_assoc(query($conn, "SELECT COUNT(id) as 'count' FROM `review` WHERE manuscriptID='$manuscriptID' AND `status`='complete'"))['count'];
    if ($totalCount > 1 && ($totalCount == $completeCount || $totalCount == $completeCount + 1)) {
      query($conn, "UPDATE `manuscript` SET `status`='pendingReviewApproval' WHERE `id`='$manuscriptID' ");
    }
    header("Location:listReview.php");
    $GLOBALS['message']  = "<div class='alert alert-success'>
   Successfully submitted
</div>";
  } else {
    $GLOBALS['message']  = "<div class='alert alert-danger'>
  Something went wwrong
</div>";
  }
  //$last_id = mysqli_insert_id($conn);
  // header("Location:driverDetails.php?id=$last_id");
  //exit();
}


$targetDir = "uploads/manuscript/";
function getManuscript($conn, $id)
{
  $authorID = $_SESSION['curUser']['id'];
  return query($conn, "SELECT manuscript.*,review.id as 'reviewID',review.status as 'reviewStatus',review.comment,review.rating FROM `manuscript` JOIN review ON manuscript.id=review.manuscriptID WHERE review.id='$id' ");
}
if (isset($_GET) && !empty($_GET)) {
  $result = getManuscript($conn, $_GET['id']);
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location:listReview.php");
}

if (isset($_POST['submit'])) {
  updateReview($conn);
}




include("shared/layout/header.php");


?>
<div class="container my-5">
 <h2 class="text-center py-5">Review Manuscript</h2>

 <div class="text-white lh-lg">
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Manuscript ID</div>
   <div class="col"><?php echo $row['id'] ?></div>
  </div>
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Title</div>
   <div class="col"><?php echo $row['title'] ?></div>
  </div>
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Abstract</div>
   <div class="col"><?php echo $row['abstract'] ?></div>
  </div>
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Status</div>
   <div class="col"><?php echo getStatusMessage($row['reviewStatus'])  ?></div>
  </div>
  <div class="row">
   <div class="col-md-4 border-end fw-bold">File</div>
   <div class="col">
    <?php echo $row['file'] ?>
    <br />
    <a href="<?php echo $targetDir . $row['file'] ?>" download><i class="fas fa-download"></i></a>
   </div>
  </div>
  <div class="row border-top">
  </div>



 </div>
 <br />
 </br />

 <form action="<?php echo basename($_SERVER['PHP_SELF']) . '?id=' . $row['reviewID']  ?>" method="POST" novalidate
  class="needs-validation">
  <input type="hidden" name="id" value="<?php echo $row['id'] ?>">

  <div class="row">
   <div class="col-md-4 mb-3">
    <label for="Rating">Rating: </label>
   </div>
   <div class="col-md-8 mb-3">
    <select class="form-select form-control" id="rating" name="rating" value="<?php echo $row['rating'] ?>"
     <?php echo $row['reviewStatus'] == "complete" ? "disabled readonly" : ""; ?>>
     <?php
          for ($i = 1; $i <= 10; $i++) {
            echo  '<option value="' . $i . '" ' . ($i == intval($row['rating']) ? "selected" : "") . '>' . $i . '</option>';
          }
          ?>
    </select>
    <div class="invalid-feedback">
     Invalid rating
    </div>
   </div>
  </div>
  <div class="row">
   <div class="col-md-4 mb-3">
    <label for="Comments">Comments: </label>
   </div>
   <div class="col-md-8 mb-3">
    <textarea class="form-control" name="comment" id="comment" placeholder="Enter comment" required
     <?php echo $row['reviewStatus'] == "complete" ? "readonly" : ""; ?>><?php echo $row['comment'] ?>
    </textarea>
    <div class="invalid-feedback">
     Invalid comment
    </div>
   </div>
  </div>

  <?php echo $message ?>

  <div class="text-center">
   <a class="btn roundedPrimaryBtn" href="listReview.php">Back</a>
   <?php if ($row['reviewStatus'] == 'pending') {
        echo ' <button class="btn roundedPrimaryBtn" type="submit" name="submit" value="Submit">Submit</button>';
      } ?>

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
include("shared/layout/footer.php");