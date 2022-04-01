<?php
include_once("shared/connect.php");

$targetDir = "uploads/manuscript/";

function sendHardcopy($conn, $id)
{
  return query($conn, "UPDATE `manuscript` SET `hardcopy`='1' WHERE `id`='$id' ");
}

function getManuscript($conn, $id)
{
  return query($conn, "SELECT manuscript.*,user_account.name FROM `manuscript` JOIN `user_account` ON manuscript.authorID=user_account.id WHERE manuscript.id='$id' ");
}

function updateManuscriptStatus($conn)
{
  $manuscriptID = $_POST['id'];
  $status = $_POST['approval'];
  $reason = $_POST['reason'];
  if ($status == 'reject') {
    return query($conn, "UPDATE `manuscript` SET `status`='$status',`reason`='$reason' WHERE `id`='$manuscriptID' ");
  }
  return query($conn, "UPDATE `manuscript` SET `status`='pendingAssign' WHERE `id`='$manuscriptID' ");
}

function updateReviewApproval($conn)
{

  $manuscriptID = $_POST['id'];
  $status = $_POST['reviewApproval'];
  $overallRating = $_POST['overallRating'];
  $overallComment = mysqli_real_escape_string($conn, $_POST['overallComment']);

  if ($status == 'reject') {

    $reason = $_POST['reason'];
    return query($conn, "UPDATE `manuscript` SET `status`='$status',`overallRating`='$overallRating',`overallComment`='$overallComment',`reason`='$reason' WHERE `id`='$manuscriptID' ");
  }
  $result = query($conn, "UPDATE `manuscript` SET `status`='$status',`overallRating`='$overallRating',`overallComment`='$overallComment' WHERE `id`='$manuscriptID' ");
}

function publishManuscript($conn, $id)
{
  return query($conn, "UPDATE `manuscript` SET `status`='publish' WHERE `id`='$id' ");
}

if (isset($_POST['approval']) && !empty($_POST['approval'])) {
  updateManuscriptStatus($conn);
}
if (isset($_POST['reviewApproval']) && !empty($_POST['reviewApproval'])) {

  updateReviewApproval($conn);
}

if (isset($_GET) && !empty($_GET)) {

  if (isset($_GET['hardcopy']) && !empty($_GET['hardcopy'])) {
    sendHardcopy($conn, $_GET['id']);
  }
  if (isset($_GET['publish']) && !empty($_GET['publish'])) {
    publishManuscript($conn, $_GET['id']);
  }
  $result = getManuscript($conn, $_GET['id']);
  $row = mysqli_fetch_assoc($result);
} else {
  header("Location:listManuscript.php");
}
include("shared/layout/header.php");


