<!DOCTYPE html>
<html>
    <head>
        <title>
            Wongnok : สูตรอาหารวงนอก
        </title>
        <link rel="stylesheet" href="ofindex.css">
        <link rel="stylesheet" href="regisform.css">
    </head>
    <body>
    <?php 
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['showuser'] == ""){?>
    <!--Login-->
    <button class="open-button" onclick="openForm()">เข้าสู่ระบบ</button>
        <div class="form-popup" id="myForm">
      <form class="form-container" name="login" action="commitpage.php" method="post">
        <h2>เข้าสู่ระบบ</h2>

        <label for="logemail"><b>Email</b></label>
        <input type="text" name="email" placeholder="ใส่ Email ที่ลงทะเบียนไว้" required>

        <label for="logpsw"><b>Password</b></label>
        <input type="password" name="psw" placeholder="ใส่รหัสผ่านที่ลงทะเบียนไว้" required>

        <button type="submit" name="logbut" value="login" class="btn">เข้าสู่ระบบ</button>
        <button type="button" class="btn cancel" onclick="closeForm()">ยกเลิก</button>
      </form>
     </div>
    <!--Login-->
    <!--Regis-->
        <button class="open-button" style="margin: 0px 125px 0px 0px;"onclick="openFormregis()">สมัครสมาชิก</button>
        <div class="form-popup" id="myFormregis">
      <form class="form-container" name="regis" action="commitpage.php" method="post">
        <h2>สมัครสมาชิก</h2>

        <label for="regisuser"><b>ชื่อที่แสดง</b></label>
        <input type="text" name="regisuser" placeholder="ชื่อที่จะแสดงในเว็บ" required>

        <label for="regisemail"><b>Email</b></label>
        <input type="text" name="regisemail" placeholder="อีเมลล์" required>

        <label for="regispsw"><b>สร้างรหัสผ่านใหม่</b></label>
        <input type="password" name="regispsw" placeholder="รหัสผ่านที่ใช้สำหรับเว็บนี้เท่านั้น" required>

        <button type="submit" name="regbut" value="regis" class="btn">สมัครสมาชิก</button>
        <button type="button" class="btn cancel" onclick="closeFormregis()">ยกเลิก</button>
      </form>
     </div>
    <!--Regis-->
    <?php } else if($_SESSION['showuser'] != ""){?>
    <!--logout-->
      <form action="logout.php" method="post">
      <button class="open-button">ออกจากระบบ</button>
      </form>
    <!--logout-->
    <!--owner-->
      <button class="open-button" style="margin: 0px 125px 0px 0px;"onclick="openFormregis()"><?php echo $_SESSION['showuser'];?></button>
        <div class="form-popup" id="myFormregis">
      <form class="form-container" name="manage" action="commitpage.php" method="post">
      <h3>- เกี่ยวกับคุณ -</h3>
      <label for="menuchoose">จัดการข้อมูล : </label>
      <select name="menuchoose" required oninvalid="this.setCustomValidity('เลือกรายการก่อน')" oninput="setCustomValidity('')" style="vertical-align:middle;font: 14pt;font-weight: bold; padding: 5px;">
      <option value="" style="vertical-align:middle;font: 16pt;font-weight: bold;">เลือกรายการ</option>
      <option value="addrecipes" style="vertical-align:middle;">จัดการสูตรอาหาร</option>
      </select>
      <h5>หมายเลขสมาชิก : <?php echo $_SESSION['showid'];?></h5>
      <input type="hidden" name="userid" value="<?php echo $_SESSION['showid'];?>">
        <button type="submit" name="okay" value="okay" class="btn">ตกลง</button>
        <button type="button" class="btn cancel" onclick="closeFormregis()">ปิด</button>
      </form>
     </div>
    <!--owner-->
    
     <?php } session_write_close();?>
<!-- ---------------------------------------------------------------------------------------------------------->
        <center><img src="src/banner.jpg" style="width: auto; height: auto;"></center><br>
        <center><div><a href="?type=popular" style="text-decoration:none; color: #69c;">สูตรยอดฮิต</a>&nbsp;&nbsp;&emsp;
        <a href="?type=liked" style="text-decoration:none; color: #69c;">สูตรที่ถูกใจ</a>&nbsp;&nbsp;&emsp;
        <a href="?type=new" style="text-decoration:none; color: #69c;">สูตรมาใหม่</a></div></center><br><br>
        <div>
        <form name="srcmenu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <center><input type="textbox" name="menuspec" size="12" placeholder="ค้นหาจาก วัตถุดิบ หรือ ชื่อเมนู" style="font-size:11pt; width:220px;">&nbsp;
        <input type="submit" name="menusrc" value="ค้นหา" name="find"></center>
        </form>
        </div>
