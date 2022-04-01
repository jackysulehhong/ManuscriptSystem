<?php
include_once("shared/connect.php");


include("shared/layout/header.php");
function getHardcopy($conn)
{
  $userID = $_SESSION['curUser']['id'];
  $position = $_SESSION['curUser']['position'];
  return query($conn, "SELECT manuscript.* FROM `manuscript` JOIN `user_account` ON manuscript.authorID=user_account.id WHERE `status`='publish'");
}

?>
<div class="container my-5">
 <h2 class="text-center">Hardcopy Status List</h2>

 <?php
  $result = getHardcopy($conn);
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
      <td>' .  ($row['hardcopy'] == 1 ? 'Sent' : 'Pending')  . '</td>
     <td class="text-center">

    <a href="manuscriptApproval.php?id=' . $row['id']  . '" class="btn btn-primary">View More</a>

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

 $.fn.datepicker.defaults.format = "yyyy-mm-dd";
 $(function() {
  $("#datepicker").datepicker({
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
   searchDate = new Date(searchDate);
   var curDate = new Date(data[3]);
   console.log(searchDate == curDate);

   if (searchDate >= curDate && searchDate <= curDate)
    return true;
   return false;
  });

 $('#tablelist').DataTable({
  dom: 'Bfrtip',
  buttons: [{
   extend: 'pdf',
   exportOptions: {
    columns: [0, 1, 2, 3, 4]
   },
   title: 'Hardcopy List',
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