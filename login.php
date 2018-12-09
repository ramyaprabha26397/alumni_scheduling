<?php
session_start();
$con = new mysqli("localhost","root","","alumni");
$username=$_POST["username"];
$password=$_POST["password"];
$sql = $con->query("select * from user where username='".$username."'");
if ($sql->num_rows > 0) {
  $row=$sql->fetch_assoc();
  if ($password==$row["password"]) {
    if ($row["user_type"]==0) {
      $_SESSION['userid'] = $row["id"];
      echo "<script>document.location='student_dashboard.php'</script>";
    }else if ($row["user_type"]==1){
      $_SESSION['userid'] = $row["id"];
      echo "<script>document.location='alumni_dashboard.php'</script>";
    }else {
      echo "<script>alert('Unauthorized access');document.location='index.php'</script>";
    }
  }else {
    echo "<script>alert('Password Incorrect');document.location='index.php'</script>";
  }
}else {
  echo "<script>alert('User not found');document.location='index.php'</script>";
}
 ?>
