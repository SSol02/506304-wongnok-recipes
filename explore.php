<?php
if($_POST['itemid'] == "" && $_POST['ownuser'] == ""){
    //header("location:index.php");
    echo "here";
}
$recipesid = $_POST['itemid'];
$userid = $_POST['ownuser'];
$reuser = $_POST['ownrecipes'];

session_start();

if(isset($_COOKIE['session_cookie'])) {
    $session_id = $_COOKIE['session_cookie'];

} else {
    $session_id = uniqid();

    $cookie_name = "session_cookie";
    $cookie_value = $session_id;
    $cookie_expiration = time() + 86400;

    setcookie($cookie_name, $cookie_value, $cookie_expiration, '/');
}

if($recipesid != ""){
    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
  
    mysqli_set_charset($objCon, "utf8");

    $srcview = "SELECT huser,rid FROM hisview WHERE huser = '$session_id' AND rid = '$recipesid'";
    $sqlsrcview = mysqli_query($objCon, $srcview);
    $getsrcview = mysqli_fetch_array($sqlsrcview,MYSQLI_ASSOC);

    if(!$getsrcview){
        $upview = "UPDATE recipes SET rview = rview + 1 WHERE rid = '$recipesid'";
        mysqli_query($objCon, $upview);

        $inshisview = "INSERT INTO hisview(huser,rid) VALUES('$session_id','$recipesid')";
        mysqli_query($objCon, $inshisview);
    }
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
    ?>
    <br><br>
    <?php
    $chkusername = htmlspecialchars($_SESSION['showuser'] ?? "");
    $chkuserid = htmlspecialchars($_SESSION['showid'] ?? "");
    if($chkusername == ""){ ?>
    &emsp;&emsp;&emsp;<button type="submit" onclick="myFunction()" class="btn">ถูกใจ</button>
    <?php }

    else if($chkusername != "" && ($reuser == $chkusername)){ ?>
    &emsp;&emsp;&emsp;<button type="submit" class="btn" disabled>ถูกใจ</button>
    <?php }

    else if($chkusername != "" && ($reuser != $chkusername)){ 
        $chkwholike = "SELECT likeid FROM hislike WHERE userlike='$chkuserid' AND itemlike='$recipesid'";
        $sqlwholike = mysqli_query($objCon, $chkwholike);
        $reswholike = mysqli_fetch_array($sqlwholike,MYSQLI_ASSOC);
        if(!$reswholike){
        ?>
            <form name="belike" method="post" action="mng.php" target="_blank" onsubmit="setTimeout(function(){ location.reload(); }, 500);">
            <input type="hidden" name="ritemid" value="<?php echo $recipesid;?>">
            &emsp;&emsp;&emsp;<button type="submit" name="willlike" value="like" class="btn">ถูกใจ</button>
            </form>
    <?php }
        else {
        echo '&emsp;&emsp;&emsp;<button type="submit" class="btn" disabled>ถูกใจแล้ว</button>';
        }
    }

    session_write_close();
    mysqli_close($objCon);
    ?>
    </body>
    </html>
    <script>
    function myFunction() {
    alert("กรุณาเข้าสู่ระบบ");
    window.location.href = "login.php";
    }
    </script>