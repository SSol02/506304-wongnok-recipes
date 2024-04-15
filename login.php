<!DOCTYPE html>
<html>
    <head>
        <title>
            Wongnok : เข้าสู่ระบบ
        </title>
        <link rel="stylesheet" href="regisform2.css">
    </head>
    <body onload="openForm(),openFormregis()">
    <div class="main">
        <div class="form-popup2" id="myForm">
      <form class="form-container" name="login" action="commitpage.php" method="post">
        <h2>เข้าสู่ระบบ</h2>
        <label for="logemail"><b>Email</b></label>
        <input type="text" name="email" placeholder="ใส่ Email ที่ลงทะเบียนไว้" required>

        <label for="logpsw"><b>Password</b></label>
        <input type="password" name="psw" placeholder="ใส่รหัสผ่านที่ลงทะเบียนไว้" required>

        <button type="submit" name="logbut" value="login" class="btn">เข้าสู่ระบบ</button>
      </form>
     </div>
    <!--Login-->
    <!--Regis-->
        <div class="form-popup" id="myFormregis">
      <form class="form-container" name="regis" action="commitpage.php" method="post">
        <h2>สมัครสมาชิก</h2>
        <label for="regisuser"><b>ชื่อที่แสดง</b></label>
        <input type="text" name="regisuser" placeholder="ชื่อที่จะแสดงในเว็บ" required>

        <label for="regisemail"><b>Email</b></label>
        <input type="text" name="regisemail" placeholder="Email" required>

        <label for="regispsw"><b>สร้างรหัสผ่านใหม่</b></label>
        <input type="password" name="regispsw" placeholder="รหัสผ่านที่ใช้สำหรับเว็บนี้เท่านี้" required>

        <button type="submit" name="regbut" value="regis" class="btn">สมัครสมาชิก</button>
      </form>
     </div>
    </div>
    <!--Regis-->
    </body>
</html>
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function openFormregis() {
  document.getElementById("myFormregis").style.display = "block";
}
</script>