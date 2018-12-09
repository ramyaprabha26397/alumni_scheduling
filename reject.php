<?php
$con=new mysqli("localhost","root","","alumni");
$userid=$_GET["userid"];
$bookingid=$_GET["bookingid"];
$sql=$con->query("update bookings set status=0 where id=".$bookingid."");
if ($sql) {
  echo "<script>document.location='alumni_dashboard.php'</script>";
}else {
  echo "unable to reject";
}
 ?>
