<?php
include_once("shared/connect.php");


include("shared/layout/header.php");
function getCategory($conn)
{
  return query($conn, "SELECT * FROM `category`");
}

?>
<div class="container my-5">
 <h2 class="text-center">Category List</h2>
 <div class="text-center py-3">
  <a href="addCategory.php" class="btn btn-primary">Add a Category</a>
 </div>
 <?php
  $result = getCategory($conn);
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
     <th>ID</th>
     <th>Category Name</th>
    </tr>

   </thead>
   <tbody>
    <?php
        while ($row = mysqli_fetch_assoc($result)) {
          echo '    <tr>
     <td>' . $row['id'] . '</td>
      <td>' . $row['name'] . '</td>
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
 //https://datatables.net/forums/discussion/53287/how-to-reset-values-in-individual-column-searching-text-inputs-at-a-button-click

 $('#tablelist').DataTable({
  dom: 'Bfrtip',
  buttons: ['pdf'],
  orderCellsTop: true,
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