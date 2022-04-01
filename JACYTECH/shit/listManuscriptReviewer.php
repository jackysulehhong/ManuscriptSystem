<?php
include_once("shared/connect.php");


include("shared/layout/header.php");
function getManuscript($conn)
{
 $reviewerID = $_SESSION['curUser']['id'];
 return query($conn, "SELECT manuscript.* FROM `manuscript` JOIN `review` ON manuscript.id=review.manuscriptID WHERE review.reviewerID='$reviewerID' ");
}

?>
<div class="container my-5">
 <h2 class="text-center">Manuscript List</h2>

 <?php
 $result = getManuscript($conn);
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
     <th>Manuscript ID</th>
     <th>Title</th>
     <th>Article Type</th>
     <th>Date</th>
     <th>Status</th>
     <th></th>
    </tr>

   </thead>
   <tbody>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
     echo '    <tr>
     <td>' . $row['id'] . '</td>
     <td>' . $row['title'] . '</td>
     <td>' . $row['type'] . '</td>
     <td>' . date('Y-m-d', strtotime($row['created_At'])) . '</td>
      <td>' . getStatusMessage($row['status']) . '</td>
     <td class="text-center"><button class="btn btn-primary" type="button"><a href="manuscriptStatus.php?id=' . $row['id']  . '" class="text-white text-decoration-none">View More</a>
     </td>
    </tr>';
    }
   }
    ?>

   </tbody>
  </table>
 </div>
</div>

<!--
 <script src="./shared/script/bootstrap.bundle.min.js"></script><script src="./shared/script/jquery-3.5.1.js"></script>

<script src="./shared/script/jquery.dataTables.min.js"></script>
<script src="./shared/script/dataTables.buttons.min.js"></script>
<script src="./shared/script/dataTables.bootstrap5.min.js"></script>
-->

<!-- bootstrap-datepicker -->
<link rel="stylesheet" type="text/css"
 href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<script type="text/javascript"
 src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<?php
include("shared/layout/script.php");
?>
<script>
$(document).ready(function() {

 $('#tablelist thead tr')
  .clone(true)
  .addClass('filters')
  .appendTo('#tablelist thead');

 $(function() {
  $("#datepicker").datepicker({
   dateFormat: 'yy-mm-dd',
   changeYear: true,
   changeMonth: true,

  });
 });

 $.fn.dataTable.ext.search.push(
  function(settings, data, dataIndex) {
   var searchDate = $('#datepicker').val();
   if (searchDate == null || searchDate == '') {
    return true;
   }
   searchDate = new Date(searchDate).valueOf();
   var curDate = new Date(data[3]).valueOf();
   console.log(searchDate == curDate)

   if (searchDate >= curDate && searchDate <=
    curDate) {
    return true;
   } else return false;
  });
 $('#tablelist').DataTable({
  "columnDefs": [{
   orderable: false,
   targets: [3]
  }],
  searching: false,
  //https://datatables.net/forums/discussion/53287/how-to-reset-values-in-individual-column-searching-text-inputs-at-a-button-click
  /** orderCellsTop: true, fixedHeader: true, initComplete: function() { var api=this.api(); // For each column api
 .columns([0, 1, 2, 3]) .every(function(colIdx) { var that=this; // Set the header cell to contain the input element var
 cell=$('.filters th').eq( $(api.column(colIdx).header()).index() ); var title=$(cell).text(); if (title=="Status" ) {
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
});

}
*/
 });
});
</script>
<?php


include("shared/layout/footer.php");