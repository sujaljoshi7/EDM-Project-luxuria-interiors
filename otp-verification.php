<?php
include 'dbconnect.php';
session_start();

if (isset($_SESSION['user_loggedin'])) {
    $email = $_SESSION['user_email'];
    $accountsql = "SELECT * FROM user where email = '$email'";
    $fetchaccount = mysqli_query($conn,$accountsql);
    $accountresult = mysqli_fetch_array($fetchaccount);
    $otp = $accountresult['otp'];
    if ($accountresult["active"] == 0) {
        header("location: account-disabled.php");
        exit;
    }elseif ($accountresult["verification"] == 1) {
        header("location: index.php");
        exit;
    }
}



if(isset($_POST['submit'])){
    $otpString = mysqli_real_escape_string($conn, $_POST['r_otp']);
    if($otp==$otpString){
        $updateSql= "UPDATE `user` SET `verification` = '1' WHERE `email` = '$email'";
        mysqli_query($conn,$updateSql);
        header("Location:index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Input Form Design</title>
    <link rel="stylesheet" href="style.css" />
<style>
body
{
margin:0;
padding:0;
font-family:sans-serif;
background:rgba(233,119,48,0.8);
}
.box
{
 position:absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
width:400px;
padding:40px;
background:rgba(0,0,0,.8);
box-sizing:border-box; 
box-shadow:0 15px 25px rgba(0,0,0,.5);
border-radius:10px;
}
.box h2
{
	margin:0 0 30px;
	padding:0;
	color:#fff;
	text-align:center;
}
.box h4
{
	margin:0 0 30px;
	padding:0;
	color:#fff;
	text-align:left;
}
.box .inputbox
{
	position:relative;
	
}
.box .inputbox input
{
	width:100%;
	padding:10px 0;
	font-size:16px;
	color:#fff;
	letter-spacing:1px;
	margin-bottom:30px;
	border:none;
	border-bottom:1px solid #fff;
	outline:none;
	background:transparent;
	}
.box .inputbox label
{
	position:absolute;
	top:0;
	left:0;
	padding:10px 0;
	font-size:16px;
	color:#fff;
	pointer-events:none;
	transition:.5s;
}
.box .inputbox input:focus~label,
.box .inputbox input:valid~label

{
	top:-18px;
	left:0;
	color:#E97730;
	font-size:12px;
}
.box input[type="submit"]
{
	background:transparent;
	border:none;
	outline:none;
	color:#fff;
	background:#E97730;
	padding:10px 20px;
	cursor:pointer;
	border-radius:5px;
}
</style>
  </head>
  <body>
    <div class="box">
      <h2>Enter OTP</h2>
      <h4>Enter OTP you received on the registered email.</h4>
      <form method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="inputbox">
          <input type="text" name="r_otp" required="" minlength="6" maxlength="6" />
          <label>OTP</label>  
        </div>
        <input type="submit" name="submit" value="Submit" />
        <input type="submit" name="resend" value="Resend" />
      </form>
    </div>
  </body>
</html>
