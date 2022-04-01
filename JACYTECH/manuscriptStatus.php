<?php
include_once("shared/connect.php");

$targetDir = "uploads/manuscript/";
function getManuscript($conn, $id)
{
  $authorID = $_SESSION['curUser']['id'];
  return query($conn, "SELECT manuscript.* FROM `manuscript` WHERE `id`='$id' ");
}
if (isset($_GET) && !empty($_GET)) {
  $result = getManuscript($conn, $_GET['id']);
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location:listManuscript.php");
}
include("shared/layout/header.php");


?>
<div class="container my-5">
 <h2 class="text-center py-5">Manuscript Status</h2>
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
   <div class="col"><?php echo getStatusMessage($row['status'])  ?></div>
  </div>

  <div class="row">
   <div class="col-md-4 border-end fw-bold">File</div>
   <div class="col">
    <?php echo $row['file'] ?>
    <br />
    <a href="<?php echo $targetDir . $row['file'] ?>" download>Download</a>
   </div>
  </div>
  <?php
    if (in_array($row['status'], ['pendingPayment', 'pendingPublish', 'publish'])) {
      echo '   
<div class="row">
      <div class="col-md-4 border-end fw-bold">Paid status</div>
      <div class="col">' . ($row['paid'] == 1 ? 'Paid' : 'Pending') . '</div>
    </div>
 ';
    }
    if ($row['status'] == 'publish') {
      echo '   
<div class="row">
      <div class="col-md-4 border-end fw-bold">Harcopy status</div>
      <div class="col">' . ($row['hardcopy'] == 1 ? 'Sent' : 'Pending') . '</div>
    </div>
 ';
    }
    ?>
  <?php if ($row['status'] == 'reject') {
      echo '  <div class="row">
   <div class="col-md-4 border-end fw-bold">Reason</div>
   <div class="col">' . $row['reason'] . '</div>
  </div>';
    }
    ?>
  <?php if (!in_array($row['status'], ['pendingManuscriptApproval', 'reject', 'approve', 'pendingReview', 'pendingAssign', 'pendingReviewApproval'])) {
      echo '  <div class="row">
   <div class="col-md-4 border-end fw-bold">Overall Rating</div>
   <div class="col">' . $row['overallRating'] . '</div>
  </div>';
    }
    ?>

  <div class="row border-top">
  </div>
 </div>
 <?php if (!in_array($row['status'], ['pendingManuscriptApproval', 'reject', 'approve', 'pendingReview', 'pendingAssign', 'pendingReviewApproval'])) {
    echo '
 <div class="card">
  <div class="card-body">
   <h5 class="card-title text-decoration-underline">Overall Comment</h5>
   <p class="card-text">
' . $row['overallComment'] . '

  </div>
 </div>
 ';
  }
  ?>
 <div id="actionRow" class="d-flex justify-content-between mt-5">
  <div><a href="listManuscript.php" class="btn roundedSecondaryBtn">Back</a></div>
  <?php
    if ($row['status'] == 'pendingResubmit') {
      echo ' <div><a href="resubmitManuscript.php?id=' . $_GET['id'] . '" class="btn roundedPrimaryBtn">Resubmit</a></div>';
    } else if ($row['status'] == 'pendingPayment') {
      echo ' <div><a href="payment.php?id=' . $_GET['id'] . '" class="btn roundedPrimaryBtn">Proceed to Payment</a></div>';
    }
    ?>
 </div>
</div>
<?php
include("shared/layout/script.php");
?>
<?php


include("shared/layout/footer.php");