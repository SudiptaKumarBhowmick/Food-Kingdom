<?php
session_start();
if(empty($_SESSION['cid'])){
	header("refresh:0; url=login.php");
}
else{
	$link = mysqli_connect("localhost","root","","food kingdom");

$query = "SELECT lat,lng FROM tracelocation ORDER BY ID DESC LIMIT 1";
$res = mysqli_query($link, $query);	
$row = mysqli_fetch_array($res);
if($row)
	// echo $row[0]."</br>";
	$latt = $row[0];
	// echo $row[1]."</br>";
	$lngi = $row[1];
	// echo "value: </br>";
	// echo $latt."</br>";
	// echo $lngi."</br>";


}
?>
<!doctype html>
<head>
<title>Delivery</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link type="text/css" href="css/style1.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>

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
            <li><a href="profile.php">profile</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="home.php">Dashboard</a></li>
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
		setTimeout(function(){
            var url = "MyOrder.php";
            window.location.href = url;
}, 5000);
</script>


<div id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: <?php echo $latt ?>, lng: <?php echo $lngi ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvzcq196Jiku09j0TambANWIeA4FJJMo4&libraries=places&callback=initMap">
    </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>