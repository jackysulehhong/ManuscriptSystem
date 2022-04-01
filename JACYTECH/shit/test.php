<?php
include_once("shared/connect.php");
include_once("DatabaseModel.php");
$db = Database::getInstance();

$mysqli = $db->getConnection();
$result = $db->query("SELECT * FROM `category`");
var_dump(mysqli_fetch_all($result));

include("shared/layout/header.php");

if (isset($_POST) && !empty($_POST)) {
 $str = implode("|", $_POST['category']);

 $arr = explode("|", $str);
 $index = 0;
 $query = "";

 foreach ($arr as $x) {

  if ($index != 0) {
   $query .= " OR ";
  };
  $query .= "`expertise` LIKE %$x% ";
  $index++;
 }
 var_dump($query);
}
?>
<form action="test.php" method="post">
 <select class="form-select" multiple name="category[]" required>
  <?php
  $categoryResult = query($conn, "SELECT `name` FROM `category`");
  while ($row = mysqli_fetch_assoc($categoryResult)) {
   echo ' <option value="' . $row['name'] . '">' . $row['name'] . '</option>';
   echo ' <option value="' . $row['name'] . '">' . $row['name'] . '</option>';
   echo ' <option value="' . $row['name'] . '">' . $row['name'] . '</option>';
  }

  while ($row = mysqli_fetch_assoc($result)) {
   echo '    <tr>
     <td>' . $row['id'] . '</td>
     <td>' . $row['title'] . '</td>
     <td>' . $row['type'] . '</td>
     <td>' . date('Y-m-d', strtotime($row['created_At'])) . '</td>
     ';
     if($row['status']=='pending'){
     echo' <td>Pending</td>';
     } else     if ($row['status'] == 'pending') {
    echo ' <td>Pending</td>';
   } else     if ($row['status'] == 'reject') {
    echo ' <td>Rejected</td>';
   } else     if ($row['status'] == 'approve') {
    echo ' <td>Approve</td>';
   } else     if ($row['status'] == 'pendingAssign') {
    echo ' <td>Waiting for assign reviewer</td>';
   } else     if ($row['status'] == 'pendingReview') {
    echo ' <td>Waiting for Review</td>';
   }
     echo'
     <td class="text-center">
     ';
  ?>

 </select>
 <button type="submit">Submit</button>

</form>
<?php


include("shared/layout/footer.php");