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

if(isset($_POST['willlike'])){
    $_POST['willlike'] = "like";
}
else{
    $_POST['willlike'] = "";
}

if($_POST['upitem'] == "" && $_POST['delitem'] == "" && $_POST['willlike'] == "")
{
    header("location:index.php");
}

///////////////////////////////////////////////////////

if($_POST['upitem']=="upd"){

$upmngid = htmlspecialchars($_POST['mngid'] ?? "");
$updinge = htmlspecialchars($_POST['upinge'] ?? "");
$updhowto = htmlspecialchars($_POST['uphowto'] ?? "");
    
$goupitem = $_POST['mngid'];
$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "wongnok";
$objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

mysqli_set_charset($objCon, "utf8");

$sqlupmngid = mysqli_real_escape_string($objCon, $upmngid);
$sqlupinge = mysqli_real_escape_string($objCon, $updinge);
$sqluphowto = mysqli_real_escape_string($objCon, $updhowto);

$updall = "UPDATE recipes SET ringe = '$sqlupinge', rdetail = '$sqluphowto' WHERE rid = '$sqlupmngid'";
mysqli_query($objCon, $updall);

mysqli_close($objCon);
header("Location: addrecipe.php");
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

$godelhid = "DELETE FROM hisview WHERE rid IN (SELECT rid FROM recipes WHERE rid = '$godelid')";
mysqli_query($objCon, $godelhid);

$godel = "DELETE FROM recipes WHERE rid = '$godelid'";
mysqli_query($objCon, $godel);

mysqli_close($objCon);
header("Location: addrecipe.php");

}

if($_POST['willlike'] == "like"){
    session_start();
    $chkitemlike = $_POST['ritemid'];
    $userlikeid = $_SESSION['showid'];

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

    mysqli_set_charset($objCon, "utf8");

    $golike = "UPDATE viewlike SET gotlike = gotlike + 1 WHERE rid IN (SELECT rid FROM viewlike WHERE rid = '$chkitemlike')";
    mysqli_query($objCon, $golike);

    $inslikehis = "INSERT INTO hislike(userlike,itemlike) VALUES('$userlikeid','$chkitemlike')";
    mysqli_query($objCon, $inslikehis);

    session_write_close();
    echo "<script>window.close();</script>";
    
}
?>