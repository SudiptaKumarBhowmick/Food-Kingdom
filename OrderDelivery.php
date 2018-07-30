<?php
session_start();
if(empty($_SESSION['sid'])){
	header("refresh:0; url=login.php");
}
$id = $_SESSION['sid'];
$link1 = mysqli_connect("localhost","root","","food kingdom");
$queryd = "SELECT customer_ID FROM order_food WHERE supplier_ID = '$id' AND orderDelivery = 'NotDelivered'";
$resd = mysqli_query($link1, $queryd);	
$rowd = mysqli_fetch_array($resd);
if(empty($rowd)){
	header("refresh:0; url=SupplierProfile.php");
}
?>
<!doctype html>
<head>
<title>Delivery</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link type="text/css" href="css/style1.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
</head>
<body>
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
        <li><a href="#">My Order</a></li>
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


<p id="demo"></p>
<p id="demo1"></p>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
var currPosition;
navigator.geolocation.getCurrentPosition(function(position) {
    updatePosition(position);
    setInterval(function(){
        var lat = currPosition.coords.latitude;
        var lng = currPosition.coords.longitude;
/* 		document.getElementById("demo").innerHTML = lat;
		document.getElementById("demo1").innerHTML = lng; */
		setTimeout(function(){
            var url = "OrderDelivery.php?lat=" + lat+"&lng="+lng;
            window.location.href = url;
}, 5000);
        jQuery.ajax({
            type: "POST", 
            url:  "/tracker/map.php", 
            data: 'x='+lat+'&y='+lng, 
            cache: false
        });
    }, 1000);
}, errorCallback); 

var watchID = navigator.geolocation.watchPosition(function(position) {
    updatePosition(position);
});

function updatePosition( position ){
    currPosition = position;
}

function errorCallback(error) {
    var msg = "Can't get your location. Error = ";
    if (error.code == 1)
        msg += "PERMISSION_DENIED";
    else if (error.code == 2)
        msg += "POSITION_UNAVAILABLE";
    else if (error.code == 3)
        msg += "TIMEOUT";
    msg += ", msg = "+error.message;

    alert(msg);
}
</script>


<?php
$link = mysqli_connect("localhost","root","","food kingdom");


$query = "SELECT customer_ID FROM order_food WHERE supplier_ID = '$id' AND orderDelivery = 'NotDelivered'";
$res = mysqli_query($link, $query);	
$row = mysqli_fetch_array($res);
echo "Your location is tracing....</br>";
if(count($_GET) == 2){
echo "latitude is:".$_GET["lat"]." and</br>";
echo "longitude is:".$_GET["lng"]."</br>";

		$latitude = $_GET["lat"];
		$longitude = $_GET["lng"];
		$qe = "Insert into tracelocation(customer_ID, supplier_ID,lat,lng) values('$row[0]','$id','$latitude','$longitude')";
		$res1 = mysqli_query($link, $qe);
}
?>


<div class="map_image">
<img style="height: 370px;width: 620px;" src="img/map.png" alt="one"/>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>