?>
<div class="container py-5">
 <h2 class="text-center py-5">Manuscript Management</h2>
 <div class="text-white lh-lg">
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Manuscript ID</div>
   <div class="col"><?php echo $row['id'] ?></div>
  </div>
  <div class="row">
   <div class="col-md-4 border-end fw-bold">Author</div>
   <div class="col"><?php echo $row['name'] ?></div>
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
   <div class="col"><?php echo getStatusMessage($row['status']) ?></div>
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

  <form action="<?php echo basename($_SERVER['PHP_SELF']) . '?id=' . $row['id'] ?>" method="POST" novalidate
   class="needs-validation">
   <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
   <?php if (in_array($row['status'], ['pendingReview', 'pendingReviewApproval', 'pendingResubmitApproval'])) {
        $reviewResult = query($conn, "SELECT * FROM `review` JOIN user_account ON review.reviewerID=user_account.id WHERE review.manuscriptID='" . $row['id'] . "'");
        $reviewCount = mysqli_num_rows($reviewResult);
        $overallRating = 0.0;
        $overallComments = "";
        $goodRatingCount = 0;
        $completedCount = 0;
      ?> <div class="table-responsive">
    <table class="table table-hover table-light" id="tablelist">
     <thead>
      <tr>
       <th>Name</th>
       <th>Rating</th>
       <th>Comment</th>
       <th>Status</th>
      </tr>

     </thead>
     <tbody>

      <?php


              while ($reviewRow = mysqli_fetch_assoc($reviewResult)) {
                echo '    <tr>
     <td>' . $reviewRow['name'] . '</td>
     <td>' . $reviewRow['rating'] . '</td>
     <td>' . $reviewRow['comment'] . '</td>
      <td>' . $reviewRow['status'] . '</td>
    </tr>';
                $overallRating += (float)$reviewRow['rating'];
                if ($reviewRow['status'] == 'complete') {
                  $completedCount++;
                }
                if ((float)$reviewRow['rating'] >= 7) {
                  $goodRatingCount++;
                }
                $overallComments .= $reviewRow['comment'] . '&#13;&#10;';
              }
              $overallRating = $overallRating / $reviewCount;
              //$reviewCount += 1;
              //  $completedCount += 1;
              // $goodRatingCount += 1;
              ?>
     </tbody>
    </table>
   </div>
   <?php

        if ($reviewCount > 1 && $reviewCount == $completedCount) {
          echo '
     <div class="row">
      <div class="col-md-4 mb-3 ">
       <label for="Overall Rating">Overall Rating</label>
      </div>
      <div class="col-md-8 mb-3">
       <input type="text" class="form-control" name="overallRating" id="overallRating" value="' . $overallRating . '"
        readonly>
       <div class="invalid-feedback">
        Invalid overall rating
       </div>
      </div>
     </div>';
        ?>

   <?php
          echo '

<div class="row">
   <div class="col-md-4 mb-3">
    <label for="Overall Comments">Overall Comments: </label>
   </div>
   <div class="col-md-8 mb-3">
    <textarea rows="10" class="form-control" name="overallComment" id="overallComment" placeholder="Enter overallComment" required>' . $overallComments . '</textarea>
    <div class="invalid-feedback">
     Invalid overall comment
    </div>
   </div>
  </div>

 ';
        }
      }
      ?>

   <?php if ($row['status'] == 'pendingManuscriptApproval' || (in_array($row['status'], ['pendingReviewApproval', 'pendingResubmitApproval']) && $reviewCount == $completedCount && $goodRatingCount < 2)) {
        echo '  <div class="row">
   <div class="col-md-4 border-end fw-bold">  <label for="Reason">Reason: </label></div>
     <div class="col-md-8 mb-3">
    <textarea class="form-control" name="reason" id="reason" placeholder="Enter reason"></textarea>
    <div class="invalid-feedback">
     Invalid reason
    </div>
   </div>
  </div>';
      }

      ?>
   <?php if ($row['status'] == 'pendingManuscriptApproval') {
        echo '   <div class="text-center">
   <button class="btn roundedSecondaryBtn" type="submit" name="approval" value="reject">Reject</button>
   <button class="btn roundedPrimaryBtn" type="submit" name="approval" value="approve">Approve</button>
  </div> ';
      } else if (in_array($row['status'], ['pendingReviewApproval', 'pendingResubmitApproval']) && $reviewCount == $completedCount) {
        echo '   <div class="text-center">';
        if ($goodRatingCount < 2) {
          echo '<button class="btn roundedSecondaryBtn" type="submit" name="reviewApproval" value="reject">Reject</button>';
        } else {
          echo '<button class="btn roundedPrimaryBtn" type="submit" name="reviewApproval" value="pendingResubmit">Resubmit</button>';
          echo '<button class="btn roundedPrimaryBtn" type="submit" name="reviewApproval" value="pendingPayment">Request Payment</button>';
        }
        echo '</div> ';
      }
      ?>

  </form>

  <?php
    if (in_array($row['status'], ['pendingManuscriptApproval', 'reject', 'publish', 'pendingPayment', 'pendingPublish', 'pendingResubmit', 'pendingResubmitApproval']) || (in_array($row['status'], ['pendingReview', 'pendingReviewApproval']) && $reviewCount > 1 && $reviewCount != $completedCount)) {
      echo '   <div class="text-center mt-5">
  <div><a href="listManuscript.php" class="btn roundedSecondaryBtn">Back</a></div>
  ';
      if ($row['status'] == 'publish' && $row['hardcopy'] == 0) {

        echo '  <div><a href="manuscriptApproval.php?id=' . $_GET['id'] . '&hardcopy=1" class="btn roundedPrimaryBtn">Send Hardcopy</a></div>';
      } else if ($row['status'] == 'pendingPublish')
        echo '  <div><a href="manuscriptApproval.php?id=' . $_GET['id'] . '&publish=1" class="btn roundedPrimaryBtn">Publish</a></div>';
      echo '
  </div> ';
    } else if ($row['status'] == 'pendingAssign' || ($row['status'] == 'pendingReview' && $reviewCount == 1) || (in_array($row['status'], ['pendingReview', 'pendingReviewApproval']) && $reviewCount == 2 && $completedCount == 2 && $goodRatingCount < 2)) {
      echo ' 
       <div id="actionRow" class="d-flex justify-content-between mt-5">
  <div><a href="listManuscript.php" class="btn roundedSecondaryBtn">Back</a></div>
   <div><a href="assignTask.php?id=' . $row['id'] . '" class="btn roundedPrimaryBtn">Assign</a></div>
    </div>';
    }

    ?>


 </div>

 <?php
  include("shared/layout/script.php");
  ?><script>
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
 <?php


    include("shared/layout/footer.php");