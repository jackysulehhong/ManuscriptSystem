<?php
include_once("shared/connect.php");


include("shared/layout/header.php");
function getReviewer($conn)
{
  $userID = $_SESSION['curUser']['id'];
  $position = $_SESSION['curUser']['position'];
  return query($conn, "SELECT user_account.*,COUNT(*) AS 'total',sum(case when review.status = 'pending' then 1 else 0 end) AS pendingCount,sum(case when review.status = 'complete' then 1 else 0 end) AS completeCount FROM user_account JOIN review ON review.reviewerID=user_account.id WHERE position='reviewer' GROUP BY  user_account.id ");
}



?>
<div class="container my-5">
 <h2 class="text-center">Reviewer List</h2>

 <?php
  $result = getReviewer($conn);
  if (mysqli_num_rows($result) == 0) {
    echo '<div class="card">
   <div class="card-body">
   No data
   </div>
  </div>';
  } else {


  ?>
 <div class="table-responsive">
  <table class="table table-hover table-light" id="tablelist">
   <thead>
    <tr>
     <th>Name</th>
     <th>Expertise</th>
     <th>Total Reviews Count</th>
     <th>Completed Reviews Count</th>
     <th>Pending Reviews Count</th>
    </tr>

   </thead>
   <tbody>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo '    <tr>
     <td>' . $row['name'] . '</td>
     <td>' . $row['expertise'] . '</td>
     <td>' . $row['total'] . '</td>
     <td>' . $row['completeCount'] . '</td>
    <td>' . $row['pendingCount'] . '</td>
    </tr>';
        }
      }
        ?>

   </tbody>
  </table>
 </div>
</div>

<!--
 <script src="./shared/script/bootstrap.bundle.min.js"></script>
 <script src="./shared/script/jquery.dataTables.min.js"></script>
<script src="./shared/script/dataTables.buttons.min.js"></script>
<script src="./shared/script/dataTables.bootstrap5.min.js"></script>
-->

<!-- bootstrap-datepicker -->

<?php
include("shared/layout/script.php");
?>
<link rel="stylesheet" type="text/css"
 href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<script type="text/javascript"
 src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {


 $('#tablelist thead tr')
  .clone(true)
  .addClass('filters')
  .appendTo('#tablelist thead');


 $('#tablelist').DataTable({
  "order": [
   [2, "desc"]
  ],
  dom: 'Bfrtip',
  buttons: [{
   extend: 'pdf',
   title: 'Reviewer List'
  }],
  orderCellsTop: true,
  initComplete: function() {
   var api = this.api(); // For each column api
   api.columns().every(function(colIdx) {

    var that = this; // Set the header cell to contain the input element var
    cell = $('.filters th').eq($(api.column(colIdx).header()).index());
    if ([0, 1, 2, 3, 4].includes(colIdx)) {
     var title = $(cell).text();
     if (title == "Date") {
      $(cell).html('<input type="text" id="datepicker" placeholder="' + title + '" />');
     } else {
      $(cell).html('<input type="text" placeholder="' + title + '" />');
     }

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