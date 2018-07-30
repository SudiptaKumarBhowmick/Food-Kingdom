<?php
session_start();
if(empty($_SESSION['sid'])){
	header("refresh:0; url=login.php");
}
require_once("dbcontroller.php");
$db_handle = new DBController();
	$id = $_SESSION['sid'];
    $query = "SELECT * FROM supplier WHERE supplier_ID = '$id'";
    $res = mysqli_query($db_handle->connectDB(), $query);	
	if (mysqli_num_rows($res) == 1) 
                $row = mysqli_fetch_array($res);
?>
<?php
if(isset($_POST["DeliveryStateValue"])){
	$supplierID = $_SESSION['sid'];
	$squery = "update supplier set DeliveryState = 'NotInDelivery' where supplier_ID = '$supplierID'";
    $sres = mysqli_query($db_handle->connectDB(), $squery);	
	$ofquery = "update order_food set orderDelivery = 'Delivered' where supplier_ID = '$supplierID'";
    $ofres = mysqli_query($db_handle->connectDB(), $ofquery);
		if($sres && $ofres)
			echo "<script type='text/javascript'>alert('Thanks for Delivery.')</script>";
}
?>
<!doctype html>
<html>
<head>
<link type="text/css" href="css/style1.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Germania+One" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
              input.hidden {
    position: absolute;
    left: -9999px;
}

#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
	border:2px solid #03b1ce ;}
	.tital{ font-size:16px; font-weight:500;}
	 .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}
</style>
</head>

<body>

<?php
if(empty($_SESSION['email'])){

?>
<div class="Navbar">
<div class="container1">
<div class="icon">
<h3>Food Kingdom</h3>
</div>
<div class="menubar">
<ul>
<li><a href="LogIn.html">LogIn</a></li> <span> | </span>
<li><a href="SignUp.html">Sign Up</a></li>
</ul>
</div>
</div>
</div>
<?php
}
else{
	
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Food Kingdom</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="SupplierProfile.php">profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="OrderDelivery.php">Order trace</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
}
?>

<div class="container">
	<div class="row">
        
       <div class="col-md-7 ">

<div class="panel panel-default">
  <div class="panel-heading">  <h4 >Supplier</h4></div>
   <div class="panel-body">
       
    <div class="box box-info">
        
            <div class="box-body">
                     <div class="col-sm-6">
                     <div  align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> 
                
                <input id="profile-image-upload" class="hidden" type="file">
<div style="color:#999;" >click here to change profile image</div>
                <!--Upload Image Js And Css-->
</div>
<br>
    
              <!-- /input-group -->
            </div>
            <div class="col-sm-6">
            <h4 style="color:#00b1b1;"><?php echo $row[1] ?> </h4></span>
              <span><p>Supplier</p></span>            
            </div>
            <div class="clearfix"></div>
            <hr style="margin:5px 0 5px 0;">
    
              
<div class="col-sm-5 col-xs-6 tital " >Name:</div><div class="col-sm-7 col-xs-6 "><?php echo $row[1] ?></div>
     <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Phone:</div><div class="col-sm-7"> <?php echo $row[3] ?> </div>
  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Age:</div><div class="col-sm-7"><?php echo $row[2] ?> </div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >Email:</div><div class="col-sm-7"><?php echo $row[4] ?> </div>

  <div class="clearfix"></div>
<div class="bot-border"></div>

<div class="col-sm-5 col-xs-6 tital " >DeliveryState:</div><div class="col-sm-7"><?php echo $row[5] ?> </div>

 <div class="clearfix"></div>


            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
       
            
    </div> 
    </div>
</div>  
    <script>
              $(function() {
    $('#profile-image1').on('click', function() {
        $('#profile-image-upload').click();
    });
});       
    </script> 
       
   </div>
</div>
<?php
    $oquery = "SELECT DISTINCT customer_ID ,orderLocation from order_food where supplier_ID ='$id' and orderDelivery='NotDelivered'";
    $ores = mysqli_query($db_handle->connectDB(), $oquery);	
	if (mysqli_num_rows($ores) == 1) 
                $row1 = mysqli_fetch_array($ores);
	if (!empty($row1)){ 
	$cquery = "SELECT customerName, customerPhone, customerEmail from customer where customer_ID = '$row1[0]'";
	$cres = mysqli_query($db_handle->connectDB(), $cquery);	
		if (mysqli_num_rows($cres) == 1) 
                $row2 = mysqli_fetch_array($cres);
	}
?>
<?php
if (empty($row1) && empty($row2)) {
     echo "<h2>There is no product for delivery.</h2>";
}
else{
?>
<div style="background-color:#f2f2f2; width: 100%; margin:0 auto; padding:50px;">
<h3>Delivery Details:</h3>
<p>you have assigned for a delivery.<p>
<p>Delivery location: <?php echo $row1[1]?></p>
<p>Customer Name: <?php echo $row2[0]?></p>
<p>Customer Phone: <?php echo $row2[1]?></p>
<p>Customer Email: <?php echo $row2[2]?></p>
</div>
<form action="SupplierProfile.php" method="post">
	<input style="margin: 26px;padding:10px 21px;font-weight:bold;background-color:#08B2CF;border-color:#08B2CF;color:#fff;font-size:16px;" type="submit" id="btnSubmit" name="DeliveryStateValue" value="Delivered Product" />
</form>
<?php 
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>