<div class="maindiv">
  <?php 
  $srctype = $_GET['type'];

  $serverName = "localhost";
  $userName = "root";
  $userPassword = "";
  $dbName = "wongnok";
  $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
  
  mysqli_set_charset($objCon, "utf8");
  
  if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['menuspec'] != ""){
    $forsrcmenu = htmlspecialchars($_POST['menuspec'] ?? "");
    $essrcmenu = mysqli_real_escape_string($objCon, $forsrcmenu);
    $getrecipe = "SELECT recipes.rid, rname, rpic, rview, user, gotlike, verilog.id FROM recipes JOIN verilog ON verilog.id = recipes.id JOIN viewlike ON recipes.rid = viewlike.rid WHERE (rname LIKE '%$essrcmenu%' OR ringe LIKE '%$essrcmenu%')";
  }

  if($_POST['menuspec'] == ""){
    $getrecipe = "SELECT recipes.rid,rname,rpic,rview,user,gotlike,verilog.id FROM recipes,verilog,viewlike WHERE verilog.id = recipes.id AND recipes.rid = viewlike.rid ORDER BY RAND() LIMIT 15";
  }
  
  if($srctype == "popular"){
    $forpop = htmlspecialchars($_GET['type'] ?? "");
    $espop = mysqli_real_escape_string($objCon, $forpop);
    $getrecipe = "SELECT recipes.rid,rname,rpic,rview,user,gotlike,verilog.id FROM recipes,verilog,viewlike WHERE verilog.id = recipes.id AND recipes.rid = viewlike.rid ORDER BY rview DESC LIMIT 15";
  }

  if($srctype == "new"){
    $fornew = htmlspecialchars($_GET['type'] ?? "");
    $esnew = mysqli_real_escape_string($objCon, $fornew);
    $getrecipe = "SELECT recipes.rid,rname,rpic,rview,user,gotlike,verilog.id FROM recipes,verilog,viewlike WHERE verilog.id = recipes.id AND recipes.rid = viewlike.rid ORDER BY recipes.rid DESC LIMIT 15";
  }

  if($srctype == "liked"){
    $forliked = htmlspecialchars($_GET['type'] ?? "");
    $esliked = mysqli_real_escape_string($objCon, $forliked);
    $getrecipe = "SELECT recipes.rid,rname,rpic,rview,user,gotlike,verilog.id FROM recipes,verilog,viewlike WHERE verilog.id = recipes.id AND recipes.rid = viewlike.rid ORDER BY gotlike DESC LIMIT 15";
  }
  
  $sqlgetrec = mysqli_query($objCon, $getrecipe);
  while ($recfet = mysqli_fetch_array($sqlgetrec, MYSQLI_ASSOC)) {
  ?>
  <div class="card">
  <form name="showitem" method="post" action="explore.php" target="_blank">
    <div class="container">
    <img src="uploads/<?php echo $recfet['rpic'];?>" width="100%">
    <h2><b><?php echo $recfet['rname'];?></b></h2>
    <h4>แจกสูตรโดย : <?php echo $recfet['user'];?></h4>
    <h4>ยอดคนดู <?php echo $recfet['rview'];?></h4>
    <h4>ยอดคนถูกใจ <?php echo $recfet['gotlike'];?></h4>
    <input type="hidden" name="itemid" value="<?php echo $recfet['rid'];?>">
    <input type="hidden" name="ownuser" value="<?php echo $recfet['id'];?>">
    <input type="hidden" name="ownrecipes" value="<?php echo $recfet['user'];?>">
    <button type="submit" name="viewmore" value="getshow">ดูเพิ่มเติม...</button>
    </div>
    </form>
  </div>
  <?php } mysqli_close($objCon);?>
</div>
    </body>
</html>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function openFormregis() {
  document.getElementById("myFormregis").style.display = "block";
}

function closeFormregis() {
  document.getElementById("myFormregis").style.display = "none";
}
</script>