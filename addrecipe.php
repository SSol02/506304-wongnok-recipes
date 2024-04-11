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
        &emsp;&ensp;&nbsp;ชื่อเมนู : <input type="text" name="menuname"><br><br>
        รายละเอียด : <textarea name="howto" rows="10" cols="50" placeholder="ใส่วัตถุดิบและวิธีทำ" style="vertical-align:middle;"></textarea><br><br>
        รูปภาพ(ขนาดไม่เกิน 5MB) : <input type="file" name="image" accept="image/*"><br><br>
        <button type="submit" name="comitem" value="addall">เพิ่มสูตร
        </form>
        </div>
        <div><h2>ลบสูตรอาหาร</h2>
        </div>
    </body>
</html>
<?php } else {
    header("Location: index.php");
}
?>