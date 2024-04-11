<?php
if($_POST['delid']==""){
    header("Location: index.php");
}
else{
$godelid = $_POST['delid'];
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "wongnok";
$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

mysqli_set_charset($objCon, "utf8");

$godel = "DELETE FROM recipes WHERE rid = '$godelid'";
mysqli_query($objCon, $godel);
mysqli_close($objCon);
header("Location: addrecipe.php");
}
?>