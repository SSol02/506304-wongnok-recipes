<?php
if($_POST['itemid'] == "" && $_POST['ownuser'] == ""){
    header("location:index.php");
}
$recipesid = $_POST['itemid'];
$userid = $_POST['ownuser'];

session_start();

if (!isset($_SESSION['counter']) || !isset($_SESSION['visited'])) {
    $_SESSION['counter'] = 1;
    $_SESSION['visited'] = true;

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
  
    mysqli_set_charset($objCon, "utf8");

    $upview = "UPDATE recipes SET rview = rview + 1 WHERE rid = '$recipesid'";
    $sqlup = mysqli_query($objCon, $upview);

    session_write_close();
}

?>

<!DOCTYPE html>
<html>
    <head>
    <title>Wongnok : สูตรอาหารวงนอก</title>
    
    </head>
    <body>
    <?php 
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
  
    mysqli_set_charset($objCon, "utf8");

    $getdetail = "SELECT rname,ringe,rdetail,rpic,rview,user,viewid,gotlike FROM verilog,recipes,viewlike WHERE verilog.id = recipes.id AND recipes.rid = viewlike.rid AND recipes.rid = '$recipesid' AND recipes.id = '$userid'";
    $sqlgetdet = mysqli_query($objCon, $getdetail);
    $resdat = mysqli_fetch_array($sqlgetdet,MYSQLI_ASSOC);
    echo '<center>';
    echo '<br><br>';
    echo '<img src="uploads/',$resdat['rpic'],'" width="40%"'; echo '<br><br><br>';
    echo '</center>';
    echo "สูตรโดย ",$resdat['user']; echo '<br><br>';
    echo "ชื่อเมนู : ",$resdat['rname']; echo '<br><br>';
    echo "วัตถุดิบ : ",$resdat['ringe']; echo '<br><br>';
    echo "วิธีทำ : ",$resdat['rdetail'];





    mysqli_close($objCon);
    ?>
    </body>
    </html>