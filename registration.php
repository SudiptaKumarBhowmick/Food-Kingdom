<!DOCTYPE html>
<html>
<head>
<title>Registration Form</title>
<link href="https://fonts.googleapis.com/css?family=Courgette&amp;subset=latin-ext" rel="stylesheet">
<style>
body{
	background-color:#2D3E50;
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
    background-color: #27A69B;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover{
	background-color: #E10000;
	transition:1s;
}

.signupbtn {
float: left;
width: 65%;
margin-top: 30px;
margin-left: 87px;
font-size: 21px;
font-weight:bold;
}

.container {
    padding: 16px;
	width:500px;
	border:1px solid #ccc;
	margin: 60px auto;
	background-color:#fff;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
h2{
	padding: 10px;
	margin-top: -17px;
	margin-bottom: 25px;
	text-align: center;
	background-color: #27A69B;
	margin-left: -17px;
	margin-right: -17px;
	color: #fff;
	font-size: 35px;
    font-family: 'Courgette', cursive;
}
</style>
</head>
<body>

<form method="post" action="registration.php" name="myForm" onsubmit="return(validate());">
  <div class="container">
  <h2>Signup Form</h2>
	<label><b>Customer Name</b></label>
    <input type="text" placeholder="Enter Customer Name" name="customername" required>
  
    <label><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label><b>Address</b></label>
    <input type="text" placeholder="Enter address" name="address" required>
	
    <label><b>Phone</b></label>
    <input type="text" placeholder="Enter Phone" name="phone" required>	
	
    <label><b>Age</b></label>
    <input type="text" placeholder="Enter Age" name="Age" required>

    <button type="submit" class="signupbtn" name="submit">Create My Account</button>
  </div>
</form>

<?php
$link = mysqli_connect("localhost","root","","food kingdom");

if(!$link){
/* 	die("Error: ".mysqli_connect_error()); */
echo 'Not connected to server';
}
if(isset($_POST['submit'])){
	$cname = $_POST['customername'];
	$email = $_POST['email'];
	$password = $_POST['psw'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$age = $_POST['Age'];
	
	$sql = "INSERT INTO customer (customerName, customerAddress, customerPhone, customerAge, customerEmail) VALUES('$cname','$address','$phone','$age','$email')";
	
	if(!mysqli_query($link,$sql)){
	echo 'Not inserted';
	}
	else{
	$sql1 = "Select customer_ID from customer where customerName = '$cname' and customerAddress = '$address' and customerPhone = '$phone' and customerAge = '$age' and customerEmail = '$email'";	
	$res = mysqli_query($link,$sql1);
		if (mysqli_num_rows($res) == 1) 
                $row = mysqli_fetch_array($res);
	$customerID = $row[0];
	$sql2 = "INSERT INTO user_authentication (email, pass, customer_ID) VALUES('$email','$password','$customerID')";
	mysqli_query($link,$sql2);
	header("refresh:0; url=login.php");
	}
}
?>
</body>
</html>