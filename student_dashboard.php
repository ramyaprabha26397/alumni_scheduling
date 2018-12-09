<?php
session_start();
if(isset($_SESSION['userid']))
{
  $userid = $_SESSION["userid"];
  $con = new mysqli("localhost","root","","alumni");
  $sql = $con->query("select * from user where id='".$userid."'");
  $row=$sql->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <center>
      <a href="logout.php"><button style="float:right;margin-right:20px;">Logout</button></a>
      <h1>Student Alumni Booking, Welcome <?php echo $row["username"]; ?></h1>
      <form class="" action="book_alumni.php" method="post">
        <label>Slot time : </label>
        <select class="" name="slot">
          <option value="1">Slot-1(1pm-2pm)</option>
          <option value="2">Slot-2(4pm-5pm)</option>
          <option value="3">Slot-3(6pm-7pm)</option>
        </select><br><br>
        <label>Date : </label>
        <input type="date" name="date"><br><br>
        <input type="hidden" name="userid" value="<?php echo $userid ?>">
        <input type="submit" value="Book">
      </form>
    </center>

  </body>
</html>

<?php
}else {
  echo "<script>alert('Unauthorized access');document.location='logout.php'</script>";
}
 ?>
