<?php
session_start();
if(empty($_SESSION['cid'])){
	header("refresh:0; url=login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link type="text/css" href="css/style1.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Germania+One" rel="stylesheet">
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
        <li><a href="MyOrder.php">My Order</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php">profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="Home.php">Dashboard</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<?php
}
?>

<div class="background_image">
<div class="overlay">
<div class="container">
<div class="content col-md-10">
<h1>Are you Hungry</h1>
<!-- <select class="dropdownSelectFood">
  <option value="Drinks">Drinks</option>
  <option value="Breakfast">Breakfast</option>
  <option value="Lunch">Lunch</option>
  <option value="Dinner">Dinner</option>
  <option value="Fast Food">Fast Food</option>
  <option value="Desserts">Desserts</option>
</select> -->
<input class="btnShowFood" type="button" value="Show Me Food" onclick="redirect()"/>
</div>
</div>
</div>
</div>

<div class="portfolio">
<div class="container1">
<div class="content_text">
<h1>Find our resturant in different places.<h1>
</div>
</div>

<div class="content_image">
<div class="img_size">
<img src="img/r1.jpg" alt="one"/>
</div>
<div class="img_size">
<img src="img/r2.jpg" alt="two"/>
</div>
<div class="img_size">
<img src="img/r3.jpg" alt="three"/>
</div>
<div class="img_size">
<img src="img/r4.jpg" alt="four"/>
</div>
<div class="img_size">
<img src="img/r5.jpg" alt="five"/>
</div>
<div class="img_size">
<img src="img/r6.jpg" alt="six"/>
</div>
<div class="img_size">
<img src="img/r7.jpg" alt="seven"/>
</div>
<div class="img_size">
<img src="img/r8.jpg" alt="eight"/>
</div>
</div>
</div>

<div class="container1">
<div class="content_text_Design">
<h1>Deliver your food anywhere you want.<h1>
</div>
</div>

<div class="deliverfood">
<div class="overlay_next">
<div class="container1">
<div class="class_content">
<p>A restaurant, or an eatery, is a business which prepares and serves food and drinks to customers in exchange for money. Meals are generally served and eaten on the premises</p>
<button class="btn_start" type="button" onclick="window.open('https://google.com')">Select a Food Item</button>
</div>
</div>
</div>
</div>

<div class="container1">
<div class="content_text_Devolopment">
<h1>Get Discount On Order<h1>
</div>
</div>

<div class="foodDiscount">
<div class="overlay_discountfood">
<div class="container1">
<div class="class_content_two">
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
<button class="btn_find" type="button" onclick="window.open('https://google.com')">Get Some Cash Back</button>
</div>
</div>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script>
function redirect() {
    window.location.href = 'delivery.php';
}
</script>

</body>
<footer class="Foot">
<p>&copyCreated by sudipta kumar bhowmick. 152-35-1133</p>
</footer>
</html>