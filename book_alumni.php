<?php
session_start();
if(isset($_SESSION['userid']))
{
  $userid = $_SESSION["userid"];
  $con= new mysqli("localhost","root","","alumni");
  $slot=$_POST["slot"];
  $date=$_POST["date"];
  $data = explode('-', $date);
  $today = date("d");

  if ($data[2]-$today >= 7) {
    $studentbookings = $con->query("select * from bookings where user_id=".$userid." and status=2");
    if ($studentbookings->num_rows >= 2) {
      echo "<script>alert('You have already booked 2 slots');document.location='index.php'</script>";
    }else {
      $sql=$con->query("insert into bookings(user_id,slot_id,date,status) values('".$userid."','".$slot."','".$date."',1) ");
      if ($sql) {
        echo "<script>alert('Booked successfully');document.location='student_dashboard.php'</script>";
      }else {
        echo "<script>alert('unable to book');document.location='student_dashboard.php'</script>";
      }
    }
  }else {
    echo "<script>alert('You can book the slot only 7days before');document.location='student_dashboard.php'</script>";
  }
}else {
  echo "<script>alert('Unauthorized access');document.location='logout.php'</script>";
}


?>
