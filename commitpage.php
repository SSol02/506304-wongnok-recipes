<?php
if(isset($_POST['logbut'])){
    $_POST['logbut'] = "login";
}
else{
    $_POST['logbut'] = "";
}
if(isset($_POST['regbut'])){
    $_POST['regbut'] = "regis";
}
else{
    $_POST['regbut'] = "";
}
if($_POST['logbut'] == "login"){
    $email = htmlspecialchars($_POST['email'] ?? "");
    $psw = htmlspecialchars($_POST['psw'] ?? "");

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    
    mysqli_set_charset($objCon, "utf8");
    $beqemail = mysqli_real_escape_string($objCon, $email);
    $beqpsw = mysqli_real_escape_string($objCon, $psw);

    $chklog = "SELECT id,user,email,pass FROM verilog WHERE email = '$beqemail' AND pass = '$beqpsw'";
    $dosql = mysqli_query($objCon, $chklog);
    $getveri = mysqli_fetch_array($dosql,MYSQLI_ASSOC);
    if(!$getveri)
    {
        mysqli_close($objCon);
        header("location:index.php");
    }
    else {
        session_start();
        $_SESSION['showuser'] = $getveri['user'];
        $_SESSION['showid'] = $getveri['id'];
        mysqli_close($objCon);
        session_write_close();
        header("location:index.php");
    }
}
if($_POST['regbut'] == "regis"){
    $regisuser = htmlspecialchars($_POST['regisuser'] ?? "");
    $regisemail = htmlspecialchars($_POST['regisemail'] ?? "");
    $regispsw = htmlspecialchars($_POST['regispsw'] ?? "");

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    
    mysqli_set_charset($objCon, "utf8");
    $beqregisuser = mysqli_real_escape_string($objCon, $regisuser);
    $beqregisemail = mysqli_real_escape_string($objCon, $regisemail);
    $beqregispsw = mysqli_real_escape_string($objCon, $regispsw);

    $ins = "INSERT INTO verilog(user,email,pass) VALUES('$beqregisuser','$beqregisemail','$beqregispsw')";
    $doins = mysqli_query($objCon, $ins);
    mysqli_close($objCon);
    header("location:index.php");
}
?>