<?php
include_once("shared/connect.php");


include("shared/layout/header.php");
function updatePayment($conn)
{
 $manuscriptID = $_GET['id'];
 query($conn, "UPDATE manuscript SET `paid`=1,`status`='pendingPublish' WHERE id='$manuscriptID'");
}
updatePayment($conn);
?>
<div class="container p-5">
 <div class="d-flex align-items-center text-center justify-content-center">
  <div class="message">
   <img class="img-fluid resulticon" src="./assets/loading.gif" alt="Loading">
   <p class="fs-1 resultmessage">Processing Payment...</p>
  </div>
 </div>
</div>
<?php
include("shared/layout/script.php");
?>
<script>
$(document).ready(function() {

 var timeleft = 3;

 function chgStatus() {
  $(".resulticon").attr("src", "./assets/success.gif");
  //https://stackoverflow.com/a/6685505
  var downloadTimer = setInterval(function hello() {
   console.log(timeleft)
   if (timeleft <= 0) {
    clearInterval(downloadTimer);
    window.location.href = "listManuscript.php";
    $(".resultmessage").text(`Redirecting...`);

   } else {
    $(".resultmessage").innerHTML = 'here';
    $(".resultmessage").text(`Sucess. Redirecting in ${timeleft} seconds...`);
   }
   timeleft -= 1;
   return hello;
  }(), 1000);
 }
 setTimeout(chgStatus, 3000);
});
</script>
<?php
include("shared/layout/script.php");
?>

<?php
include("shared/layout/footer.php");