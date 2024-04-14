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

if(isset($_POST['menuchoose'])){
    $_POST['menuchoose'] = "addrecipes";
}
else{
    $_POST['menuchoose'] = "";
}

if(isset($_POST['comitem'])){
    $_POST['comitem'] = "addall";
}
else{
    $_POST['comitem'] = "";
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

if($_POST['menuchoose'] == "addrecipes"){
    header("location:addrecipe.php");
}

if($_POST['comitem'] == "addall"){
    
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // Check file extension
        if (!in_array($file_extension, $allowed_types)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }

        // Check file size (max 5MB)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit;
        }

        // Generate unique file name to prevent overwriting existing files
        $file_name = uniqid() . '.' . $file_extension;

        // Move uploaded file to desired directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $file_name)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file was uploaded.";
    }

    session_start();
    $userid = $_SESSION['showid'];

    $serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "wongnok";
    $objCon = mysqli_connect($serverName, $userName, $userPassword, $dbName);
    
    mysqli_set_charset($objCon, "utf8");

    $insname = $_POST['menuname'];
    $insinge = $_POST['inge'];
    $inshowto = $_POST['howto'];

    $insnames = mysqli_real_escape_string($objCon, $insname);
    $insinges = mysqli_real_escape_string($objCon, $insinge);
    $inshowtos = mysqli_real_escape_string($objCon, $inshowto);
    $insimgname = mysqli_real_escape_string($objCon, $file_name);

    $insrecipe = "INSERT INTO recipes(rname,ringe,rdetail,rpic,rview,id) VALUES('$insnames','$insinges','$inshowtos','$insimgname','0','$userid')";
    mysqli_query($objCon, $insrecipe);

    $selforlike = "SELECT rid FROM `recipes` ORDER BY rid DESC LIMIT 1";
    $getrerid = mysqli_query($objCon, $selforlike);
    $rerid = mysqli_fetch_array($getrerid,MYSQLI_ASSOC);
    $reridlast = $rerid['rid'];
    $insvlike = "INSERT INTO viewlike(id,rid,gotlike) VALUES('$userid','$reridlast',0)";
    mysqli_query($objCon, $insvlike);

    session_write_close();
    mysqli_close($objCon);
    header("location:index.php");
}
?>