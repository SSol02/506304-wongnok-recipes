<?php
if(isset($_POST['upitem'])){
    $_POST['upitem'] = "upd";
}
else{
    $_POST['upitem'] = "";
}

if(isset($_POST['delitem'])){
    $_POST['delitem'] = "delt";
}
else{
    $_POST['delitem'] = "";
}

if(isset($_POST['upcomitem'])){
    $_POST['upcomitem'] = "upaddall";
}
else{
    $_POST['upcomitem'] = "";
}

if($_POST['upitem'] == "" && $_POST['delitem'] == "" && $_POST['upcomitem'] == "")
{
    header("location:index.php");
}

///////////////////////////////////////////////////////

if($_POST['upitem']=="upd"){
    
$goupitem = $_POST['mngid'];
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "wongnok";
$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

mysqli_set_charset($objCon, "utf8");

$goup = "SELECT ringe,rdetail FROM recipes WHERE rid = '$goupitem'";
$sqlup = mysqli_query($objCon, $goup);
$resup = mysqli_fetch_array($sqlup,MYSQLI_ASSOC);
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    วัตถุดิบ : <textarea name="upinge" rows="10" cols="50" placeholder="ใส่วัตถุดิบ" style="vertical-align:middle;"><?php echo $resup['ringe']; ?></textarea><br><br>
    &nbsp;&ensp;วิธีทำ : <textarea name="uphowto" rows="10" cols="50" placeholder="ใส่วิธีทำ" style="vertical-align:middle;"><?php echo $resup['rdetail']; ?></textarea><br><br>
    <button type="submit" name="upcomitem" value="upaddall" style="margin-left: 200px;">แก้ไข</button>
</form>

<?php

mysqli_close($objCon);
}

////////////////////////////////////////////////////////

if($_POST['delitem']=="delt"){

$godelid = $_POST['mngid'];
$godelvid = $_POST['vid'];
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "wongnok";
$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

mysqli_set_charset($objCon, "utf8");

$godelvlike = "DELETE FROM viewlike WHERE viewid = '$godelvid'";
mysqli_query($objCon, $godelvlike);

$godel = "DELETE FROM recipes WHERE rid = '$godelid'";
mysqli_query($objCon, $godel);

mysqli_close($objCon);
header("Location: addrecipe.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["upcomitem"] == "upaddall") {
    /*$upreinge = $_POST['upinge'];
    $uprehowto = $_POST['uphowto'];
    $chkupinge = mysqli_real_escape_string($objCon, $upreinge);
    $chkuphowto = mysqli_real_escape_string($objCon, $uprehowto);

    $uptwotext = "UPDATE"
    */
}
?>