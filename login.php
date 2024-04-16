<!DOCTYPE html>
<html>
    <head>
        <title>
            Wongnok : เข้าสู่ระบบ
        </title>
        <link rel="stylesheet" href="regisform2.css">
    </head>
    <body>
    <div class="form-structor">
    <form name="regis" action="commitpage.php" method="post">
	<div class="signup">
		<h2 class="form-title" id="signup"><span>-</span>สมัครสมาชิก</h2>
		<div class="form-holder">
			<input type="text" name="regisuser" class="input" placeholder="ชื่อที่จะแสดงในเว็บ" required/>
			<input type="email" name="regisemail" class="input" placeholder="อีเมลล์" required/>
			<input type="password" name="regispsw" class="input" placeholder="รหัสผ่านที่ใช้สำหรับเว็บนี้เท่านั้น" required/>
		</div>
		<button class="submit-btn" name="regbut" value="regis">ตกลง</button>
  </form>
	</div>
  <form name="login" action="commitpage.php" method="post">
	<div class="login slide-up">
		<div class="center">
			<h2 class="form-title" id="login"><span>-</span>เข้าสู่ระบบ</h2>
			<div class="form-holder">
				<input type="email" name="email" class="input" placeholder="ใส่ Email ที่ลงทะเบียนไว้" required/>
				<input type="password" name="psw" class="input" placeholder="ใส่รหัสผ่านที่ลงทะเบียนไว้" required/>
			</div>
			<button class="submit-btn" name="logbut" value="login">เข้าสู่ระบบ</button>
    </form>
		</div>
	</div>
</div>
    </body>
</html>
<script>
console.clear();

const loginBtn = document.getElementById('login');
const signupBtn = document.getElementById('signup');

loginBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode.parentNode;
	Array.from(e.target.parentNode.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			signupBtn.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});

signupBtn.addEventListener('click', (e) => {
	let parent = e.target.parentNode;
	Array.from(e.target.parentNode.classList).find((element) => {
		if(element !== "slide-up") {
			parent.classList.add('slide-up')
		}else{
			loginBtn.parentNode.parentNode.classList.add('slide-up')
			parent.classList.remove('slide-up')
		}
	});
});
</script>