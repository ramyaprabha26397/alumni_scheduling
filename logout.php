<?php
session_start();
if(isset($_SESSION['userid']))
{
	$_SESSION["userid"] = "";
	session_destroy();
  echo "<script>document.location='index.php'</script>";
}else {
  echo "<script>document.location='index.php'</script>";
}
?>
