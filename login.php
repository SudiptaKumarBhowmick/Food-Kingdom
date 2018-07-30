<!DOCTYPE html>
<html>
<head>
<title>LogIn</title>
<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet"> 
<style>
body{
	background-color:#3A4563;
}
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #647AE0;
    color: white;
    padding: 10px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
	font-size: 22px;
}

button:hover{
	background-color: #2F4494;
	transition:1s;
}

.container {
    padding: 16px;
	width:300px;
	margin: 160px auto;
}
h2{
	text-align:center;
    font-family: 'Satisfy', cursive;
	color:#fff;
	font-size: 30px;
}
a{
	color:#fff;
	text-style:none;
}
</style>
</head>
<body>

<form method="post" action="login.php">
  <div class="container">
  <h2>Access your Account</h2>
  
    <input type="text" placeholder="example@gmail.com" name="email" required>
    <input type="password" placeholder="your password" name="psw" required>

    <button type="submit" class="loginbtn" name="submit">Log In</button>
	<a href="registration.php">Not a registered user?<a>
  </div>
</form>

<?php
session_start();
$numbers = array();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(isset($_POST['submit'])){
	$email = $_POST['email'];
	$password = $_POST['psw'];
	
    $query = "SELECT * FROM user_authentication WHERE email = '$email' AND pass = '$password'";
    $res = mysqli_query($db_handle->connectDB(), $query);	
	if (mysqli_num_rows($res) == 1) {
                $row = mysqli_fetch_array($res);
                $_SESSION['email'] = $row[0];
                $_SESSION['password'] = $row[1];
				if($row[2] != null){
                $_SESSION['cid'] = $row[2];
				header("refresh:0; url=home.php");}
				if($row[3] != null){
                $_SESSION['pid'] = $row[3];
				header("refresh:0; url=user.php");}
				if($row[4] != null){
                $_SESSION['sid'] = $row[4];
				header("refresh:0; url=SupplierProfile.php");}
 }
	
}
?>

</body>
</html> 