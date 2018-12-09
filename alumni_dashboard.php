<?php
session_start();
if(isset($_SESSION['userid']))
{
  $userid = $_SESSION["userid"];
  $con = new mysqli("localhost","root","","alumni");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      table,th,td{
         border:1px solid black;
         padding: 7px 20px;
         text-align: center;
      }
    </style>
  </head>
  <body>
    <center>
      <a href="logout.php"><button style="float:right;margin-right:20px;">Logout</button></a>
      <h1>student alumni booking list</h1>
      <table>
        <tr>
          <th>slno</th>
          <th>studentname</th>
          <th>slottime</th>
          <th>date</th>
          <th>status</th>
          <th>action</th>
        </tr>
        <?php
          $sql=$con->query("select bookings.*,username,slot_time from bookings inner join user on user.id=bookings.user_id inner join alumni_slots on bookings.slot_id=alumni_slots.id");
          if ($sql->num_rows>0) {
            $sno = 1;
            while ($row=$sql->fetch_array()) {
            echo "<tr><td>";
            echo $sno++;
            echo "</td><td>";
            echo $row["username"];
            echo "</td><td>";
            echo $row["slot_time"];
            echo "</td><td>";
            echo $row["date"];
            echo "</td><td>";
            if ($row["status"]==0) {
              echo "rejected";
            }elseif ($row["status"]==1) {
              echo "pending";
            }else {
              echo "accepted";
            }
            echo "</td><td>";
            if ($row["status"]==0) {
              echo "<a href='accept.php?userid=".$row["user_id"]."&bookingid=".$row["id"]."'>accept</a>";
            }elseif ($row["status"]==1) {
              echo "<a href='accept.php?userid=".$row["user_id"]."&bookingid=".$row["id"]."'>accept</a> | <a href='reject.php?userid=".$row["user_id"]."&bookingid=".$row["id"]."'>reject</a>";
            }else {
              echo "<a href='reject.php?userid=".$row["user_id"]."&bookingid=".$row["id"]."'>reject</a>";
            }
            echo "</td></tr>";
            }
          }else {
            echo "<tr><td>no data</td></tr>";
          }
        ?>
      </table>
    </center>
  </body>
</html>

<?php
}else {
  echo "<script>alert('Unauthorized access');document.location='logout.php'</script>";
}
 ?>
