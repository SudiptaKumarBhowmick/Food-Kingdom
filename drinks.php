
<?php 
 session_start(); 
if(empty($_SESSION['cid'])){
	header("refresh:0; url=login.php");
}
if(!empty($_GET["lv"]))
	$_SESSION["location"] = $_GET["lv"];
 
 $connect = mysqli_connect("localhost", "root", "", "food kingdom");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="drinks.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="drinks.php"</script>';  
                }  
           }  
      }  
 } 
$avd = new addValueToDatabase; 
if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "confirm")  
      {  
			date_default_timezone_set("Asia/Dhaka");
			$datetime = date("Y-m-d h:i:sa");
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                $avd->addvalue($values["item_id"], $values["item_name"], $values["item_price"] , $_SESSION['cid'], $_SESSION["location"], $datetime, 1, 'NotDelivered');
           }
			header("refresh:0; url=profile.php");
      }  
 } 
 ?>  
<?php
 
class addValueToDatabase{
/* 	public $cID = $_SESSION['userid'];
	public $location = $_SESSION["location"]; */
	
	//function to add value
function addvalue($foodID, $foodName, $foodPrice, $customerID, $location, $orderDateTime, $processorID, $OrderDelivery) { 
/* 	$result = array();
	$query = mysqli_query($db_handle->connectDB(),"Select * from food where code = '$value'");
	while ( $row = mysqli_fetch_array($query, MYSQLI_ASSOC) )
		$ID = $row['ID'];
		$Name = $row['name'];
		$Price = $row['price'];
	
	mysqli_query($db_handle->connectDB(),"INSERT INTO order_food (food_ID,food_Name,food_Price,customer_ID,orderLocation) 
		values('$ID', '$Name', '$Price', '$sessionID' , '$sessionLocation')");
    } */
	
	 $connect = mysqli_connect("localhost", "root", "", "food kingdom"); 
	$query1 = "Insert into order_food (food_ID,food_Name,food_Price,customer_ID,processor_ID,orderDelivery,orderLocation, orderDateTime)
	values ('$foodID', '$foodName', '$foodPrice', '$customerID', '$processorID', '$OrderDelivery' , '$location', '$orderDateTime')";
	$result = mysqli_query($connect, $query1);
}
}

?>
 
 

<!DOCTYPE html>
<html>
<head>
<title>Drinks</title>
<link href="css/bootstrap.min.css" rel="stylesheet"/>
<link type="text/css" href="css/style1.css" rel="stylesheet"/>
<link type="text/css" href="css/shoppingCart.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,500,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
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
        <li><a href="#">My Order</a></li>
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



<div class="cover_image">
<div class="image_overlay">
<div class="image_container">
<div class="image_content">
<h1>Order your favourite Food.</h1>
<h2>Get free delivery for all product.</h2>
</div>
</div>
</div>
</div>

<div class="searchDrinks">
<form>
<input class="searchboxDrinks" type="text" placeholder="Search..">
<input class="btnShowdrinks" type="button" value="Show Me drinks"/>
</form>
</div>

<div class="drinks_header">
<h1>Order Food.</h1>
</div>

<br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Food Cart</h3><br />  
                <?php  
                $query = "SELECT * FROM food ORDER BY id ASC";  
                $result = mysqli_query($connect, $query);  
                if(mysqli_num_rows($result) > 0)  
                {  
                     while($row = mysqli_fetch_array($result))  
                     {  
                ?>  
                <div class="col-md-4">  
                     <form method="post" action="drinks.php?action=add&id=<?php echo $row["ID"]; ?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <img src="<?php echo $row["image"]; ?>" class="img-responsive" /><br />  
                               <h4 class="text-info"><?php echo $row["name"]; ?></h4>  
                               <h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>  
                               <input type="text" name="quantity" class="form-control" value="1" />  
                               <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />  
                               <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />  
                               <input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />  
                          </div>  
                     </form>  
                </div>  
                <?php  
                     }  
                }  
                ?>  
                <div style="clear:both"></div>  
                <br />  
                <h3>Order Details</h3>  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="40%">Item Name</th>  
                               <th width="10%">Quantity</th>  
                               <th width="20%">Price</th>  
                               <th width="15%">Total</th>  
                               <th width="5%">Action</th>  
                          </tr>  
                          <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $values["item_name"]; ?></td>  
                               <td><?php echo $values["item_quantity"]; ?></td>  
                               <td>$ <?php echo $values["item_price"]; ?></td>  
                               <td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>  
                               <td><a href="drinks.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                          </tr>  
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>  
                          <tr>  
                               <td colspan="3" align="right">Total</td>  
                               <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                               <td><a href="drinks.php?action=confirm&id="><span class="text-success">Submit</span></a></td> 
                          </tr>  
                          <?php  
                          }  
                          ?>  
                     </table>  
                </div>  
           </div>  
           <br />  

</body>
</html>