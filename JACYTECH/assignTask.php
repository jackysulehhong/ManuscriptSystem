<?php
include_once("shared/connect.php");
function insertReview($conn, $id)
{
    $reviewerID = $_GET['assign'];
    query($conn, "UPDATE `manuscript` SET `status`='pendingReview' WHERE id='$id'");
    return query($conn, "INSERT INTO `review` (`manuscriptID`,`reviewerID`) VALUES ('$id','$reviewerID')");
}
function getManuscript($conn, $id)
{
    $authorID = $_SESSION['curUser']['id'];
    return query($conn, "SELECT manuscript.* FROM `manuscript` WHERE `id`='$id' ");
}
function checkExistingReview($conn, $id, $category)
{
    $reviewerID = $_SESSION['curUser']['id'];
    //  return query($conn, "SELECT user_account.id FROM `user_account` JOIN `review` ON user_account.id=review.reviewerID WHERE review.manuscriptID='$id' AND user_account.expertise='' ");
    return query($conn, "SELECT * FROM `user_account` WHERE `expertise`='$category' AND NOT `id` IN (SELECT user_account.id FROM `user_account` JOIN `review` ON user_account.id=review.reviewerID WHERE review.manuscriptID='$id')");
}
function getTotalPendingReview($conn, $id)
{
    return query($conn, "SELECT COUNT(id) as 'totalReview' FROM `review` WHERE `reviewerID`='$id' AND `status`='pending' ");
}
if (isset($_GET) && !empty($_GET)) {
    if (isset($_GET['assign']) && !empty($_GET['assign'])) {
        insertReview($conn, $_GET['id']);
    }
    $manuscriptResult = getManuscript($conn, $_GET['id']);
    $manuscriptRow = mysqli_fetch_assoc($manuscriptResult);
    $reviwerResult = checkExistingReview($conn, $_GET['id'], $manuscriptRow['type']);
} else {
    header("Location:listManuscript.php");
}
include("shared/layout/header.php");


?>
<div class="container">
 <h2 class="text-center">Reviewer List For <?php echo $manuscriptRow['type'] ?></h2>
 <form action="<?php echo basename($_SERVER['PHP_SELF']) . '?id=' . $row['id']  ?>" method="POST" novalidate
  class="needs-validation">
  <div class="table-responsive">

   <table class="table table-hover table-light" id="tablelist">
    <thead>
     <tr>
      <th>Name</th>
      <th>Pending Review Count</th>
      <th></th>
     </tr>
    </thead>
    <tbody>

     <?php
                    while ($reviewerRow = mysqli_fetch_assoc($reviwerResult)) {
                        $pendingReviewCount = mysqli_fetch_assoc(getTotalPendingReview($conn, $reviewerRow['id']))['totalReview'];

                        echo '  
                       <tr>  
                       <td>' . $reviewerRow['name'] . '</td>
                    <td>' . $pendingReviewCount . '</td>
                    <td>
                    <a class="btn btn-primary" href="assignTask.php?id=' . $_GET['id'] . '&assign=' . $reviewerRow['id'] . '">Assign</a></td>
          </tr>';
                    }
                    ?>


    </tbody>
   </table>
  </div>
 </form>

 <div class="text-center py-5">
  <a class="btn roundedSecondaryBtn" href="manuscriptApproval.php?id=<?php echo $_GET['id'] ?>">Back</a>
 </div>

</div>

<?php
include("shared/layout/script.php");
?>

<script>
$(document).ready(function() {


 $('#tablelist thead tr')
  .clone(true)
  .addClass('filters')
  .appendTo('#tablelist thead');

 $('#tablelist').DataTable({
  "order": [
   [1, "asc"]
  ],
  "columnDefs": [{
   orderable: false,
   targets: [2]
  }, {
   searchable: false,
   targets: [2]
  }],
  orderCellsTop: true,
  //https://datatables.net/forums/discussion/53287/how-to-reset-values-in-individual-column-searching-text-inputs-at-a-button-click
  /** orderCellsTop: true, fixedHeader: true, 
   */
  initComplete: function() {
   var api = this.api(); // For each column api
   api.columns().every(function(colIdx) {

    var that = this; // Set the header cell to contain the input element var
    cell = $('.filters th').eq($(api.column(colIdx).header()).index());
    if ([0, 1].includes(colIdx)) {
     var title = $(cell).text();
     $(cell).html('<input type="text" placeholder="' + title + '" />');

     // On every keypress in this input
     $(
       'input',
       $('.filters th').eq($(api.column(colIdx).header()).index())
      )
      .off('keyup change')
      .on('keyup change', function(e) {
       e.stopPropagation();

       if (that.search() !== this.value) {
        that
         .search(this.value)
         .draw();
       }
      });
    } else {
     $(cell).html('');
    }
   });

  }

 });
});
</script>
<?php


include("shared/layout/footer.php");