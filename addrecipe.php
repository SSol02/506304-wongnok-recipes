<?php
session_start();
if($_SESSION['showuser'] != "" && $_SESSION['showid'] != ""){
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Wongnok : สูตรอาหารวงนอก
        </title>
    </head>
    <body>
        <div><h2>เพิ่มสูตรอาหาร</h2>
        <form name="addre" method="post" action="commitpage.php" enctype="multipart/form-data">
        ชื่อเมนู : <input type="text" name="menuname"><br><br>
        วัตถุดิบ : <textarea name="inge" rows="10" cols="50" placeholder="ใส่วัตถุดิบ" style="vertical-align:middle;"></textarea><br><br>
        &ensp;วิธีทำ : <textarea name="howto" rows="10" cols="50" placeholder="ใส่วิธีทำ" style="vertical-align:middle;"></textarea><br><br>
        รูปภาพ(ขนาดไม่เกิน 5MB) : <input type="file" name="image" accept="image/*"><br><br>
        <button type="submit" name="comitem" value="addall">เพิ่มสูตร</button>
        </form>
        </div>
        <div><h2>จัดการสูตรอาหาร</h2>
        <?php 
        $idformng = $_SESSION['showid'];
        $serverName = "localhost";
        $userName = "root";
        $userPassword = "";
        $dbName = "wongnok";
        $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    
        mysqli_set_charset($objCon, "utf8");

        $listown = "SELECT recipes.rid,rname,viewid FROM recipes,viewlike WHERE recipes.rid = viewlike.rid AND recipes.id = '$idformng'";
        $comlistown = mysqli_query($objCon, $listown);
        while ($fetlistown = mysqli_fetch_array($comlistown, MYSQLI_ASSOC)) { ?>
            <form name="formng" method="post" action="mng.php">
            <input type="hidden" name="mngid" value="<?php echo $fetlistown['rid'];?>">
            <input type="hidden" name="vid" value="<?php echo $fetlistown['viewid'];?>">
            <div><?php echo $fetlistown['rname']," ";?>&ensp;
            <button type="submit" name="upitem" value="upd">แก้ไข</button>&ensp;
            <button type="submit" name="delitem" value="delt">ลบ</button></div><br>
        </form>
        <?php } 
        session_write_close();
        mysqli_close($objCon);?>
        </div>
    </body>
</html>
<?php } else {
    header("Location: index.php");
}
?>